<!DOCTYPE html>
<?php
// if user logged in sent to details page

session_start();



if(!isset($_SESSION['companyid']) || !isset($_GET['productid']))
{
    
    header("Location: http://localhost/techshop/company-account.php");
}


            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "techshop";


            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            $companyid =$_SESSION['companyid'];
            $productid =$_GET['productid'];
            $sql ="SELECT * FROM `product` AS p WHERE p.companyid='$companyid' AND p.productid='$productid';";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result) < 1){
                echo'Unauthorized access try.';
                header( "refresh:1;url=http://localhost/techshop/company-account.php" );
                
            }else{




?>



<?php include 'nonsearchheader.php';?>

    <!-------- add product------->

    <div class="small-container">
        <div class="row company-name">
            <h3><?php echo ucfirst($_SESSION['companyname']) ?> </h3>
        </div>
        <div class="adress">
            <h3>Edit Product</h3>
        </div>
        <div class="row">
            <div class="col-2 add-product">
                <form id="ProductAdd" method="post" action="/techshop/editproduct.php?productid=<?php echo $productid; ?>" enctype="multipart/form-data">
                    <p>Product Name</p>
                    <input type="text" placeholder="Enter product name" name="productname" required="required" id="productname" />
                    <p>Categorie</p>
                    <select  name="category" id="category">
                                <option value="phone">Phone</option>
                                <option value="computer">Computer</option>
                                <option value="television">Television</option>
                                <option value="gameconsole">Game Console</option>
                                <option value="camera">Camera</option>
                            </select>
                    <p>Description</p>
                    <textarea name="productdescription" cols="69" rows="5" placeholder="Enter products description" required="required" id="productdescription"></textarea>
                    <p>Price</p>
                    <input type="text" placeholder="Enter price" name="productprice" required="required" id="productprice" />
                    <label for="img">Select image</label>
                    <input type="file" id="image" name="image" required="required" >
                    <button type="submit" class="btn">Edit Product</button>
                </form>
            </div>
        </div>
    </div>


    <?php 
    
    $sql ="SELECT * FROM `product` AS p WHERE p.productid='$productid';";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <script>
                
            document.getElementById("productname").value = "<?php echo $row['productname'];?>";
            document.getElementById("productdescription").innerHTML = "<?php echo $row['productdescription'];?>";
            document.getElementById("category").value = "<?php echo $row['category'];?>";
            document.getElementById("productprice").value = "<?php echo $row['productprice'];?>";
            </script>


            <?php
        }
    }
    
    
    
    
    
    ?>






     <!---------------footer------->
<?php include 'footer.php';?>

</body>
</html>

<?php

if(isset( $_POST['productname']) && isset($_POST['productdescription']) && ($_POST['productprice']) && isset($_POST['category'])){
    
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techshop";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



$productname = $_POST['productname'];
$productdescription = $_POST['productdescription'];
$productprice = $_POST['productprice'];
$category = $_POST['category'];
$companyid = $_SESSION['companyid'];
$RandomNumber = uniqid();
$ext = pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
$target_dir = $category."/".$RandomNumber.".".$ext;
$productid =$_GET['productid'];


// UPDATE `product` SET `productdescription` = '$productdescription',`productname` ='$productname', `productprice`='$productprice',`category`='$category', `image`='$target_dir'  WHERE `product`.`productid` = '$productid';
$sql = "UPDATE `product` SET `productdescription` = '$productdescription',`productname` ='$productname', `productprice`='$productprice',`category`='$category', `image`='$target_dir'  WHERE `product`.`productid` = '$productid';";


if ($conn->query($sql) === TRUE) {
    echo'<script>
    var success = document.getElementById("success");
    success.innerText="Succesfully Registered";
    </script>';

    

    if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_dir )) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }







    echo'<script>
    alert("Item updated succesfully.");
    window.location.href = "http://localhost/techshop/product-list.php";
    

    </script>';


} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo'<script>
    alert("Please fill all all fields properly. Youre redirecting to productlist.");
    

    </script>';
}

}


?>
<?php
}
            
?>