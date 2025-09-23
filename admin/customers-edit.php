<?php include('includes/header.php'); ?>

         <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                           <div class="card mt-4 shadow-sm"> 
                             <div class="card-header">
                                 <h4 class="mb-0">Edit Customers
                                    <a href="customers.php" class="btn btn-primary float-end">Back</a>
                                 </h4>

                             </div>   
                             <div class="card-body">
                                <?php alertMessaage(); ?>

                                    <form action="code.php" method="POST">

                                              <?php
                                              $paramValue = checkParamId('id');
                                              if (!is_numeric($paramValue)) {
                                                echo '<h5>'.$paramValuea.'</h5>';
                                                return false;

                                              }
                                              $customer = getById('customers',$paramValue);
                                              if ($customer['status']==200) {
                                                ?>
                                                <input type="hidden" name="customerId" value="<?=$customer['data']['id']; ?>">
                                                   <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="">Name *</label>
                                                <input type="text" name="name" required value="<?=$customer['data']['name']; ?>" class="form-control">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="">Email *</label>
                                                <input type="email" name="email" value="<?=$customer['data']['email']; ?>" class="form-control">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="">Phone *</label>
                                                <input type="number" name="phone" value="<?=$customer['data']['phone']; ?>"  class="form-control">
                                            </div>
                                             
                                              <div class="col-md-6">
                                                <label >status(Unchecked=Visible,Checked=Hidden)</label>
                                                <br/>
                                                <input type="checkbox" name="status" <?=$customer['data']['status']==true ? 'checked ':''; ?> style="width: 30px;height: 30px;">
                                              </div>
                                              
                                            <div class="col-md-12 mb-3 text-end">
                                                <br/>
                                              <button type="submit" name="updateCustomer" class="btn btn-primary float-end">Update</button>
                                            </div>

                                         </div>

                                                <?php

                                              }
                                                else {
                                                echo '<h5>'.$customer['message'].'</h5>';
                                               }
                                              ?>
                                    

                                      
                                    </form>
                               
                        </div>                   
                    </div>   
                </div>              
 <?php include('includes/footer.php'); ?>