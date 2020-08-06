<?php
if($_POST){
    $students_id=mHelper::postIntegerVariable('students_id');
    $mylessons_id=mHelper::postIntegerVariable('mylessons_id');
    $teachers_id=mHelper::postVariable('teachers_id');
    $text=mHelper::postVariable('text');
    $score=mHelper::postIntegerVariable('score');

    if($text==""){
        $returnArray['message']="Text Alanını Boş Bırakılamaz";
        return;
    }

     $c =$db->db->prepare("select * from mylessons where id=?");
     $c->execute(array($mylessons_id));
     $count=$c->rowCount();
     if($count==0){
         $returnArray['message']="Böyle bir aldığım ders  yok";
     }

     $date= date("Y-m-d");
     $insert = $db->db->prepare("insert into comments(students_id,mylessons_id,teachers_id,text,score,date) value (?, ?, ?,?,?,? )");
     $insertResult=$insert->execute(array($students_id,$mylessons_id,$teachers_id,$text,$score,$date));
     if($insertResult){
         $returnArray['message']="Yorum başarı ile eklendi";
         $returnArray['status']=true;
     }
}
?>