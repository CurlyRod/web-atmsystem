<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <?php include ('./shared/header.php')?> 
    <link rel="stylesheet" href="../shared/css/bootstrap.css">
    <link rel="stylesheet" href="../shared/css/simplebar.css"> 
    <link rel="stylesheet" href="../shared/css/style.css">
    <title>My Dashboard</title> 
</head>
<body class="overlay-bg"> 
    <?php 
    require_once("../database/config.php");  
    include ('./shared/checkuser.php'); 
    ?> 
     <div class="student-number d-none"><?php echo $_SESSION['user_id']; ?></div>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php  include("./shared/sidebar.php");?>
        <div class="body-wrapper">
            <?php include("./shared/topbar.php") ?>
            <div class="container-fluid">
                <?php include("./content.php");?>  
            </div>
        </div> 
    </div> 
    <script src="./js/logout.js"></script> 
    
    <script>
   $(document).ready(function(){   
    RenderAllRecord();
    function RenderAllRecord() {  
   
        $.ajax({
            url: "./controller/StudentController.php",
            type: "POST",
            data: {
                action: "view", student_number: <?php echo $_SESSION['user_id'] ?>
            },
            success: function(response) {

                $("#showUser").html(response);
                $('#user_datatable').DataTable({
                    order: [0, "desc"],
                    responsive: true
                }); 
            }
        });
    }
   });

    </script>
</body>
</html> 
