<?php
// if user logged in sent to details page

session_start();



if(isset($_SESSION['companyid']))
{
    
    header("Location: http://localhost/techshop/product-list.php");
}


?>

<!DOCTYPE html>

<?php include 'nonsearchheader.php';?>
    <!------------account page------>
    <div class="company-account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/logo.png" />

                </div>
                <div class="col-2">
                    <div class="company-form-container">
                        <h3>Company Login</h3>
                        <form method="post" action="company-account.php" id="CompanyLoginForm">
                        <span style="color:red;" id="warning"></span>
                            <input type="text" placeholder="Company Name" id="companyname" name="companyname" />
                            <input type="password" placeholder="Password" name="password" id="password" />
                            <button type="submit" class="btn">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!---------------footer------->
<?php include 'footer.php';?>
</body>
</html>
<?php

if(isset($_POST['companyname']) && isset($_POST['password'])){
    $companyname = $_POST['companyname'];
    $pass = $_POST['password'];


///Login operations
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT companyid,companyname FROM company WHERE companyname= '$companyname' AND companypassword ='$pass';";
$result = mysqli_query($conn,$sqll);


if(mysqli_num_rows($result) > 0){

    while ($row = mysqli_fetch_assoc($result)) {

    $_SESSION['companyid']=$row["companyid"];
    $_SESSION['companyname']=$row["companyname"];
    header("Location: http://localhost/techshop/product-list.php");

}
}else{
    echo'<script>
var warning = document.getElementById("warning");
warning.innerText="This company doesnt exist.";
</script>';

}










}
?>
