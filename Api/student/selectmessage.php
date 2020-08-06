<?php
$students_id=mHelper::getIntegerVariable('students_id');


$list=$db->db->prepare("select DISTINCT(teachers_id) from messages where students_id=?");
$list->execute(array($students_id));
$result=$list->fetchAll(PDO::FETCH_ASSOC);
$returnDataArray=[];
foreach($result as $key => $value){

    $teachers = $db->db->prepare("select * from teachers where id=?");
    $teachers->execute(array($value['teachers_id']));
    $teachersInfo= $teachers->fetch(PDO::FETCH_ASSOC);


    //$returnDataArray[$key]['id']=$value['id'];
    $returnDataArray[$key]['teachers_id']=$value['teachers_id'];
    $returnDataArray[$key]['teacher']=$teachersInfo['name']." ".$teachersInfo['surname'];

}

$returnArray['status']=true;
$returnArray['data']=$returnDataArray;
?>
<?php
