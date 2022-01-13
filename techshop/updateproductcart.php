<?php
session_start();

    if(isset($_POST['quantity']) && isset($_POST['productid'])&& isset($_SESSION['customerid'])){


        $customerid = $_SESSION['customerid'];
        $productid = $_POST['productid'];
        $quantity = $_POST['quantity'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);



        $sqlsearch = "SELECT cartid FROM `cart` WHERE customerid='$customerid'";
        $result = mysqli_query($conn,$sqlsearch);
    

        if(mysqli_num_rows($result) > 0){

        while ($row = mysqli_fetch_assoc($result)) {

            $cartid =$row['cartid'];
            }
        }
    
    
        $sqlsearch = "SELECT * FROM `cartitem` WHERE cartid='$cartid' AND productid ='$productid'";
        $result = mysqli_query($conn,$sqlsearch);

        if(mysqli_num_rows($result) > 0){
        /* update count
        $sql = "UPDATE `cartitem` SET `quantity`='$itemcount' WHERE productid='$productid';";
        */
        $sql = "UPDATE `cartitem` SET `quantity`='$quantity' WHERE productid='$productid' AND cartid='$cartid' ;";
        $conn->query($sql);



    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }else{

        header("Location: http://localhost/techshop/cart.php");
    }
    
    ?>