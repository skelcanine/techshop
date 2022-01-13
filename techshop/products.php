<?php
session_start();


    if (isset($_GET['search'])) 
    {
    $search= $_GET['search'];
    }

    if (isset($_GET['category'])) 
    {
        $category= $_GET['category'];
        
    }

    if (isset($_GET['sort'])) 
    {
      $sort= $_GET['sort'];
    }else{
        $sort= 'soldquantity';
    }

    if (isset($_GET['value'])) 
    {
      $value= $_GET['value'];
    }else{
        $value=10000;
    }

    if (isset($_GET['page'])) 
    {
      $page= $_GET['page'];
    }else{
        $page=1; 
    }

    $pagemin =(($page-1)*16);
    $pagemax= $page*16;
    
    if (isset($_GET['search']) && !isset($_GET['category'])) 
    {
        $sqlsearch = "SELECT * FROM `product` WHERE productname LIKE '%$search%' AND productprice <='$value' ORDER BY $sort DESC LIMIT $pagemin,$pagemax";

        
    
    }else if (!isset($_GET['search']) && isset($_GET['category'])) 
    {
        $sqlsearch = "SELECT * FROM `product` WHERE category='$category' AND productprice <='$value' ORDER BY $sort DESC LIMIT $pagemin,$pagemax";

    }elseif (isset($_GET['search']) && isset($_GET['category'])) 

    {
        $sqlsearch = "SELECT * FROM `product` WHERE productname LIKE '%$search%' AND category='$category' AND productprice <='$value' ORDER BY $sort DESC LIMIT $pagemin,$pagemax";
        
    }else{
        header("Location: http://localhost/techshop/index.php");
    }
    






?>



<!DOCTYPE html>

<?php include 'searchheader.php';?>
    <div class="small-container">
        <div class="row row-2">
            <h2>All Products</h2>

            <select id="sort" name="sort" onchange="redirect(this.name,this.value)">
                <option disabled selected value>Default Sorting</option>
                <option name="sort" value="productprice">Sort by price</option>
                <option name="sort" value="soldquantity">Sort by popularity</option>
            </select>

            <div class="slidecontainer">
                <input type="range" min="1" max="10000" value="<?php echo $value;?>" class="slider" id="myRange"
                name="value" onchange="redirect(this.name,this.value)">
                <p>Value: <span id="demo"></span></p>
            </div>

            <select id="category" class="category-select" name="category" onchange="redirect(this.name,this.value)">
                <option name="category" disabled selected value>Select Category</option>
                <option name="category" value="phone">Phones</option>
                <option name="category" value="computer">Computers</option>
                <option name="category" value="television">Tv's'</option>
                <option name="category" value="gameconsole">Game Consoles</option>
                <option name="category" value="camera">Cameras</option>
            </select>

        </div>

        <div class="row">
        <?php 
        ///Login operations
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "techshop";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        
        $result = mysqli_query($conn,$sqlsearch);
        $num_rows = ceil(mysqli_num_rows($result)/16);

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
        <div class="page-btn">
            <?php
            
            for ($i = 1;$i<=$num_rows ; $i++) {
            ?>

        
            <button class="btn" value="<?php echo $i;?>"  name="page" onclick=" redirect(this.name,this.value)" ><?php echo $i;?></button>
            
        

        <?php }?>
        </div>
    </div>
    <!---------------footer------->
    <?php include 'footer.php';?>
    <!-----------------javascript----------->
    <script>
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value; // Display the default slider value

        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function () {
            output.innerHTML = this.value;
        }

        

        function redirect(name,value)
        {
            
            var queryParams = new URLSearchParams(window.location.search);
            queryParams.set(name, value);
            setTimeout(function() {
                writeNumber.html("1");
            }, 1000);
            window.location.href = "http://localhost/techshop/products.php?"+queryParams;


        }

        

    </script>


<?php
    if (isset($_GET['category'])) 
    {
        $category= $_GET['category'];
        ?>
        <script>
        var categoryset = document.getElementById("category");  
        categoryset.value ="<?php echo $category?>";
        </script>
        <?php
    }
?>
<?php
    if (isset($_GET['sort'])) 
    {
        $category= $_GET['sort'];
        ?>
        <script>
        var categoryset = document.getElementById("sort");  
        categoryset.value ="<?php echo $category?>";
        </script>
        <?php
    }
?>
</body>
</html>