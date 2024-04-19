<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="../shared/css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="../shared/image/desktop.png" />
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="../shared/signup/signup.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Monitoring</title>
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
                                    <div class="image-container">
                                        <img src="../assets/uploads/placeholder.png" id="studentImg">
                                    </div>
                                    <div class="name-container">
                                        <p class="message fw-bold ">Student Number:</p>
                                        <p class="message fw-bold"  id="studentnumber">09876543211</p>
                                    </div>
                                    <div class="name-container">
                                        <p class="message fw-bold">Name: </p>
                                        <p class="message fw-bold"  id="fullname">John Dela Cruz </p>
                                    </div>
                                    <div class="name-container">
                                        <p class="message fw-bold">Section: </p>
                                        <p class="message fw-bold" id="section">BSIT-412 </p>
                                    </div> 
                                    <div class="top-message" style="opacity:0;"><input type="text" id="rfidTagField" autofocus></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        const inputField = document.getElementById('rfidTagField');
        inputField.addEventListener('change', function() {
            const enteredValue = this.value.trim(); // Trim any whitespace
            if (enteredValue.length === 10 && /^\d+$/.test(
                enteredValue)) { // Check if exactly 12 digits
                let recentRfid = inputField.value;
                console.log("recent", recentRfid);

                $.ajax({
                    url: './controller/ActionClasses.php',
                    method: 'POST',
                    data: {
                        rfid: recentRfid,
                        action: "check-user"
                    },
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status === 200) {
                            $("#studentImg").attr("src", res['image']);
                            $("#fullname").text(res.fullname); 
                            $("#studentnumber").text(res.studentnumber); 
                            $("#section").text(res.section);
                            // $("#errorMsg").text(res.message);
                        } else {
                            console.log("Else", res);
                            $("#errorMsg").text(res.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                    }
                });
                $('#rfidTagField').val('');
                $('#rfidTagField').focus();

            }
        });

    });
    </script>
</body>

</html>