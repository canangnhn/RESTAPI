<?php

if($_POST) {
    $returnArray = [];
    $returnArray['status'] = false;
    $id = mHelper::postIntegerVariable("id");
    $title = mHelper::postVariable("title");
    $keyword = mHelper::postVariable("keyword");
    $desciption = mHelper::postVariable("description");
    $aboutus = mHelper::postVariable("aboutus");
    $contact = mHelper::postVariable("contact");
    $status = mHelper::postVariable("status");


    $update = $db->db->prepare("update settings set title = ?, keyword = ? , description = ? , contact = ? , aboutus = ?, status = ? where id = ?");
    $updateResult = $update->execute(array($title, $keyword, $desciption, $aboutus, $aboutus, $status, $id));
    if ($updateResult) {
        $returnArray['status'] = true;
        $returnArray['message'] = "Bilgiler başarı ile değiştirildi";
    } else {
        $returnArray['message'] = "Bilgiler Düzenlenemedi";
    }
}