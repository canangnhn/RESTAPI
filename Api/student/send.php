<?php
$students_id=mHelper::postVariable('students_id');
$teachers_id=mHelper::postVariable('teachers_id');
$text=mHelper::postVariable('text');




$result=$db->db->prepare("select * from mylessons where teachers_id=? and students_id=? and status='True'");
$result->execute(array($teachers_id,$students_id));
$count=$result->rowCount();
if($count==0){
    $returnArray['message']="Bu egitmene mesaj gonderemezsiniz.";
}
else{
    if($text==""){
        $returnArray['message']="Text Alanını Boş Bırakılamaz";
        return;
    }
    $time=date("h:i:sa");
    $date= date("Y-m-d");
    $from="Student";

    $insert = $db->db->prepare("insert into messages(students_id,teachers_id,text,date,time,fromm) value (?,?,?,?,?,?)");
    $insertResult=$insert->execute(array($students_id,$teachers_id,$text,$date,$time,$from));
    if($insertResult){
        $returnArray['message']="Mesaj basari ile gonderildi";
        $returnArray['status']=true;
    }
}
?>