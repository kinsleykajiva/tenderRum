<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="js/nakupanda_bootstrap3dialog/bootstrap-dialog.min.css"/>

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a style="display: none;" href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                            <h4>Register Company</h4>
                            <h3 id="serverReponseFinal"></h3>
                        </div>
                        <div class="login-form">
                            <form  onsubmit="return false ; " autocomplete="off" action="" method="post">
                                <div class="form-group">
                                    <label>Company Name  <span id="companyNameRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span> </label> 
                                    <input class="au-input au-input--full" type="text"  id="companyName" placeholder="Name">
                                </div>
                                 <div class="form-group">
                                    <label>Company Category  <span id="companyCategoryRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span></label>
                                    <select id="companyCategory" class="au-input au-input--full form-control" >
                                        <option value="null">Select</option>
                                        <?php 
                                        require 'app/DBClass/DBCompaniesCategories.php';
                                        $DBCompaniesCategories = new DBCompaniesCategories();
                                        $DBCompaniesCategoriesData = $DBCompaniesCategories->getAllCompanyCategories() ;

                                        while($row = mysqli_fetch_assoc($DBCompaniesCategoriesData)){
                                        ?>
                                        <option value="<?php print $row['id'] ;?>"><?php print $row['title'] ;?></option>
                                    <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Company Registrattiobn Date  <span id="companyRegiDateRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span></label>
                                    <input id="companyRegiDate" class="au-input au-input--full" type="date"  >
                                </div>
                                <div class="form-group">
                                    <label>Company Email Address <span id="companyEmailRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span></label>
                                    <input id="companyEmail" class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                               <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                    <label>Username  <span id="compnayUsernameRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span></label>
                                    <input   id="compnayUsername" class="au-input au-input--full" type="text"  placeholder="User Name">
                                </div>
                                </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                    <label>Password  <span id="companyPasswordRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span></label>
                                    <input   id="companyPassword" class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                </div>

                                   
                               </div>
                                 <div class="form-group">
                                    <label>Address <span id="companyAddressRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span></label>
                                    <input  id="companyAddress" class="au-input au-input--full" type="text"   placeholder="address">
                                </div>
                                 <div class="form-group">
                                    <label>Phone <span id="compnyPhoneRequired" style="color:red;display: none;"> &nbsp; <i class="fa fa-warning"></i> &nbsp; Required</span></label>
                                    <input id="compnyPhone" class="au-input au-input--full" type="tel"   placeholder="contact">
                                </div>
                                
                                <button onclick="registerCompany()" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>
                             
                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="login.php">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
 <script src="js/loadingoverlay.min.js"></script>
    <script type="text/javascript">

        function registerCompany(){
            let companyName =  $("#companyName").val().trim();
            let companyCategory =  $("#companyCategory").val();
            let companyRegiDate =  $("#companyRegiDate").val().trim();
            let companyEmail =  $("#companyEmail").val().trim();
            let compnayUsername =  $("#compnayUsername").val().trim();
            let companyPassword =  $("#companyPassword").val().trim();
            let companyAddress =  $("#companyAddress").val().trim();
            let compnyPhone =  $("#compnyPhone").val().trim();

            if(companyName === ''){
                $("#companyNameRequired").slideDown(); return;
            }$("#companyNameRequired").slideUp();
            // ----
             if(companyCategory === 'null'){
                $("#companyCategoryRequired").slideDown(); return;
            }$("#companyCategoryRequired").slideUp();
            // ----
             if(companyRegiDate === ''){
                $("#companyRegiDateRequired").slideDown(); return;
            }$("#companyRegiDateRequired").slideUp();
            // ----
             if(companyEmail === ''){
                $("#companyEmailRequired").slideDown(); return;
            }$("#companyEmailRequired").slideUp();

            // ----
             if(compnayUsername === ''){
                $("#compnayUsernameRequired").slideDown(); return;
            }$("#compnayUsernameRequired").slideUp();
            // ----
             if(companyPassword === ''){
                $("#companyPasswordRequired").slideDown(); return;
            }$("#companyPasswordRequired").slideUp();
            // ----
             if(companyAddress === ''){
                $("#companyAddressRequired").slideDown(); return;
            }$("#companyAddressRequired").slideUp();
            // ----
             if(compnyPhone === ''){
                $("#compnyPhoneRequired").slideDown(); return;
            }$("#compnyPhoneRequired").slideUp();
            // ----
            loadingOverlay(true  , "Saving....") ;
            $.post('app/ajax_slave/regi_login_company.php', {
              companyName:companyName , 
              companyCategory:companyCategory ,
              companyRegiDate:companyRegiDate ,
              companyEmail:companyEmail ,
              companyPassword :companyPassword ,
              compnayUsername:compnayUsername ,
              companyAddress:companyAddress ,
              compnyPhone : compnyPhone
            }).done(respo=>{
                loadingOverlay(false  , "Saving....") ;
                if("done"){
                         $("#serverReponseFinal").html("<span style='color:green;'>Saved  , Log In </span>");
                } else{
                    $("#serverReponseFinal").html("<span style='color:red;'> Failed To Save </span>");
                }
            }) .fail(()=>{
                     $("#serverReponseFinal").html("<span style='color:red;'> Failed To Save </span>");
            });
            
            
        }
/*********************************************************************************************/
function loadingOverlay ( isToShowBool , message ) {
    if ( isToShowBool ) {
        $.LoadingOverlay ( 'show' , {
            background : 'rgba(165, 190, 100, 0.5)' ,
            textAutoResize : true ,
            text : message === '' ? 'Loading ... ' : message
        } );
    }
    else {
        $.LoadingOverlay ( 'hide' );
    }

}
/*********************************************************************************************/
    </script>

</body>

</html>
<!-- end document-->