<?php 
require_once('db.php');

extract($_POST);


if(isset($_POST['reqtype'])){

    if($_POST['reqtype'] == 'edit'){

         $query="SELECT `id`,`name`, `age`, `city`, `state`, `country`, `dob`, `blood_group` FROM `tbl_patient` where id='{$id}'";
$stmt = $conn->prepare($query);
$resultSet = $stmt->executeQuery();

$data = array();

while($row =  $resultSet->fetchAssociative()){
    $row['dob'] = date("Y-m-d",strtotime($row['dob']));
    $date = new DateTime($row['dob']);
    $now = new DateTime();
    $interval = $now->diff($date);
    $row['age']= $interval->y;
    $data[] = $row;
}

// $query = $conn->query("SELECT * FROM `tbl_patient` where id = '{$id}'");
if($resultSet){
    $resp['status'] = 'success';
    $resp['data'] = $data;
}else{
    $resp['status'] = 'Fail';
    $resp['msg'] = 'Somthing went wrong ';
}
echo json_encode($resp);

    }elseif($_POST['reqtype'] == 'delete'){


      $query="DELETE FROM `tbl_patient` where id='{$id}'";
      $stmt = $conn->prepare($query);
      $result = $stmt->executeQuery();
      if($result){
         $resp['status'] = 'success';
         $resp['msg'] = 'Deleted successfully ';
      }else{
          $resp['status'] = 'Fail';
          $resp['msg'] = 'Somthing went wrong '; 
      }

       echo json_encode($resp);
    }

}else{

$msg='';
if(empty($name)){
$msg='Name is required';
}

if($msg == ''){

   $create_date=date('Y-m-d H:i:s');
   $dob=date('Y-m-d', strtotime($dob));
   $name=trim($name);


   if(isset($_POST['savepatientdata'])){
  
   //===inser query
   $queryBuilder = $conn->createQueryBuilder();
   $queryBuilder = $queryBuilder->insert('tbl_patient')
    ->values(['name' => '?', 'age' => '?','city' => '?','state' => '?', 'country' => '?','dob' => '?','blood_group' => '?', 'create_on' => '?'])
    ->setParameters([0 => $name, 1 => $age,2 => $city, 3 => $state,4 => $country, 5 => $dob,6 => $bloodgroup, 7 => $create_date]);
   $query=$queryBuilder->execute();
   }

   //===Update Query
   if(isset($_POST['editpatientdata'])){

     $queryBuilder = $conn->createQueryBuilder();
     $sql = $queryBuilder->update('tbl_patient')
        ->set('name', ':name')
        ->set('age', ':age')
        ->set('city', ':city')
        ->set('country', ':country')
        ->set('state', ':state')
        ->set('dob', ':dob')
        ->set('blood_group', ':bgroup')
        ->where('id = :editId')
        ->setParameter('name', $name)
        ->setParameter('age', $age)
        ->setParameter('city', $city)
         ->setParameter('country', $country)
        ->setParameter('state', $state)
        ->setParameter('dob', $dob)
         ->setParameter('bgroup', $bloodgroup)
       ->setParameter('editId', $id)
        ;
     $query = $sql->execute();
   
   }

   if($query){
     $resp['status'] = 'success';
   }else{
     $resp['status'] = 'Fail';
     $resp['msg'] = 'Somthing went wrong';
   }

}else{
     $resp['status'] = 'fail';
     $resp['msg'] = $msg;
}

echo json_encode($resp);

}


