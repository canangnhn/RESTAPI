<?php

    $lessons_id=mHelper::getIntegerVariable('lessons_id');
    $address=mHelper::getVarcharVariable('address');



    $list=$db->db->prepare("select * from teachers where lessons_id= ? and address=?");
    $list->execute(array($lessons_id,$address));
    $result=$list->fetchAll(PDO::FETCH_ASSOC);


/*Data Düzenleme*/

$returnDataArray=[];
foreach($result as $key => $value){

    $teachers_id=$value['id'];


    $dates =$db->db->prepare("select date,hour,time from calenders where teachers_id=?");
    $dates->execute(array($teachers_id));
    $dateInfo=$dates->fetch(PDO::FETCH_ASSOC);
    $count = $dates->rowCount();
    if($count==0){
        $returnDataArray['message']="Aradığınız kriterlerde sonuç bulunamamıştır.";
    }
    else{


        $returnDataArray[$key]['id']=$value['id'];
        $returnDataArray[$key]['teacher']=$value['name']." ".$value['surname'];
        $returnDataArray[$key]['teacher_id']=$value['id'];
        $returnDataArray[$key]['address']=$value['address'];
        $returnDataArray[$key]['price']=$value['price'];
        $returnDataArray[$key]['date']=$dateInfo['date'];
        $returnDataArray[$key]['time']=$dateInfo['time'];
        $returnDataArray[$key]['hour']=$dateInfo['hour'];


    }


}


$returnArray['data']=$returnDataArray;

?>
