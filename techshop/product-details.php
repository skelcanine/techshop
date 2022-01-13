<!DOCTYPE html>
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(isset($_SESSION['customerid'])){
$customerid = $_SESSION['customerid'];
}

if (isset($_GET['productid'])) {
    $productid= $_GET['productid'];}
?>

<script>


function sendData(){
    
        var customerid = "<?php echo $customerid; ?>" ;
    var productid = "<?php echo $productid; ?>" ;
    var itemcount =document.getElementById("count").value;
    
        
        
        //get the input value

        $.ajax({
            type : "POST",  //type of method
            url  : "/techshop/itemaddupdate.php",  //your page
            data : { customerid : customerid, productid : productid, itemcount : itemcount },// passing the values
            success: function(res){  
                console.log("res = "+res);
                    }
        });



        
    }

    

</script>




<?php include 'searchheader.php';?>


<?php
if (isset($_GET['productid'])) {
    $productid= $_GET['productid'];


    ///Login operations
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "techshop";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    $sqlsearch = "SELECT * FROM `product` WHERE productid='$productid'";
    $result = mysqli_query($conn,$sqlsearch);

    if(mysqli_num_rows($result) > 0){

        while ($row = mysqli_fetch_assoc($result)) {



?>





    <!--------------single product details-->

    <div class="small-container single-product">
        <div class="row">
        <div class="col-2">
            </div>
            <div class="col-2">
                <div class="popup" id="popup">
                    <div class="popup-inner top" data-popup="top">
                        <div class="bg-primary popup-inner-content">
                            <p class="popup-text">Item added!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img src="<?php echo $row["image"]; ?>" />
            </div>
            <div class="col-2">
                <p><?php echo ucfirst($row["category"]); ?></p>
                <h1><?php echo ucfirst($row["productname"]); ?></h1>
                <h4><?php echo '$'.$row["productprice"]; ?></h4>
                <?php
// if user logged in sent to details page

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



if(isset($_SESSION['customerid']))
{
    


?>

                <input type="number" value="1" id="count" />
                <p class="btn" onclick="sendData()">Add To Cart</p>


                <?php
                }
                ?>

                <h3>Product Details</h3>
                <p><?php echo $row["productdescription"]; ?></p>
            </div>
        </div>
    </div>


    <?php
}}
} else{
    header("Location: http://localhost/techshop/");
}
?>

    <!---------------footer------->
    <?php include 'footer.php';?>
    <script>
        // Variables
        const btns = document.querySelectorAll('.btn');
        const popup = document.getElementById('popup');
        const outer = document.querySelector('.outer');

        let popupTimer;

        // Helper function
        function removeStates(ele, states) {

            const popupActiveStates = ['active', 'top', 'bottom'];

            popupActiveStates.forEach((state) => {
                ele.classList.remove(state);
            });

            // Clear timer if popup closed on click
            clearTimeout(popupTimer);
        }



        // Click Events
        btns.forEach((btn) => {

            btn.addEventListener('click', function (e) {

                // Conditional to check if popup is currently active so only one popup shows at a time
                if (!popup.classList.contains('active')) {
                    popup.classList.add('active');
                    popup.classList.add(this.dataset.popup);

                    // Close popup after open for 8 seconds
                    popupTimer = setTimeout(function () {

                        removeStates(popup);

                    }, 8000);
                }

            });

        });

        document.body.addEventListener('click', function (e) {

            // Close popup if outer section is clicked.
            if (e.target.classList.contains('outer')) {
                removeStates(popup);
            }

            // Close popup if popup container is clicked
            if (e.target.classList.contains('popup-container')) {
                removeStates(popup);
            }
        });
    </script>
</body>
</html>

