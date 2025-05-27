<?php
   
    session_start();

  
    $prod_id = $_SESSION['user_id'];

    

 

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

<div class="container">

<?php

    require_once "dbconnection.php";

  

    if (isset($_GET['editinventory'])) {
    $editID = $_GET['editinventory'];

    $editsql = "select * from tbl_inventory where inventory_id = $editID";

    $result = $conn->query($editsql);

    if ($result->num_rows > 0) {

    $fielddata = $result->fetch_assoc();


    $product_id = $fielddata['product_id'];
?>

<!-- form -->

    <form action="" method="post">


    <input type="hidden" value = "<?php echo $fielddata['inventory_id'] ?>" name = "updateIID">


    <br>

    <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Edit Inventory: </label>
        <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Enter new stock: </label>
        <input type="newStock" class="form-control" name="updateIQuantity">
        
        </div>
    </div>
        
        </div>
    </div>

    <br>

    <div class="btns">

    <div class="row">
        <div class="col mt-3">  
            <input type="submit"  name="edit" class="btn btn-primary btn-block w-100" value="Update Product Details" id=sub>
        </div>
    </div>

    <div class="row">
        <div class="col mt-3">  
            <input type="reset" id="close-edit"  name="reset" class="btn btn-primary btn-block w-100" value="Cancel">
        </div>
    </div>

    </div>


    </form>

<!-- form -->

<?php
    }
    

    }


    ?>


    
     



</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>
</html>

<?php

  if (isset($_POST['edit'])) {
        $updateIID = $_POST['updateIID'];
        $updateIQuantity = $_POST['updateIQuantity'];

       
        $updatesql = "update tbl_inventory set quantity_in_stock = '$updateIQuantity' where inventory_id = $updateIID";
        
        $conn->query($updatesql);

        $updatessql = "update tbl_product set available_quantity = '$updateIQuantity' where product_id = $product_id";
        
        $conn->query($updatessql);
        
        

        $logssql = "insert into tbl_logs (user_id, action, date) values ('".$prod_id."', 'Edited Inventory',NOW())";

    
        $conn->query($logssql);


        if ($updatesql) {

             header('location:admin_inventory.php');
        } else {
            echo "Error updating details!";
        }
        

     

    }




?>

