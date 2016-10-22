<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
    <link rel='stylesheet' href='./style.css'>
  </head>
  <body>
<div class='container'>
<?php

$coffee_json = '[
  {
    "shopName": "The Coffee Connection",
      "address": "123 Lakeside Way",
      "phone": "16503600708",
      "prices": [
        {
          "Cafe Latte": 4.75,
            "Flat White": 4.75,
            "Cappucino": 3.85,
            "Single Espresso": 2.05,
            "Double Espresso": 3.75,
            "Americano": 3.75,
            "Cortado": 4.55,
            "Tea": 3.65,
            "Choc Mudcake": 6.40,
            "Choc Mousse": 8.20,
            "Affogato": 14.80,
            "Tiramisu": 11.40,
            "Blueberry Muffin": 4.05,
            "Chocolate Chip Muffin": 4.05,
            "Muffin Of The Day": 4.55
      }
    ]
  }
]';

class Menu {
  private $prices;

  public function __construct($coffee_json) {
    $jsonCleaner = new JsonCleaner($coffee_json);
    $cleanedJson = $jsonCleaner->cleanedJson()[0]; 
    $this->prices = $cleanedJson['prices'][0];
  }

  public function prices() {
    return $this->prices; 
  }
}

$obj = new Menu($coffee_json);

class Item 
{
  private $name;
  private $price;

  public function __construct($name, $menu=Menu) {
    $this->name = $name;

  }
}

class Till
{
  // public property declaration
  // private property declaration
  private $construct_var;
  private $item;
  private $order;
  private $tax;
  private $netTotal;
  private $grossTotal;
  private $itemPrices = array();
  // constructor
  public function __construct($json) {
    $clean_json_obj = new JsonCleaner($json);
    $this->shop_details = $clean_json_obj->cleanedJson()[0]; 
  }
  public function inputOrder($order) {
    $this->printReceiptHeader();
    $this->order = $order;
    for($x = 0; $x < count($this->order); $x++) {
      $item = $order[$x];
      array_push($this->itemPrices, $this->itemPrice($item));
      echo "<br>";
    }
    $this->netTotal = $this->calculateOrderCost();    
  }

  public function finalTotals() {
    $this->tax();
    $this->grossTotal();
    $this->printTotals(); 
  }

  private function grossTotal() {
    $this->grossTotal =  $this->netTotal + $this->tax;
  }

  private function printTotals() {
    echo "<br>";
    echo "<span class = 'left-column'> Tax: </span> <span class = 'right-column'> $" . $this->tax . "</span><br>";
    echo "<span class = 'left-column'> Total: </span> <span class= 'right-column'> $" . $this->grossTotal . "</span><br>";
    echo "<div class='footer'>Thanks</div>";
  }

  private function itemPrice($item) {
    echo "<span class='item-name'>" . $item .  "<span class='right-column'> " . $this->prices()[$item] . "</span>";
    return $this->prices()[$item];
  }

  private function prices() {
    return $this->shop_details['prices'][0];
  }
  private function tax() {
    $this->tax = round(($this->netTotal * 0.0864), 2);
  }

  private function calculateOrderCost() {
    $netTotal = 0;
    for($x = 0; $x < count($this->itemPrices); $x++) {
      $netTotal += $this->itemPrices[$x];     
    }

    return $netTotal;
  }

  private function printReceiptHeader() {
    echo $this->dateAndTimeNow() . "<br>";
    echo $this->shop_details['shopName'] . "<br><br>";
    echo $this->shop_details['address'] . "<br>";
    echo "Phone: " .$this->shop_details['phone'] . "<br><br>";
  }

  private function phoneNumber() {
    $p = $this->shop_details['phone'];
    $string = "Phone: +" . $p[0] . " "; ;
    $string << $p[0] . " ";
    $string << "(" . $p[1] . $p[2] . $p[3] . ")";
    return $string;
  }

  private function dateAndTimeNow() {
    date_default_timezone_set('Europe/London');
    return date('Y.m.d h:i:s', time());
  }
}


class JsonCleaner
{
  public function __construct($json) {
    $this->cleanedJson = json_decode($json,true);
  }
  public function cleanedJson() {
    return $this->cleanedJson;
  }
} 

$coffee_shop_obj = new Till($coffee_json);
$coffee_shop_obj->inputOrder([ 'Flat White', 'Muffin Of The Day']);
$coffee_shop_obj->finalTotals();


//var_dump($decoded_json);
//$menu_array = $decoded_json[0];
//$menu_prices_all = $menu_array['prices'];
//$actual_menu_prices = $menu_prices_all[0];
//print "\n Price of a Latte" .$actual_menu_prices["Cafe Latte"];

#print $actual_menu_prices['Cafe Latte'];
?>
</div>
  </body>
</html>
