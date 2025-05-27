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

  

    if (isset($_GET['editusers'])) {
    $editID = $_GET['editusers'];

    $editsql = "select * from tbl_users where user_id = $editID";

    $result = $conn->query($editsql);

    if ($result->num_rows > 0) {

    $fielddata = $result->fetch_assoc();
           

?>

<!-- form -->

    <form action="" method="post">


    <div class="container p-5 w-100 border border-primary rounded mt-5">

    <input type="hidden" value = "<?php echo $fielddata['user_id'] ?>" name = "updateUID">


    <br>

    <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Full Name: </label>
        <input type="text" class="form-control" required value = "<?php echo $fielddata['fullname'] ?>" name="updateUName">
        
        </div>
    </div>

    <br>

        <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example6">Role</label>

        <select name="updateURole" class="form-control" id="">
            <option> Admin </option>
            <option> Employee </option>
            <option> User </option>
        </select>
  
        </div>
         </div>


      

    <br>

        <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Username: </label>
        <input type="text" class="form-control" required value = "<?php echo $fielddata['username'] ?>" name="updateUUsername">
        
        </div>
        </div>



    <br>

        <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Email: </label>
        <input type="text" class="form-control" required value = "<?php echo $fielddata['email'] ?>" name="updateUEmail">
        
        </div>
        </div>

    <br>

        <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Contact: </label>
        <input type="text" class="form-control" required value = "<?php echo $fielddata['contact'] ?>" name="updateUContact">
        
        </div>
        </div>

    <br>

        <div class="row">
        <div class="col">

        <label class="form-label" for="form6Example7">Address: </label>
        <input type="text" class="form-control" required value = "<?php echo $fielddata['address'] ?>" name="updateUAddress">
        
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
        $updateUID = $_POST['updateUID'];
        $updateUName = $_POST['updateUName'];
        $updateURole = $_POST['updateURole'];
        $updateUUsername = $_POST['updateUUsername'];
        $updateUEmail = $_POST['updateUEmail'];
        $updateUContact = $_POST['updateUContact'];
        $updateUAddress = $_POST['updateUAddress'];
      

      



        $updatesql = "update tbl_users set fullname = '$updateUName', role='$updateURole', username='$updateUUsername',email='$updateUEmail',contact='$updateUContact', address='$updateUAddress' where user_id = $updateUID";
        
        $conn->query($updatesql);

        $logssql = "insert into tbl_logs (user_id, action, date) values ('".$prod_id."', 'Edited User',NOW())";

    
        $conn->query($logssql);


        if ($updatesql) {

             header('location:admin_users.php');
        } else {
            echo "Error updating details!";
        }
        

     

    }




?>

