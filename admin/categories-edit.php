<?php include('includes/header.php'); ?>

         <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                           <div class="card mt-44 shadow-sm"> 
                             <div class="card-header">
                                 <h4 class="mb-0">Edit Category
                                    <a href="admins.php" class="btn btn-primary float-end">Back</a>
                                 </h4>

                             </div>   
                             <div class="card-body">
                                <?php alertMessaage(); ?>

                                    <form action="code.php" method="POST">
                                           <?php
                                               $parmValue = checkParamId('id');
                                               if (!is_numeric($parmValue)) {
                                                echo '<h5>'.$parmValue.'</h5>';
                                                return false;
                                               }

                                               $category =getById('categories',$parmValue);
                                               if ($category['status']==200) {
                                               ?>
                                                        <input type="hidden" name="categoryId" value="<?=$category['data']['id']; ?>">
                                         <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="">Name *</label>
                                                <input type="text" name="name" value="<?=$category['data']['name']; ?>" required class="form-control">
                                            </div>
                                              <div class="col-md- mb-3">
                                                <label for="">Description</label>
                                                <textarea name="description" class="form-control" rows="3">value="<?=$category['data']['description']; ?>"</textarea>
                                              </div>
                                              <div class="col-md-6">
                                                <label >status(Unchecked=Visible,Checked=Hidden)</label>
                                                <br/>
                                                <input type="checkbox" name="status" value="<?=$category['data']['status']==true ? 'checked ':''; ?>" style="width: 30px;height: 30px;">
                                              </div>
                                              
                                            <div class="col-md-12 mb-3 text-end">
                                                <br/>
                                              <button type="submit" name="updateCategory" class="btn btn-primary float-end">Update</button>
                                            </div>

                                         </div>
                                         <?php
                                               }
                                               else {
                                                echo '<h5>'.$category['message'].'</h5>';
                                               }
                                               ?>

                                    </form>
                               
                        </div>                   
                    </div>   
                </div>              
 <?php include('includes/footer.php'); ?>