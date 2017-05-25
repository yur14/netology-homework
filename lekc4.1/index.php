<?php
    session_start();
    error_reporting(E_ALL);
    require_once "autoload.php";
    require_once "config.php";
    $db = new DataBase();
    $db->connectToDB();
// Проверяем авторизацию
    $auth = new Authorization($db);
    $auth->isLogged();

    $tasks = new Tasks($db);
    $tasks->action();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>TO-DO List</title>
        <style>
    table {
        border-spacing: 0;
        border-collapse: collapse;
    }
    table td, table th {
        border: 1px solid #ccc;
        padding: 5px;
    }
    table th {
        background: #eee;
    }
        </style>
    </head>
<body>
<center>
<h1>Добро пожаловать, <?php echo $_SESSION['username'] ?>!</h1>
<table>
    <tr><td>
        <form method="POST">
            <label for="new_task">Новая задача: </label><input type="text" name="new_task" value=""/>
            <input type="submit" name="save" value="Добавить"/>
        </form>
    </td><td>
        <form method="POST">
            <label for="sort">Сортировать по:</label>
            <select name="sort_by">
                <option value="date_added">Дате добавления</option>
                <option value="is_done">Статусу</option>
                <option value="description">Описанию</option>
            </select>
            <input type="submit" name="sort" value="Отсортировать" />
        </form>
    </td><td>
        <a href="logout.php">Выйти из учетной записи</a>
    </td></tr>
</table>

<?php if(isset($_SESSION['error'])):?>
    <h1><?php echo $_SESSION['error'] ?></h1>
<?php endif; ?>

<?php
// Загружаем данные из БД: задачи созданные текущим юзером
$tasksCreatedByUser = $tasks->tasksCreatedByUser();
?>
<hr/>
<h1>Все назначенные вам задачи:</h1>

<?php
// Загружаем данные из БД: задачи назначенные текущему юзеру
$tasksWhereUserIsResponsible = $tasks->tasksWhereUserIsResponsible(); ?>
<table>
    <tr>
        <th>Дата добавления</th>
        <th>Описание задачи</th>
        <th>Статус</th>
        <th>Задачу создал</th>
        <th>Действия</th>
    </tr>
<?php foreach ($tasksWhereUserIsResponsible as $task): ?>
    <tr><td>
        <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
    <form method="post">
        <input style="text-align: left" type="text" name="new_date_added" value="<?php echo $task['date_added']?>">
    <?php else: echo $task['date_added']; endif; ?>
    </td><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
        <input type="text" name="new_description" value="<?php echo $task['description']?>">
    <?php else: echo $task['description']; endif; ?>
    </td><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
        <select name="new_is_done">
            <option value="0">Не выполнено</option>
            <option value="1">В процессе</option>
            <option value="2">Выполнено</option>
        </select>
    <?php else: echo $task['is_done']; endif; ?>
    </td><td>
    <?php if ($task['author'] == $_SESSION['username']) : echo 'Я'; else : echo $task['author']; endif;  ?>
    </td><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
        <button type="submit" name="change_id" value="<?php echo $task['id']?>">Сохранить</button>
        <button type="submit" name="change_id" value="">Отмена</button>
    </form>
    <?php else: ?>
    </form>
    <form method="post">
    <?php if ($task['is_done'] !== 'Выполнено') : ?>
        <button type="submit" value="<?php echo $task['id']?>" name="mark_as_done">Выполнить</button>
    <?php endif; ?>
        <button type="submit" value="<?php echo $task['id']?>" name="change">Изменить</button>
        <button type="submit" value="<?php echo $task['id']?>" name="delete">Удалить</button>
    </form>
    <?php endif; ?>
    </td></td></tr>
<?php endforeach; ?>
</table>
<hr/>
<h1>Все созданные вами задачи:</h1>

<table>
    <tr>
        <th>Дата добавления</th>
        <th>Описание задачи</th>
        <th>Статус</th>
        <th>Исполнитель</th>
        <th>Действия</th>
    </tr>

<?php foreach ($tasksCreatedByUser as $task): ?>
    <tr><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
    <form method="post">
        <input type="text" name="new_date_added" value="<?php echo $task['date_added']?>">
    <?php else: echo $task['date_added']; endif; ?>
    </td><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
        <input type="text" name="new_description" value="<?php echo $task['description']?>">
    <?php else: echo $task['description']; endif; ?>
    </td><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
        <select name="new_is_done">
            <option value="0">Не выполнено</option>
            <option value="1">В процессе</option>
            <option value="2">Выполнено</option>
        </select>
    <?php else: echo $task['is_done']; endif; ?>
    </td><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']):
        $users = $tasks->getAllUsers(); ?>
        <select name="new_responsible">
    <?php foreach ($users as $user):?>
            <option value="<?php echo $user['user_id'] ?>"><?php echo $user['username'] ?></option>
    <?php endforeach; ?>
        </select>
    <?php elseif($task['responsible'] == $_SESSION['username']) : echo 'Я'; else : echo $task['responsible']; endif; ?>
    </td><td>
    <?php if (isset($_POST['change']) && $_POST['change'] == $task['id']): ?>
        <button type="submit" name="change_id" value="<?php echo $task['id']?>">Сохранить</button>
        <button type="submit" name="change_id" value="">Отмена</button>
    </form>
    <?php else: ?>
    </form>
    <form method="post">
    <?php if ($task['is_done'] !== 'Выполнено') : ?>
        <button type="submit" value="<?php echo $task['id']?>" name="mark_as_done">Выполнить</button>
    <?php endif; ?>
        <button type="submit" value="<?php echo $task['id']?>" name="change">Изменить</button>
        <button type="submit" value="<?php echo $task['id']?>" name="delete">Удалить</button>
    </form>
    <?php endif; ?>
    </td></td></tr>
<?php endforeach; ?>
</table>
</center>
</body>
</html>
<?php $_SESSION['error'] = ''; ?>
