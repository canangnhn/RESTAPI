<?php
$id = mHelper::postIntegerVariable("id");
$status=mHelper::postVariable("status");

$update = $db->db->prepare("update comments set status=? where id = ?");
$updateResult = $update->execute(array($status,$id));
if($updateResult)
{
    $returnArray['status'] = true;
    $returnArray['message'] = "Bilgiler başarı ile değiştirildi";
}
else
{
    $returnArray['message'] = "Bilgiler Düzenlenemedi";
}
?>