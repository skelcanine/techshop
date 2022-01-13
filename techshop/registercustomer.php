<?php
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['emailregister']) && isset($_POST['telephonenumber']) && isset($_POST['passwordregister']))

{echo "New record created successfully";
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

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}else{
    echo"asdfsadsa@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@";
}

?>
<script>
    console.log("123123@@@@@@@@@@");
</script>