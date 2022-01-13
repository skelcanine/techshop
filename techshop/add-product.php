<?php
// if user logged in sent to details page

session_start();



if(!isset($_SESSION['companyid']))
{
    
    header("Location: http://localhost/techshop/company-account.php");
}


?>

<!DOCTYPE html>

<?php include 'nonsearchheader.php';?>

    <!-------- add product------->

    <div class="small-container">
        <div class="row company-name">
            <h3><?php echo ucfirst($_SESSION['companyname']) ?> </h3>
        </div>
        <div class="adress">
            <h3>Add Product</h3>
        </div>
        <div class="row">
            <div class="col-2 add-product">
                <form id="ProductAdd" method="post" action="/techshop/add-product.php" enctype="multipart/form-data">
                    <p>Product Name</p>
                    <input type="text" placeholder="Enter product name" name="productname" />
                    <p>Categorie</p>
                    <select name="category">
                                <option value="phone">Phone</option>
                                <option value="computer">Computer</option>
                                <option value="television">Television</option>
                                <option value="gameconsole">Game Console</option>
                                <option value="camera">Camera</option>
                            </select>
                    <p>Description</p>
                    <textarea name="productdescription" cols="69" rows="5" placeholder="Enter products description"></textarea>
                    <p>Price</p>
                    <input type="text" placeholder="Enter price" name="productprice" />
                    <label for="img">Select image</label>
                    <input type="file" id="image" name="image" >
                    <button type="submit" class="btn">Add Product</button>
                </form>
            </div>
        </div>
    </div>

     <!---------------footer------->
<?php include 'footer.php';?>

</body>
</html>

<?php

if(isset( $_POST['productname']) && isset($_POST['productdescription']) && ($_POST['productprice']) && isset($_POST['category'])){
    var_dump($_POST);
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



$sql = "INSERT INTO `product` (`productid`, `companyid`, `productname`, `productdescription`, `productprice`, `category`, `image`, `soldquantity`) VALUES (NULL, '$companyid', '$productname', '$productdescription', '$productprice', '$category', '$target_dir', '0');";


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
    alert("Item added succesfully.");
    window.location.href = "http://localhost/techshop/product-list.php";
    

    </script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo'<script>
var warning = document.getElementById("warning");
warning.innerText="Database Error Occured.";
</script>';
}


}









?>