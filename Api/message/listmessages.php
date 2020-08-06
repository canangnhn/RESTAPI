<?php
$teachers_id=mHelper::getIntegerVariable('teachers_id');
$students_id=mHelper::getIntegerVariable('students_id');


$list=$db->db->prepare("select * from messages where teachers_id=? and students_id=? ");
$list->execute(array($teachers_id,$students_id));
$result=$list->fetchAll(PDO::FETCH_ASSOC);
$returnDataArray=[];
foreach($result as $key => $value){



        $returnDataArray[$key]['from']=$value['fromm'];
        $returnDataArray[$key]['message']=$value['text'];
        $returnDataArray[$key]['date']=$value['date'];
        $returnDataArray[$key]['time']=$value['time'];


}

$returnArray['status']=true;
$returnArray['data']=$returnDataArray;
?>
