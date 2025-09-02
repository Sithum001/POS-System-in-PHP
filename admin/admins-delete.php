<?php
require '../config/function.php';
  
$paramResultId = checkParamId('id');

if (is_numeric($paramResultId)) {
    $adminId = validate($paramResultId);
    $admin = getById('admins', $adminId);

    echo "Admin ID: " . $adminId;  

    if ($admin['status'] == 200) {
        $adminDeleteRes = delete('admins', $adminId);

        if ($adminDeleteRes) {
            redirect('admins.php', 'Admin deleted successfully ');
        } else {
            redirect('admins.php', ' Something went wrong');
        }

    } else {
        redirect('admins.php', $admin['message']);
    }

} else {
    redirect('admins.php', 'Invalid or missing ID');
}

?>   