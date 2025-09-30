$(document).ready(function() {

  // Increment
  $(document).on('click', '.increment', function () {
    var $quantityInput = $(this).closest('.qtyBox').find('.qty');
    var productId = $(this).closest('.qtyBox').find('.proId').val(); // hidden input for product id
    
    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue)) {
      var qtyVal = currentValue + 1;
      $quantityInput.val(qtyVal);
      quantityIncDec(productId, qtyVal);
    }
  });

  // Decrement
  $(document).on('click', '.decrement', function () {
    var $quantityInput = $(this).closest('.qtyBox').find('.qty');
    var productId = $(this).closest('.qtyBox').find('.proId').val(); // hidden input for product id
    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue) && currentValue > 1) {
      var qtyVal = currentValue - 1;
      $quantityInput.val(qtyVal);
      quantityIncDec(productId, qtyVal);
    }
  });

  function quantityIncDec(prodId, qty) {
    console.log("product id".prodId)
    $.ajax({
         type:"POST",
         url:"orders-code.php",
         data:{
            'productIncDec':true,
            'product_id':prodId,
            'quantity':qty
         },
         success: function (response){
            var res =JSON.parse(response);
            if(response.status==200){
                window.location.reload();
                alertify.success(res.message);
            }
            else{
              //  alertify.error(res.message);
            }
         }

    });

  }

});
