

<?php
session_start();


    if(isset($_GET['productid']) && isset($_SESSION['customerid'])){
        $productid= $_GET['productid'];
        $customerid = $_SESSION['customerid'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        $sql = "DELETE ci FROM cartitem  AS ci,cart  AS c WHERE ci.productid = '$productid' AND c.cartid =ci.cartid AND c.customerid='$customerid';";
        $conn->query($sql);

        
        header( "refresh:0;url=cart.php" );

    }else{
        echo'Couldnt Complete the operation.';
        header( "refresh:1;url=cart.php" );
    }

        ?>