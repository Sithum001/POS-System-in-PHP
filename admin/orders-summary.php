<?php include('includes/header.php'); 
if (!isset($_SESSION['productItems'])) {
   echo '<script> window.location.href = "order-create.php"</script>';
}
?>

<div class="modal fade" id="orderSuccessModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  
      <div class="modal-body">
     <div class="mb-3 p-4">
          <h5 id="oderPlaceSuccessMessage"></h5>
     </div>
        <a href="orders.php" class="btn btn-secondary" >Close</a>
        <button type="button" class="btn btn-danger ">Print </button>
        <button type="button" class="btn btn-warning ">Download PDF </button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid px-4">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Order Summary 
                    <a href="order-create.php " class="btn btn-danger" >Back to create order</a>
                </h4>
                <div class="card-body">
                    <?php alertMessaage(); ?>
                    <div id="myBillingArea">
                        <?php
                           if (isset($_SESSION['cphone'])) {
                        
                            $phone = validate($_SESSION['cphone']);
                            $invoiceNo = validate($_SESSION['invoice_no']);
                            $customerQuery =mysqli_query($con,"SELECT * FROM customers WHERE phone='$phone' LIMIT 1");

                            if ($customerQuery) {
                                if (mysqli_num_rows($customerQuery)> 0) {
                                     $cRowData = mysqli_fetch_assoc($customerQuery);
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
                                                <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Customer Name:<?= $cRowData['name'] ?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Customer Phone No:<?= $cRowData['phone'] ?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Customer Email Id:<?= $cRowData['email'] ?></p>
                                            </td>
                                        </tr>
                                           <tr>
                                            <td align="end">
                                                <h4 style="font-size: 23px; line-height:30px; margin:2px; padding:0;">Invoice Details</h4>
                                                <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Invoice No:<?=$invoiceNo;?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Invoice Date: <?= date('d M Y'); ?></p>
                                                 <p style="font-size: 16px; line-height:24px; margin:2px; padding:0;">Address: 1st main road, Colombo ,Sri lanaka</p>
                                            </td>
                                        </tr>

                                    </table>
                                    
                                    <?php
                                } else {
                                    echo "<h5>No Customer Found</h5> ";
                                    return;
                                }
                                
                            }
                           }


                        ?>

                        <?php
                        if (isset($_SESSION['productItems'])) {
                            $sessionProducts = $_SESSION['productItems'];
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
                                    $totalAmount  =0;
                                    foreach($sessionProducts as $key => $row):
                                        $totalAmount += $row['price']  * $row['quantity'];
                                    ?>
                                    <tr>
                                        <td style="border-bottom:1px solid #ccc;"><?= $i++; ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= $row['name']; ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= number_format($row['price'],0) ?></td>
                                        <td style="border-bottom:1px solid #ccc;"><?= $row['quantity']; ?></td>
                                        <td style="border-bottom:1px solid #ccc;" class="fw-bold">
                                            <?= number_format($row['price']*$row['quantity'],0)  ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>

                                    <tr>
                                        <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td>
                                        <td colspan="1" style="font-weight: bold;"><?= number_format($totalAmount,0) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" >Payment Mode:<?= $_SESSION['payment_mode']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                           </div>

                           <?php
                        }
                        else {
                           echo '<h5 class="text-center" >No Customer Added</h5> ';
                        }
                        ?>



                    </div>

                    <?php
                    if (isset($_SESSION['productItems'])): 
                    ?>
                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-primary px-4 mx-1" id="saveOrder">Save</button>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>    

</div>

<?php include('includes/footer.php'); ?>