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
    <title>Respond To Tender - Dashboard</title>
		
		<?php require 'includes/shared_css.php'; ?>
          <link rel="stylesheet" href="js/quil-editor/quill.snow.css">


</head>

<body class="animsition">

<div class="page-wrapper">
    <!-- HEADER MOBILE-->
		<?php require 'includes/shared_header.php'; ?>

    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
		<?php require 'includes/shared_sidebar.php'; ?>

    <!-- END MENU SIDEBAR-->
    <?php 

    if(!isset($_GET['artile']) || !is_numeric($_GET['artile']) || empty($_GET['artile'])){
         header('location:view-tenders.php');
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=view-tenders.php">';    
        exit;
    }
    $getId = $_GET['artile'];

    ?>

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
                                <h2 class="title-1"> Answer to Tender </h2>

                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">Tender Response </div>
                                <div class="card-body">
                                   
                                    <form action="" onsubmit="return false;" method="post" novalidate="novalidate">
                                        <?php
                                            require_once  "app/DBClass/DBTender.php";
		                                        $DBTender = new DBTender();
		                                        $tenderData = $DBTender->getTender ($getId);
                                        ?>
                                        <div class="form-group">
                                            <label for="cc-name" class="control-label mb-1">
                                                <strong>
                                                    Title
                                                </strong>
                                            </label>
                                            <br>
                                            <label for="cc-payment" class="control-label mb-1">
                                                <?php
                                                    print $tenderData['title'];
                                                ?>
                                            </label>
                                            <span id="in_tender_id" style="display: none;"><?php print $getId; ?></span>
                                            
                                             </div>
                                        <div class="form-group has-success">
                                            <label for="cc-name" class="control-label mb-1">
                                                <strong>
                                                    Description
                                                </strong>
                                            </label>
                                                <br>
                                            <label for="cc-name" class="control-label mb-1">
		                                            <?php
				                                            print $tenderData['description'];
		                                            ?>
                                            </label>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="tenderprice" class="control-label mb-1">Price ($)</label>
                                            <span style="color: red;display: none;" id="tenderpriceReq"><sup><small>Required</small></sup></span>
                                            <input id="tenderprice"  type="text" class="form-control cc-number identified visa"  >
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="tendertimespan" class="control-label mb-1">Time Span (Express in Days)</label>
                                                    <span style="color: red;display: none;" id="tendertimespanReq"><sup><small>Required</small></sup></span>
                                                    <input id="tendertimespan"  type="text" class="form-control cc-exp"  >
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="x_card_code" class="control-label mb-1">Warranty Period (in years e.g 2.0 or 1.5 or 3.2)</label>
                                                <div class="input-group">
                                                    <span style="color: red;display: none;" id="warrantee_periodReq"><sup><small>Required</small></sup></span>
                                                    <input id="warrantee_period"  type="text" class="form-control cc-cvc" >

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" >
                                            <div class="col-6">
                                                <select class="form-control cc-cvc" onchange="showBrandsDiv()" id="supplierBrand" >
                                                <option value='null'> Select Supplier </option>
                                                <option value='self'> Self  Supply </option>
                                                <option value='known_brands'> Known Brand Supply </option>

                                                </select>
                                            </div>
                                            <div class="col-6">
                                            
                                            </div>
                                        </div>
                                       
                                         <div class="form-group">
                                            <label for="quillEditor" class="control-label mb-1">Description</label>
                                          
                                            <div name="quillEditor" id="quillEditor"  style="height: 285px; margin-bottom: 20px;"  class="form-control"></div>

                                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                        </div>
                                        
                                        <div>
                                            <button id="btnSaveTender" type="submit" class="btn btn-lg btn-info btn-block">
                                                <i class="fa fa-save"></i>&nbsp;
                                                <span id="payment-button-amount">Submit Tender Proposal</span>
                                               
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  <!-- end of div atg -->
                        <div class="col-lg-4" style="display: none;" id="divBrands">
                            <div class="card">
                                <div class="card-header">
                                            <strong id="brandsHeader">Known Brands With Regards</strong>                                           
                                </div>
                                <div class="card-body card-block">
                                       
                                        <div class="row form-group">
                                                <div style="visibility: hidden;" class="col col-md-3">
                                                    <label class=" form-control-label">Company</label>
                                                </div>
                                               
                                                <div class="col col-md-9">
                                                    <div class="form-check" id="compSelection">
                                                       <?php 
                                                       require 'app/DBClass/DBTenderBrandsCorrelations.php';

                                                       $acceptableBrandsObject = new DBTenderBrandsCorrelations();

                                                       $acceptableBrandsData = $acceptableBrandsObject-> getBrandsSelected();
                                                       while($brandsRow = mysqli_fetch_assoc($acceptableBrandsData)){
                                                        $brandId = $brandsRow['id'] ;
                                                        ?>
                                                        <div class="radio">
                                                            <label for="radio1" class="form-check-label ">
                                                                <input type="checkbox" data-id ='<?php print $brandId; ?>' id="radio1" name="radios" value="option1" class="form-check-input"> <?php  print $brandsRow['brandName'] ; ?>
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        
                                       
                                    </div>
                            </div>
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
<script src="js/quil-editor/quill.min.js"></script>
<script src="js/forpages/respond-to-tender.js"></script>


</body>

</html>
<!-- end document-->
