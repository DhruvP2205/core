<?php 
    $childrens = $this->getChildren();
    foreach ($childrens as $child) {
        echo $child->toHtml();
    }
?>
