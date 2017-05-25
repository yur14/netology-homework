<?php
class Authorization
{
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Проверяем, авторизован ли пользователь
     */
    public function isLogged() {
        if (empty($_SESSION['user_id'])) {
            header('Location: login.php');
        }
    }

    /**
     * Регистрация нового пользователя
     */
    public function signUp() {
        if (! empty($_POST['username']) && ! empty($_POST['password'])) {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = $_POST['password'];
            // Проверяем имя пользователя
            if ($this->ifUsernameAlreadyExists($username) == true) {
                $_SESSION['error_reg'] = 'Выбранное имя пользователя уже занято';
            return false;
            }
            //шифруем пароль
            $pass = md5($_POST['password']); //шифруем пароль
            $pass = strrev($pass); // для надежности добавим реверс
            $pass = $pass."1qaz"; //добавим соли

            // Отправляем логин и пароль в базу. Авторизируем пользователя и пересылаем на главную.
            // Добавляем пользователя
            $sth = $this->db->pdo->prepare('INSERT INTO user (login, password) VALUES (:username, :pass)');
            $sth->bindValue(':username', $username, PDO::PARAM_STR);
            $sth->bindValue(':pass', $pass, PDO::PARAM_STR);
            $sth->execute();
            // Достаем id для сохранения в глобальную переменную сессии
            $sth = $this->db->pdo->prepare('SELECT id FROM user WHERE login = :username');
            $sth->bindValue(':username', $username, PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $username;
            header('Location: index.php');
        }
    }

    /**
     * Проверка логина и пароля при авторизации
     */
    public function checkLogin() {
        if (! empty($_POST['username']) && ! empty($_POST['password'])) {
            $username = $username = htmlspecialchars(trim($_POST['username']));
            $password = $_POST['password'];

            //шифруем пароль для проверки
            $pass = md5($_POST['password']); //шифруем пароль
            $pass = strrev($pass); // для надежности добавим реверс
            $pass = $pass."1qaz"; //добавим соли

            $sth = $this->db->pdo->prepare('SELECT id, password FROM user WHERE login = :username');
            $sth->bindValue(':username', $username, PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            $user_pass = $result['password'];

            if ($user_pass == $pass) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $username;
                header('Location: index.php');
            } else {
                $_SESSION['error_login'] = 'Неверные логин или пароль';
            }
        }
    }

    /**
     * Проверка, существует ли уже пользователь с таким именем
     * @param $username
     * @return bool
     */
    protected function ifUsernameAlreadyExists($username) {
        $sth = $this->db->pdo->prepare('SELECT * FROM user WHERE login = :username');
        $sth->bindValue(':username', $username, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if (! empty($result)) {
            return true;
        } else {
          return false;
        }
    }
}
