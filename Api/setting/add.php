<?php

if($_POST) {
    $returnArray = [];
    $returnArray['status'] = false;

    $title = mHelper::postVariable("title");
    $keyword = mHelper::postVariable("keyword");
    $desciption = mHelper::postVariable("description");
    $aboutus = mHelper::postVariable("aboutus");
    $contact = mHelper::postVariable("contact");
    $status = mHelper::postVariable("status");


if($title!="" )
{

    $c = $db->db->prepare("select * from settings where title = ?");
    $c->execute(array($title));
    $count = $c->rowCount();
    if($count!=0)
    {
        $returnArray['message'] = "Bu title kullanımda";
        return;
    }


    $date = date("Y-m-d");
    $eklemeSorgu = $db->db->prepare("insert into settings (title,keyword,description,aboutus,contact,status,date) values ('".$title."','".$keyword."','".$desciption."','".$aboutus."','".$contact."','".$status."'
    ,'".$date."')");
    $result = $eklemeSorgu->execute(array($title,$keyword,$desciption,$aboutus,$contact,$status,$date));
    if($result)
    {
        $returnArray['status'] = true;
        $returnArray['message'] = "Başarı ile Eklendi";
    }
    else
    {
        $returnArray['message'] = "Eklenemedi";
    }

}
else
{
    $returnArray['status'] = false;
    $returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
}



}
else
{
    die("Post İşlemi Yapılmamış");
}