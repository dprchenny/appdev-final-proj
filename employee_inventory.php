<?php

    session_start();

  
    $userID = $_SESSION['user_id'];


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

<!-- container -->
<div class="container  column-gap-3">

<div class="row">

    <!-- sidebar container -->
    <div class="col ms-0">

    <nav class="navbar bg-light">
    
    <a href="admindashb.php" class="">Products</a>
    <a href="usertable.php" class="">Users</a>

    </nav>
    

    </div>
    <!-- sidebar container -->


    
    <!-- table container -->
    <div class="col-11">

    <!-- search button -->

<form action="admin_inventory.php" method="post">
        <div class="row g-5">
            <div class="col-auto">
            <input type="search" name="searchinput" id="" placeholder="Search" class="form-control">
            </div>
            <div class="col-auto">
            <input type="submit" name = "search" value="Search" class="btn-primary btn">
            </div>
        </div>
</form>


<!-- php of displaying table -->

<?php


require_once "dbconnection.php";


$selectsql = "Select * from tbl_inventory";




if (isset($_POST['search'])) {
    $usersearch = $_POST['searchinput'];


    $selectsql = "Select * from tbl_inventory where inventory_id like '%".$usersearch."%'
    OR product_id like '%".$usersearch."%'
    ";
} else {
    $selectsql = "Select * FROM tbl_inventory";
}


$result = $conn->query($selectsql);


if ($result->num_rows > 0) {

?>

<table class="table table-success">
    <tr>
        <th>
            Inventory ID
        </th>
        <th>
            Product ID
        </th>
        <th>
            Quantity in Stock
        </th>
        <th>
            Last Stock Update
        </th>
    </tr>
    <!-- <button></button> -->


<?php
    foreach ($result as $fieldname) {
        echo "<tr>";
        echo "<td>".$fieldname['inventory_id']."</td>";
        echo "<td>".$fieldname['product_id']."</td>";
        echo "<td>".$fieldname['quantity_in_stock']."</td>";
        echo "<td>".$fieldname['last_stock_update']."</td>";
        echo "<td>
        
        
        <a href = 'update_inventory.php?editinventory=".$fieldname['inventory_id']."' class='edit'> edit </a>
        
        
        </td>";
        echo "<tr>";
    }


    


?>

</table>


<?php
   
} else {
    echo "no record found";
}



?>

<!--  -->

<!-- modal container - the edit form -->
        

</div>


    

    <?php




if (isset($_POST['sub'])) {
   $updatedQuantity = $_POST['newStock'];

   $id = $fieldname['inventory_id'];


   $updateinventorysql = "update tbl_inventory set quantity_in_stock = $updatedQuantity, last_stock_update = NOW() where inventory_id = $id";


    $conn->query($updateinventorysql);

    $logssql = "insert into tbl_logs (user_id, action, date) values ('".$userID."', 'Updated Stock',NOW())";

    
    $conn->query($logssql);


   
   ?>


<script>


function previewImg(event) {
    

    var displaying = document.getElementById ("preview_img");
    displaying.src = URL.createObjectURL(event.target.files[0]);

}

</script>

    

<!-- modal form -->

    </div>
    <!-- table container -->

</div>

<!-- row container -->






</div> 
<!-- container -->





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>


function previewImg(event) {
    

    var displaying = document.getElementById ("preview_img");
    displaying.src = URL.createObjectURL(event.target.files[0]);

}

</script>


</body>
</html>



<?php

if($result == TRUE){
 ?>

 <script>
     Swal.fire({
     position: "center",
     icon: "success",
     title: "Your work has been saved",
     showConfirmButton: false,
     timer: 1500
     });
 </script>


 <?php

}else{
 echo $conn->error;
}
}



?>
