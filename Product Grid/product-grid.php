<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product</title>
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
    <a href='product-add.php'>Add Product</a>
    <h2>All Records</h2>

    <?php 

        $conn = mysqli_connect('localhost:3308','root','1234','demodb');
      
        $query = "Select * from product";
        $result = mysqli_query($conn,$query) or die("Unsuccessful!");  
        if (mysqli_num_rows($result)>0) 
        { ?>
            <table cellpadding="7px">
                <thead>
                    <th>Sr No.</th>
                    <th>Product ID</th>
                    <th>Name</th>  
                    <th>Price</th>
                    <th>Quantity</th>  
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                
                <?php 
                    $i=1;
                    while($row =mysqli_fetch_assoc($result))
                    {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['productID']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['createdDate']; ?></td>
                    <td><?php echo $row['updatedDate']; ?></td>
                    <td>
                        <a href="product-edit.php?id=<?php echo($row['productID']);?>">Edit</a>
                        <a href="product-delete.php?id=<?php echo($row['productID']);?>">Delete</a>
                    </td>
                </tr>

                <?php
                    $i++; 
                    }
                ?>
                
                </tbody>
            </table>
        <?php
            } 
            else
            {
                echo "<h2>NO RECORD FOUND!</h2>";
            }
            mysqli_close($conn);
        ?>
</body>
</html>
