<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="./assets/images/desktop.png" />
    <link rel="stylesheet" href="../shared/css/styles.css" />
    <!-- <link rel="stylesheet" href="../shared/loader/loader.css"> -->
    <link rel="stylesheet" href="../shared/login/login.css" />
    <link rel="stylesheet" href="./style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <title>My Profile</title>

</head>
<style media="screen">
.container-profile {
    display: block;
    width: 100%;
    height: 200px;
    border: 1px solid var(--bs-body-color);
    margin-top: 10px;
    display: flex;
    justify-content: center;
}

.container-profile img {

    max-width: 100%;
    max-height: 100%;
}

.button-upload button {
    width: 100%;
}
</style>

<body class="login-body">
    <?php  
    require_once '../database/config.php';
    include ('./checkuser.php'); 
     ?>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="loader-container" id="loader-container">
                            <div class="loader" id="loader"></div>
                        </div>
                        <div class="card mb-0" id="card-container">
                            <div class="card-body login-card">
                                <form method="POST" action = "" enctype = "multipart/form-data">
                                <div class="container-profile ">
                                    <img src="" id="profileImage" alt="profile">
                                </div>
                                <div class=" btn-container mb-1 mt-4">
                                    <input type="file" name="fileImg" id="fileImg" class="form-control"></input>
                                </div>
                                <div class="button-upload text-center m-4">
                                    <button class="btn btn-sm btn-primary" onclick = "submitData();">Upload</button>
                                </div>
                                <div class="profile-container mb-2">
                                    <label class="form-control text-center"> <?php echo$_SESSION['user_id']?> </label>
                                </div>
                                <div class="profile-container mb-2">
                                    <label
                                        class="form-control text-center"><?php echo$_SESSION['fname'].' '.$_SESSION['lname']?>
                                    </label>
                                </div>
                                <div class="btn-container mb-2">
                                    <label class="form-control text-center"><?php echo $_SESSION['section']?></label>
                                </div>
                                <div class="btn-container mb-3">
                                    <label class="form-control text-center">Status: Non-verified</label>
                                </div>
                                <div class="button-upload text-center ">
                                    <button class="btn btn-sm btn-danger" id="log-out-btn"href="./log-out.php">Log-out</button>
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
    <script src="./logout.js"></script>
    <!-- <script src="../shared/loader/loader.js"></script> -->
    <!-- <script type="text/javascript">
    // Preview
    fileImg.onchange = evt => {
        const [file] = fileImg.files
        if (file) {
            profileImage.src = URL.createObjectURL(file)
        }
    }

    function submitData() {
        $(document).ready(function() {
            var formData = new FormData();
            var files = $('#fileImg')[0].files;
            formData.append('fileImg', files[0]);

            $.ajax({
                url: 'upload-function.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == "Success") {
                        alert("Successfully Added");
                    } else if (response == "Invalid Extension") {
                        alert("Invalid Extension");
                    } else {
                        alert("Please Fill Out The Form");
                    }
                }
            });
        });
    }
    </script> -->
</body>

</html>