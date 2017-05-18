<?php
///5 класов
class Car
{
    const WHEELS = 4;
    const HAS_GAS_TANK = true;
    private $typeOfColor = 'White';
    public $clearance;
    // Цена цвета машины
    public function priceOfColor($typeOfColor)
    {
        if ($typeOfColor == 'White') {
            return $this->colorPrice;
        }
        if ($typeOfColor == 'Black') {
            return $this->colorPrice + 2000;
        }
        return 0;
    }

    public function priceWithAdditions($leatherInterior = false)
    {
        if ($leatherInterior) {
            // 150000 - цена кожаного салона
            return $this->price + 15000 + $this->priceOfColor($this->typeOfColor);
        }
        if (!$leatherInterior) {
            return $this->price + $this->priceOfColor($this->typeOfColor);
        }
        return $this->price;
    }

    public function __construct($model, $price, $color, $colorPrice)
    {
        $this->model = $model;
        $this->price = $price;
        $this->color = $color;
        $this->colorPrice = $colorPrice;
    }
}
class TV
{

    const REMOTE_CONTROLLER = true;
    public $isHasOS;

    public function diagonalSize()
    {
        return round(($this->width^2 + $this->height^2)^0.5, 2);
    }

    public function __construct($model, $price, $widthInMeters, $heightInMeters)
    {
        $this->model = $model;
        $this->price = $price;
        $this->width = $widthInMeters;
        $this->height = $heightInMeters;
    }
}
class Pen
{
    public $color;
    public $inkColor;
    public $priceInRubles;

    public function isSuitableForEGE()
    {
        return $this->inkColor == 'black' || $this->inkColor == 'dark-blue';
    }
}
class Duck
{
    // Просто попробовать
    private $isPet;

    public function setIsPetValue($value = false)
    {
        $this->isPet = $value;
    }

    public function __construct($age, $color, $sex)
    {
        $this->age = $age;
        $this->color = $color;
        $this->sex = $sex;
    }
}
class Product
{
    private $price;
    public $discount = 10;

    public function getPrice()
    {
        return $this->price * (1 - ($this->discount / 100));
    }

    public function __construct($name, $price)
    {
        $this->price = $price;
        $this->name = $name;
    }
}
// по 2 обьекта
// Car
$ford = new Car('BMW', 500000, 'white', 15000);
$mersedes = new Car('Audi', 600000, 'black', 20000);
// TV
$smartTV = new TV('Sony', 10000, 2, 1.3);
$basicTV = new TV('Saturn', 2000, 0.3, 0.2);
$basicTV->isHasOS = false;
// Pen
$pen1 = new Pen();
$pen1->color = 'red';
$pen1->inkColor = 'blue';
$pen1->priceInRubles = 20;

$pen2 = new Pen();
$pen2->color = 'blue';
$pen2->inkColor = 'dark';
$pen2->priceInRubles = 30;
// Duck
$duck = new Duck('1', 'grey', 'male');
$duckPet = new Duck('2', 'white', 'famale');
$duckPet->setIsPetValue(true);
// Product
$barOfChocolate = new Product('Володька', 100);
$notebook = new Product('Lenovo', 55000);
/*echo*/ $notebook->getPrice();
