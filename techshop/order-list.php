<?php

    session_start(); 

if(isset($_SESSION['customerid'])){
    $customerid =$_SESSION['customerid'];

}else{
    header("Location: http://localhost/techshop/index.php");
}

?>



<!DOCTYPE html>

<?php include 'nonsearchheader.php';?>


    <div class="small-container cart-page">
    <?php 
        ///Login operations
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sqlorders ="SELECT * FROM `orders` WHERE customerid='$customerid' ORDER BY orderid DESC";
        $result = mysqli_query($conn,$sqlorders);

        if(mysqli_num_rows($result) > 0){
          while ($row = mysqli_fetch_assoc($result)) {
              $cartno =$row['orderid'];
              $cartstart =1;
              $carttotal=0;


            if($cartstart==1){
        ?>

        <h3>OrderId: </h3>
        <p><?php echo $row['orderid'] ?></p>
        <table class="order-list">
            <tr>
                <th>Product</th>
                <th>Order Date</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php }

            $sqleachitem = "SELECT oi.productname AS productname,oi.price AS productprice, oi.productimage AS image,
            oi.quantity AS quantity,oi.quantity*oi.price AS totalprice,o.orderdate AS orderdate 
            FROM orderitem AS oi, orders AS o WHERE oi.orderid=o.orderid AND o.customerid='$customerid' AND o.orderid='$cartno';";
            $result2 = mysqli_query($conn,$sqleachitem);

            if(mysqli_num_rows($result2) > 0){
                while ($row2 = mysqli_fetch_assoc($result2)) { 
                    $carttotal+=$row2['totalprice'];     

            
            
            ?>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="<?php echo $row2['image']; ?>" />
                        <div>
                            <p><?php echo ucfirst($row2["productname"]); ?></p>
                            <small><?php echo '$'.$row2["productprice"]; ?></small>
                        </div>
                    </div>
                </td>
                <td><?php echo $row2['orderdate']; ?></td>
                <td><?php echo $row2['quantity']; ?></td>
                <td><?php echo '$'.$row2['totalprice']; ?></td>
            </tr>
            <?php }}?>
        </table>
        

        <div class="total-price">
            <table>
                <tr>
                    <td>Total</td>
                    <td><?php echo '$'.$carttotal; ?></td>
                </tr>
            </table>
        </div>
        <?php }}?>
        
    </div>


        <!---------------footer------->
        <?php include 'footer.php';?>
</body>
</html>