//loginpage.php

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
    <form action="loginpage.php" method="post">
    <div class="container p-5 w-50 border border-primary rounded mt-5">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-1 text-primary">
                Login
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
                <div class="form-outline">
                    <input type="text" id="firstname" name="username" class="form-control" >
                    <label class="form-label" id="firstname-label" for="firstname">Username</label>
                </div>
            </div>
    </div>


    <div class="row">
        <div class="col">
        <input type="password" name="password" id="">
        <label class="form-label" for="form6Example6">Password</label>
        </div>
    </div>

    <div class="row">
        <div class="col mt-3">  
            <input type="submit"  name="sub" class="btn btn-primary btn-block w-100" value="Login" id=sub>
        </div>
    </div>
    </form>



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



