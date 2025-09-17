<?php
require '../config/function.php';
  
$paramResultId = checkParamId('id');

if (is_numeric($paramResultId)) {
    $categoryId = validate($paramResultId);
    $category = getById('categories', $categoryId);

    echo "Admin ID: " . $categoryId;  

    if ($category['status'] == 200) {
        $response = delete('categories', $categoryId);

        if ($response) {
            redirect('categories.php', 'Category deleted successfully ');
        } else {
            redirect('categories.php', ' Something went wrong');
        }

    } else {
        redirect('categories.php', $category['message']);
    }

} else {
    redirect('categories.php', 'Invalid or missing ID');
}

?>   