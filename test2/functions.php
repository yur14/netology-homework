<?php
function showUploadedTests ($uploadDir) {

    if ($handle = opendir($uploadDir)) {

        $i = 1;
        $tests = [];

        while (false !== ($entry = readdir($handle))) {

            $sourceFileName = basename($entry);
            $sourceFileType = substr($sourceFileName, -4, 4);

        echo "<ul>";

            if ($sourceFileType === 'json')
            {
                $tests[$i] = $sourceFileName;
                echo "<li>Тест $i</li>";
                $i++;
            }

            echo "</ul>";
        }
    }

    return $tests;
}

function checkAnswers ($submittedAnswer, $correctAnswer) {
    if (!empty($submittedAnswer)) {
        $submittedAnswer = mb_strtolower($submittedAnswer, "UTF-8");
        $correctAnswer = mb_strtolower($correctAnswer, "UTF-8");
        if ($submittedAnswer == $correctAnswer) {
            echo "<i>Верно!</i></br>";
        } else {
            echo "<i>Неверно</i></br>";
            $GLOBALS['incorrectAnswer'] = true;
        }
    }
}

function notAllFieldsFilled ($jsonDecoded) {
    foreach ($jsonDecoded as $question) {
        if (empty($_POST["answer_$question[id]"])) {
            $notAllFieldsFilled = true;
            return $notAllFieldsFilled;
        }
    }
}

function showTest ($jsonDecoded) {

    echo "<form method=\"post\">";

    foreach ($jsonDecoded as $question) {
        if (!empty($_POST)) {
            $usersAnswer = $_POST["answer_$question[id]"];
        } else {
            $usersAnswer = "";
        }
        echo "<dl><dt><label for=\"answer_$question[id]\">Вопрос № $question[id]. $question[question]</label></dt>";
        echo "<dd><input id=\"answer_$question[id]\" name=\"answer_$question[id]\" value=\"$usersAnswer\"/></dd></dl>";
        if (notAllFieldsFilled($jsonDecoded) !== true) {
            checkAnswers ($usersAnswer, $question['answer']);
        }
    }

    if (notAllFieldsFilled($jsonDecoded) == true) {
        echo "</br>";
        echo "<button type=\"submit\">Проверить</button>";
    }

    echo "</form></br>";

    if (notAllFieldsFilled($jsonDecoded) == true && !empty($_POST)) {
        echo "Прежде чем проверить тест, ответьте, пожалуйста, на все вопросы";
    }

    if (notAllFieldsFilled($jsonDecoded) !== true && !isset($GLOBALS['incorrectAnswer'])) {
        echo '<form method="post" action="certificate.php">
        <label for="testNumber">Для получения сертификата введите свое полное имя:</label>
        <input id="usersName" name="usersName" />
        <button type="submit">Создать сертификат</button>
        </form>';
    }

}

function imageTextCenter ($imagePath, $fontPath, $fontSize, $text, $heightParam) {
    // Получаем размер изображения
    list($imgWidth, $imgHeight,,) = getimagesize(realpath(__DIR__ . $imagePath));
    // Подключаем изображение
    $image = imagecreatefrompng(realpath(__DIR__ . $imagePath));
    // Подключаем шрифт, настраиваем цвет
    $realFontPath = realpath(__DIR__ . $fontPath);
    $textColor = imagecolorallocate($image, 00, 00, 00);
    // Центрируем текст по ширине
    $p = imagettfbbox($fontSize,0,$realFontPath,$text);
    $txt_width=$p[2]-$p[0];
    $x = ($imgWidth - $txt_width) / 2;
    // Настраиваем высоту
    $y = $imgHeight * $heightParam;
    // Вставляем текст
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $realFontPath, $text);
    imagepng($image);
    imagedestroy($image);
}
