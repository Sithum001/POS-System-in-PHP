<?php include('includes/header.php'); ?>

         <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                           <div class="card mt-44 shadow-sm"> 
                             <div class="card-header">
                                 <h4 class="mb-0">Products
                                    <a href="products-create.php" class="btn btn-primary float-end">Add Products</a>
                                 </h4>

                             </div>   
                             <div class="card-body">

                                 <?php alertMessaage(); ?>
                                   <?php
                                            $products = getAll('products');
                                            if (!$products) {
                                                echo'<h4>something Went Wrong</h4>';
                                                return false;
                                            }
                                            if (mysqli_num_rows($products)>0) {
                                                
                                           
                                            ?> 
                                 <div class="table-responsive">
                                       
                                     <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <?php foreach($products as $Iteam) : ?>
                                            <tr>
                                                <td><?= $Iteam['id'] ?></td>
                                                <td>
                                                    <img src="../<?= $Iteam['image']; ?>" style="width:50px;height:50px;" alt="IMG">
                                                </td>
                                                <td><?= $Iteam['name'] ?></td>
                                               
                                                <td>
                                                    <?php
                                                    if($Iteam['status']==1){
                                                           echo'<span class="badge bg-danger">Hidden</span>';
                                                    }
                                                    else{
                                                           echo'<span class="badge bg-primary">Visible</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="products-edit.php?id=<?= $Iteam['id'] ?>"  class="btn btn-success btn-sm">Edit</a>
                                                    <a href="products-delete.php?id=<?= $Iteam['id'] ?>" class="btn btn-danger btn-sm">delete</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>

                                      
                                        </tbody>
                                     </table>
                                
                             </div> 
                                   <?php
                                            }
                                            else {
                                                ?>
                                                <tr>
                                                <h4 class="mb-0" >No Record found</h4>
                                            </tr>

                                            <?php
                                            }
                                            ?>
                        </div>                   
                    </div>   
                </div>              
 <?php include('includes/footer.php'); ?>