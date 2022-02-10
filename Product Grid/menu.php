<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
                body {
                    margin: 0;
                }

                .topnav {
                    display: table;
                    text-align: center;
                    width: 100%;

                    overflow: hidden;
                    background-color: #006699;
                }

                .topnav a {
                    color: #f2f2f2;
                    display: inline-block;
                    float: none;
                    font-size: 25px;
                    padding: 10px 30px;
                    text-decoration: none;
                    font-weight: bold;
                }

                .topnav a:hover {
                    color: #E96B15;
                    
                }

            </style>
        </head>
        <body>

        <div class="topnav">
            <?php

            $fileList = glob('Controller/*.php');
            foreach($fileList as $filename){
                if(is_file($filename)){
                    $file = explode("/", $filename);
                    //print_r($file);
                    $fileList = explode(".",$file[1]); ?>
                    <a href="index.php?c=<?php echo strtolower($fileList[0]); ?>&a=grid"><?php echo $fileList[0]; ?></a>
                    <?php
                }   
            }
        ?>
        </div>

    </body>
</html>
