<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Product_Media extends Controller_Admin_Action
{
    public function __construct()
    {
        if(!$this->authentication())
        {
            $this->redirect('login','admin_login');
        }
    }
    
    public function gridAction()
    {
        $this->setTitle('Product Media');
        $content = $this->getLayout()->getContent();
        $mediaGrid = Ccc::getBlock('Product_Media_Grid');
        $content->addChild($mediaGrid,'Grid');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $mediaModel = Ccc::getModel('Product_Media');
            $productModel = Ccc::getModel('Product');
            $request = $this->getRequest();
            $productId = $request->getRequest('id');

            if($request->isPost())
            {
                if(!$request->getPost())
                {
                    $mediaData = $mediaModel;
                    $mediaData->productId = $productId;

                    $file = $request->getFile();
                    $ext = explode('.',$file['name']['name']);
                    $fileExt = end($ext);
                    $fileName = prev($ext)."".date('Ymdhis').".".$fileExt;
                    $fileName = str_replace(" ","_",$fileName);
                    $mediaData->name = $fileName;

                    $extension = array('jpg','jpeg','png','JPG','JPEG','PNG','Jpg','Jpeg','Png');

                    if(in_array($fileExt, $extension))
                    {
                        $result = $mediaModel->save();

                        if(!$result)
                        {
                            $this->getMessage()->addMessage('System is unable to save your data.',3);
                            throw new Exception("System is unable to save your data.", 1); 
                        }   
                        move_uploaded_file($file['name']['tmp_name'],Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/").$fileName);
                        $this->getMessage()->addMessage('Media uploaded Successfully.');
                    }
                }
                else
                {
                    $mediaData = $mediaModel;
                    $productData = $productModel;

                    $productData->productId = $productId;
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
                                $this->getMessage()->addMessage('Invalid request.',3);
                                throw new Exception("Invalid request.", 1);
                            }
                            unlink(Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/"). $media->name);
                            
                            if($postData['media']['base'] == $remove)
                            {
                                unset($postData['media']['base']);
                            }

                            if($postData['media']['thumb'] == $remove)
                            {
                                unset($postData['media']['thumb']);
                            }

                            if($postData['media']['small'] == $remove)
                            {
                                unset($postData['media']['small']);
                            }
                            $this->getMessage()->addMessage('Media Deleted Succesfully.');
                        }
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
                                $this->getMessage()->addMessage('Invalid request.',3);
                                throw new Exception("Invalid request.", 1);
                            }
                        }
                        unset($mediaData->mediaId);
                    }
                    else
                    {
                        $mediaData->gallery = 2;
                        $result = $mediaModel->save('productId');
                        $this->getMessage()->addMessage('Data updated.',1);
                    }
                    unset($mediaData->gallery);

                    if(array_key_exists('base',$postData['media']))
                    {
                        $productData->base = $postData['media']['base'];
                        $result = $productModel->save('productId');

                        if(!$result)
                        {
                            $this->getMessage()->addMessage('System is unabel to set base.',3);
                            throw new Exception("System is unabel to set base.", 1);
                        }
                        unset($productData->base);
                    }

                    if(array_key_exists('thumb',$postData['media']))
                    {
                        $productData->thumb = $postData['media']['thumb'];
                        $result = $productModel->save('productId');

                        if(!$result)
                        {
                            $this->getMessage()->addMessage('System is unabel to set thumb.',3);
                            throw new Exception("System is unabel to set thumb.", 1);
                        }
                        unset($productData->thumb);
                    }

                    if(array_key_exists('small',$postData['media']))
                    {
                        $productData->small = $postData['media']['small'];
                        $result = $productModel->save('productId','product');
                        if(!$result)
                        {
                            $this->getMessage()->addMessage('System is unabel to set small.',3);
                            throw new Exception("System is unabel to set small.", 1);
                        }
                        unset($productData->small);
                    }
                    $this->getMessage()->addMessage('Media Updated.');
                }
            }
            $this->getMessage()->addMessage('Data saved.',1);    
            $this->redirect('grid','product_media',['id' => $productId],true);    
        }
        catch (Exception $e)
        {
            $this->redirect('grid','product_media');
        } 
    }
}
