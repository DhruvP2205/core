<div class="topnav">
    <?php
    $fileList = glob('Controller/*.php');
    foreach($fileList as $filename){
        if(is_file($filename))
        {
            $file = explode("/", $filename);
            $fileList = explode(".",$file[1]); ?>
            <a href="<?php echo $this->getUrl('grid',strtolower($fileList[0]),[],true)?>"><?php echo $fileList[0]; ?></a>
            <?php
        }   
    }
?>
</div>
