<?php
$id=intval($_GET['id']);
$c = $db->db->prepare('select * from lessons where id = ?');
$c->execute(array($id));
$count = $c->rowCount();
if($count == 0){
    $returnArray['message'] = "Böyle bir ders bulunamadı";
    return;
}

$w = $db->db->prepare('select * from lessons where id = ?');
$w->execute(array($id));
$result = $w->fetch(PDO::FETCH_ASSOC);
$returnArray['status'] = true;
$returnArray['data'] = $result;

