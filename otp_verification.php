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
    <form action="otp_verification.php" method="post">
    <div class="container p-5 w-50 border border-primary rounded mt-5">
    <div class="row">
        <div class="col text-center">
            <h1 class="display-1 text-primary">
                OTP Verification
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
                <label class="form-label" id="firstname-label" for="firstname">Please enter otp</label>

                <div class="form-outline">
                    <input type="text" id="firstname" name="otp" class="form-control" >
                    
                </div>
            </div>
    </div>

    <div class="row">
        <div class="col mt-3">  
            <input type="submit"  name="sub" class="btn btn-primary btn-block w-100" value="Confirm" id=sub>
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



    $otp = $_POST['otp'];


    $otpsql = "select * from tbl_users where otp = $otp";

    $result = $conn->query($otpsql);

    if ($result->num_rows == 1) {
        $updatesql = "update tbl_users SET status = 'Active', otp = 'NULL' where otp = '".$otp."'";

        $conn->query($updatesql);

        ?>

    <script>
        Swal.fire({
        position: "center",
        icon: "success",
        title: "OTP verified!",
        showConfirmButton: false,
        timer: 1500
        }).then(() => {
            window.location.href = "loginpage.php";
        });
    </script>



<?php
    } else {
        ?>
    <script>
        Swal.fire({
        position: "center",
        icon: "error",
        title: "Wrong OTP!",
        showConfirmButton: false,
        timer: 1500
        })
    </script>

<?php
    }
    
}


?>


