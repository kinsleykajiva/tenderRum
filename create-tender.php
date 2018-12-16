<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Create Tender - TenderRum</title>
		
		<?php require 'includes/shared_css.php'; ?>
    <link rel="stylesheet" href="js/quil-editor/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="js/iCheck/flat/red.css"/>

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
                                <h2 class="title-1">Create Tender </h2>

                            </div>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">Form</div>
                                
                                <div class="card-body">
                                    <!--<div class="card-title">
                                        <h3 class="text-center title-2">Pay Invoice</h3>
                                    </div>
                                    <hr>-->
                                    <form action="" onsubmit="return false;" method="post" novalidate="novalidate">
                                        <?php
                                                $tenderNumber = strtoupper(rand(11,40) . '-'.get_random_string(5) .'.'.get_random_string(rand(2,6)).'-'. rand(1,50) ) ;
                                        ?>
                                        <div class="form-group">
                                            <label for="tenderNumber" class="control-label mb-1">Tender Number  &nbsp;&nbsp; <strong> <small> <small><small> Randomly Generated Number </small></small> </small> </strong></label>
                                            <input id="tenderNumber" readonly  type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php print $tenderNumber ; ?>">
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="tendertitle" class="control-label mb-1">Title</label>
                                            <input id="tendertitle" name="tendertitle" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card"
                                                   autocomplete="tendertitle" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                            <span class="help-block field-validation-valid" data-valmsg-for="tendertitle" data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="tenderCategory" class="control-label mb-1">Category</label>
                                            <select name="select" id="tenderCategory"  class="form-control cc-number identified visa" data-val="true" autocomplete="tenderCategory">
                                                <option selected value="0">Please select</option>
                                                <option value="1">Option #1</option>
                                                <option value="2">Option #2</option>
                                                <option value="3">Option #3</option>
                                            </select>
                                           
                                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="tenderCategory" class="control-label mb-1">Description</label>
                                          
                                            <div name="quillEditor" id="quillEditor"  style="height: 75px; margin-bottom: 20px;"  class="form-control"></div>

                                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            Show Tender To Bidders After Saving &nbsp;&nbsp; <input type="checkbox" class="icheck" name="checkbox1"/>
                                        </div>
                                        
                                        <div style="margin-top: 20px;">
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info ">
                                                <i class="fa fa-save"></i>&nbsp;
                                                <span onclick="btnSaveTender();">Save</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                            </button>
                                        </div>
                                    </form>
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
<script src="js/iCheck/icheck.min.js"></script>
<script src="js/quil-editor/quill.min.js"></script>
<script src="js/forpages/create-tender.js"></script>


</body>

</html>
<!-- end document-->
