<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <?php include ('../shared/core/header.php');?> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    <title>Admin - Dashboard</title>
</head>

<body class="overlay-bg"> 
    <?php 
    require_once("../controller/config.php");  
    include ('../checkuser.php');
    include '../controller/FetchSectionController.php';  
    $section = new FetchSection();
    $allSection = $section->GetAllSection();    
    
    ?>
    <?php include("../modal/dashboard_modal.php") ?>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <?php  include("../shared/core/sidebar.php");?>
        <div class="body-wrapper"> 
            <?php include("../shared/core/topbar.php") ?>
            <div class="container-fluid">
                <?php include("./content.php");?>
            </div>
        </div>
    </div> 
    <script src="../js/dashboard.js"></script>
    <script src="../js/custom_sanitize.js"></script>
    <script src="../js/function-script.js"></script>
    <script src="../js/logout.js"></script>
</body>

</html>