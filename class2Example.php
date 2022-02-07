<?php
    echo "<pre>";
    class Box
    {
        protected $item = null;
        
        public function setItem($item) {
            $this->item = $item;
            return $this;
        }

        public function getItem() {
            return $this->item;
        }
    }

    class User extends Box
    {

    }

    /* ------ CASE 1------------*/

    $box = new Box();
    $box->setItem('phone');

    $user = new User();
    echo $user->getItem();
    echo "<br>";

    /* ------ CASE 2------------*/

    $user = new User();
    $user->setItem('phone');

    $box = new Box();
    echo $box->getItem();
    echo "<br>";

    /* ------ CASE 3------------*/

    $user = new User();
    $user->setItem('phone');

    $box = new Box();
    $box->setItem('mobile');

    echo $user->getItem();
    echo "<br>";

?>
