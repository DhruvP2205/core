<?php Ccc::loadClass('Block_Core_Grid');

class Block_Product_Grid extends Block_Core_Grid   
{ 
	public function __construct()
	{
		parent::__construct();
        $this->prepareCollections();
	}

	public function prepareCollections()
    {

        $this->addColumn([
        'title' => 'Product Id',
        'type' => 'int',
        'key' =>'productId'
        ],'id');

        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'name'
        ],'Name');

        $this->addColumn([
        'title' => 'Sku',
        'type' => 'varchar',
        'key' =>'sku'
        ],'Sku');

        $this->addColumn([
        'title' => 'Base Image',
        'type' => 'int',
        'key' =>'base'
        ],'Base Image');

        $this->addColumn([
        'title' => 'Thumb Image',
        'type' => 'int',
        'key' =>'thumb'
        ],'Thumb Image');

        $this->addColumn([
        'title' => 'Small Image',
        'type' => 'int',
        'key' =>'small'
        ],'Small Image');

        $this->addColumn([
        'title' => 'Price',
        'type' => 'int',
        'key' =>'price'
        ],'Price');

        $this->addColumn([
        'title' => 'TAX',
        'type' => 'int',
        'key' =>'tax'
        ],'TAX');

        $this->addColumn([
        'title' => 'Discount',
        'type' => 'int',
        'key' =>'discount'
        ],'Discount');

        $this->addColumn([
        'title' => 'MSP',
        'type' => 'int',
        'key' =>'msp'
        ],'MSP');

        $this->addColumn([
        'title' => 'Cost Price',
        'type' => 'int',
        'key' =>'costPrice'
        ],'Cost Price');

        $this->addColumn([
        'title' => 'Quantity',
        'type' => 'int',
        'key' =>'quantity'
        ],'Quantity');

        $this->addColumn([
        'title' => 'Status',
        'type' => 'int',
        'key' =>'status'
        ],'Status');

        $this->addColumn([
        'title' => 'Created Date',
        'type' => 'datetime',
        'key' =>'createdDate'
        ],'Created Date');

        $this->addColumn([
        'title' => 'Updated Date',
        'type' => 'datetime',
        'key' =>'updatedDate'
        ],'Updated Date');

        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'category'],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'product' ],'Delete');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $products = $this->getProducts();
        $this->setCollection($products);
        return $this;
    }

   	public function getProducts()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $productModel = Ccc::getModel('Product');

        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(productId) FROM `product`");
        $pagerModel->execute($totalCount, $page, $ppr);
        
        $this->setPager($pagerModel);

		$products = $productModel->fetchAll("SELECT * FROM `product` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
		$productColumn = [];
        if($products)
        {
            foreach ($products as $product) 
            {
                array_push($productColumn, $product);
            }
        }
        return $productColumn;
	}
}
