<?php include('includes/header.php');  ?>
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">print orders
              <a href="" class="btn btn-dander mx-2 btn-sm float-end">Back</a>
              </h4>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['track'])) {
                $trackingNo = validate($_GET['track']);
                if ($trackingNo  =='') {
                    ?>
            <div class="text-center py-5">
                      <h5>Please provide Tracking Number </h5>
            <div>
                   <a href="orders.php" class="btn btn-primary mt-4 w-25" > GO back to orders</a>
            </div>
            </div>
                    <?php
                }
                       $orderQuery ="SELECT  o.*,c.* FROM orders as o,customers as c WHERE c.id =o.customer_id AND tracking_no='$trackingNo' LIMIT 1";
                       $orderQueryRes = mysqli_query($con,$orderQuery);
                       if (!$orderQueryRes) {
                         echo"<h5>Something went Wrong</h5>";
                          return false;
                       }
                       if(mysqli_num_rows($orderQueryRes)>0) {
                        $orderDataRow = mysqli_fetch_assoc($orderQueryRes);
                        ?>
                          <table style="width:100%; margin: button 20px;">
                                        <tr>
                                            <td style="text-align: center;" colspan="2">
                                                <h4 style="font-size: 23px; line-height:30px; margin:2px; padding:0;">Company Xyz</h4>
                                                <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">#555, 1st st street ,colombo Sri lanaka </p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">company xyz pvt ltd</p>
                                            </td>
                                        </tr>
                                           <tr>
                                            <td >
                                                <h4 style="font-size: 23px; line-height:30px; margin:2px; padding:0;">Customer Details</h4>
                                                <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Customer Name:<?= $orderDataRow['name'] ?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Customer Phone No:<?= $orderDataRow['phone'] ?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Customer Email Id:<?= $orderDataRow['email'] ?></p>
                                            </td>
                                        </tr>
                                           <tr>
                                            <td align="end">
                                                <h4 style="font-size: 23px; line-height:30px; margin:2px; padding:0;">Invoice Details</h4>
                                                <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Invoice No:<?=$orderDataRow['tracking_no'];?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Invoice Date: <?= date('d M Y'); ?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Address: 1st main road, Colombo ,Sri lanaka</p>
                                            </td>
                                        </tr>

                                    </table>
                        <?php

                       }
                       else {
                         echo"<h5>No  data found</h5>";
                          return false;
                       }

                       $orderItemQuery ="SELECT oi.quantity as orderItemQuantity,oi.price as orderItemPrice, o.*,oi.*,p.* FROM orders as o,order_items as oi, products as p WHERE oi.order_id =o.id AND p.id =oi.product_id AND o.tracking_no='$trackingNo'";
                       $orderItemQueryRes = mysqli_query($con,$orderItemQuery);
                       if ($orderItemQueryRes) {
                        if (mysqli_num_rows($orderItemQueryRes)>0) {
                            ?>
                            <div class="table-responsive mb-3">
                            <table style="width: 100%;" cellpadding="5">
                                <thead>
                                    <tr>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">Id</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;">Product Name</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Price</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantity</th>
                                        <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Toatal Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i =1;
                                    
                                    foreach($orderItemQueryRes as $key => $row):
                                    
                                    ?>
                                    <tr>
                                        <td style="border-bottom:1px solid #ccc;"><?= $i++; ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= $row['name']; ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= number_format($row['orderItemPrice'],0) ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= $row['orderItemQuantity']; ?></td>
                                        <td style="border-bottom:1px solid #ccc;" class="fw-bold">
                                            <?= number_format($row['orderItemPrice']*$row['orderItemQuantity'],0)  ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td>
                                        <td colspan="1" style="font-weight: bold;"><?= number_format($row['total_amount'],0) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" >Payment Mode:<?= $row['payment_mode']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                           </div>
                            <?php

                        }
                      }
                      else {
                        echo"<h5>Something went Wrong</h5>";
                          return false;
                      }
                    
            } else {
              ?>
            <div class="text-center py-5">
                <h5>No Tracking Number Found</h5>
            <div>
                <a href="orders.php" class="btn btn-primary mt-4 w-25" > GO back to orders</a>
            </div>
            </div>
              <?php
            }
            

            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>