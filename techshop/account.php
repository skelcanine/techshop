
<!DOCTYPE html>


<?php
// if user logged in sent to details page

session_start();



if(isset($_SESSION['customerid']))
{
    $userid = $_SESSION['customerid'];
    header("Location: http://localhost/techshop/index.php");
}


?>

<?php include 'nonsearchheader.php';?>
    <!------------account page login register ------>
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/logo.png" />

                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator" />
                        </div>
                        <form method="post" action="account.php" id="LoginForm">
                            <span style="color:red;" id="warninglogin"></span>
                            <input type="email" placeholder="e-mail" id="emaillogin"  name="emaillogin"/>
                            <input type="password" placeholder="Password" id="passwordlogin" name="passwordlogin" />
                            
                            <button type="submit" class="btn" value="Login">Login</button>
                            <a href="company-account.php">For companies</a>
                        </form>
                        <form  method="post" action="account.php" id="RegForm">
                            <span style="color:red;" id="warning"></span>
                            <span style="color:green;" id="success"></span>
                            <input type="text" placeholder="First Name" id="firstname"  name="firstname"/>
                            <input type="text" placeholder="Last Name" id="lastname" name="lastname" />
                            <input type="email" placeholder="e-mail" id="emailregister" name="emailregister" />
                            <input type="text"  placeholder="Telephone Number" id="telephonenumber" name="telephonenumber"/>
                            <input type="password" placeholder="Password" id="passwordregister" name="passwordregister" />
                            <button type="submit" class="btn" value="Register" onclick="Register()">Register</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    <!--------------js for toogle form-->
    
    <script>















        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Indicator = document.getElementById("Indicator");

        function register() {
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";

        }
        function login() {
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }

        



    </script>

    <!--------------js for registercheck-->

<script>



function Register() {
var warning = document.getElementById("warning");
var fname = document.getElementById("firstname").value;
var lname = document.getElementById("lastname").value;
var emailregister = document.getElementById("emailregister").value;
var telephonenumber = document.getElementById("telephonenumber").value;
var passwordregister = document.getElementById("passwordregister").value;
if (!fname) {
warning.innerHTML="fnameasdsadasd";
warning.innerText="First name cannot be null.";

}else if(!lname) {
    warning.innerText="Last name cannot be null";
    
}else if(!emailregister) {
    
    warning.innerText="Email cannot be null.";
    
}else if(!telephonenumber ) {
    warning.innerText="Telephone must be valid.";
    var tellen = $("#telephonenumber").val().toString().length;
    if(tellen>10 || tellen<9)
    {
        alert("Telephone must be valid.");
    }
    
    
}else if(!passwordregister) {
    var passlen = $("#passwordregister").val().toString().length;
     
    warning.innerText="Password cant be empty.";
    if(passlen<6)
    {
        alert("Password must be longer than 6 characters."); 
    }
    
}else{
    console.log("99999999999@@@@@@@@@@");
    
         
}


console.log("Hello world!");
}




</script>













</body>
</html>


<?php

/// Register operations
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['emailregister']) && isset($_POST['telephonenumber']) && isset($_POST['passwordregister']))

{
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['emailregister'];
    $tel = $_POST['telephonenumber'];
    $pass = $_POST['passwordregister'];
    


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `customer` (`customerid`, `email`, `password`, `fname`, `lname`, `telephone`, `country`, `adress`) VALUES (NULL, '$email', '$pass', '$fname', '$lname', '$tel', NULL, NULL);";

$sqlcheck="SELECT * FROM `customer` WHERE email='$email';";

$result = mysqli_query($conn,$sqlcheck);

if(mysqli_num_rows($result) > 0){
    echo'<script>
var warning = document.getElementById("warning");
warning.innerText="This user already exists";
</script>';

}


else if ($conn->query($sql) === TRUE) {
    echo'<script>
    var success = document.getElementById("success");
    success.innerText="Succesfully Registered";
    </script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo'<script>
var warning = document.getElementById("warning");
warning.innerText="Database Error Occured.";
</script>';
}






$conn->close();




}
if(isset($_POST['emaillogin']) && isset($_POST['passwordlogin'])){
    $email = $_POST['emaillogin'];
    $pass = $_POST['passwordlogin'];


///Login operations
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT customerid,fname,lname FROM customer WHERE email= '$email' AND password ='$pass';";
$result = mysqli_query($conn,$sqll);


if(mysqli_num_rows($result) > 0){

    while ($row = mysqli_fetch_assoc($result)) {

    $_SESSION['customerid']=$row["customerid"];
    $_SESSION['firstname']=$row["fname"];
    $_SESSION['lastname']=$row["lname"];
    echo'<meta http-equiv="refresh" content="0;url=index.php">';

}
}else{
    echo'<script>
var warning = document.getElementById("warninglogin");
warning.innerText="This user doesnt exist.";
</script>';

}










}






?>
<!---------------footer------->
<?php include 'footer.php';?>
