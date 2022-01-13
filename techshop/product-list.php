<?php
// if user logged in sent to details page

session_start();



if(!isset($_SESSION['companyid']))
{
    
    header("Location: http://localhost/techshop/company-account.php");
}


?>

<!DOCTYPE html>



<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Account | Technological Products Shopping System </title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="images/logo.png" height="100" width="125">
                </div>
                <nav>
                    <ul>
                        
                    </ul>
                </nav>
                




                <div class="logout-btn">
                    <a href="logout.php" class="btn">Logout</a>
                </div>

            </div>
        </div>
    </div>



















 <!-------- cart itmes details-->

    <div class="small-container product-list">
        <div class="row company-name-product-list">
        <div class="col-2">
            <h3><?php echo ucfirst($_SESSION['companyname']) ?> </h3>
        </div>
        <div class="col-2 add-product-btn">
        <a href="/techshop/add-product.php" class="btn">Add Item</a>
        </div>
        </div>

        <table>


        <?php 
        $companyid = ($_SESSION['companyid']);
        ///Login operations
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        $sqlsearch = "SELECT * FROM `product` WHERE companyid='$companyid'";
        $result = mysqli_query($conn,$sqlsearch);

        if(mysqli_num_rows($result) > 0){

            while ($row = mysqli_fetch_assoc($result)) {
                
            
        
        
        
        ?>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <div class="product-image-name">
                        <img src="<?php echo $row["image"]; ?>" />
                        <div class="product-name">
                            <p><?php echo ucfirst($row["productname"]); ?></p>
                        </div>
                    </div>
                </td>
                <td><?php echo '$'.$row["productprice"]; ?></td>
                <td>
                    <a href="editproduct.php?productid=<?php echo $row["productid"]; ?>">Edit</a>
                    <br />
                    <a href="deleteproduct.php?productid=<?php echo $row["productid"]; ?>">Delete</a>
                </td>
            </tr>

            <?php 
            }}
           
           ?>
            
        </table>
    </div>


    <!---------------footer------->
<?php include 'footer.php';?>
</body>
</html>