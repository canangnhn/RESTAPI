<?php
$teachers_id=mHelper::getIntegerVariable('teachers_id');

$result=$db->db->prepare("select * from comments where teachers_id= ?");
$result->execute(array($teachers_id));
$count=$result->rowCount();
if($count == 0){
    $returnArray['message']="Yorum bulunmamaktadir.";
    return;
}




/*Data Düzenleme*/
$returnDataArray=[];
foreach($result as $key => $value)
{
    $user =$db->db->prepare("select * from students where id=?");
    $user->execute(array($value['students_id']));
    $userInfo=$user->fetch(PDO::FETCH_ASSOC);

    $returnDataArray[$key]['id']=$value['id'];
    $returnDataArray[$key]['students']=$userInfo['name']." ".$userInfo['surname'];
    $returnDataArray[$key]['text']=$value['text'];
    $returnDataArray[$key]['score']=$value['score'];
    $returnDataArray[$key]['date']=$value['date'];

}


$returnArray['data']=$returnDataArray;

?>