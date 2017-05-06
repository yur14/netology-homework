<?php

class Electronic
{
    public $title = "";
    public $price = 0;
    public $weight = 0;
    public $delivery = 250;
    public $deliveryDisc = 300;
    public $discount = 0;
    public $discountHeight = 0;

    public function getPrice()
    {
        return $this->price;
    }

    public function getDiscount()
    {
        if (!$this->discount) {
            return 0;
        }
        return ($this->price * $this->discount / 100);
    }

    public function getDiscountHeight()
    {
        if ($this->weight < 10) {
            return 0;
        }
        return $this->price * $this->discountHeight / 100;
    }

    public function getDelivery()
    {
        return $this->getDiscount() ? $this->deliveryDisc : $this->delivery;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function __construct()
    {
        echo "Название продукта: {$this->getTitle()} Цена : {$this->getPrice()} Доставка : {$this->getDelivery()} Скидка составила : {$this->getDiscount()}+{$this->getDiscountHeight()} ";
    }
}

interface Apple
{
    public function getDiscount();

    public function __construct();
}

class Phone extends Electronic implements Apple
{
    public $title = "Apple";
    public $price = 70000;
    public $discount = 10;


    public function getDiscount()
    {
        parent::getDiscount();
    }

    public function __construct()
    {
        parent::__construct();

    }
}

$sp = new Phone();
?>
    <br>
<?php

interface TVW
{
    public function getPrice();

    public function getDiscountHeight();

    public function __construct();
}

class SmartLedTV extends Electronic implements TVW
{
    public $title = "Samsung";
    public $price = 240000;
    public $weight = 11;
    public $delivery = "300 p.";
    public $discountHeight = 5;
    public $discount = 10;

    public function getPrice()
    {
        return ($this->price) - ($this->getDiscount() + ($this->getDiscountHeight()));
    }

    public function getDiscountHeight()
    {
        if ($this->weight < 10) {
            return 0;
        }
        return $this->price * $this->discountHeight / 100;
    }

    public function __construct()
    {
        parent::__construct();
    }
}

$sp = new SmartLedTV();
?>
    <br>
<?php

interface CoffeeMachine
{
    public function getPrice();

    public function getDelivery();

    public function __construct();
}

class Bork extends Electronic implements CoffeeMachine
{
    public $title = "Bork";
    public $price = 40000;

    public function getPrice()
    {
        return ($this->price) - ($this->getDiscount() + ($this->getDiscountHeight()));
    }

    public function getDelivery()
    {
        if (!$this->discount) {
            return $this->delivery;
        }
        return $this->deliveryDisc;
    }

    public function __construct()
    {
        parent::__construct();
    }
}

$sp = new Bork();
