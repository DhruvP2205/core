<?php
echo '<pre>';

$data = [

    ['category'=>1,'attribute'=>1,'option'=>1],
    ['category'=>1,'attribute'=>1,'option'=>2],
    ['category'=>1,'attribute'=>2,'option'=>3],
    ['category'=>1,'attribute'=>2,'option'=>4],
    ['category'=>2,'attribute'=>3,'option'=>5],
    ['category'=>2,'attribute'=>3,'option'=>6],
    ['category'=>2,'attribute'=>4,'option'=>7],
    ['category'=>2,'attribute'=>4,'option'=>8]
];

echo "JSON Format\n";
$i=0;
while($i<count($data)){
    $result[$data[$i]['category']][$data[$i]['attribute']][$data[$i]['option']]=$data[$i]['option'];
    $i++;
}

print_r($result);



echo "\n\nNormal Format\n";
$final = [];

foreach ($result as $categoryID => $level1) {
    $row['category'] = $categoryID;
    foreach ($level1 as $attributeID => $level2) {
        $row['attribute'] = $attributeID;
        foreach ($level2 as $optionID => $level3) {
            $row['option'] = $optionID;
            array_push($final,$row);
        }
    }
}

print_r($final);


/*$data = [
    '1'=>[
        '1' => [
            '1' => 1,
            '2' => 2        
        ],
        '2' => [
            '3' => 3,
            '4' => 4        
        ]
    ],
    '2'=>[
        '3' => [
            '5' => 5,
            '6' => 6        
        ],
        '4' => [
            '7' => 7,
            '8' => 8        
        ]
    ],
];*/

?>


