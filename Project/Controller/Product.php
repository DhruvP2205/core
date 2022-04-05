<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Product extends Controller_Admin_Action
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
        $this->setTitle('Product');
        $content = $this->getLayout()->getContent();
        $productGrid = Ccc::getBlock('Product_Index');
        $content->addChild($productGrid);
        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $productGrid = Ccc::getBlock('Product_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $productGrid,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function addBlockAction()
    {
        $productModel = Ccc::getModel('Product');
        $media = Ccc::getModel('Product_Media');

        Ccc::register('product',$productModel);
        Ccc::register('media',$media);

        $productEdit = Ccc::getBlock('Product_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();

        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $productEdit,
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
        try 
        {
            $request = $this->getRequest();
            $productModel = Ccc::getModel('Product');
            
            $productId = $request->getRequest('id');
            if(!$productId)
            {   
                throw new Exception("Error Processing Request");
            }
            if(!(int)$productId)
            {   
                throw new Exception("Error Processing Request");
            }
    
            $product = $productModel->load($productId);
            if(!$product)
            {  
                throw new Exception("Error Processing Request");
            }

            $media = $product->getMedia();

            Ccc::register('product',$product);
            Ccc::register('media',$media);

            $productEdit = Ccc::getBlock('Product_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();

            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $productEdit,
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
            $this->gridBlockAction();
        }   
    }

    public function saveAction()
    {
        try
        {
            $request=$this->getRequest();
            $productModel= Ccc::getModel('Product');
            $categoryIds = $request->getPost('category');
            $productId = $request->getRequest('id');
            $type = $request->getPost('discountMethod');
            $category = null;
            $product = null;
            if($request->isPost())
            {
                $postData = $request->getPost('product');
                if($postData)
                {
                    $productData = $productModel->setData($postData);
                    if($type == 1)
                    {
                        $productData->discount = $productData->price * $productData->discount / 100;
                    }
                    if(!($productData->costPrice <= ($productData->price - $productData->discount) && $productData->price - $productData->discount <= $productData->price) || $productData->discount<0)
                    {
                        throw new Exception("Invalid discount");
                    }
                    if($productData->productId)
                    {
                        $productData->updatedDate = date('Y-m-d h:i:s');
                    }
                    else
                    {
                        unset($productData->productId);
                        $productData->createdDate = date('Y-m-d h:i:s');
                    }
                    $product = $productData->save();    
                    if(!$product)
                    {
                        throw new Exception('product con not be saved');         
                    }
                }
                if(array_key_exists('category',$request->getPost()))
                {
                    $categoryIds = $request->getPost('category');
                    $product = $productModel;
                    $product->productId = $productId;
                    $category = $product->saveCategories($categoryIds);
                }
                else if(!array_key_exists('product',$request->getPost()))
                {
                    $categoryIds = $request->getPost('category');
                    $product = $productModel;
                    $product->productId = $productId;
                    $category = $product->saveCategories($categoryIds);
                }
                $this->getMessage()->addMessage('product Save Successfully');
            }
            $this->gridBlockAction();
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }

    public function saveMediaAction()
    {
        try 
        {
            $mediaModel = Ccc::getModel('Product_Media');
            $productModel = $mediaModel->getProduct();
            $request = $this->getRequest();
            $file = $request->getFile();
            $productId = $request->getRequest('id');
            if($request->isPost())
            {
                if($file)
                {
                    $mediaData = $mediaModel;
                    $mediaData->productId = $productId;
                    $file = $request->getFile();
                    $ext = explode('.',$file['name']['name']);
                    $fileExt = end($ext);
                    $fileName = prev($ext)."".date('Ymdhis').".".$fileExt;
                    $fileName = str_replace(" ","_",$fileName);
                    $mediaData->name = $fileName;
                    $extension = array('jpg','jpeg','png','Jpg','Jpeg','Png','JPEG','JPG','PNG');
                    if(in_array($fileExt, $extension))
                    {
                        $result = $mediaModel->save();
                        if(!$result)
                        {
                            throw new Exception("Error Processing Request");
                        }   
                        move_uploaded_file($file['name']['tmp_name'],Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/Product/").$fileName);
                    }
                    $this->getMessage()->addMessage('Your Media saved successfully');
                }
                else
                {
                    $mediaData = $mediaModel;
                    $productData = $productModel;
                    $mediaData->productId = $productId;
                    $postData = $request->getPost();
                    if(array_key_exists('remove',$postData['media']))
                    {
                        foreach($postData['media']['remove'] as $remove)
                        {
                            $media = $mediaModel->load($remove);
                            $result = $media->delete();
                            if(!$result)
                            {
                                throw new Exception("Error Processing Request");
                            }
                            unlink(Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/Product/"). $media->name);

                            if(array_key_exists('base',$postData['media']))
                            {
                                if($postData['media']['base'] == $remove)
                                {
                                    unset($postData['media']['base']);
                                }   
                            }
                            if(array_key_exists('thumb',$postData['media']))
                            {
                                if($postData['media']['thumb'] == $remove)
                                {
                                    unset($postData['media']['thumb']);
                                }
                            }
                            if(array_key_exists('small',$postData['media']))
                            {
                                if($postData['media']['small'] == $remove)
                                {
                                    unset($postData['media']['small']);
                                }
                            }
                        }
                        $this->getMessage()->addMessage('Your Media removed');
                    }
    
                    if(array_key_exists('gallery',$postData['media']))
                    {
                        $mediaData->gallery = 2;
                        $result = $mediaModel->save('productId');
                        $mediaData->gallery = 1;
                        foreach ($postData['media']['gallery'] as $gallery) 
                        {
                            $mediaData->mediaId = $gallery;
                            $result = $mediaModel->save();
                            if(!$result)
                            {
                                throw new Exception("Error Processing Request");
                            }
                        }
                        unset($mediaData->mediaId);
                        $this->getMessage()->addMessage('Your Gallery Sellected');
                    }
                    else
                    {
                        $mediaData->gallery = 2;
                        $result = $mediaModel->save('productId');
                    }
                    unset($mediaData->gallery);
                    if(array_key_exists('base',$postData['media']))
                    {
                        $productData->productId = $productId;
                        $productData->base = $postData['media']['base'];
                        $result = $productModel->save();
                        if(!$result)
                        {
                            throw new Exception("Error Processing Request");
                        }
                        unset($productData->base);
                        $this->getMessage()->addMessage('Base set successfully');
                    }
                    if(array_key_exists('thumb',$postData['media']))
                    {
                        $productData->productId = $productId;
                        $productData->thumb = $postData['media']['thumb'];
                        $result = $productModel->save();
                        if(!$result)
                        {
                            throw new Exception("Error Processing Request");
                        }
                        unset($productData->thumb);
                        $this->getMessage()->addMessage('Thumb set successfully');
                    }
                    if(array_key_exists('small',$postData['media']))
                    {
                        $productData->productId = $productId;
                        $productData->small = $postData['media']['small'];
                        $result = $productModel->save();
                        if(!$result)
                        {
                            throw new Exception("Error Processing Request");
                        }
                        unset($productData->small);
                        $this->getMessage()->addMessage('Small set successfully');
                    }
                }
            }   
            $this->editBlockAction();
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }   
    }

    public function deleteAction()
    {
        try 
        {
            $productModel = Ccc::getModel('Product');
            
            $request = $this->getRequest();
            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }

            $productId = $request->getRequest('id');
            if(!$productId)
            {
                throw new Exception("Unable to fetch ID.");
            }
            
            $medias = $productModel->fetchAll("SELECT `name` FROM `product_media` WHERE  `productId` = {$productId}");
            if($medias)
            {
                foreach ($medias as $media)
                {
                    unlink(Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/"). $media->name);
                }
            }

            $result = $productModel->load($productId);
            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->gridBlockAction();
        } 
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }       
    }
}
