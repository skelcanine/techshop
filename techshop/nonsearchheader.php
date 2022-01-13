
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
                        <li> <a href="index.php">Home</a></li>
                        <?php


if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



if(isset($_SESSION['customerid']))
{
    


?>
                        <li> <a href="order-list.php">My Orders</a></li>

                        <?php
                }else{
                    ?>
                    <li> <a href="account.php">Account</a></li>
    
    <?php } ?>
                    </ul>
                </nav>
                <?php
// if user logged in sent to details page

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



if(isset($_SESSION['customerid']))
{
    $logoutcreated =1;
    


?>



<a href="cart.php"><img src="images/cart.png" height="30" width="30" /> </a>
                <p>Cart</p>

                <div class="logout-btn">
                    <a href="logout.php" class="btn">Logout</a>
                </div>


                <?php
                }else{
                    $logoutcreated =0;

                }
                if(isset($_SESSION['companyid'])&& $logoutcreated!=1)
                {


                ?>

<div class="logout-btn">
                    <a href="logout.php" class="btn">Logout</a>
                </div>






<?php }
    


    ?>
            </div>
        </div>
    </div>



    



    