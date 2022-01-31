<?php
    echo "<pre>";
    class a1{}
    class a2 extends a1 {
        function a2Msg()
        {
            echo "Hello";
        }
    }
    class car {
        public $name = "Abc";
        public $color = "White";

        // Methods
        function setName($name) {
            $this->name = $name;
        }
        function getName() {
            return $this->name;
        }
        function setColor($color) {
            $this->color = $color;
        } 
        function getColor() {
            return $this->color;
        }
        
        function called(){
            var_dump(get_called_class());//return name of class
        }
    }

    function printHello(){
        echo "Hello";
    }

    trait carTrail{}

    $obj = new car();
    $objA1 = new a1();
    $objA2 = new a2();

    echo "Print using varDump\n";
    var_dump($obj);
    echo "<br>";
    echo "<br>";
    echo "Print using print_r\n";
    print_r($obj);


    //class_exists(): Checks if class exists or not - if exists then give 1 or else give nothing
    echo "<br>";
    echo "<br>";
    echo "class Exists: ";
    echo "<br>";
    echo(class_exists('car'));
    echo "<br>";
    echo(class_exists('a1'));
    echo "<br>";
    echo(class_exists('obj'));
    echo "<br>";


    //method_exists (): Return true if the given class method exists or else give nothing
    echo "<br>";
    echo "<br>";
    echo "Method Exists: ";
    echo "<br>";
    echo(method_exists ($obj,'setName'));
    echo "<br>";
    echo(method_exists ($obj,'printHello'));
    echo "<br>";
    echo(method_exists ($obj,'getColor'));
    echo "<br>";
    echo(method_exists ($obj,'obj'));
    echo "<br>";


    //function_exists(): Return true if the given function exists or else give nothing
    echo "<br>";
    echo "<br>";
    echo "Function Exists: ";
    echo "<br>";
    echo(function_exists('setName'));
    echo "<br>";
    echo(function_exists('printHello'));
    echo "<br>";
    echo(function_exists('getColor'));
    echo "<br>";
    echo(function_exists('obj'));
    echo "<br>";


    //get_defined_functions(): Returns array of internal and user defined functions
    echo "<br>";
    echo "<br>";
    echo "Defined Function: ";
    echo "<br>";
    //print_r(get_defined_functions());
    echo "<br>";


    //class_alias(): Creates alias of class - Return true if the alias created or else give nothing
    echo "<br>";
    echo "<br>";
    echo "Class alias: ";
    echo "<br>";
    print_r(class_alias('car','model'));
    echo "<br>";


    //get_class(): Returns the name of the class of an object
    echo "<br>";
    echo "<br>";
    echo "Get class: ";
    echo "<br>";
    print_r(get_class($obj));
    echo "<br>";
    print_r(get_class($objA1));
    echo "<br>";
    print_r(get_class($objA2));
    echo "<br>";


    //get_called_class(): return called class name
    echo "<br>";
    echo "<br>";
    echo "Get class called: ";
    echo "<br>";
    $obj::called();
    echo "<br>";

    //get_class_methods(): Return class method names
    echo "<br>";
    echo "<br>";
    echo "Class method: ";
    echo "<br>";
    print_r(get_class_methods('car'));
    echo "<br>";
    print_r(get_class_methods('a1'));
    echo "<br>";
    print_r(get_class_methods('asdf'));
    echo "<br>";


    //get_class_vars(): return default properties of class
    echo "<br>";
    echo "<br>";
    echo "Class vars: ";
    echo "<br>";
    print_r(get_class_vars(get_class($obj)));
    echo "<br>";
    /* Give warning if obj not exists
    print_r(get_class_vars(get_class($obj3)));
    echo "<br>";*/


    //get_parent_class(): return parent class name
    echo "<br>";
    echo "<br>";
    echo "Parent Class: ";
    echo "<br>";
    print_r(get_parent_class('a2'));
    echo "<br>";
    print_r(get_parent_class('car'));
    echo "<br>";
    print_r(get_parent_class('a1'));
    echo "<br>";


    //is_subclass_of(): Checks if the object has class as one of its parents or implements it
    echo "<br>";
    echo "<br>";
    echo "Is sub class: ";
    echo "<br>";
    print_r(is_subclass_of($objA2,'a1'));
    echo "<br>";
    print_r(is_subclass_of($objA2,'car'));
    echo "<br>";
    print_r(is_subclass_of($obj,'a1'));
    echo "<br>";


    //interface_exists(): Checks if the interface has been defined
    echo "<br>";
    echo "<br>";
    echo "Interface exists: ";
    echo "<br>";
    print_r(interface_exists('inter1'));
    echo "<br>";


    //get_declared_classes(): Returns an array with the name of the defined classes
    echo "<br>";
    echo "<br>";
    echo "Declared class: ";
    echo "<br>";
    print_r(get_declared_classes());
    echo "<br>";


    //get_declared_traits(): Returns an array of all declared traits
    echo "<br>";
    echo "<br>";
    echo "Declare traits: ";
    echo "<br>";
    print_r(get_declared_traits());
    echo "<br>";


    //trait_exists(): Checks if the trait exists
    echo "<br>";
    echo "<br>";
    echo "Declare traits: ";
    echo "<br>";
    print_r(trait_exists('carTrail'));
    echo "<br>";


    //get_mangled_object_vars(): Returns an array of mangled object properties
    echo "<br>";
    echo "<br>";
    echo "Mangled object: ";
    echo "<br>";
    print_r(get_mangled_object_vars($obj));
    echo "<br>";
    print_r(get_mangled_object_vars($objA1));
    echo "<br>";
    print_r(get_mangled_object_vars($objA2));
    echo "<br>";


    //is_a(): Checks if the object is of this class or has this class as one of its parents
    echo "<br>";
    echo "<br>";
    echo "Is a: ";
    echo "<br>";
    print_r(is_a($obj,'car'));
    echo "<br>";
    print_r(is_a($objA2,'car'));
    echo "<br>";
    print_r(is_a($objA1,'a1'));
    echo "<br>";

    //property_exists(): Checks if the object or class has a property
    echo "<br>";
    echo "<br>";
    echo "Property exists: ";
    echo "<br>";
    print_r(property_exists('car','name'));
    echo "<br>";
    print_r(property_exists('car','email'));
    echo "<br>";
    print_r(property_exists('a1','name'));
    echo "<br>";



?>
