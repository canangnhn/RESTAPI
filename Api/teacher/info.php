<?php
$teachers_id=mHelper::getIntegerVariable('teachers_id');

$c = $db->db->prepare('select * from teachers where id = ?');
$c->execute(array($teachers_id));
$count = $c->rowCount();
if($count == 0){
    $returnArray['message'] = "Böyle bir kullanıcı bulunamadı";
    return;
}

$score=$db->db->prepare("select score from comments where teachers_id= ?");
$score->execute(array($teachers_id));
$count = 0;
$sum = 0;
foreach($score as $key => $value){
    $count = $count + 1;
    $sum = $sum + $value['score'];
}
$score=floor($sum/$count);


$result= $db->db->prepare('select * from teachers where id = ?');
$result->execute(array($teachers_id));


/*Data Düzenleme*/
$returnDataArray=[];
foreach($result as $key => $value)
{


    $returnDataArray[$key]['id']=$value['id'];
    $returnDataArray[$key]['name_surname']=$value['name']." ".$value['surname'];
    $returnDataArray[$key]['school']=$value['school'];
    $returnDataArray[$key]['lessons_id']=$value['lessons_id'];
    $returnDataArray[$key]['birth_date']=$value['birth_date'];
    $returnDataArray[$key]['gender']=$value['gender'];
    $returnDataArray[$key]['address']=$value['address'];
    $returnDataArray[$key]['price']=$value['price'];
    $returnDataArray[$key]['email']=$value['email'];
    $returnDataArray[$key]['score']=$score;

}


$returnArray['data']=$returnDataArray;

