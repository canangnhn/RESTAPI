<?php
if($_POST)
{
    $returnArray = [];
    $returnArray['status'] = false;

    $name= mHelper::postVariable("name");
    //$parent_id=mHelper::postVariable("parent_id");

    if($name!="" )
    {

        $c = $db->db->prepare("select * from lessons where name = ?");
        $c->execute(array($name));
        $count = $c->rowCount();
        if($count!=0)
        {
            $returnArray['message'] = "Bu ders adı kullanımda";
            return;
        }


        $date = date("Y-m-d");
        $eklemeSorgu = $db->db->prepare("insert into lessons (name,date) values ('".$name."','".$date."')");
        $result = $eklemeSorgu->execute(array($name,$date));
        if($result)
        {
            $returnArray['status'] = true;
            $returnArray['message'] = "Ders Başarı ile Eklendi";
        }
        else
        {
            $returnArray['message'] = "Ders Eklenemedi";
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