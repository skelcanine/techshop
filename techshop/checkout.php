<!DOCTYPE html>

<?php include 'nonsearchheader.php';?>

    <!-------- checkout-->

    <div class="small-container">
        <div class="adress">
            <h3>Billing Information</h3>
        </div>
        <div class="row">
            <div class="col-2 checkout">
                <form id="Checkout" action="checkoutfinal.php" method="post">
                    <p>Contry</p>
                    <input type="text" placeholder="Enter your country" name="country" minlength="2" maxlength="15" required="required" />
                    <p>Adress</p>
                    <textarea name="address" cols="69" rows="5" placeholder="Enter your adress."></textarea>
                    <div class="radio">
                        <label for="creditcard">Credit Card</label>
                        <input type="radio" name="radio" id="radio" onclick="change()" value="creditcard" checked />
                        <label for="debitcard">Debit Card</label>
                        <input type="radio" name="radio" id="radio" onclick="change()" value="debitcard"  />                        
                        <div class="cardinfo">
                            <input type="text" id="cardnumber" name="cardnumber" placeholder="Your card number" />
                            <input type="month" name="date" />
                            <input type="text" name="securitynumber" placeholder="Security Number" />
                        </div>
                    </div>
                    <button type="submit"  class="btn">Proceed</button>
                </form>
            </div>
        </div>
    </div>

    <!---------------footer------->
<?php include 'footer.php';

?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        


        

        function change() {
  var values = {
    "radio": $('input[name=radio]:checked').val()
  }
  console.log(values.radio);
}

    </script>

</body>
</html>