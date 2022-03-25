<?php Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit extends Block_Core_Template   
{
    public function __construct()
    {
        $this->setTemplate('view/cart/edit.php');
    }  

    public function getCustomers()
    {
        $customerModel = Ccc::getModel('Customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer`");
        return $customer;
    }

    public function getCart()
    {
        $cart = $this->cart;
        return $cart;
    }

    public function getProducts()
    {
        $productModel = Ccc::getModel('Product');
        $cartId = !($this->cart->item->cartId) ? null : $this->cart->item->cartId;
        if($cartId)
        {
            $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `productId` NOT IN (SELECT `productId` FROM `cart_item` WHERE `cartId` = $cartId)");
            return $products;
        }
        else
        {
            $products = $productModel->fetchAll("SELECT * FROM `product`");
            return $products;
        }
    }

    public function getItems()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        $cartId = !($this->cart->item->cartId) ? null : $this->cart->item->cartId;
        if($cartId)
        {
            $items = $itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$cartId} ");
            return $items;
        }
        return null;
    }

    public function getTotal()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        $cartId = !($this->cart->item->cartId) ? null : $this->cart->item->cartId;
        if($cartId)
        {
            $items = $itemModel->getResource()->getAdapter()->fetchOne("SELECT sum(`itemTotal`) FROM `cart_item` WHERE `cartId` = {$cartId} ");
            return $items;
        }
        return null;
    }

    public function getTax($cartId)
    {
        $itemModel = Ccc::getModel('Cart_Item');
        if($cartId)
        {
            $tax = $itemModel->getResource()->getAdapter()->fetchOne("SELECT sum(c.itemTotal * p.tax / 100) FROM `cart_item` as c JOIN `product` as p ON c.productId = p.productId WHERE c.cartId = {$cartId}");
            return $tax;    
        }
        return null;
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
