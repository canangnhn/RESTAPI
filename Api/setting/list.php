<?php

$sorgu=$db->db->prepare("select * from settings ");
$sorgu->execute();
$result=$sorgu->fetchAll(PDO::FETCH_ASSOC);

$returnArray['status']=true;
$returnArray['data']=$result;

?>