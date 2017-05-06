<?php

class Category
{
    private $title;
    private $list;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setList($list)
    {
        $this->list = $list;
    }

    public function getTitleCategory()
    {
        return $this->title;
    }

    public function getList()
    {
        return $this->list;
    }

}

interface NoteBook
{
    public function getName();

    public function getTitle();

    public function getPrice();

    public function getAmount();

    public function getDescription();
}

class NotBook implements NoteBook
{
    private $name;
    private $price;
    private $amount;
    public $color;
    public $property;
    public $description;

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->getName();
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDescription()
    {
        return $this->description . PHP_EOL . $this->property . PHP_EOL . $this->color;
    }

}

interface SmartPhone
{
    public function getName();

    public function getPrice();

    public function getAmount();

    public function getDescription();
}

class SPhone extends Category implements SmartPhone
{
    private $name;
    private $price;
    private $amount;
    public $color;
    public $property;
    public $description;

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDescription()
    {
        return $this->description . PHP_EOL . $this->property . PHP_EOL . $this->color;
    }
}

interface SmartWatch
{
    public function getName();

    public function getPrice();

    public function getAmount();

    public function getDescription();
}

class SWatch extends Category implements SmartWatch
{
    private $name;
    private $price;
    private $amount;
    public $color;
    public $property;
    public $description;

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDescription()
    {
        return $this->description . PHP_EOL . $this->property . PHP_EOL . $this->color;
    }
}

interface TV
{
    public function getName();

    public function getPrice();

    public function getAmount();

    public function getDescription();
}


class SmartTV extends Category implements TV
{
    private $name;
    private $price;
    private $amount;
    public $color;
    public $property;
    public $description;

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDescription()
    {
        return $this->description . PHP_EOL . $this->property . PHP_EOL . $this->color;
    }
}

