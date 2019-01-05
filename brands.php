<?php  
require 'session_check.php';
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Brands - Dashboard</title>
		
		<?php require 'includes/shared_css.php'; ?>


</head>

<body class="animsition">

<div class="page-wrapper">
    <!-- HEADER MOBILE-->
		<?php require 'includes/shared_header.php'; ?>

    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
		<?php require 'includes/shared_sidebar.php'; ?>

    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
			<?php require 'includes/header.php'; ?>

        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Add/View Brands</h2>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix spacer "></div>
                    <?php // require 'includes/add-brand.php'; ?>
                    <?php require 'includes/view-brands.php'; ?>
                   


                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
<?php require 'includes/shared_js.php'; ?>
<script type="text/javascript" src="js/forpages/brands.js"></script>


</body>

</html>
<!-- end document-->
