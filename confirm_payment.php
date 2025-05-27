<?php

session_start();



?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
         rel="stylesheet">
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form action="confirm_payment.php" method="post">
    <div class="container p-5 w-50 border border-primary rounded mt-5">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-1 text-primary">
                Payment Method
            </h1>
        </div>
    </div>
   

    <div class="row">
        <div class="col">
        <label class="form-label" for="form6Example6">Payment Method:</label>
        <select name="payment" class="form-control" id="">
            <option> E-cash</option>
            <option> Debit/Credit Card</option>
            <option> Cash on Delivery</option>
        </select>

        </div>
    </div>
    <div class="row">
        <div class="col mt-3">  
            <input type="submit"  name="sub" class="btn btn-primary btn-block w-100" value="Proceed to checkout" id=sub>
        </div>
    </div>
    </form>

    <?php


require_once "dbconnection.php";



if (isset($_POST['sub'])) {
   

    $_SESSION['payment'] = $_POST['payment'];

    header("location: checkout.php");
    

}   



?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>
</html>


