<?php
    echo "<pre>";
    $arr1 = array('A','B');
    $arr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red", 
            "color4" => "Yellow",
            "color5" => "Orange");
    $arr3 = array();

    $str = "Dhruv";


    echo "Print using varDump\n";
    var_dump($arr1);
    echo "<br>";
    echo "<br>";
    echo "Print using print_r\n";
    print_r($arr2);

    //array_push(): insert element at last
    echo "<br>";
    echo "<br>";
    echo "Push";
    array_push($arr1, 'C','D','E');
    echo "<br>";
    print_r($arr1);


    //array_pop(): remove last element
    echo "<br>";
    echo "<br>";
    echo "Pop";
    array_pop($arr1);
    echo "<br>";
    print_r($arr1);


    //array_search(): returns the first corresponding key if not found then return nothing
    echo "<br>";
    echo "<br>";
    echo "Search";
    echo "<br>";
    echo "index: ";
    echo(array_search('D',$arr1));


    //array_key_exists(): Checks if the given key or index exists - if exists then give 1 otherwise give nothing
    echo "<br>";
    echo "<br>";
    echo "Key exists";
    echo "<br>";
    echo(array_key_exists(2,$arr1));
    echo "<br>";
    echo(array_key_exists("color4",$arr2));
    


    //array_keys(): Return all the keys
    echo "<br>";
    echo "<br>";
    echo "Return Keys";
    echo "<br>";
    print_r(array_keys($arr1));
    echo "<br>";
    print_r(array_keys($arr2));
    echo "<br>";
    print_r(array_keys($arr3));


    //array_values(): Return all the values
    echo "<br>";
    echo "<br>";
    echo "Return value";
    echo "<br>";
    print_r(array_values($arr1));
    echo "<br>";
    print_r(array_values($arr2));
    echo "<br>";
    print_r(array_values($arr3));


    //array_merge(): Merge array-if there is any empty array then it will not merge that array-if key value match then it will append that value
    echo "<br>";
    echo "<br>";
    echo "Merge";
    echo "<br>";
    print_r(array_merge($arr1,$arr2,$arr3));
    echo "<br>";
    print_r(array_values($arr1));
    echo "<br>";
    print_r(array_values($arr2));
    echo "<br>";
    print_r(array_values($arr3));


    //array_change_key_case(): Changes the case of keys - by default lowercase
    echo "<br>";
    echo "<br>";
    echo "Change key case: ";
    echo "<br>";
    print_r(array_change_key_case($arr2,CASE_LOWER));
    echo "<br>";
    print_r(array_change_key_case($arr2,CASE_UPPER));


    //sizeof(): return array size
    echo "<br>";
    echo "<br>";
    echo "Sizeof: ";
    echo "<br>";
    echo(sizeof($arr1));
    echo "<br>";
    echo(sizeof($arr2));
    echo "<br>";
    echo(sizeof($arr3));


    //is_array(): Finds variable is an array or not - if array then return 1 or else return nothing
    echo "<br>";
    echo "<br>";
    echo "Is array: ";
    echo "<br>";
    echo(is_array($arr1));
    echo "<br>";
    echo(is_array($arr2));
    echo "<br>";
    echo(is_array($str));


    //empty(): check a array is empty - if empty then return 1 or else return nothing
    echo "<br>";
    echo "<br>";
    echo "Empty: ";
    echo "<br>";
    echo(empty($arr1));
    echo "<br>";
    echo(empty($arr2));
    echo "<br>";
    echo(empty($arr3));


    //array_rand(): Pick number of random keys out of an array - by deafult select only 1 element - If there is empty array then return error - if number is greater than array size than give error
    echo "<br>";
    echo "<br>";
    echo "Random: ";
    echo "<br>";
    print_r(array_rand($arr1));
    echo "<br>";
    print_r(array_rand($arr2,2));
    /* Give error
    echo "<br>";
    print_r(array_rand($arr1,8));*/
    /* Give error
    echo "<br>";
    print_r(array_rand($arr3,2));*/


    //array_combine(): Creates another array by using 1st array as a keys and 2nd array as a values - if key and value array array size is not matched then give error - If there is already key in array then overwrite key
    $arrKey = array('a1','a2','a3','a4','a5');
    $arrVal = array('A','B','C','D','E');
    echo "<br>";
    echo "<br>";
    echo "Combine: ";
    echo "<br>";
    print_r(array_combine($arrKey,$arrVal));
    echo "<br>";
    print_r(array_combine($arrKey,$arr2));


    //array_count_values(): Counts all the values of array
    $arrKey = array('a1','a2','a1','a4','a5');
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");
    echo "<br>";
    echo "<br>";
    echo "Count value: ";
    echo "<br>";
    print_r(array_count_values($arrKey));
    echo "<br>";
    print_r(array_count_values($tempArr2));
    echo "<br>";
    print_r(array_count_values($arr3));


    //array_unique(): Removes duplicate values from array - it is Case sensitive
    $arrKey = array('a1','a2','a1','A1','a4','a5');
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","red","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");
    echo "<br>";
    echo "<br>";
    echo "Unique value: ";
    echo "<br>";
    print_r(array_unique($arrKey));
    echo "<br>";
    print_r(array_unique($tempArr2));
    echo "<br>";
    print_r(array_unique($arr3));


    //array_reverse(): Return an array with elements in reverse order - If we add true parameter then it will show original array index
    $arrKey = array('a1','a2','a1','A1','a4','a5');
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","red","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");
    echo "<br>";
    echo "<br>";
    echo "Reverse Array: ";
    echo "<br>";
    print_r(array_reverse($arrKey,true));
    echo "<br>";
    print_r(array_reverse($tempArr2));
    echo "<br>";
    print_r(array_reverse($tempArr2,true));
    echo "<br>";
    print_r(array_reverse($arr3));


    //array_flip(): Interchange keys values of array - If value repeated than it will overwrite
    echo "<br>";
    echo "<br>";
    echo "Flip: ";
    echo "<br>";
    print_r(array_flip($arr1));
    echo "<br>";
    print_r(array_flip($arr2));
    echo "<br>";
    print_r(array_flip($tempArr2));

    //sort(): Sort array in ascending order - if array sort then give 1 or else empty - if array is multi dimensonal then it will sort in 1D array
    echo "<br>";
    echo "<br>";
    echo "Sort in ascending: ";
    echo "<br>";
    print_r(sort($arr1));
    echo "<br>";
    print_r($arr1);
    echo "<br>";
    print_r(sort($arr2));
    echo "<br>";
    print_r($arr2);
    echo "<br>";
    print_r(sort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(sort($arr3));
    echo "<br>";
    print_r($arr3);

    //rsort(): Sort array in descending order - if array sort then give 1 or else empty - if array is multi dimensonal then it will sort in 1D array
    echo "<br>";
    echo "<br>";
    echo "Sort in descending : ";
    echo "<br>";
    print_r(rsort($arr1));
    echo "<br>";
    print_r($arr1);
    echo "<br>";
    print_r(rsort($arr2));
    echo "<br>";
    print_r($arr2);
    echo "<br>";
    print_r(rsort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(rsort($arr3));
    echo "<br>";
    print_r($arr3);


    //asort(): Sort an array in ascending order and maintain original index
    $arr1 = array('A','B');
    $arr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red", 
            "color4" => "Yellow",
            "color5" => "Orange");
    $tempArr2 = array(
            "color1" => "White", 
            "color2" => "Black", 
            "color3" => "Red","Blue","red","Red", 
            "color4" => "Yellow",
            "color5" => "Orange","White");

    echo "<br>";
    echo "<br>";
    echo "Sort in ascending: ";
    echo "<br>";
    print_r(asort($arr1));
    echo "<br>";
    print_r($arr1);
    echo "<br>";
    print_r(asort($arr2));
    echo "<br>";
    print_r($arr2);
    echo "<br>";
    print_r(asort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(asort($arr3));
    echo "<br>";
    print_r($arr3);

    //arsort(): Sort an array in descending order and maintain original index
    echo "<br>";
    echo "<br>";
    echo "Sort in descending: ";
    echo "<br>";
    print_r(arsort($arr1));
    echo "<br>";
    print_r($arr1);
    echo "<br>";
    print_r(arsort($arr2));
    echo "<br>";
    print_r($arr2);
    echo "<br>";
    print_r(arsort($tempArr2));
    echo "<br>";
    print_r($tempArr2);
    echo "<br>";
    print_r(arsort($arr3));
    echo "<br>";
    print_r($arr3);
?>
