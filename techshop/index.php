<!DOCTYPE html>


<?php include 'searchheader.php';?>
        <!----------featured categories---------------->

        <div class="categories">
            <div class="small-container">
                <div class="row">
                    <div class="col-5">
                        <a href="/techshop/products.php?category=phone">
                            <img src="images/phone.jpg" />
                        </a>
                        <h4>Phones</h4>
                    </div>
                    <div class="col-5">
                        <a href="/techshop/products.php?category=computer">
                            <img src="images/computer.jpg" />
                        </a>
                        <h4>Computers</h4>
                    </div>
                    <div class="col-5">
                        <a href="/techshop/products.php?category=television">
                            <img src="images/tv.jpg" />
                        </a>
                        <h4>Tv's</h4>
                    </div>
                    <div class="col-5">
                        <a href="/techshop/products.php?category=gameconsole">
                            <img src="images/console.jpg" />
                        </a>
                        <h4>Game Consoles</h4>
                    </div>
                    <div class="col-5">
                        <a href="/techshop/products.php?category=camera">
                            <img src="images/camera.jpg" />
                        </a>
                        <h4>Cameras</h4>
                    </div>
                </div>
            </div>
        </div>

        <!----------featured products---------------->

        
        <div class="small-container">
            <h2 class="title">Featured Products</h2>
            <div class="row">

            <?php 
        ///Login operations
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        $sqlsearch = "SELECT * FROM `product` ORDER BY soldquantity LIMIT 16";
        $result = mysqli_query($conn,$sqlsearch);

        if(mysqli_num_rows($result) > 0){

            while ($row = mysqli_fetch_assoc($result)) {
                
            
        
        
        
        ?>

                <div class="col-4">
                <a href="product-details.php?productid=<?php echo $row["productid"]; ?>">
                    <img src="<?php echo $row["image"]; ?>">
                    <h4><?php echo ucfirst($row["productname"]); ?></h4>
                    <p class="price"><?php echo '$'.$row["productprice"]; ?></p>
                    </a>
                </div>


           <?php 
            }}
           
           ?>
            </div>
        </div>
        <!-----------offer------------>

        <?php 
        ///Login operations
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        $sqlsearch = "SELECT * FROM `product` ORDER BY soldquantity ASC LIMIT 1";
        $result = mysqli_query($conn,$sqlsearch);


        if(mysqli_num_rows($result) > 0){

            while ($row = mysqli_fetch_assoc($result)) {
                
            
        
        
        
        ?>

        
        


        <div class="offer">
            <div class="small-container">
                <div class="row">
                    <div class="col-2">
                        <img src="<?php echo $row["image"]; ?>" class="offer-img" />
                    </div>
                    <div class="col-2">
                        <p>Exclusive</p>
                        <h1><?php echo ucfirst($row["productname"]); ?></h1>
                        <small><?php echo ucfirst($row["productdescription"]); ?><br /></small>

                        <a href="product-details.php?productid=<?php echo $row["productid"]; ?>" class="btn">Buy &#8594;</a>
                    </div>
                </div>
            </div>
        </div>

        <?php

            }}
?>
        
        <!---------------footer------->
        <?php include 'footer.php';?>

</body>
</html>