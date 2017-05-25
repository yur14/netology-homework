<?php
class DataBase
{
    public $pdo;

    /**
     * Подключаемся к БД
     */
    public function connectToDB() {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'utf8'");
        } catch (Exception $e) {
            echo "Произошла ошибка при загрузке базы данных.";
            exit;
        }
    }

    /**
     * Получаем названия таблиц в виде ассоциированного массива
     * @return array
     */
    public function getAllTablesNames() {
        $sth = $this->pdo->prepare('SHOW TABLES');
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Получаем всю информацию о таблице
     * @param $table
     * @return mixed
     */
    public function getInfoAboutTable($tableName) {
        $sth = $this->pdo->prepare('DESCRIBE '. $tableName);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    }

    /**
     * Выводим на экран селект
     */

    public function showSelect() {
        $tables = $this->getAllTablesNames();
        echo '<form method="post">
                <label for="select_table">Выберите таблицу:</label>
                <select name="select_table">';
                foreach ($tables as $table) {
                    foreach ($table as $name) {
                        echo '<option value="' . $name . '">';
                        echo $name;
                    }
                }
            echo '</select>
        			<button type="submit" name="b_select_table" value="">Показать структуру</button>
        			<button type="submit" name="b_add_table" value="">Добавить таблицу</button>
           			<button type="submit" name="b_delete_table" value="">Удалить таблицу</button>
                </form>';
  }

    /**
     * Выводим на экран струкутру таблицы выбранной из селекта
     */

    public function showStructureFromSelect() {
        if (isset($_POST['b_select_table'])) {
            $tableName = $_POST['select_table'];
            $this->showStructure($tableName);
        }
    }

    /**
     * Выводим на экран струкутру таблицы
     */

    public function showStructure($tableName) {
        if (isset($tableName)) {
                $tableInfo = $this->getInfoAboutTable($tableName);
                echo '<h2> Выбрана таблица: ' . $tableName . ' </h2> ';
                echo '<table>
                <tr>
                    <th></th>
                    <th>Поле</th>
                    <th>Тип</th>
                    <th>NULL</th>
                    <th>Ключ</th>
                    <th>Значение по умолчанию</th>
                    <th>Дополнительно</th>
                </tr>';

                echo '<form method="post">
                <tr>';
                foreach ($tableInfo as $field) {
                    echo '<td><input type="checkbox" name="chkbox[]" value="' . $field ["Field"] . '"></td>';
                        foreach ($field as $detail) {
                            echo '<td>' . $detail . '</td>';
                        }
                echo '</tr>';
                }
                echo '</table><hr/>
                <button type="submit" name="b_delete_field" value="">Удалить выбранные поля</button>
                <button type="submit" name="b_new_field" value="">Добавить поле</button>
                </form>';
        $_SESSION['current_table'] = $tableName;
        }
    }

    /**
     * Выводим на экран форму создания новой таблицы
     */
    public function addNewTableForm() {
        if (isset($_POST['b_add_table'])) {
            echo '<hr/>
                    <form method="POST">
                        <label>Название таблицы:</label>
                        <input type="text" name="name_table" value="" placeholder="название">
       	    		    <button type="submit" name="b_add_new_table" value="">Создать</button>
                    </form>';
        }
    }

    /**
     * Создаем таблицу
     */
    public function addNewTable() {
        if (isset($_POST['b_add_new_table']))  {
            if (! empty($_POST['name_table'])) {
            $tableName = htmlspecialchars(trim($_POST['name_table']));

        	    $sql = "CREATE TABLE IF NOT EXISTS {$tableName} (`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY) ENGINE=InnoDB, COLLATE='utf8_general_ci'";
        	    $sth = $this->pdo->prepare($sql);
        	    $sth->execute();
            $this->showStructure($tableName);
            }
        }
    }

     /**
     * Удаляем таблицу
     */
    public function deleteTable() {
        if (isset($_POST['b_delete_table'])) {
            $tableName =  $_POST['select_table'];
            $sth = $this->pdo->prepare('DROP TABLE '. $tableName);
            $sth->execute();
            echo '<hr/>Таблица: <b>' . $tableName . '</b> удалена!';
        }
    }


    /**
     * выводим на экран форму добавления нового поля
     */
    public function addNewFieldForm() {
        if (isset($_POST['b_new_field']))  {
            $type_field = array("TINYINT", "SMALLINT", "MEDIUMINT", "INT", "BIGINT", "FLOAT", "DOUBLE", "DATE", "DATETIME", "TIMESTAMP", "CHAR", "VARCHAR", "TINYTEXT", "TEXT", "MEDIUMTEXT", "LONGTEXT", "BLOB");
            $tableName = $_SESSION['current_table'];
            $this->showStructure($tableName);
            echo '<table><tr>
                <th>Поле</th>
                <th>Тип</th>
                <th>NULL</th>
                <th>Значение по умолчанию</th>
                <th></th>
                </tr>';
            echo '<form method="POST">
                  <tr><td><input type="text" name="Field" value="" placeholder="Field"></td>';
			echo '<td><select name="Field_type">';
				foreach ($type_field as $typeName) {
					echo '<option value="' . $typeName . '">' . $typeName . '</option>';
				}
        	echo '</select></td>
					<td><input type="checkbox" name="chbx" value="NULL"></td>
					<td><input type="text" name="Default" value="" placeholder="Default"></td>
					<td><button type="submit" name="b_add_new_field" value="">Добавить</button></td></tr>
			</form>';
        }
    }

    /**+++
     * добавляем новое поле
     */
    public function addNewField() {
        if (isset($_POST['b_add_new_field']))  {
        $tableName = $_SESSION['current_table'];
    //тут надо сделать кучу проверок на правильность ввода полей и соответствия типам
            if (! empty($_POST['Field'])) {
            $field = htmlspecialchars(trim($_POST['Field']));
            $field_type =  $_POST['Field_type'];
                if (isset($_POST['chbx'])) {
                    $m_default = 'NULL';
                    $default = 'NULL';
	            } else {
                    $m_default = 'NOT NULL';
                    $default = htmlspecialchars(trim($_POST['Default']));
        	    }
      	    $sql = 'ALTER TABLE ' . $tableName . ' ADD COLUMN ' . $field . ' ' . $field_type . ' ' . $m_default . ' ' . $default;
            echo '<hr/>' . $sql;
       	    $sth = $this->pdo->prepare($sql);
       	    $sth->execute();
            $this->showStructure($tableName);
            } else { echo '<hr/> Поле Field обязательно для заполнения! <hr/>';
            $this->showStructure($tableName);
            }
        }
    }

    /**
     * удаляем поле
     */
    public function deleteField() {
		if (isset($_POST['b_delete_field'])) {
            $fields = $_POST['chkbox'];
                if (! empty ($fields)) {
                    $tableName = $_SESSION['current_table'];
                    foreach ($fields as $field) {
                        $sql = 'ALTER TABLE ' . $tableName . ' DROP COLUMN ' . $field;
                   	    $sth = $this->pdo->prepare($sql);
        	            $sth->execute();
                    }
                } else {
                    echo 'Надо выбрать хотя бы одно поле!';
                }
        $this->showStructure($tableName);
        }
    }

    /**
     * Аккумулируем в этом методе все возможные действия пользователя
     * @return void
     */
    public function actions() {
        $tableName = NULL;
        $this->showSelect();
        $this->showStructureFromSelect();
        $this->showStructure($tableName);
        $this->addNewTableForm();
        $this->addNewTable();
        $this->deleteTable();
        $this->addNewFieldForm();
        $this->addNewField();
        $this->deleteField();
    }
}




