<?php
    echo "<pre>";
    class Product
    {
        protected $price = null;
        public function setPrice($price) 
        {
            $this->price = $price;
            return $this;
        }

        public function getPrice() {
            return $this->price;
        }

        public function doubleThePrice($p)
        {
            $p->setPrice(20.00 * 2);
        }
    }

    /* ------ CASE 1------------*/

    $p1 = new Product(); // create new object
    $p1->setPrice(10.00);

    $p2 = new Product(); // create new object
    echo $p2->getPrice();

    echo "<br>";

    /* ------ CASE 2------------*/

    $p1 = new Product(); // create new object
    $p1->setPrice(10.00);

    $p2 = new Product(); // create new object
    $p2->setPrice(20.00);

    echo $p1->getPrice();
    echo "<br>";

    /* ------ CASE 3------------*/

    $p1 = new Product(); // create new object
    $p1->setPrice(10.00);

    $p2 = $p1;
    $p2->setPrice(20.00);

    echo $p1->getPrice();
    echo "<br>";

    /* ------ CASE 4 ------------*/

    function changePrice($p){
        $p->setPrice(20.00);
    }

    $p1 = new Product(); // create new object
    $p1->setPrice(10.00);

    changePrice($p1);

    echo $p1->getPrice();
    echo "<br>";

    /* ------ CASE 5 ------------*/

    function tripleThePrice($p){
        $p->setPrice($p->getPrice() * 3);
    }

    $p1 = new Product(); // create new object
    $p1->setPrice(10.00);

    tripleThePrice($p1);

    echo $p1->getPrice();
    echo "<br>";
?>
