<?php include('includes/header.php'); ?>

         <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                           <div class="card mt-44 shadow-sm"> 
                             <div class="card-header">
                                 <h4 class="mb-0">Add Products
                                    <a href="admins.php" class="btn btn-primary float-end">Back</a>
                                 </h4>

                             </div>   
                             <div class="card-body">

                                <?php alertMessaage(); ?>

                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                         <div class="row">
                                            <div class="col-md-12 mb-3">
                                               <label >Select Category</label>
                                               <select name="category_id" class="from-select">
                                                <option value="">Select Category</option>
                                                <?php
                                                $categories = getAll('categories');
                                                if ($categories) {
                                                    if (mysqli_num_rows($categories)>0) {
                                                        foreach ($categories as $key => $cateItem) {
                                                           echo '<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">No CAtegories found</option>';
                                                    }
                                                    
                                                }
                                                else{
                                                    echo '<option value="">Something Went Wrong !</option>';
                                                }
                                                ?>
                                               </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="">Product Name *</label>
                                                <input type="text" name="name" required class="form-control">
                                            </div>
                                              <div class="col-md-12 mb-3">
                                                <label for="">Description</label>
                                                <textarea name="description" class="form-control" rows="3"></textarea>
                                              </div>
                                               <div class="col-md-4 mb-3">
                                                <label for="">Price *</label>
                                                <input type="text" name="price" class="form-control" rows="3"></input>
                                              </div>
                                               <div class="col-md-4 mb-3">
                                                <label for="">Quantity</label>
                                                <input type="text" name="quantity" class="form-control" rows="3"></input>
                                              </div>
                                               <div class="col-md-4 mb-3">
                                                <label for="">Image</label>
                                                <input type="file" name="image" class="form-control" rows="3"></input>
                                              </div>
                                              <div class="col-md-6">
                                                <label >status(Unchecked=Visible,Checked=Hidden)</label>
                                                <br/>
                                                <input type="checkbox" name="status" style="width: 30px;height: 30px;">
                                              </div>
                                              
                                            <div class="col-md-12 mb-3 text-end">
                                                <br/>
                                              <button type="submit" name="saveProduct" class="btn btn-primary float-end">Save</button>
                                            </div>

                                         </div>

                                    </form>
                               
                        </div>                   
                    </div>   
                </div>              
 <?php include('includes/footer.php'); ?>