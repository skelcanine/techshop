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


if(isset($_SESSION['customerid']))
{
    


?>
 



<a href="cart.php"><img src="images/cart.png" height="30" width="30" /> </a>
                <p>Cart</p>

                <div class="logout-btn">
                    <a href="logout.php" class="btn">Logout</a>
                </div>


                <?php
                }else{
                ?>




<?php


          
          } ?>    

            </div>
            <div class="row">
                <div class="wrap">
                     <div class="search" id="search-form">
                         <input type="text" class="searchTerm" id="searchbar" placeholder="What are you looking for?">
                         <button href="cart.php" onclick="search()" class="searchButton">
                             <i class="fa fa-search"></i>
                         </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function search(){
            var searchbar = document.getElementById("searchbar").value;
            
            window.location.href = "http://localhost/techshop/products.php?search="+searchbar;
            
        }



    </script>
   