<?php
require '../config/function.php';
  
$paramResultId = checkParamId('id');

if (is_numeric($paramResultId)) {
    $productId = validate($paramResultId);
    $product = getById('products', $productId);

    echo "Admin ID: " . $productId;  

    if ($product['status'] == 200) {
        $response = delete('products', $productId);

        if ($response) {
            $deleteImage ="../".$product['data']['image'];
            if (file_exists($deleteImage)) {
                unlink($deleteImagel);
            }
            redirect('products.php', 'product deleted successfully ');
        } else {
            redirect('products.php', ' Something went wrong');
        }

    } else {
        redirect('products.php', $product['message']);
    }

} else {
    redirect('products.php', 'Invalid or missing ID');
}

?>   