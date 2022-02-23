<?php
Ccc::loadClass('Block_Core_Template');
class Block_Admin_Grid extends Block_Core_Template   
{ 
	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
	}

   public function getAdmins()
   {
   		$admins = Ccc::getModel('Admin')->fetchAll("SELECT * FROM admin");
		return $admins;
   }
}

?>
