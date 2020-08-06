<?php
if($_POST)
{
    $returnArray = [];
    $returnArray['status'] = false;
    $id = mHelper::postIntegerVariable("id");
    $name= mHelper::postVariable("name");


    if($name=="" )
    {
        $returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
        return;
    }


    $w = $db->db->prepare("select * from lessons where id = ? ");
    $w->execute(array($id));
    $result = $w->fetch(PDO::FETCH_ASSOC);


    $update = $db->db->prepare("update lessons set name = ? where id = ?");
    $updateResult = $update->execute(array($name,$id));
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