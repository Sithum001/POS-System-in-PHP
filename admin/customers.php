<?php include('includes/header.php'); ?>

         <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                           <div class="card mt-4 shadow-sm"> 
                             <div class="card-header">
                                 <h4 class="mb-0">Customers
                                    <a href="customers-create.php" class="btn btn-primary float-end">Add Customers</a>
                                 </h4>

                             </div>   
                             <div class="cardd-body">

                                 <?php alertMessaage(); ?>
                                   <?php
                                            $customers = getAll('customers');
                                            if (!$customers) {
                                                echo'<h4>something Went Wrong</h4>';
                                                return false;
                                            }
                                            if (mysqli_num_rows($customers)>0) {
                                                
                                           
                                            ?> 
                                 <div class="table-responsive">
                                       
                                     <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <?php foreach($customers as $Iteam) : ?>
                                            <tr>
                                                <td><?= $Iteam['id'] ?></td>
                                                <td><?= $Iteam['name'] ?></td>
                                                <td><?= $Iteam['email'] ?></td>
                                                <td><?= $Iteam['phone'] ?></td>
                                               
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
                                                    <a href="customers-edit.php?id=<?= $Iteam['id'] ?>"  class="btn btn-success btn-sm">Edit</a>
                                                    <a href="customers-delete.php?id=<?= $Iteam['id'] ?>" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure want to delete this product ')">
                                                    Delete</a>
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