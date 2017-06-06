<?php
//родительский класс - устройство
class Device {
    public $size; //размер
    public $color; //цвет
    }

interface KettleInterface {
    public function someFunction($argument1, $argument2);
    }

//дочерний класс - чайник
  class Kettle extends Device implements KettleInterface {
    public $caseMaterial; //материал корпуса
    public $volume; //объем
    public $power; //мощность
    private $manufacturer; //производитель
    private $productionDate; //дата производства


    public function __construct($caseMaterial, $volume, $power, $manufacturer, $productionDate) {
      $this->caseMaterial = $caseMaterial;
      $this->volume = $volume;
      $this->power = $power;
      $this->manufacturer = $manufacturer;
      $this->productionDate = $productionDate;
    }


}

$kettle1 = new Kettle ('Керамика','220','1','Bosh','11-05-2016');
$kettle2 = new Kettle ('Металл','1000','1,5','Vitek','01-10-2016');
$kettle3 = new Kettle ('Пластик','1500','1','DeLongi','04-03-2015');
$kettle4 = new Kettle ('Стекло','900','2','Philips','01-12-2016');
$kettle5 = new Kettle ('Металл','1000','2','Braun','07-09-2014');
