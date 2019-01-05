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
    <title>Tender Responses - Dashboard</title>
		
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
        <?php
            if(!isset($_GET['tender']) || !is_numeric($_GET['tender']) || empty($_GET['tender'])){
               header('location:view-tenders.php');
               echo '<META HTTP-EQUIV="Refresh" Content="0; URL=view-tenders.php">';    
               exit;
           }
           $getId = $_GET['tender'];

            require_once  "app/DBClass/DBTender.php";
            $DBTender = new DBTender();
            $tenderData = $DBTender->getTender ($getId);
        ?>
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1">Tender Responses For :</h2>


                            </div>
                        </div>
                    </div>

                     <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <hr>
                                <br>
                                <br>
                                <h3 class="title-5 m-b-35">
                                    
                                    <?php
                                                    print $tenderData['title'];
                                                ?>
                                </h3>
                                <div style="display: none;" class="table-data__tool">
                                   
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add item</button>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Export</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2"   >
                                        <thead>
                                            <tr>
                                                
                                                <th  >Tender ID</th>
                                                <th>Supplier</th>
                                                <th>Catagory</th>
                                                <th>Date Submited</th>
                                                <th>price</th>
                                                <th id="sl" >Perfomance Score (4 d.p)</th>
                                               
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="mytable">
                                            <?php 

                                            require 'app/DBClass/DBTenderProposal.php';   
                                            require 'app/DBClass/DBTenderBrandsCorrelations.php'; 
                                            require 'app/DBClass/DBCompanies.php'; 

                                            require_once 'lib/ItemComponents.php';                                         
                                            require_once 'lib/TenderProvider_Supplier.php';
                                            require_once 'lib/MultiCriteriaDecisionMaking.php';
                                            require_once 'lib/Tender.php';
                                            
                                            function array_push_assoc($array, $key, $value){
                                                $array[$key] = $value;
                                                return $array;
                                            }

                                            $tenderProposalObject = new DBTenderProposal();  
                                            $companiesObject = new DBCompanies();
                                            $proposalsData = $tenderProposalObject ->getAllProposals();

                                            $brandCorrection = new DBTenderBrandsCorrelations();
                                             $itemComponents                = new ItemComponents( [] );   // [1]

                                            
                                            $savedBrands =  array(); // get brands in the fomr of array                                            

                                            while($proposalsRow = mysqli_fetch_assoc($proposalsData)) { 
                                                
                                                $weights_arr                   = array ( 0.14 , 0.14, 0.14, 0.14 ,0.14 ,0.14,  0.14);
                                               $savedBrands = $brandCorrection ->getBrandsWightDataForProposal($proposalsRow['id'] );
                                                $price                         = (float) $proposalsRow['price']; // [0]
                                                //print $price . '\n';
                                                $provision_time_period_in_days =  $proposalsRow['time_of_service_provision']; // [2]
                                                $proposalMNaker = $companiesObject->getCompanyDetails($proposalsRow['created_by']) ; 
                                                $providersName                 = new TenderProvider_Supplier( $proposalMNaker['title'] , (float) $proposalMNaker['years_of_operation'] );  // [3]  // [4]
                                                $itemsCount                    = 1.0;  // [5]
                                                $computer_1                    = new Tender(
                                                $weights_arr , $price , $itemComponents , $provision_time_period_in_days , $providersName , $itemsCount , $savedBrands , $proposalsRow
                                                );

                                            } 

                                            MultiCriteriaDecisionMaking::normalise ();
                                            $resultProcess = MultiCriteriaDecisionMaking::getResultsFactory ();  

                                           
                                            function sortByOrder($a, $b) {
                                                return $a['rowResult'] - $b['rowResult'];
                                            }
                                           
                                           // usort ( MultiCriteriaDecisionMaking::$performance_score , 'sortByOrder') ;            
                                            
                                            foreach (MultiCriteriaDecisionMaking::$performance_score as $ObjKey ) {                                                                              

                                            ?>
                                            <tr class="tr-shadow">
                                               
                                                <td><?php  print $ObjKey ['otherDataArr'] ['tender_number']; ?></td>
                                                <td>
                                                    <span class="block-email">
                                                        <?php  print $ObjKey ['tenderProvidersNameOrId'] ; ?>
                                                    </span>
                                                </td>
                                                <td class="desc">
                                                     <?php  print  $ObjKey ['otherDataArr'] ['ttender_catagory']  ; ?>
                                                </td>
                                                <td> <?php  print  $ObjKey ['otherDataArr']  ['date_created'] ; ?> </td>
                                                <td>
                                                    <span class="status--process">
                                                         <?php  print $ObjKey ['price_actual'] ; ?>
                                                    </span>
                                                </td>
                                                <td  >
                                                 <?php   print round( $ObjKey ['rowResult'] , 4)  ; ?>
                                                     
                                                 </td>
                                                 <td>
                                                     <div class="btn-group">
                                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                     <i class="fa fa-newspaper-o fa-lg text-success "></i>  Action 
                                                                                                          <span class="caret"></span>
                                                 </button>
                                                 <ul class="dropdown-menu" role="menu">
                                                    <li onclick="viewHiddenDiv('<?php print $ObjKey['otherDataArr']['id']; ?>');" class="dropdown-item"><a href="#">View More</a></li>
                                                    <!-- <li class="dropdown-item"><a href="#">Delete</a></li> -->

                                                </ul>
                                            </div>
                                                 </td>
                                                
                                             
                                            </tr>
                                          
                                            
                                            <tr style="display: none;" id="<?php print $ObjKey['otherDataArr']['id']. '_hiddemRowDiv' ; ?>" >
                                                <td colspan="7">
                                                    <div class="">
                                                        <div class="col-md-10">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <strong class="card-title">
                                                                        Warrantee perod :  <?php print $ObjKey['otherDataArr']['warrantee_period'] ;?>  Years <br>
                                                                        Time Of Provisioning :  <?php print $ObjKey['otherDataArr']['time_of_service_provision'] ;?> Days<br>

                                                                    </strong>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">
                                                                        <?php print $ObjKey['otherDataArr']['description'] ;?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr> 
                                           
                                        <?php  } ?>
                                          
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
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
<script type="text/javascript" src="js/forpages/view-tenders-response.js"></script>

<script type="text/javascript">
   $(document).ready(function () {
       let max = 0;
       $('#mytable tr').find('td:nth-last-child(2)').each(function(){

        max = Math.max($(this).text(),max);
    });
      

$("#mytable td:nth-child(6)").each(function () {
   if (parseFloat($(this).text()) === max ) {
    $(this).parent("tr").css("background-color", "green");
}


});

});
</script>
</body>

</html>
<!-- end document-->
