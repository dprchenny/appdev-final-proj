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
    <form action="register.php" method="post">
    <div class="container p-5 w-50 border border-primary rounded mt-5">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-1 text-primary">
                Register
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
                <div class="form-outline">
                    <input type="text" id="firstname" name="first" class="form-control" >
                    <label class="form-label" id="firstname-label" for="firstname">First name</label>
                </div>
            </div>
            <div class="col">
            <div class="form-outline">
                <input type="text" id="lastname" name="last" class="form-control " />
                <label class="form-label" for="lastname">Last name</label>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
       
        <div class="btn-group mx-5 text-center" id="btn-group-3" >
            <div class="form-check form-check-inline ">
                <input class="form-check-input" type="radio" name="Gender" id="inlineRadio1" value="Female" />
                <label class="form-check-label" for="inlineRadio1">Female</label>
            </div>


            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Gender" id="inlineRadio2" value="Male" />
                <label class="form-check-label" for="inlineRadio2">Male</label>
            </div>


            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="Gender" id="inlineRadio3" value="Others"/>
                <label class="form-check-label" for="inlineRadio3">Others</label>
            </div>
        </div>
        <div class="row d-block">
            <div class="col">
                <span class="form-label ">Gender</span>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col text">
        <input type="text" id="form6Example4"  name="add" class="form-control" />
        <label class="form-label" for="form6Example4">Address</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <input type="text" id="email"  name="email" class="form-control" />
        <label class="form-label" for="email">Email</label>
        </div>
    </div>


    <div class="row">
        <div class="col">
        <input type="text" id="form6Example6" name="contact" class="form-control" />
        <label class="form-label" for="form6Example6">Phone</label>
        </div>
    </div>


    <div class="row">
        <div class="col">
        <textarea class="form-control" name="addinfo" id="form6Example7" rows="4"></textarea>
        <label class="form-label" for="form6Example7">Additional information</label>
        </div>
    </div>




    <div class="row">
        <div class="col">
        <input type="text" id="form6Example6" name="username" class="form-control" />
        <label class="form-label" for="form6Example6">Username</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <input type="password" id="form6Example6" name="password" class="form-control" />
        <label class="form-label" for="form6Example6">Password</label>
        </div>
    </div>

    <div class="row">
        <div class="col mt-3">  
            <input type="submit"  name="sub" class="btn btn-primary btn-block w-100" value="Save Details" id=sub>
        </div>
    </div>
    </form>

    <?php


require_once "dbconnection.php";

include 'email_verification.php';



if (isset($_POST['sub'])) {
   $first = $_POST['first'];
   $last = $_POST['last'];
   $full = $first." ".$last;
   $gen = $_POST['Gender'];
   $add = $_POST['add'];
   $email = $_POST['email'];
   $contact = $_POST['contact'];
   $addinfo = $_POST['addinfo'];
   $username = $_POST['username'];
   $password = md5($_POST['password']);
   $role = "User";
   $otp = rand(000000,999999);
   $status = "Pending";


   $insertsql = "Insert into tbl_users (fullname,role,username,password,email,contact,address,otp,status) values ('$first','$role','$username','$password','$email',$contact,'$add','$otp','$status')";


   $result = $conn->query($insertsql);

    if ($result == TRUE) {
        send_verification($full, $email, $otp);

        header("location: otp_verification.php");

    } else {
        echo $conn->error;
    }
    


   if($result == TRUE){
    ?>
    <script>
        Swal.fire({
        position: "center",
        icon: "success",
        title: "OTP sent!",
        showConfirmButton: false,
        timer: 1500
        }).then(() => {
            window.location.href = "otp_verification.php";
        });
    </script>


    <?php
   }else{
    echo $conn->error;
   }
}






?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




</body>
</html>


