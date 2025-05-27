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

  

    if (isset($_GET['editproduct'])) {
    $editID = $_GET['editproduct'];

    $editsql = "select * from tbl_product where product_id = $editID";

    $result = $conn->query($editsql);

    if ($result->num_rows > 0) {

    $fielddata = $result->fetch_assoc();
           
    $pPrice = $fielddata['price'];
    echo $pPrice;


?>

<!-- form -->

    <form action="" method="post" enctype = "multipart/form-data">


    <div class="container p-5 w-100 border border-primary rounded mt-5">
    
    <img src="<?php echo $fielddata['img_path'] ?>" width=200 height=200 alt="">


    <input type="hidden" value = "<?php echo $fielddata['product_id'] ?>" name = "updatePID">


    <br>

    <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Product Name: </label>
        <input type="text" class="form-control" required value = "<?php echo $fielddata['product_name'] ?>" name="updatePName">
        
        </div>
    </div>

    <br>

      <div class="row">
        <div class="col">

         <label class="form-label" for="form6Example7">Product Price: </label>

        <div class="input-group mb-3">

         <span class="input-group-text">₱</span>
         <input type="text" class="form-control" required value= "<?php echo $fielddata['price'] ?>" name="updatePPrice">
        <span class="input-group-text">.00</span>

        </div>
        
        </div>
        </div>

        <br>

         <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example6">Product Category: </label>

        <select class="form-control" id="" required name="updatePCategory">
            <option disabled selected> Please select product category</option>
            <option> 1</option>
            <option> 2</option>
            <option> 3</option>
        </select>
      
        </div>
    </div>



    <br>

        <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Product Image: </label>
        <input type="file" class="form-control" required name="updatePIMG">
        
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
        $updatePID = $_POST['updatePID'];
        $updatePName = $_POST['updatePName'];
        $updatePPrice = $_POST['updatePPrice'];
        $updatePCategory = $_POST['updatePCategory'];

        echo $updatePName;
        $updateimagepath = "img/".basename($_FILES["updatePIMG"]["name"]);

      



        $updatesql = "update tbl_product set product_name = '$updatePName', price=$updatePPrice, category='$updatePCategory',img_path='$updateimagepath' where product_id = $updatePID";
        
        $conn->query($updatesql);

        $logssql = "insert into tbl_logs (user_id, action, date) values ('".$prod_id."', 'Edited Product',NOW())";

    
        $conn->query($logssql);


        if ($updatesql) {
             copy($_FILES["updatePIMG"]["tmp_name"],$updateimagepath);

             header('location:admin_products.php');
        } else {
            echo "Error updating details!";
        }
        

     

    }




?>

