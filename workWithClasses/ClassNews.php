<?php

class NewsClass
{
    public function __construct()
    {
    return $this->id = isset($_GET["id"]) ? $_GET["id"] : false;
    }
    public function getNews()
    {
        $file = file_get_contents(__DIR__ . "/news.json");
        if(!$file){
            return false;
        }
        $file = json_decode($file);
        $file = $file[$this->id];
        return $file;
    }
    public function getTitle()
    {
        $obj = $this->getNews($this->id);
        $title = $obj->title;
        return $title;
    }
    public function getText()
    {
        $obj = $this->getNews($this->id);
        $text = $obj->text;
        return $text;
    }
    public function getComment()
    {
        $obj = $this->getNews($this->id);
        $comment = $obj->comment;
        return $comment;
    }
}
