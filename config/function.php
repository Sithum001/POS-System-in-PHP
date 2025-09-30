<?php
session_start();
require(__DIR__ . '/dbcon.php'); // Always works


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
      $updateDataString .= $column.'='."'$value',";

    }
      $finalUpdateData =substr($updateDataString, 0, -1); //remove last comma
      $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
      $result = mysqli_query($con, $query );
      return $result;
}

function getAll($tableName, $status = NULL){
    global $con;
    $table = validate($tableName);
    $query = "SELECT * FROM $table";
    
    if($status =='status'){
         $query = "SELECT * FROM $table WHERE status='0'";
    }
    else{
        $query = "SELECT * FROM $table";
    }

    return mysqli_query($con,$query);
}

//get record by id using this function
function getById($tableName, $id){
    global $con;
    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result) {
          if(mysqli_num_rows($result)==1)   {
               // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $row = mysqli_fetch_assoc($result);
                     $reesponse =[
            'status'  =>200,
            'data'=>$row,
            'message' => 'Record Found'
        ];
        return $reesponse;

          }else{
              $reesponse =[
            'status'  =>404,
            'message' => 'No Data  Found'
        ];
        return $reesponse;
          }

    } else {
        $reesponse =[
            'status'  =>500,
            'message' => 'Something went wrong',
        ];
        return $reesponse;
    }
}

//Delete record  using this function
function delete($tableName, $id){
   global $con;
    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($con, $query);
    return $result;

}


//cheack paramiterID

function checkParamId($type){
    if (isset($_GET[$type])) {
        if ($_GET[$type] != '') {
            
           return $_GET[$type];
        }
        else {
            return '<h5>No Id Found. <h5/>';
        }
    } else {
        return '<h5>No Id Given in Prams </h5>';
    }
    
}


   function logoutSession(){
            unset($_SESSION['loggedIn']);
            unset($_SESSION['loggedInUser']);
    }

    
    function jsonResponse($status, $status_type,$message){
             $response =[
            'status' => $status,
            'status_type' => $status_type,
            'message' => $message
        ];
        echo json_encode($response);
        return;
    }
?>