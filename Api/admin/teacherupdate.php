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
    $cv= mHelper::postVariable("cv");
    $school= mHelper::postVariable("school");
    $email = mHelper::postVariable("email");
    $password = mHelper::postVariable("password");
    $address = mHelper::postVariable("address");
    $price=mHelper::postVariable("price");
    $lessons_id=mHelper::postVariable("lessons_id");
    $status=mHelper::postVariable("status");

    if($name=="" and $surname=="" and $email=="")
    {
        $returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
        return;
    }


    // 2. Kullanıcı varmı kontrol et
    $c = $db->db->prepare("select * from teachers where id = ?");
    $c->execute(array($id));
    $count = $c->rowCount();
    if($count == 0){
        $returnArray['message'] = "Böyle bir kullanıcı yok";
        return;
    }

    // 3. email varmı kontrol et
    $cEmail = $db->db->prepare("select * from teachers where id != ? and email = ?");
    $cEmail->execute(array($id,$email));
    $countEmail = $cEmail->rowCount();
    if($countEmail !=0){
        $returnArray['message'] = "Bu Email Kullanımda";
    }


    $w = $db->db->prepare("select * from teachers where id = ? ");
    $w->execute(array($id));
    $result = $w->fetch(PDO::FETCH_ASSOC);



    //  Update et

    $update = $db->db->prepare("update teachers set name = ?, surname = ? , email = ? , password = ? , gender = ? , birth_date= ? , school = ? , address= ? , cv= ? , lessons_id= ?, price=?, status=? where id = ?");
    $updateResult = $update->execute(array($name,$surname,$email,$password,$gender,$birth_date,$school,$address,$cv,$lessons_id,$price,$status,$id));
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