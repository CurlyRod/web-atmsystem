<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="../shared/css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/desktop.png" />
    <link rel="stylesheet" href="../shared/loader/loader.css">
    <link rel="stylesheet" href="./css/signup.css" />
    <link rel="stylesheet" href="../shared/signup/signup.css" /> 
    <title>Signup Successful</title>
</head>
<body> 

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-10 col-lg-10 col-xxl-5">
                        <div class="loader-container" id="loader-container">
                            <div class="loader" id="loader"></div>
                        </div>
                        <div class="card mb-0" id="card-container">
                            <div class="card-body">
                                <div class="success-container">
                                    <div class="top-message">Successful Registration</div>
                                    <img src="../shared/image/success.jpg">
                                    <p class="message fw-bold">I appreciate you being so amazing! </p> 
                                    <p class="message fw-bold">Verification code was sent to your email. </p>
                                </div>
                                <p class="login text-center fw-bold">You can now <a href="../index.php">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../shared/loader/loader.js" defer></script>
</body>

</html>