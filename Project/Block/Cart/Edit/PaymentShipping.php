<?php Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit_PaymentShipping extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("view/cart/edit/paymentShipping.php");
    }

    public function getCart()
    {
        if(!Ccc::getModel('Admin_Cart')->getCart())
        {
            return Ccc::getModel('Cart');
        }
        $cartId = Ccc::getModel('Admin_Cart')->getCart();
        $cartModel = Ccc::getModel('Cart')->load($cartId);
        return $cartModel;
    }
    
    public function getShippingMethod()
    {
        $cartModel = Ccc::getModel('Cart');
        $shippingMethods = $cartModel->fetchAll("SELECT * FROM `shipping_method`");
        return $shippingMethods;
    }

    public function getPaymentMethod()
    {
        $cartModel = Ccc::getModel('Cart');
        $paymentMethods = $cartModel->fetchAll("SELECT * FROM `payment_method`");
        return $paymentMethods;
    }
}
