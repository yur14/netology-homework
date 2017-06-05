<?php

class News
{
    protected $id;
    protected $date;
    protected $title;
    protected $author;
    protected $body;

    public function __construct($id, $date, $title, $author, $body)
    {
        $this->id = $id;
        $this->date = $date;
        $this->title = $title;
        $this->author = $author;
        $this->body = $body;
    }

    /**
     * @param mixed $author
     */
    protected function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @param mixed $body
     */
    protected function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @param mixed $date
     */
    protected function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $title
     */
    protected function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    protected function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    protected function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    protected function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    protected function getTitle()
    {
        return $this->title;
    }

    protected function getComments ($comments) {

        ?>
        <tr>
            <td colspan="2">
                <b>Комментарии:</b> <br>
                <?php if(isset($comments[$this->id])) {
                    echo '<table>';
                    $i = 0;
                    foreach ($comments[$this->id] as $comment) {
                        $comments[$this->id][$i] = $comment;
                        $comments[$this->id][$i]->showComment();
                        $i++; }
                    echo '</table>';
                    }  else {
                    echo '<br>';
                    echo '<i>Нет комментариев</i>';
                    } ?>
            </td>
        </tr>
        <?php
    }

    public function showNews ($comments) {
        ?>
        <table>
            <tr>
                <td colspan="2">
                    <h2><?= $this->getTitle() ?></h2>
                </td>
            </tr>
            <tr>
                <td>
                    Дата: <?= $this->getDate() ?>
                </td>
                <td>
                    Источник: <?= $this->getAuthor() ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $this->getBody() ?>
                </td>
            </tr>
            <tr>
                    <?php $this->getComments($comments) ?>
            </tr>
        </table>
        <?php
    }


}
