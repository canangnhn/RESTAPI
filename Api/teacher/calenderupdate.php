<?php
if($_POST)
{
    $returnArray = [];
    $returnArray['status'] = false;
    $id = mHelper::postIntegerVariable("id");
    $hour= mHelper::postVariable("hour");
    $time= mHelper::postVariable("time");
    $date= mHelper::postVariable("date");
    $teachers_id=mHelper::postVariable("teachers_id");




    $w = $db->db->prepare("select * from calenders where id = ? ");
    $w->execute(array($id));
    $result = $w->fetch(PDO::FETCH_ASSOC);


    $update = $db->db->prepare("update calenders set hour = ?, time = ?, date = ?, teachers_id = ? where id = ?");
    $updateResult = $update->execute(array($hour,$time,$date,$teachers_id,$id));
    if($updateResult)
    {
        $returnArray['status'] = true;
        $returnArray['message'] = "Bilgiler başarı ile değiştirildi";
    }
    else
    {
        $returnArray['message'] = "Bilgiler Düzenlenemedi";
    }



}