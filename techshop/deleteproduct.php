

<?php
session_start();


    if(isset($_GET['productid']) && isset($_SESSION['companyid'])){
        $productid= $_GET['productid'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "DELETE FROM `product` WHERE `product`.`productid` = '$productid';";
        $conn->query($sql);

        echo'Operation succesfull.';
        header( "refresh:1;url=product-list.php" );

    }else{
        echo'Couldnt Complete the operation.';
        header( "refresh:1;url=product-list.php" );
    }

        ?>