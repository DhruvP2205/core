<?php Ccc::loadClass('Model_Core_Message');

class Model_Admin_Message extends Model_Core_Message
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSession()
    {
        if(!$this->session)
        {
            $adminSession = Ccc::getModel('Admin_Session');
            $this->setSession($adminSession);
        }
        return $this->session;
    }
}
