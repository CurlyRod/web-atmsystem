<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../shared/css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="../assets/images/desktop.png" />
    <title>Signup</title> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../shared/loader/loader.css">
    <link rel="stylesheet" href="../shared/signup/signup.css" />
    <?php include("./controller/FetchSectionController.php")?>
    <script src="https://cdn.jsdelivr.net/npm/just-validate@4.3.0/dist/just-validate.production.min.js"></script> 
    <script src="./js/customize_validation.js" defer></script> 
    <script src="./js/custom_sanitize.js" defer></script> 
    <?php  
     require('../database/config.php'); 

     $database = new Database();
     $mysqli = $database->getConnection();    

     $section = new FetchSection();
     $allSection = $section->GetAllSection();  
    ?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100 p-2">
                    <div class="col-md-10 col-lg-10 col-xxl-5"> 
                    <div class="loader-container" id="loader-container">
                            <div class="loader" id="loader"></div>
                        </div>
                        <div class="card mb-0" id="card-container"> 
                            <div class="card-body" >
                                <div class="form-container">
                                    <a href="#"
                                        class="register-container text-nowrap logo-img text-center d-block  w-100 ">
                                        <img src="../assets/images/signup.jpg" alt="">
                                    </a>
                                    <p class="text-center mb-3">Register your details</p>
                                    <form method="POST"  action="process-signup.php" id="signupForm" novalidate 
                                        onsubmit=" return checkforblank()">
                                        <div class="row mb-2 form-item">
                                            <div class="col">
                                                <label class="form-label">Student Number</label>
                                                <input type="text" class="form-control" id="student_number"
                                                    name="student_number">
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Section</label>
                                                <select class="form-select form-select" id="section" name="section"
                                                    onchange="checkforblank()">
                                                    <option selected> Choose Section</option>
                                                    <?php  
                                                    foreach($allSection  as $option)
                                                    {
                                                        ?><option value="<?php echo $option['id']; ?>">
                                                        <?php echo $option['section']; ?> </option><?php
                                                    }
                                                 ?>
                                                </select>
                                                <p class="error-msg  d-none" id="error-msg"
                                                    style="color:rgb(184, 17, 17)">Section is required </p>
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-item">
                                            <div class="col">
                                                <label class="form-label">FirstName</label>
                                                <input type="text" class="form-control" id="fname" name="fname">
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="mname" name="mname">
                                            </div>
                                        </div>
                                        <div class="row mb-2 form-item">
                                            <div class="col">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lname" name="lname">
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" id="email">
                                            </div>
                                        </div>
                                        <div class="row form-item">
                                            <div class="col">
                                                <div class="mb-2">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control"
                                                        id="password_confirmation" name="password_confirmation">

                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Register</button>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <p class="fs-3 mb-0 fw-bold">Already have an Account?</p>
                                            <a class="text-primary fw-bold ms-2" href="../login">Sign
                                                In</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../shared/loader/loader.js" defer></script> 

    <!-- <script>
        $(document).ready(function(){
            $.ajax({
                url: "test.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script> -->

   
</body>

</html>

