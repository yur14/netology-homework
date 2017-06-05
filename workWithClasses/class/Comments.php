<?php
class Comment
{
    protected $date;
    protected $author;
    protected $body;

    public function __construct($date, $author, $body)
    {
        $this->date = $date;
        $this->author = $author;
        $this->body = $body;
    }

    public function showComment () {
        ?>
    <tr>
        <td>
            Дата: <?= $this->date ?>
        </td>
        <td>
            Автор: <?= $this->author ?>
        </td>
    </tr>
    <tr>
          <td colspan="2">
              <?= $this->body ?>
          </td>
    </tr>
<?php
    }
}
