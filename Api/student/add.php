<?php

if($_POST)
{
    $returnArray = [];
    $returnArray['status'] = false;

    $name= mHelper::postVariable("name");
    $surname= mHelper::postVariable("surname");
    $birth_date= mHelper::postVariable("birth_date");
    $gender= mHelper::postVariable("gender");
    $image= mHelper::postVariable("image");
    $school= mHelper::postVariable("school");
    $email = mHelper::postVariable("email");
    $password = mHelper::postVariable("password");
    $address = mHelper::postVariable("address");
    if($email!="" and $password!="" and $name!="" and $surname!="" )
    {

        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $returnArray['message'] = "Email Formatı Hatalı";
            return;
        }

        $c = $db->db->prepare("select * from students where email = ?");
        $c->execute(array($email));
        $count = $c->rowCount();
        if($count!=0)
        {
            $returnArray['message'] = "Bu Email Kullanımda";
            return;
        }


        $date = date("Y-m-d");
        $eklemeSorgu = $db->db->prepare("insert into students (name,surname,birth_date,gender,image,school,email,password,address,date) values ('".$name."','".$surname."','".$birth_date."','".$gender."',
        '".$image."','".$school."','".$email."','".$password."','".$address."','".$date."')");
        $result = $eklemeSorgu->execute(array($name,$surname,$birth_date,$gender,$image,$school,$email,$password,$address,$date));
        if($result)
        {
            $returnArray['status'] = true;
            $returnArray['userId'] = $db->db->lastInsertId();
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