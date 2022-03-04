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
          $adminModel = Ccc::getModel('Admin');
          $admins = $adminModel->fetchAll("SELECT * FROM admin");
          return $admins;
     }

     const STATUS_ENABLED = 1;
     const STATUS_DISABLED = 2;
     const STATUS_DEFAULT = 1;
     const STATUS_ENABLED_LBL = 'Active';
     const STATUS_DISABLED_LBL = 'Inactive';
     public function getStatus($key = null)
     {
          $statuses = [
               self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
               self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
          ];
          if(!$key)
          {
               return $statuses;
          }

          if(array_key_exists($key, $statuses))
          {
               return $statuses[$key];
          }
          return $statuses[self::STATUS_DEFAULT];
     }
}

?>
