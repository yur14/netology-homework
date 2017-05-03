<?php

class Notebook
{
    private $name;
    private $title;
    private $price;
    private $amount;
    private $color;
    private $property;
    private $description;

    public function getName()
    {
        return $this->name;
    }
    public function getTitle()
    {
        return $this->getName() . $this->title;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function getProperty()
    {
        return $this->property;
    }
    public function getDescription()
    {
        return $this->description . $this->property . $this->color;
    }
}

class TV
{
    private $name;
    private $color;
    private $title;
    private $price;
    private $amount;
    private $property;
    private $description;

    public function getName()
    {
        return $this->name;
    }
    public function getTitle()
    {
        return $this->getName() . $this->title;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function getProperty()
    {
        return $this->property;
    }
    public function getDescription()
    {
        return $this->description . $this->property . $this->color;
    }
}

class SmartPhone
{
    private $name;
    private $title;
    private $price;
    private $description;
    private $property;
    private $color;
    private $amount;

    public function getName()
    {
       return $this->name;
    }
    public function getTitle()
    {
        return $this->getName() . $this->title;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getDescription()
    {
        return $this->description . $this->property . $this->color;
    }
    public function getAmount()
    {
        return $this->amount;
    }
}

class SmartWatch
{
    private $name;
    private $title;
    private $price;
    private $amount;
    private $color;
    private $property;
    private $description;

    public function getName()
    {
        return $this->name;
    }
    public function getTitle()
    {
        return $this->getName() . $this->title;
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
        return $this->description . $this->property . $this->color;
    }
}

class Planshet
{
    private $name;
    private $title;
    private $price;
    private $amount;
    private $color;
    private $property;
    private $description;

    public function getName()
    {
        return $this->name;
    }
    public function getTitle()
    {
        return $this->getName() . $this->title;
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
        return $this->description . $this->color . $this->property;
    }
}
