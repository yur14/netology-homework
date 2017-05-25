<?php
class Tasks
{
    private $db;
    private $orderBy;
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Получение задач, созданных пользователем
     * @return array
     */
    public function tasksCreatedByUser() {
    $this->sortBy();
    if (isset ($this->orderBy)) {
        $sth = $this->db->pdo->prepare(
            "SELECT t.id AS id, t.description AS description, t.is_done AS is_done, t.date_added AS date_added, u.login AS responsible
            FROM task AS t
            JOIN user AS u ON u.id = t.assigned_user_id
            WHERE t.user_id = ?
            $this->orderBy");
    } else {
        $sth = $this->db->pdo->prepare(
            "SELECT t.id AS id, t.description AS description, t.is_done AS is_done, t.date_added AS date_added, u.login AS responsible
            FROM task AS t
            JOIN user AS u ON u.id = t.assigned_user_id
            WHERE t.user_id = ?
            ORDER BY t.date_added DESC");
    }
    $sth->bindValue(1, $_SESSION['user_id'], PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $result = $this->statusNumbersToWords($result);
    return $result;
    }

    /**
     * Получение задач, где пользователь назначен исполнителем
     * @return array
     */
    public function tasksWhereUserIsResponsible() {
        $this->sortBy();
        if (isset ($this->orderBy)) {
            $sth = $this->db->pdo->prepare(
                "SELECT t.id AS id, t.description AS description, t.is_done AS is_done, t.date_added AS date_added, u.login AS author
                FROM task AS t
                JOIN user AS u ON u.id = t.user_id
                WHERE t.assigned_user_id = ?
                $this->orderBy");
        } else {
            $sth = $this->db->pdo->prepare(
                "SELECT t.id as id, t.description AS description, t.is_done AS is_done, t.date_added AS date_added, u.login AS author
                FROM task AS t
                JOIN user AS u ON u.id = t.user_id
                WHERE t.assigned_user_id = ?
                ORDER BY t.date_added DESC");
        }
        $sth->bindValue(1, $_SESSION['user_id'], PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        $result = $this->statusNumbersToWords($result);
        return $result;
    }

    /**
     * Получаем всех пользователей (id, username) для выпадающего меню при назначении исполнителя
     * @return array
     */
    public function getAllUsers()
    {
        $sth = $this->db->pdo->prepare("SELECT id as user_id, login as username FROM user ORDER BY login");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Меняем статусы с чисел (как они в базе) на слова
     * @param $allTasks
     * @return array
     */
    protected function statusNumbersToWords($allTasks) {
        foreach ($allTasks as $key => $task) {
            switch ($task['is_done']) {
                case 0:
                    $allTasks[$key]['is_done'] = 'Не выполнено';
                    break;
                case 1:
                    $allTasks[$key]['is_done'] = 'В процессе';
                    break;
                case 2:
                    $allTasks[$key]['is_done'] = 'Выполнено';
                    break;
            }
        }
        return $allTasks;
    }

    /**
     * Сортировка задач
     * @return void
     */
    protected function sortBy() {
        if (isset($_POST['sort_by'])) {
            switch ($_POST['sort_by']) {
                case 'description':
                    $this->orderBy = 'ORDER BY description';
                    break;
                case 'is_done':
                    $this->orderBy = 'ORDER BY is_done';
                    break;
                case 'date_added':
                    $this->orderBy = 'ORDER BY date_added DESC';
                    break;
                default:
                    $this->orderBy = 'ORDER BY date_added DESC';
            }
        }
    }

    /**
     * Аккумулируем в этом методе все возможные действия пользователя
     * @return void
     */
    public function action() {
        $this->addNewTask();
        $this->deleteTask();
        $this->changeTask();
        $this->markAsDone();
        $this->changeResponsible();
    }

    /**
     * Добавляем новую задачу
     * @return void
     */
    protected function addNewTask() {
        if (! empty($_POST['new_task'])) {
            $newTask = htmlspecialchars(trim($_POST['new_task']));
            $sth = $this->db->pdo->prepare('INSERT INTO task (description, is_done, date_added, user_id, assigned_user_id)
            VALUES (?, 0, ?, ?, ?)');
            $sth->bindValue(1, $newTask, PDO::PARAM_STR);
            $sth->bindValue(2, date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $sth->bindValue(3, $_SESSION['user_id'], PDO::PARAM_INT);
            $sth->bindValue(4, $_SESSION['user_id'], PDO::PARAM_INT);
            $sth->execute();
        }
    }

    /**
     * Маркируем задачу как выполненную
     * @return void
     */
    protected function markAsDone() {
        if (isset($_POST['mark_as_done'])) {
            $sth = $this->db->pdo->prepare('UPDATE task
            SET is_done = 2
            WHERE id = :num
            LIMIT 1;');
            $sth->bindValue(':num', $_POST['mark_as_done'], PDO::PARAM_INT);
            $sth->execute();
        }
    }

    /**
     * Вносим изменения в существующие задачу: дата, описание, статус
     * @return void
     */
    protected function changeTask() {
        if (isset($_POST['new_date_added']) || isset($_POST['new_description']) || isset($_POST['new_is_done']))
        {
            $newDateAdded = htmlspecialchars(trim($_POST['new_date_added']));
            //проверяем валидность даты
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $newDateAdded);
            if (!$date) {
                echo "Формат даты не валидный, формат нужен такой: Y-m-d H:i:s";
                $newDateAdded = date('Y-m-d H:i:s');
            }
            $newDescription = htmlspecialchars(trim($_POST['new_description']));
            $sth = $this->db->pdo->prepare('UPDATE task
            SET date_added = :date,
            description = :desc,
            is_done = :status
            WHERE id = :num
            LIMIT 1;');
            $sth->bindValue(':num', $_POST['change_id'], PDO::PARAM_INT);
            $sth->bindValue(':date', $newDateAdded, PDO::PARAM_STR);
            $sth->bindValue(':desc', $newDescription, PDO::PARAM_STR);
            $sth->bindValue(':status', $_POST['new_is_done'], PDO::PARAM_STR);
            $sth->execute();
        }
    }

    /**
     * Вносим изменения в существующие задачу: исполнитель
     * @return void
     */
    protected function changeResponsible() {
        if (isset($_POST['new_responsible']))
        {
            $sth = $this->db->pdo->prepare('UPDATE task SET assigned_user_id = :resp
            WHERE id = :num LIMIT 1;');
            $sth->bindValue(':num', $_POST['change_id'], PDO::PARAM_INT);
            $sth->bindValue(':resp', $_POST['new_responsible'], PDO::PARAM_STR);
            $sth->execute();
        }
    }


    /**
     * Удаляем задачу
     * @return void
     */
    protected function deleteTask() {
        if (isset($_POST['delete'])) {
            $sth = $this->db->pdo->prepare('SELECT user_id FROM task WHERE id = ? LIMIT 1;');
            $sth->bindValue(1, $_POST['delete'], PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            $userId = $result[0]['user_id'];
            if ($userId == $_SESSION['user_id']) {
                $sth = $this->db->pdo->prepare('DELETE FROM task WHERE id = ? LIMIT 1;');
                $sth->bindValue(1, $_POST['delete'], PDO::PARAM_STR);
                $sth->execute();
            } else {
                $_SESSION['error'] = 'Вы не можете удалить задачу, созданную другим пользователем!';
            }
        }
    }
}
