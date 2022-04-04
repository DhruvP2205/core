<?php Ccc::loadClass("Controller_Admin_Action");

class Controller_cart extends Controller_Admin_Action
{
    public function __construct()
    {
        if(!$this->authentication())
        {
            $this->redirect('login','admin_login');
        }
    }

    public function indexAction()
    {
        $this->setTitle('Cart');
        $content = $this->getLayout()->getContent();
        $cartIndex = Ccc::getBlock('Cart_Index');
        $content->addChild($cartIndex);
        $this->renderLayout();
    }

    public function indexBlockAction()
    {
        $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
        $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
        $cartEditPaymentShipping = Ccc::getBlock('Cart_Edit_PaymentShipping')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartAddress',
                    'content' => $cartEditAddress,
                ],
                [
                    'element' => '#paymentShipping',
                    'content' => $cartEditPaymentShipping,
                ],
                [
                    'element' => '#cartProduct',
                    'content' => $cartEditItem,
                ],
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function gridBlockAction()
    {
        $this->getCart()->unsetCart();
        $cartGrid = Ccc::getBlock('Cart_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartGrid,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        $cartEdit = Ccc::getBlock('Cart_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartEdit,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function gridAction()
    {
        $this->setTitle('Cart');
        $this->getCart()->unsetCart();
        $cartGrid = Ccc::getBlock('Cart_Grid');
        $content = $this->getLayout()->getContent();
        $content->addChild($cartGrid,'Grid');
        $this->renderLayout();
    }

    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Cart');

            $content = $this->getLayout()->getContent();
            $cartEdit = Ccc::getBlock('Cart_Edit');
            $content->addChild($cartEdit);
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','cart',[],true);
        }
    }

    public function addCartAction()
    {
        try
        {
            if($this->getCart()->getCart())
            {
                $this->editBlockAction();
            }
            else
            {
                $cartModel = Ccc::getModel('Cart');
                $request = $this->getRequest();
                $customerId = (int)$request->getRequest('id');
                
                $cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
                if($cart)
                {
                    $this->getCart()->addCart($cart->cartId);
                }
                else
                {
                    $cartModel->customerId = $customerId;
                    $cartModel->paymentMethod = 4;
                    $cartModel->shippingMethod = 3;
                    $cartModel->shippingCharge = 50;
                    $cart = $cartModel->save();
                    if(!$cart)
                    {
                        throw new Exception("Unable to save cart.");
                    }
                    $this->saveAddressAction($cart);
                    $this->getCart()->addCart($cart->cartId);
                }
                $this->getMessage()->addMessage('Cart loaded.');
                $this->editBlockAction();
            }
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function saveAddressAction($cart)
    {
        try
        {
            $request = $this->getRequest();
            $customerId = $request->getRequest('id');
            if(!$customerId)
            {
                throw new Exception("Request Invalid.");
            }
            $customer = $cart->getCustomer();
            $customerBillingAddress = $customer->getBillingAddress();
            $customerShippingAddress = $customer->getShippingAddress();
            if($customerBillingAddress)
            {
                $bilingAddress = $cart->getBillingAddress();
                $bilingAddress->cartId = $cart->cartId;
                $bilingAddress->firstName = $customer->firstName;
                $bilingAddress->lastName = $customer->lastName;
                $bilingAddress->setData($customerBillingAddress->getData());
                unset($bilingAddress->addressId);
                unset($bilingAddress->customerId);
                $bilingAddress->save();
                if(!$bilingAddress)
                {
                    throw new Exception("Biling address not saved.");
                }
            }
            if($customerShippingAddress)
            {
                $shipingAddress = $cart->getShippingAddress();
                $shipingAddress->cartId = $cart->cartId;
                $shipingAddress->firstName = $customer->firstName;
                $shipingAddress->lastName = $customer->lastName;
                $shipingAddress->setData($customerShippingAddress->getData());
                unset($shipingAddress->addressId);
                unset($shipingAddress->customerId);
                $shipingAddress->save();
                if(!$shipingAddress)
                {
                    throw new Exception("Shiping address not saved.");
                }
            }
            $this->getMessage()->addMessage("Address Saved.");
        }
        catch (Exveption $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function saveCartAddressAction()
    {
        try
        {
            $cartModel = Ccc::getModel('Cart');
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);

            if(!$cartId)
            {
                throw new Exception("Request Invalid.");
            }

            $billingData = $request->getPost('billingAddress');
            $shippingData = $request->getPost('shippingAddress');
            
            $billingAddress = $cart->getBillingAddress();
            $shippingAddress = $cart->getShippingAddress();
            
            $billingAddress->setData($billingData);
            $shippingAddress->setData($shippingData);
            
            $billingAddress->save();
            $shippingAddress->save();
            
            if($request->getPost('saveToBillingBook'))
            {
                $customer = $cart->getCustomer();
                $customerBillingAddress = $customer->getBillingAddress();
                $customerBillingAddress->setData($billingData);
                unset($customerBillingAddress->firstName);
                unset($customerBillingAddress->lastName);
                $customerBillingAddress->save();
            }
            if($request->getPost('saveToShippingBook'))
            {
                $customer = $cart->getCustomer();
                $customerShippingAddress = $customer->getShippingAddress();
                $customerShippingAddress->setData($shippingData);
                unset($customerShippingAddress->firstName);
                unset($customerShippingAddress->lastName);
                $customerShippingAddress->save();
            }
            $this->getMessage()->addMessage("Address Saved.");
            
            $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartAddress',
                        'content' => $cartEditAddress,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function saveShipingMethodAction()
    {
        try
        {
            $cartModel = Ccc::getModel('Cart');
        
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            if(!$cartId)
            {
                throw new Exception("Request Invalid.");
            }
            
            $shippingMethod = $request->getPost('shippingMethod');
            if($shippingMethod == 1)
            {
                $shippingCharge = '100';
            }
            else if($shippingMethod == 2)
            {
                $shippingCharge = '70';
            }
            else
            {
                $shippingCharge = '50';
            }
            $cart->setData(['shippingCharge' => $shippingCharge, 'shippingMethod' => $shippingMethod]);

            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("Shipping method not saved.");
            }
            $this->getMessage()->addMessage("Shipping method saved.");
            
            $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartAddress',
                        'content' => $cartEditAddress,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function savePaymentMethodAction()
    {
        try
        {
            $cartModel = Ccc::getModel('Cart');
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            if(!$cartId)
            {
                throw new Exception("Request Invalid.");
            }
            $paymentData = $request->getPost('paymentMethod');
            $cart->setData(['paymentMethod' => $paymentData]);

            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("Payment method not saved.");
            }
            $this->getMessage()->addMessage("Payment method saved.");
            
            $cartEditPaymentShipping = Ccc::getBlock('Cart_Edit_PaymentShipping')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#paymentShiping',
                        'content' => $cartEditPaymentShipping,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function addCartItemAction()
    {
        try
        {
            $request = $this->getRequest();
            $cartModel = Ccc::getModel('Cart');
            $cartId = $this->getCart()->getCart();
            $cart = $cartModel->load($cartId);
            
            $item = Ccc::getModel('Cart_Item');
            $productModel = Ccc::getModel('Product');
            
            $taxAmount = null;
            $discount = null;
            $cartData = $request->getPost('cartProduct');
            $item->cartId = $cart->cartId;

            if(!$cartId)
            {
                throw new Exception("Request Invalid.");
            }

            foreach($cartData as $cartItem)
            {
                if(array_key_exists('productId',$cartItem))
                {
                    $product = $productModel->load($cartItem['productId']);
                    
                    if($product->quantity >= $cartItem['quantity'])
                    {
                        unset($item->itemId);
                        $item->setData($cartItem);
                        $item->itemTotal = $product->price * $cartItem['quantity'];
                        $item->tax = $product->tax;
                        $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $item->discount = ($product->discount * $cartItem['quantity']);
                        $item->save();
                        $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $discount +=($product->discount * $cartItem['quantity']);
                        unset($item->itemId);
                    }
                }
            }
            $subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
            $cart->subTotal = $subTotal->subTotal;
            $cart->taxAmount += $taxAmount;
            $cart->discount += $discount;
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("subTotal not updated", 1);
            }
            $this->getMessage()->addMessage("Product added in cart.");
            
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],      
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function cartItemUpdateAction()
    {
        try
        {
            $request = $this->getRequest();
            $cartModel = Ccc::getModel('Cart');
            $cartId = $this->getCart()->getCart();
            $cart = $cartModel->load($cartId);
            $productModel = Ccc::getModel('Product');
            $cartData = $request->getPost('cartItem');
            $item = $cart->getItem();
            $taxAmount = null;
            $discount = null;

            if(!$cartId)
            {
                throw new Exception("Request Invalid.");
            }

            foreach($cartData as $cartItem)
            {
                $product = $productModel->load($cartItem['productId']);
                if($product->quantity >= $cartItem['quantity'])
                {
                    $item->setData($cartItem);
                    $item->itemTotal = $product->price * $cartItem['quantity'];
                    $item->tax = $product->tax;
                    $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $item->discount = $product->discount * $cartItem['quantity'];
                    $item->save();
                    $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $discount += $product->discount * $cartItem['quantity'];
                }
            }
            $subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
            $cart->subTotal = $subTotal->subTotal;
            $cart->taxAmount = $taxAmount;
            $cart->discount = $discount;
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("subTotal not updated", 1);
            }
            $this->getMessage()->addMessage("Cart updated successfully.");
            
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],      
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch(Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function deleteCartItemAction()
    {
        try
        {
            $request = $this->getRequest();
            $itemId = $request->getRequest('id');
            
            $item = Ccc::getModel('Cart_Item')->load($itemId);
            $cart = $item->getCart();
            
            $cart->subtotal = $cart->subtotal - $item->itemTotal;
            $cart->taxAmount = $cart->taxAmount - $item->taxAmount;
            $cart->discount = $cart->discount - $item->discount;

            $cartSave = $cart->save();
            if(!$cartSave)
            {
                throw new Exception("Not Saved", 1);
            }
            $result = $item->delete();

            if(!$result)
            {
                throw new Exception("Item not deleted.");
            }
            $this->getMessage()->addMessage("Item Deleted.");
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function placeOrderAction()
    {
        try
        {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            if(!$cartId)
            {
                throw new Exception("Request Invalid.");
            }
            $customer = $cart->getCustomer();
            
            $orderModel->customerId = $cart->customerId;
            $orderModel->firstName = $customer->firstName;
            $orderModel->lastName = $customer->lastName;
            $orderModel->email = $customer->email;
            $orderModel->mobile = $customer->mobile;
            $orderModel->shippingId = $cart->shippingMethod;
            $orderModel->shippingCharge = $cart->shippingCharge;
            $orderModel->paymentId = $cart->paymentMethod;
            $orderModel->grandTotal = $request->getPost('grandTotal');
            $orderModel->taxAmount = $request->getPost('taxAmount');
            $orderModel->discount = $request->getPost('discount');

            $order = $orderModel->save();
            if(!$order)
            {
                throw new Exception("Order not placed.");
            }

            $items = $cart->getItems();
            foreach($items as $item)
            {
                $product = $item->getProduct();
                $itemModel = Ccc::getModel('Order_Item');
                $itemModel->orderId = $order->orderId;
                $itemModel->productId = $product->productId;
                $itemModel->name = $product->name;
                $itemModel->sku = $product->sku;
                $itemModel->price = $item->itemTotal;
                $itemModel->tax = $product->tax;
                $itemModel->taxAmount = ($product->price * $product->tax / 100) * $item->quantity;
                $itemModel->quantity = $item->quantity;
                $itemModel->discount = $item->discount;
                $result = $itemModel->save();
                if($result)
                {
                    $item->delete();
                }
            }

            $addressModel = Ccc::getModel('Order_Address');
            $billingData = $cart->getBillingAddress();
            $shipingData = $cart->getShippingAddress();
            $billingAddress = $order->getBillingAddress();
            $shippingAddress = $order->getShippingAddress();
            $billingAddress->setData($billingData->getData());
            $billingAddress->email = $customer->email;
            $billingAddress->mobile = $customer->mobile;
            $billingAddress->orderId = $order->orderId;
            $shippingAddress->setData($shipingData->getData());
            $shippingAddress->email = $customer->email;
            $shippingAddress->mobile = $customer->mobile;
            $shippingAddress->orderId = $order->orderId;
            unset($billingAddress->cartId);
            unset($billingAddress->cartAddressId);
            unset($shippingAddress->cartId);
            unset($shippingAddress->cartAddressId);

            $billingResult = $billingAddress->save();
            $shippinhResult = $shippingAddress->save();

            if($billingResult)
            {
                $billingData->delete();
            }
            if($shippinhResult)
            {
                $shipingData->delete();
            }
            if($order)
            {
                $cart->delete();
            }
            $this->getMessage()->addMessage("Order placed successfully.");
            $this->gridBlockAction();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }
}
