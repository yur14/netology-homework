<?php

trait getDiscountMethod{
    public function getDiscount()
    {
        return $this->discount;
    }
}
trait setDiscountMethod{
    public function setDiscountMethod()
    {
        return $this->discount;
    }
}


interface forProduct
    {
    public function getPrice($amount = 1);
    public function Output($amount = 1);
    }

abstract class Products implements forProduct {
    public $name;
    public $price;
    public $discount;
    public $unit;

    public function getId() {
            return $this->id;
    }
    public function getName() {
            return $this->name;
    }
    public function getPrice($amount = 1) {
            $this->setDiscountMethod($amount);
            if ($this->getDiscount() == 0) {
                $realprice =  $amount*$this->price;
                 return $realprice; }
            else {
                $realprice = (($this->price*(100-$this->getDiscount()))*$amount/100);
                    return $realprice;
                 }
    }
    abstract public function getDiscount();

    public function getShiping(){
            if ($this->getDiscount() == 0) return 250;
            else return 300;
    }

    public function Output($amount = 1){
        echo '<b>Продукт: </b>'.$this->name.'<b> Кол-во: </b>'.$amount.' '.$this->unit."<br/>";
        echo '<b>Стоимость: </b>'.$this->getPrice($amount).' рублей. <b>Скидка: </b>'.$this->discount.'%. <b>Доставка: </b>'.$this->getShiping()." рублей<br/>";
    }
}


    class Fruit extends Products{
    use getDiscountMethod;
    public function __construct($name, $unit, $price, $discount){
            $this->name = $name;
            $this->unit = $unit;
            $this->price = $price;
            $this->discount = $discount;
    }
    public function setDiscountMethod($amount)
    {
        if ($amount > 10) $this->discount = 10;
        else $this->discount = 0;
    }
    }
    class Kettle extends Products{
        use getDiscountMethod;
        use setDiscountMethod;
        public function __construct($name, $unit, $price, $discount){
            $this->name = $name;
            $this->unit = $unit;
            $this->price = $price;
            $this->discount = $discount;
        }
    }
    class Clothes extends Products{
        use getDiscountMethod;
        use setDiscountMethod;
        public function __construct($name, $unit, $price, $discount){
            $this->name = $name;
            $this->unit = $unit;
            $this->price = $price;
            $this->discount = $discount;
    }
    }
