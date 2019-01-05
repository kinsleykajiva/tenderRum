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
    <title>View Tender - Dashboard</title>
		
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
                                <h2 class="title-1">All Available Tenders</h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                               <!--  <h3 class="title-5 m-b-35">Available Tenders </h3> -->
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                       <!--  <div class="rs-select2--light rs-select2--md">
                                           <select class="js-select2" name="property">
                                               <option selected="selected">All Properties</option>
                                               <option value="">Option 1</option>
                                               <option value="">Option 2</option>
                                           </select>
                                           <div class="dropDownSelect2"></div>
                                       </div> -->
                                       <!--  <div class="rs-select2--light rs-select2--sm">
                                           <select class="js-select2" name="time">
                                               <option selected="selected">Today</option>
                                               <option value="">3 Days</option>
                                               <option value="">1 Week</option>
                                           </select>
                                           <div class="dropDownSelect2"></div>
                                       </div> -->
                                        <span id="loadingConner">
                                            <img style="width: 40px; height: 40px;" src="images/35.gif">    Loading ...
                                        </span>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button onclick=" getAllTenders()" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-refresh-alt"></i>ReLoad</button>
                                       <!--  <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                           <select class="js-select2" name="type">
                                               <option selected="selected">Export</option>
                                               <option value="">Option 1</option>
                                               <option value="">Option 2</option>
                                           </select>
                                           <div class="dropDownSelect2"></div>
                                       </div> -->
                                    </div>
                                </div>
                                
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Tender Number</th>
                                                <th>Title</th>
                                                <th>Date Created</th>
                                                <th>Due Date</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="view_tenders_div">
                                           <tr style="color: red; font-weight: bolder;">
                                                 <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td >  No Data  !</td>
                                               <td>  No Data  !</td>
                                                <td>  No Data  !</td>
                                                <td >  No Data  !</td>
                                                <td>  No Data  !</td>
                                                 <td>
                                                     No Data  !
                                                </td>
                                            </tr> 
                                           <!--  <tr>
                                                <td colspan="7">
                                                    <hr/>
                                                </td>
                                            </tr> -->
                                          <!--   <tr  id="">
                                                <td colspan="7">
                                                    <div>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                    </div>
                                                </td>
                                                
                                            </tr> -->
                                            <!-- <tr>
                                                <td colspan="7">
                                                    <hr/>
                                                </td>
                                            </tr> -->
                                           
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>


                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

<!-- Jquery JS-->
<?php require 'includes/shared_js.php'; ?>
<script type="text/javascript" src="js/forpages/view-tenders.js"></script>

<script type="text/javascript">
    getAllTenders();
</script>

</body>

</html>
<!-- end document-->
