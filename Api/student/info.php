<?php
$id=intval($_GET['id']);
// 1. veritabanında böyle bir kullanıcı varmı
$c = $db->db->prepare('select * from students where id = ?');
$c->execute(array($id));
$count = $c->rowCount();
if($count == 0){
$returnArray['message'] = "Böyle bir kullanıcı bulunamadı";
return;
}

$w = $db->db->prepare('select * from students where id = ?');
$w->execute(array($id));
$result = $w->fetch(PDO::FETCH_ASSOC);
$returnArray['status'] = true;
$returnArray['data'] = $result;
//echo json_encode($returnArray);
