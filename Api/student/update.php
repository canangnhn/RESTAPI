<?php
if($_POST)
{
    $returnArray = [];
    $returnArray['status'] = false;
    $id = mHelper::postIntegerVariable("id");
    $name= mHelper::postVariable("name");
    $surname= mHelper::postVariable("surname");
    $birth_date= mHelper::postVariable("birth_date");
    $gender= mHelper::postVariable("gender");
    $school= mHelper::postVariable("school");
   //$phone_number= mHelper::postVariable("phone_number");
    $address= mHelper::postVariable("address");
    $email = mHelper::postVariable("email");
    $password = mHelper::postVariable("password");


    if($name=="" and $surname=="" and $email=="")
    {
        $returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
        return;
    }


    // 2. Kullanıcı varmı kontrol et
    $c = $db->db->prepare("select * from students where id = ?");
    $c->execute(array($id));
    $count = $c->rowCount();
    if($count == 0){
        $returnArray['message'] = "Böyle bir kullanıcı yok";
        return;
    }

    // 3. email varmı kontrol et
    $cEmail = $db->db->prepare("select * from students where id != ? and email = ?");
    $cEmail->execute(array($id,$email));
    $countEmail = $cEmail->rowCount();
    if($countEmail !=0){
        $returnArray['message'] = "Bu Email Kullanımda";
    }


    $w = $db->db->prepare("select * from students where id = ? ");
    $w->execute(array($id));
    $result = $w->fetch(PDO::FETCH_ASSOC);


    //  Update et

    $update = $db->db->prepare("update students set name = ?, surname = ? , email = ? ,password = ? , gender = ?, school = ?, address= ?, birth_date=? where id = ?");
    $updateResult = $update->execute(array($name,$surname,$email,$password,$gender,$school,$address,$birth_date,$id));
    if($updateResult)
    {
        $returnArray['status'] = true;
        $returnArray['message'] = "Bilgiler başarı ile değiştirildi";
    }
    else
    {
        $returnArray['message'] = "Bilgiler Düzenlenemedi";
    }

   // echo json_encode($returnArray);

}