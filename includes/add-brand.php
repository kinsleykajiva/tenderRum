 <div id="divAddBrand" style="display: none;" class="row">
                        <div class="col-md-12">
                             <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header" id="editAddTitle">Add Brand</div>
                                    <span style="display: none;" id="editid"></span>
                                    <div class="card-body">
                                      
                                        <form onsubmit="return false;" action="" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Brand Name :</label>
                                                <input id="brandName" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00">
                                                 <span class="help-block" id="brandNameRequired" style="color:red;display: none;" data-valmsg-replace="true"><small><small>Required</small></small></span>
                                            </div>
                                            <div class="form-group has-success">
                                             <div class="form-group">
                                                <label for="exampleFormControlSelect1">Brand Category</label>
                                                <select multiple  class="form-control" id="brandTag">
                                                    <option selected="selected" value="null"> Make a selection </option>
                                                    <?php 
                                                    require 'app/DBClass/DBCompaniesCategories.php';
                                                    $DBCompaniesCategories =  new DBCompaniesCategories();

                                                    $DBCompaniesCategoriesData  = $DBCompaniesCategories ->getAllCompanyCategories();
                                                    while ($roww = mysqli_fetch_assoc($DBCompaniesCategoriesData)) {                                                        
                                                   
                                                     ?>
                                                  <option value="<?php print $roww['id'] ; ?>"> <?php print $roww['title'] ; ?> </option>
                                              <?php } ?>
                                                  
                                              </select>
                                              <span class="help-block" id="brandTagRequired" style="color:red;display: none; " data-valmsg-replace="true"><small><small>Required</small></small></span>
                                          </div>
                                      </div>
                                            <div class="form-group">
                                                <label for="brandDescription" class="control-label mb-1">Description</label>
                                                <input id="brandDescription" name="cc-number" type="tel" class="form-control cc-number identified visa"  placeholder="Description .... " 
                                                 >
                                                  <span class="help-block" id="brandDescriptionRequired" style="color:red;display: none; " data-valmsg-replace="true"><small><small>Required</small></small></span>
                                               
                                            </div>
                                            
                                            <div>
                                                <button onclick="saveBrand()" id="btnUpdateSave" type="submit" class="btn btn-info">
                                                    <i class="fa fa-save"></i>&nbsp; Save
                                                   
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>