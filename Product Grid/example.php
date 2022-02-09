<?php
 class product{
    protected $price = 0.0;
    public function setPrice($price){
        $this->price = $price;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }
}

class Transfer {
    protected $product = null;
    public function setProduct($product) {
    $this->product = $product;
    return $this;
    }
    public function getProduct() {
        return $this->product;
    }
    public function sendMoney() {
        $finalAmount = $this->getProduct()->getPrice();
        return $finalAmount;
    //send into mail : $finalAmount
    }
}


$product = new Product();
$product->setPrice(100.00);

$transferl = new Transfer();
$transferl->setProduct($product);

$product->setPrice(200.00);
$transfer2 = new Transfer();
$transfer2->setProduct($product);

echo($transferl->sendMoney()); //
echo($transfer2->sendMoney()); //

?>
