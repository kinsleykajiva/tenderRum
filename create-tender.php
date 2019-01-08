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
<!--     <script type="text/javascript" src=./js/jquery-3.3.1.slim.js></script> -->

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
                    <br><br>
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
                                    <form  onsubmit="return false;"  role="form" novalidate="novalidate">
                                        <?php
                                                $tenderNumber = strtoupper(rand(11,40) . '-'.get_random_string(5) .'.'.get_random_string(rand(2,6)).'-'. rand(1,50) ) ;
                                        ?>
                                        <div class="form-group">
                                            <label for="tenderNumber" class="control-label mb-1">Tender Number  &nbsp;&nbsp; <strong> <small> <small><small> Randomly Generated Number </small></small> </small> </strong></label>
                                            &nbsp;&nbsp; &nbsp;&nbsp;
                                            <span style="color: red;display: none;" id="tenderNumberReq"><sup><small>Required</small></sup></span>
                                            <input id="tenderNumber" readonly  type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php print $tenderNumber ; ?>">
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="tendertitle" class="control-label mb-1">Title</label> &nbsp;&nbsp; <span style="color: red;display: none;" id="tendertitleReq"><sup><small>Required</small></sup></span>
                                            <input id="tendertitle" type="text" class="form-control ">
                                         
                                        </div>
                                        <div class="form-group">
                                            <label for="tenderCategory" class="control-label mb-1">Category</label> &nbsp;&nbsp; &nbsp;&nbsp;
                                            <span style="color: red;display: none;" id="tenderCategoryReq"><sup><small>Required</small></sup></span>
                                            
                                            <select onchange="showBrands();" name="select" id="tenderCategory"  class="form-control identified visa" data-val="true" >
                                                <option selected="selected" value="null">Please select</option>
		                                            <?php
				                                            require_once "app/DBClass/DBTenderCategories.php";
				                                            
				                                            $tenderCategoriesObj = new DBTenderCategories();
				                                            $datatenderCategories = $tenderCategoriesObj->getCategories ();
				                                            while($tenderCateRow = mysqli_fetch_assoc($datatenderCategories)) {
						                                            $tenderCateRow_id  = $tenderCateRow['id'] ;
						                                            ?>
                                                                <option value="<?php print  $tenderCateRow_id ; ?>"><?php print  $tenderCateRow['title']; ?></option>
						                                            <?php
				                                            } ?>
                                                
                                            </select>
                                           
                                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Due Date (yyyy-mm-dd) </label>
                                            <input type="date" id="due_date" class="form-control" placeholder="yyyy-mm-dd" >
                                            <span style="color: red;display: none;" id="tenderDueDateReq"><sup><small>Required</small></sup></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="tenderCategory" class="control-label mb-1">Description</label>
                                          
                                            <div name="quillEditor" id="quillEditor"  style="height: 285px; margin-bottom: 20px;"  class="form-control"></div>

                                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                        </div>
                                        <div class="form-group">
                                            Show Tender To Bidders After Saving &nbsp;&nbsp; <input id="isViewedAfterSaving" checked type="checkbox" class="icheck" name="checkbox1"/>
                                        </div>
                                        
                                        <div style="margin-top: 20px;">
                                            <button  id="btnSaveTender" type="submit" class="btn btn-lg btn-info ">
                                                <i class="fa fa-save"></i>&nbsp;
                                                <span >Save</span>
                                              
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" style="display: none;" id="cardBrands">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Brands OF Consideration</strong>
                                   <!-- <small> Form</small>-->
                                </div>
                                <div class="card-body card-block" id="inputCartegories">
		                                <?php
				                                require_once "app/DBClass/DBAcceptableBrands.php";
				                                $brandsObj  = new DBAcceptableBrands();
				                                $brandsData = $brandsObj ->getBrands  ();
				                                while($brandsRow = mysqli_fetch_assoc ( $brandsData)){
				                                    $brandName = $brandsRow[ 'title'];
		                                ?>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="company" class=" form-control-label">Company</label>
                                                <input type="text" data-id="<?php print $brandsRow[ 'id']; ?>" value="<?php print $brandName; ?>" readonly id="brand" placeholder="company name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="street" class=" form-control-label">Score</label>
                                                <select type="text" id="company_score"  class="form-control">
                                                 
                                                    <option selected="selected" value="null">Select</option>
                                                    <option  value="1">(1) Acceptable</option>
                                                    <option  value="2">(2) Good </option>
                                                    <option value="3">(3) Exceptional </option>
                                                    <option value="4">(4) Very Exceptional </option>
                                                    <option value="5">(5) The Best </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                    ?>
                                   
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
<script>


</script>


</body>

</html>
<!-- end document-->
