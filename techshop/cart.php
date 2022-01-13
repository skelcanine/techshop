<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(isset($_SESSION['customerid'])){
    $customerid = $_SESSION['customerid'];
    }else{
        header("Location: http://localhost/techshop/index.php");
    }

?>


<!DOCTYPE html>


<?php include 'nonsearchheader.php';?>



 <!-------- cart itmes details-->

    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>


            <?php 

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "techshop";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

        
            $sqlsearch = "SELECT p.productid AS productid,p.productname AS productname,p.productprice AS productprice, p.image AS image,
            ci.quantity AS quantity,ci.quantity*p.productprice AS totalprice,ci.quantity*p.productprice*0.18 AS taxprice
            FROM `product` AS p,`cart` AS c, `cartitem` AS ci 
            WHERE c.customerid='$customerid' AND c.cartid=ci.cartid AND ci.productid = p.productid
            ;";
            $result = mysqli_query($conn,$sqlsearch);
            $subtotal =0;
            $tax=0;
            $total=0;
    
            $totalitemcount =0;
            if(mysqli_num_rows($result) > 0){
              $totalitemcount =  mysqli_num_rows($result);

            while ($row = mysqli_fetch_assoc($result)) {
                $total+=$row["totalprice"];
                $tax+=$row["taxprice"];

            ?>

                
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="<?php echo $row["image"]; ?>" />
                        <div>
                            <p><?php echo ucfirst($row["productname"]); ?></p>
                            <small><?php echo '$'.$row["productprice"]; ?></small>
                            <br />
                            <a href="deletecartproduct.php?productid=<?php echo $row["productid"]; ?>">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="<?php echo $row["quantity"]; ?>" onchange="<?php echo'updatecartitem('.$row["productid"].')'; ?>" id="<?php echo'prod'.$row["productid"];?>"/></td>
                <td><?php echo $row["totalprice"]; ?></td>
            </tr>






<?php
            }

            } 
            $subtotal = $total - $tax;   








            
            
            
            ?>

            
            
        </table>
        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td><?php echo $subtotal.' $'; ?></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td><?php echo $tax.' $'; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?php echo $total.' $'; ?></td>
                </tr>
                <tr>
                    <td></td>
<?php  if($totalitemcount!=0){ ?>

                    <td><a href="/techshop/checkout.php" class="btn">Checkout &#8594;</a></td>
                    <?php }  ?>
                </tr>
            </table>

        </div>

    </div>
    



    <!---------------footer------->
    <?php include 'footer.php';?>

    <script>
        function updatecartitem(productid) {
        
        var quantity = document.getElementById("prod"+productid).value;
        console.log(productid+"xx"+quantity);
                
        $.ajax({
            type : "POST",  //type of method
            url  : "/techshop/updateproductcart.php",  //your page
            data : { productid : productid, quantity : quantity },// passing the values
            success: function(res){  
                window.location.reload();
                    }
        });
        
}



    </script>
</body>
</html>