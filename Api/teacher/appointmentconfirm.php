<?php

if($_POST) {
    $returnArray = [];
    $returnArray['status'] = false;

    $status = mHelper::postVariable("status");
    $id = mHelper::postIntegerVariable('id');


    $update = $db->db->prepare("update appointments set status = ? where id = ? ");
    $updateResult = $update->execute(array($status,$id));



    $updateMylesson=$db->db->prepare("update mylessons set status = ? where appointments_id = ? ");
    $result =$updateMylesson->execute(array($status,$id));


    if($result)
    {
        $returnArray['status'] = true;
        $returnArray['message'] = "Randevu durumu guncellendi.";
    }
    else
    {
        $returnArray['message'] = "Guncellenemedi.";
    }



}
