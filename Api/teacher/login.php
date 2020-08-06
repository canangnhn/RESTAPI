
<?php

if($_POST) {


$email = mHelper::postVariable("email");
$password= mHelper::postVariable("password");

if ($email == "" and $password == "") {
$returnArray['message'] = "Lütfen Tüm Alanları Doldurunuz";
return;
}

$c = $db->db->prepare("select * from teachers where email = ?");
$c->execute(array($email));
$count = $c->rowCount();
if ($count == 0) {
$returnArray['message'] = "Bu Email Sistemde kayıtlı Değil";
return;
}

$w = $db->db->prepare("select * from teachers where email = ?");
$w->execute(array($email));
$result = $w->fetch(PDO::FETCH_ASSOC);
if ($result['password'] != ($password)) {
$returnArray['message'] = "Şifreniz hatalı";
return;
}
$returnArray['status'] = true;
$returnArray['userId'] = $result['id'];
$returnArray['message'] = "Başarılı";

}


