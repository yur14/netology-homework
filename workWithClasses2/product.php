<?php

interface classProduct
{
    public function getTitle();

    public function getPrice();

    public function getDiscount();

    public function getDelivery();
}

class Product implements classProduct
{
    public $title = "";
    public $price = 0;
    public $weight = 0;
    public $delivery = 250;
    public $deliveryDisc = 300;
    public $discount = 0;
    public $discountHeight = 0;

    public function getTitle()
    {
        return $this->title;
    }

    public function isWeight()
    {
        return isset($this->weight) ? $this->weight : 0;
    }

    public function isDiscount()
    {
        return isset($this->discount) ? $this->discount : 0;
    }

    public function isDiscountHeight()
    {
        return isset($this->discountHeight) ? $this->discountHeight : 0;
    }

    public function getPrice()
    {
        return $this->price - $this->getDiscount();
    }

    public function discount()
    {
        if ($this->isDiscount() > 0) {
            return $this->price * $this->isDiscount() / 100;
        }
        return 0;
    }

    public function discountHeight()
    {
        if ($this->isWeight() > 10) {
            return $this->price * $this->isDiscountHeight() / 100;
        }
        return 0;
    }

    public function getDiscount()
    {
        return $this->discountHeight() + $this->discount();
    }

    public function getDelivery()
    {
        if ($this->discount() > 0 || $this->discountHeight() > 0) {
            return $this->deliveryDisc;
        }
        return $this->delivery;
    }
}

interface oneTypeProduct extends classProduct
{
    public function setTitle($title);

    public function setPrice($price);
}

class Fruits extends Product implements oneTypeProduct
{
    public $discount = 10;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

$fruit = new Fruits();
$fruit->setTitle("Яблоко");
$title = $fruit->getTitle();
$fruit->setPrice(150);
$price = $fruit->getPrice();
$discount = $fruit->getDiscount();
$delivery = $fruit->getDelivery();
echo $title . "<br>" . $price . "<br>" . $discount . "<br>" . $delivery . "<br>";

interface twoTypeProduct extends oneTypeProduct
{
    public function setWeight($weight);
}

class Vegetables extends Product implements twoTypeProduct
{
    public $discount = 15;
    public $discountHeight = 5;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}

$Vegetables = new Vegetables();
$Vegetables->setTitle("Картошка");
$title = $Vegetables->getTitle();
$Vegetables->setPrice(50);
$price = $Vegetables->getPrice();
$Vegetables->setWeight(20);
$discount = $Vegetables->getDiscount();
$delivery = $Vegetables->getDelivery();
echo $title . "<br>" . $price . "<br>" . $discount . "<br>" . $delivery . "<br>";

interface threeTypeProduct extends oneTypeProduct
{

}

class Drink extends Product implements threeTypeProduct
{
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

$Vegetables = new Drink();
$Vegetables->setTitle("Сок");
$title = $Vegetables->getTitle();
$Vegetables->setPrice(150);
$price = $Vegetables->getPrice();
$discount = $Vegetables->getDiscount();
$delivery = $Vegetables->getDelivery();
echo $title . "<br>" . $price . "<br>" . $discount . "<br>" . $delivery . "<br>";

