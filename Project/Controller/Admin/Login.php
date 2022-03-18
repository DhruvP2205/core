<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Admin_Login extends Controller_Admin_Action
{
    public function loginAction()
    {
        $this->setTitle('Login');
        $content = $this->getLayout()->getContent();
        $loginGrid = Ccc::getBlock('Admin_Login_Grid');
        $content->addChild($loginGrid);
        $this->renderLayout();
    }

    public function loginPostAction()
    {
        try
        {
            $adminModel = Ccc::getModel("Admin");
            $loginModel = Ccc::getModel("Admin_Login");

            $request = $this->getRequest();

            if(!$request->isPost())
            {
                throw new Exception("Invalid request.");
            }
            
            if(!$request->getPost())
            {
                throw new Exception("Invalid request.");
            }

            $loginData = $request->getPost('admin');
            $password = md5($loginData['password']);
            
            $result = $adminModel->fetchAll("SELECT * FROM `admin` WHERE `email` = '{$loginData['email']}' AND `password` = '{$password}'");
            
            if(!$result)
            {
                throw new Exception("invalid request.");
            }

            $loginModel->login($result[0]->email);
            $this->getMessage()->addMessage('You are logged in!');
            $this->redirect('grid','product',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('login','admin_login',[],true);
        }
    }

    public function logoutAction()
    {
        $loginModel = Ccc::getModel("Admin_Login");
        if($loginModel->getLogin())
        {
            $loginModel->logout();
        }
        $this->getMessage()->addMessage('Logout succesfully!');
        $this->redirect('login','admin_login',[],true); 
    }
}
