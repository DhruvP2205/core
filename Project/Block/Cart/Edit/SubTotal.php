<?php Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit_SubTotal extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("view/cart/edit/subTotal.php");
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

    public function getItems()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        $cartId = Ccc::getModel('Admin_Cart')->getCart();
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
        $cartId = Ccc::getModel('Admin_Cart')->getCart();
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
}
