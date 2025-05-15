//loginpage.php


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    @import "design.css";
    </style>
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

   <div id="navbarContainer">
      <div>
        <ul class="nav justify-content-center" id="navbarContent">
          <li class="nav-item">
            <a class="nav-link" href="home.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">PRODUCTS</a>
          </li>
          <li class="nav-item" id="logoNav">
            <a class="nav-link" href="#">
              <img src="images/logo.jpg" class="img-fluid" alt="logo" />
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="orders.php">ORDERS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">LOGIN</a>
          </li>
        </ul>
      </div>
    </div>

    <form action="loginpage.php" method="post">
    <div id="loginContainer">

    <div class="row">
        <div class="col text-center">
            <h1 id="loginTxt">
                Login
            </h1>
        </div>
    </div>

    <div id="usernameContainer">
    <div class="row">
        <div class="col">
                <div class="form-outline">
                    <label class="form-label" id="firstname-label" for="firstname">Username</label>
                    <input type="text" id="firstname" name="username" class="form-control w-50" >
                    
                </div>
            </div>
    </div>
    </div>


    <div class="row">
        <div class="col">
            <label class="form-label" for="form6Example6">Password</label>
            <br />
        <input type="password" name="password" id="">
        
        </div>
    </div>

    <div id="loginBtn">
    <div class="row">
        <div class="col">  
            <input type="submit"  name="sub" value="Login" class="btn btn-primary">
        </div>
    </div>
    </div>

    </form>


    </div>

  <div id="footerContainer">
      <div id="footerContent">
        <div id="footLeft">
          <div id="logoFooterContainer">
            <a class="nav-link" href="#">
              <img src="images/logo.jpg" class="img-fluid" alt="logo" />
            </a>
          </div>
          <div id="leftFootTxt">
            <p id="address">Wine Craft</p>
            <p>
              0325 Stray Kids St., <br />
              Kwangya City, South Korea <br />
              9AM to 5PM
            </p>
          </div>
        </div>
        <div id="footRight">
          <div id="rightFootTxt" class="float-end">
            <p>
              winecraft@gmail.com <br />
              +011 811 1003
            </p>
          </div>
        </div>
      </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>
</html>

<?php

require_once "dbconnection.php";



if (isset($_POST['sub'])) {

    session_start();

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $_SESSION['username'] = $username;




    $loginsql = "Select * from tbl_users where username = '".$username."' AND password = '".$password."' ";

    $result = $conn->query($loginsql);

    if ($result->num_rows ==1) {

        
        $fielddata = $result->fetch_assoc();
        print_r($fielddata);


        $user_type = $fielddata['role'];

        if ($user_type == 'Admin') {
            header("location: admin_products.php");
        } elseif ($user_type == 'Employee') {
           header("location: employeedashboard.php");
        }
        
//password 1 - leighcaro
//password 2 - leighcarowww




    }

    else {
        ?>

<script>
    Swal.fire({
        position: "center",
        icon: "error",
        title: "wrong username or the passwords",
        showConfirmButton: false,
        timer: 1500
        });
</script>



<?php
    }
}


?>
