<?php 
    echo "<pre>";
    
    class user
    {
        public $name;
        public $email;
        public $age;
        public $pass;

        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        public function getName()
        {
            return $this->name;
        }

        public function resetName()
        {
            $this->name = null;
            return $this;
        }

        public function setEmail($email)
        {
            $this->email = $email;
            return $this;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function resetEmail()
        {
            $this->email = null;
            return $this;
        }

        public function setAge($age)
        {
            $this->age = $age;
            return $this;
        }

        public function getAge()
        {
            return $this->age;
        }


        public function resetAge()
        {
            $this->age = null;
            return $this;
        }


        public function setPass($pass)
        {
            $this->pass = $pass;
            return $this;
        }

        public function getPass()
        {
            return $this->pass;
        }

        public function resetPass()
        {
            $this->pass = null;
            return $this;
        }

        public function insertUser($query)
        {
            $conn = mysqli_connect('localhost:3308','root','1234','demodb');

            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                if(mysqli_query($conn,$query))
                {
                    echo "Data isnserted!<br>";
                }
                else
                {
                    echo mysqli_error("<br>".$conn);
                }

                mysqli_close($conn);
            }
            return $this;
        }

        public function updateUser($query)
        {
            $conn = mysqli_connect('localhost:3308','root','1234','demodb');

            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                if(mysqli_query($conn,$query))
                {
                    echo "Data updated!<br>";
                }
                else
                {
                    echo mysqli_error("<br>".$conn);
                }
                mysqli_close($conn);
            }
            return $this;
        }

        public function deleteUser($query)
        {
            $conn = mysqli_connect('localhost:3308','root','1234','demodb');

            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                if(mysqli_query($conn,$query))
                {
                    echo "Data deleted!<br>";
                }
                else
                {
                    echo mysqli_error("<br>".$conn);
                }
                mysqli_close($conn);
            }
            return $this;
        }

        public function showUser($query)
        {
            $conn = mysqli_connect('localhost:3308','root','1234','demodb');

            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
                if($res = mysqli_query($conn,$query))
                {
                    while ($row = mysqli_fetch_row($res))
                    {
                        echo"<br>";
                        print_r($row);
                    }
                }
                else
                {
                    echo mysqli_error("<br>".$conn);
                }
                mysqli_close($conn);
            }
            return $this;
        }
    }
    
    $u1 = new user();
    $u1->setName("Dhruv")->setEmail("asdf@gmail.com")->setAge(21)->setPass("Asdf@1234");

    echo($u1->getName());
    echo "<br>";
    echo($u1->getEmail());
    echo "<br>";
    echo($u1->getAge());
    echo "<br>";
    echo($u1->getPass());


    echo "<br>";
    echo "<br>";
    echo "Insert Data: ";
    $u1->insertUser("insert into users(name,email,age,password) values('".$u1->getName()."','".$u1->getEmail()."','".$u1->getAge()."','".$u1->getPass()."')");


    $u1->setName("Dhruv Prajapati")->setEmail("asdf1234@gmail.com")->setAge(22)->setPass("123@Asdf");

    echo "<br>";
    echo "<br>";
    echo "Insert Data: ";
    $u1->insertUser("insert into users(name,email,age,password) values('".$u1->getName()."','".$u1->getEmail()."','".$u1->getAge()."','".$u1->getPass()."')");

    echo "<br>";
    echo "<br>";
    $u1->updateUser("update users set age = 20 where email='asdf@gmail.com'");

    echo "<br>";
    echo "<br>";
    $u1->showUser("select * from users");
?>
