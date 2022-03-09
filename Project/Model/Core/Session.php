<?php
class Model_Core_Session
{
    protected $namespace = null;

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function __construct()
    {
        $this->setNamespace('core');
        $this->start();
    }

    public function isStarted()
    {
        if($this->getSessionId())
        {
            return true;
        }
        return false;
    }

    public function start()
    {
        if(!$this->isStarted())
        {
            session_start();
        }
        return $this;
    }

    public function getSessionId()
    {
        return session_id();
    }

    public function regenerateId()
    {
        if(!$this->isStarted())
        {
            $this->start();
        }
        return session_regenerate_id();
    }

    public function destroy()
    {
        if($this->isStarted())
        {
            session_destroy();
        }
        return $this;
    }

    public function __set($key, $value)
    {
        if(!$this->isStarted())
        {
            $this->start();
        }
        $_SESSION[$this->getNamespace()][$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if(!$this->isStarted())
        {
            $this->start();
        }
        if (!array_key_exists($key, $_SESSION[$this->getNamespace()])) 
        {
            return null;
        }
        return $_SESSION[$this->getNamespace()][$key];
    }

    public function __unset($key)
    {
        if(!$this->isStarted())
        {
            $this->start();
        }
        if(array_key_exists($key, $_SESSION[$this->getNamespace()]))
        {
            unset($_SESSION[$this->getNamespace()][$key]);
        }
        return $this;
    }
}
