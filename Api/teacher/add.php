<?php

if($_POST)
{
    $returnArray = [];
    $returnArray['status'] = false;

    $name= mHelper::postVariable("name");
    $surname= mHelper::postVariable("surname");
    $birth_date= mHelper::postVariable("birth_date");
    $gender= mHelper::postVariable("gender");
    $school= mHelper::postVariable("school");
    $email = mHelper::postVariable("email");
    $password = mHelper::postVariable("password");
    $address = mHelper::postVariable("address");
    $price=mHelper::postVariable("price");
    $lessons_id=mHelper::postIntegerVariable("lessons_id");

    if($email!="" and $password!="" and $name!="" and $surname!="" )
    {

        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $returnArray['message'] = "Email Formatı Hatalı";
            return;
        }

        $c = $db->db->prepare("select * from teachers where email = ?");
        $c->execute(array($email));
        $count = $c->rowCount();
        if($count!=0)
        {
            $returnArray['message'] = "Bu Email Kullanımda";
            return;
        }




        $created_at = date("Y-m-d");
        $eklemeSorgu = $db->db->prepare("insert into teachers(name,surname,email,password,gender,birth_date,created_at,school,address,lessons_id,price) values(?,?,?,?,?,?,?,?,?,?,?)");
        $result = $eklemeSorgu->execute(array($name,$surname,$email,$password,$gender,$birth_date,$created_at,$school,$address,$lessons_id,$price));
        $eklemetakvim = $db->db->prepare("insert into calenders (teachers_id) VALUES (LAST_INSERT_ID())");
        $eklemetakvim->execute();

        if($result)
        {
            $returnArray['status'] = true;
            $returnArray['message'] = "Kullanıcı Başarı ile Eklendi";
        }
        else
        {

            $returnArray['message'] = "Kullanıcı Eklenemedi";
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