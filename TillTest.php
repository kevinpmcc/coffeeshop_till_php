<?php
require 'Menu.php';


class MenuTests extends PHPUnit_Framework_TestCase
{
    private $menu;

    protected function setUp()

    {
      $this->menu = new Menu($json_coffee);
    }

    protected function tearDown()
    {
      $this->menu = NULL;
    }
    public function testPrices()
    {
        $prices =  array("Cafe Latte"=> 4.75,
            "Flat White"=> 4.75,
            "Cappucino"=> 3.85,
            "Single Espresso"=> 2.05,
            "Double Espresso"=> 3.75,
            "Americano"=> 3.75,
            "Cortado"=> 4.55,
            "Tea"=> 3.65,
            "Choc Mudcake"=> 6.40,
            "Choc Mousse"=> 8.20,
            "Affogato"=> 14.80,
            "Tiramisu"=> 11.40,
            "Blueberry Muffin"=> 4.05,
            "Chocolate Chip Muffin"=> 4.05,
            "Muffin Of The Day"=> 4.55);
        $this->assertEquals("true", $this->menu->prices);
    }
}
