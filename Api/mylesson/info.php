<?php
$students_id=mHelper::getIntegerVariable('students_id');
$id=mHelper::getIntegerVariable('id');


$list=$db->db->prepare("select * from mylessons where id= ?");
$list->execute(array($id));
$result=$list->fetchAll(PDO::FETCH_ASSOC);

$c=$db->db->prepare("select * from mylessons where id= ?");
$c->execute(array($id));

$count=$c->rowCount();
if($count == 0){
    $returnArray['message']="Böyle bir aldıgım ders bulunamadi";
    return;
}


$returnDataArray=[];
foreach($result as $key => $value)
{



    $returnDataArray[$key]['id']=$value['id'];//mylessonid
    $returnDataArray[$key]['teacher']=$value['teachers'];
    $returnDataArray[$key]['lesson name']=$value['lessonname'];
    $returnDataArray[$key]['date']=$value['date'];
    $returnDataArray[$key]['time']=$value['time'];
    $returnDataArray[$key]['hour']=$value['hour'];
    $returnDataArray[$key]['place']=$value['place'];
    $returnDataArray[$key]['price']=$value['price'];
    $returnDataArray[$key]['status']=$value['status'];



}

$returnArray['status'] = true;
$returnArray['data']=$returnDataArray;

?>