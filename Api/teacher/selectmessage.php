<?php
$teachers_id=mHelper::getIntegerVariable('teachers_id');


$list=$db->db->prepare("select DISTINCT(students_id) from messages where teachers_id=?");
$list->execute(array($teachers_id));
$result=$list->fetchAll(PDO::FETCH_ASSOC);
$returnDataArray=[];
foreach($result as $key => $value){

    $students = $db->db->prepare("select * from students where id=?");
    $students->execute(array($value['students_id']));
    $studentsInfo = $students->fetch(PDO::FETCH_ASSOC);


    //$returnDataArray[$key]['id']=$value['id'];
    $returnDataArray[$key]['students_id']=$value['students_id'];
    $returnDataArray[$key]['student']=$studentsInfo['name']." ".$studentsInfo['surname'];

}

$returnArray['status']=true;
$returnArray['data']=$returnDataArray;
?>
<?php
