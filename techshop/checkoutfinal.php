<?php

    session_start(); 

if(isset($_SESSION['customerid']) &&isset($_POST['country']) &&isset($_POST['address'])&&isset($_POST['radio']) ){
$customerid = $_SESSION['customerid'];
$address =$_POST['address'];
$country =$_POST['country'];
$radio =$_POST['radio'];
$lastadress=$country.' '.$address;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techshop";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql="INSERT INTO `orders` (`orderid`, `orderdate`, `paymenttype`, `shippingaddress`, `customerid`) VALUES (NULL, current_timestamp(), 'creditcard', '$lastadress', '$customerid');";
$conn->query($sql);

$orderid="SELECT * FROM `orders` WHERE customerid='$customerid' ORDER BY orderid DESC LIMIT 1";
$result = mysqli_query($conn,$orderid);

if(mysqli_num_rows($result) > 0){

    while ($row = mysqli_fetch_assoc($result)) {
        $orderid =$row['orderid'];
        
    }
}else{
    header("Location: http://localhost/techshop/index.php");
}



$sqlsearch = "SELECT p.productid AS productid,p.productname AS productname,p.productprice AS productprice, p.image AS image,
            ci.quantity AS quantity,ci.quantity*p.productprice AS totalprice,ci.quantity*p.productprice*0.18 AS taxprice
            FROM `product` AS p,`cart` AS c, `cartitem` AS ci 
            WHERE c.customerid='$customerid' AND c.cartid=ci.cartid AND ci.productid = p.productid
            ;";
$result2 = mysqli_query($conn,$sqlsearch);


if(mysqli_num_rows($result2) > 0){

    while ($row = mysqli_fetch_assoc($result2)) {
        $productid =$row['productid'];
        $quantity =$row['quantity'];
        $productprice =$row['productprice'];
        $productname =$row['productname'];
        $image =$row['image'];

        
        
        
        $sqleach="INSERT INTO `orderitem` (`orderid`, `productid`, `productname`, `productimage`, `quantity`, `price`) VALUES ('$orderid', '$productid', '$productname', '$image', '$quantity', '$productprice');";
        echo $sqleach;
        $resultx = mysqli_query($conn,$sqleach);

        $sqldelete = "DELETE ci FROM cartitem  AS ci,cart  AS c WHERE ci.productid = '$productid' AND c.cartid =ci.cartid AND c.customerid='$customerid';";
        $conn->query($sqldelete);


    }
}else{
    header("Location: http://localhost/techshop/index.php");
}













header("Location: http://localhost/techshop/order-list.php");
}
else{
    header("Location: http://localhost/techshop/index.php");
}









?>