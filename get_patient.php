<?php 
require_once("./db.php");

extract($_POST);

//======get total count of row=========
$sql = "SELECT * FROM `tbl_patient`";
$stmt = $conn->prepare($sql);
$totalCount = $stmt->executeQuery()->rowCount();


$search_where = "";
if(!empty($search)){
    $search_where = " where ";
    $search_where .= " name LIKE '%{$search['value']}%' "; 
}

//======get all record query=========
$columns_arr = array("id", "name", "age", "city","state","country","dob","blood group","unix_timestamp(birthdate)");
$query="SELECT `id`,`name`, `age`, `city`, `state`, `country`, `dob`, `blood_group` FROM `tbl_patient` {$search_where} ORDER BY {$columns_arr[$order[0]['column']]} {$order[0]['dir']} limit {$length} offset {$start} ";
$stmt = $conn->prepare($query);
$resultSet = $stmt->executeQuery();

//======get count on condition base=========
$sql = "SELECT * FROM `tbl_patient` {$search_where} ";
$stmt = $conn->prepare($sql);
$recordsFilterCount = $stmt->executeQuery()->rowCount();



//==== prepare data for response=============
$recordsTotal= $totalCount;
$recordsFiltered= $recordsFilterCount;
$data = array();
$i= 1 + $start;
while($row =  $resultSet->fetchAssociative()){
    $row['no'] = $i++;
    $row['dob'] = date("F d, Y",strtotime($row['dob']));
    $date = new DateTime($row['dob']);
    $now = new DateTime();
    $interval = $now->diff($date);
    $row['age']= $interval->y;
    $data[] = $row;
}

//==== response in json format=============
echo json_encode(array('draw'=>$draw,'recordsTotal'=>$recordsTotal, 'recordsFiltered'=>$recordsFiltered,'data'=>$data));
