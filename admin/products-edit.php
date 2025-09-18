<?php include('includes/header.php'); ?>

         <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                           <div class="card mt-44 shadow-sm"> 
                             <div class="card-header">
                                 <h4 class="mb-0">Edit Products
                                    <a href="admins.php" class="btn btn-primary float-end">Back</a>
                                 </h4>

                             </div>   
                             <div class="card-body">

                                <?php alertMessaage(); ?>

                                    <form action="code.php" method="POST" enctype="multipart/form-data">

                                         <?php
                                         $paramValue = checkParamId('id');
                                         if (!is_numeric($paramValue)) {
                                          echo'<h5>Id is not an integer</h5>';
                                          return false;
                                        
                                         }

                                          $product =getById('products',$paramValue);
                                          if ($product) {
                                            if ($product['status']==200) {
                                          ?>
                                             <input type="hidden" name="product_id" value="<?=$product['data']['id']; ?>"  />
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

                                                          ?>
                                                          <option value="<?=$cateItem['id']; ?>"
                                                          <?=$product['data']['categoryid']==$cateItem['id']? 'selected':''; ?>
                                                          >
                                                             <?=$cateItem['name'] ?>

                                                          </option>

                                                          <?php
                                                          
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
                                                <input type="text" name="name" required value="<?=$product['data']['name']; ?>" class="form-control">
                                            </div>
                                              <div class="col-md-12 mb-3">
                                                <label for="">Description</label>
                                                <textarea name="description" class="form-control" rows="3"><?=$product['data']['description']; ?></textarea>
                                              </div>
                                               <div class="col-md-4 mb-3">
                                                <label for="">Price *</label>
                                                <input type="text" name="price"  required value="<?=$product['data']['price']; ?>" class="form-control" rows="3"></input>
                                              </div>
                                               <div class="col-md-4 mb-3">
                                                <label for="">Quantity</label>
                                                <input type="text" name="quantity"  required value="<?=$product['data']['quantity']; ?>" class="form-control" rows="3"></input>
                                              </div>
                                               <div class="col-md-4 mb-3">
                                                <label for="">Image</label>
                                                <input type="file" name="image"   class="form-control" rows="3"></input>
                                                <img src="../<?=$product['data']['image']; ?>" style="width: 60px;height=60px;" alt="IMG">
                                              </div>
                                              <div class="col-md-6">
                                                <label >status(Unchecked=Visible,Checked=Hidden)</label>
                                                <br/>
                                                <input type="checkbox" name="status" <?=$product['data']['status']== true ? 'checked':''; ?> style="width: 30px;height: 30px;">
                                              </div>
                                              
                                            <div class="col-md-12 mb-3 text-end">
                                                <br/>
                                              <button type="submit" name="updateProduct" class="btn btn-primary float-end">Update</button>
                                            </div>

                                         </div>
                                         <?php
                                             
                                               
                                            } else {
                                              echo'<h5>'.$product['message'].'</h5>';
                                            }
                                            
                                          } else {
                                          echo'<h5>Something went wrong</h5>';
                                          return false;
                                          }
                                         ?>

                                    </form>
                               
                        </div>                   
                    </div>   
                </div>              
 <?php include('includes/footer.php'); ?>