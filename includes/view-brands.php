 <div id="divViewData" class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                   <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                               
                                                <th>Brand</th>
                                                <th>Description</th>
                                                <th>Category Tags</th>
                                                <th style='display: none;' >Category Tags</th>
                                                <th>Added Date</th>                                               
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="view_tenders_div">
                                            <?php 
                                            require 'app/DBClass/DBAcceptableBrands.php';

                                            $DBAcceptableBrandsObject = new DBAcceptableBrands();
                                            $DBAcceptableBrandsObjectData = $DBAcceptableBrandsObject ->getAllBrands();
                                            while($row = mysqli_fetch_assoc($DBAcceptableBrandsObjectData)){
                                                $edit_id = $row ['id']  . '_edit';
                                            ?>
                                         <tr style="color: red; font-weight: bolder;" id="<?php print $edit_id;   ?>">

                                            <td > <?php print $row ['title'] ; ?> </td>
                                            <td > <?php print $row ['description'] ; ?> </td>
                                             <td > <?php print $row ['categoryTitle'] ; ?> </td>
                                             <td style='display: none;' > <?php print $row ['description'] ; ?> </td>
                                            <td > <?php print $row ['date_created'] ; ?> </td>
                                            <td> 
                                              <div class="btn-group">
                                                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                     <i class="fa fa-newspaper-o fa-lg text-success "></i>  Action 
                                                                                                          <span class="caret"></span>
                                                 </button>
                                                 <ul class="dropdown-menu" role="menu">
                                                    <li onclick="editOption( '<?php print $edit_id;   ?>')" class="dropdown-item"><a href="#">Edit</a></li>
                                                    <li class="dropdown-item"><a href="#">Delete</a></li>

                                                </ul>
                                            </div>
                                        </td>

                                    </tr> 
                                <?php } ?>
                                           
                                           
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>