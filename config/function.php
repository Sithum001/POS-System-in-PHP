<?php
session_start();
require('config/dbcon.php');

//input field validati0n
function validate($inputData){
    global $con;
    $validateData = mysqli_real_escape_string($con, $inputData);
    return  trim($validateData);
}

//redirect from one page to another page with the massage
function redirect($url, $status){
 $_SESSION['status'] = $status;
 header("Location: $url");
 exit(0);
}

//dispaly massage or staus after any process
function alertMessaage(){
    if(isset($_SESSION['status']) ){
        $_SESSION['status'] ;
        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h6>'.$_SESSION['status'].'</h6>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
        unset($_SESSION['status']);
    }
}




//isert record using this function
function insert($tableName, $data){
    global $con;
    $table =validate($tableName);
    $colums =array_keys($data);
    $values =array_values($data);

    $finalColumns = implode(", ",  $colums);
    $finalValues  = implode("', '", $values);
    
    $query = "INSERT INTO $tableName ($finalColumns) VALUES ('$finalValues')";
    $result = mysqli_query($con, $query);
    return $result;
   
}

//update record using this function
function  update($tableName, $id,$data){
    global $con;
    $table =validate($tableName);
    $id =  validate($id);

    $updateDataString = "";
    foreach($data as $column => $value){
      $updateDataString .= $column = '='."'$value',";
 
    }
      $finalUpdateData =substr($updateDataString, 0, -1); //remove last comma
      $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
      $result = mysqli_query($con, $query );
      return $result;
}

?>