<?php 
require_once("./db.php");

extract($_POST);


if($searchtype == 'country'){

$query="SELECT * FROM `countries` order by name asc";
$stmt = $conn->prepare($query);
$resultSet = $stmt->executeQuery();
$row = $resultSet->fetchAllAssociative();
echo json_encode(array('data'=>$row));
}


if($searchtype == 'state'){
$query="SELECT s.* FROM `countries` as c 
 join `states` as s on s.country_id=c.id where c.name ='{$countryname}' order by s.name asc";
$stmt = $conn->prepare($query);
$resultSet = $stmt->executeQuery();
$row = $resultSet->fetchAllAssociative();
echo json_encode(array('data'=>$row));
}


if($searchtype == 'city'){
$query="SELECT s.* FROM `states` as c 
 join `cities` as s on s.state_id=c.id where c.name ='{$statename}' order by s.name asc";
$stmt = $conn->prepare($query);
$resultSet = $stmt->executeQuery();
$row = $resultSet->fetchAllAssociative();
echo json_encode(array('data'=>$row));
}
