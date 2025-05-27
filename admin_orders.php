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
    <a href="admin_users.php" class="">Users</a>

    </nav>
    

    </div>
    <!-- sidebar container -->


    
    <!-- table container -->
    <div class="col-11">

    <!-- search button -->

<form action="admin_orders.php" method="post">
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

$selectsql = "Select * from tbl_orders";




if (isset($_POST['search'])) {
    $usersearch = $_POST['searchinput'];


    $selectsql = "Select * from tbl_orders where order_id like '%".$usersearch."%'
    OR user_id like '%".$usersearch."%'
    ";
} else {
    $selectsql = "Select * from tbl_orders";
}


$result = $conn->query($selectsql);


if ($result->num_rows > 0) {

?>

<table class="table table-success">
    <tr>
        <th>
            Order ID
        </th>
        <th>
            User ID
        </th>
        <th>
            Order Date
        </th>
        <th>
            Total Order Price
        </th>
        <th>
            Order Status
        </th>
    </tr>


<?php
    foreach ($result as $fieldname) {
        echo "<tr>";
        echo "<td>".$fieldname['order_id']."</td>";
        echo "<td>".$fieldname['user_id']."</td>";
        echo "<td>".$fieldname['order_date']."</td>";
        echo "<td>".$fieldname['total_price']."</td>";
        echo "<td>".$fieldname['order_status']."</td>";
        echo "<td>
        
        <a href = 'delete_order.php?deleteorder=".$fieldname['order_id']."' class='delete' onclick='popup()'> delete </a>
        
        
        </td>";
        echo "<tr>";

       
    }

?>

</table>

<script>
    function popup(){
        confirm("Are you sure you want to delete this product?");
    }
</script>


<?php
   
} else {
    echo "no record found";
}

?>



    </div>
    <!-- table container -->

</div>

<!-- row container -->




</div> 
<!-- container -->





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>
</html>



