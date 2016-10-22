<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
  </head>
  <body>
<p>HELLO</p>
<?php 
echo "<h1>BLAHBLAHBLAH</h1>";
?>
<h1>YET MORE</h1>
<?php
class SimpleClass
{
    // public property declaration
    public $var = 'a default value';

    // private property declaration
    private $construct_var;

    // constructor
    public function __construct($construct_var) {

       // this is like self in Ruby
       $this->construct_var = $construct_var;
       print "In constructor\n";
   }

    // public method declaration
    public function displayVar() {
        echo $this->var;
        $this->displayPrivate();
    }

    // private method declaration
    private function displayPrivate() {
        echo $this->construct_var;
        echo "Only called within this class";
    }
}

$object = new SimpleClass('constructor vars');
$object->displayVars();

?>
<p>ANOTHER THING</p>  
  </body>
</html>
