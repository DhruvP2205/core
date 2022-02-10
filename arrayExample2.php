<?php
echo '<pre>';

$data = [

    ['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>1,'optionname'=>'o1'],
    ['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>2,'optionname'=>'o2'],
    ['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>3,'optionname'=>'o3'],
    ['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>4,'optionname'=>'o4'],
    ['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>5,'optionname'=>'o5'],
    ['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>6,'optionname'=>'o6'],
    ['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>7,'optionname'=>'o7'],
    ['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>8,'optionname'=>'o8']

];


echo "JSON Format\n";

$final['category']=[];

foreach ($data as $level1) {

    if(!array_key_exists($level1['category'], $final['category']))
    {
        $final['category'][$level1['category']]=[];    
    }
    
    if(!array_key_exists('name',$final['category'][$level1['category']]))
    {
        $final['category'][$level1['category']]['name']=$level1['categoryname'];
        $final['category'][$level1['category']]['attribute']=[];   
    }
    
    if(!array_key_exists($level1['attribute'],$final['category'][$level1['category']]['attribute']))
    {
        $final['category'][$level1['category']]['attribute'][$level1['attribute']]=[];
    }
    
    if(!array_key_exists('name',$final['category'][$level1['category']]['attribute'][$level1['attribute']]))
    {
        $final['category'][$level1['category']]['attribute'][$level1['attribute']]['name']=$level1['attributename']; 
        $final['category'][$level1['category']]['attribute'][$level1['attribute']]['option']=[];
    }
    
    if(!array_key_exists($level1['option'],$final['category'][$level1['category']]['attribute'][$level1['attribute']]['option']))
    {
        $final['category'][$level1['category']]['attribute'][$level1['attribute']]['option'][$level1['option']]=[];
    }
    
    if(!array_key_exists('name',$final['category'][$level1['category']]['attribute'][$level1['attribute']]['option'][$level1['option']]))
    {
        $final['category'][$level1['category']]['attribute'][$level1['attribute']]['option'][$level1['option']]['name']=$level1['optionname'];  
    }
}

print_r($final);


echo "\n\nNormal Format\n";

$row = [];
$reverseArray = [];

foreach($final['category'] as $categoryID => $level1){

    $row['category'] = $categoryID;
    $row['categoryname'] = $final['category'][$categoryID]['name'];

    foreach($level1['attribute'] as $attributeId => $level2){
        $row['attribute'] = $attributeId;
        $row['attributename'] = $final['category'][$categoryID]['attribute'][$attributeId]['name'];
        foreach ($level2['option'] as $optionId => $level3) {
            $row['option'] = $optionId;
            $row['optionname'] = $final['category'][$categoryID]['attribute'][$attributeId]['option'][$optionId]['name'];
            array_push($reverseArray,$row);
        }
    }
} 

print_r($reverseArray);

?>
