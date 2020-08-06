<?php
if($_POST) {
    $students_id = mHelper::postIntegerVariable('students_id');
    $teachers_id = mHelper::postIntegerVariable('teachers_id');
    $place=mHelper::postVariable('place');
    $status="Beklemede";

    if ($students_id != "" and $teachers_id != "") {



        $created_at = date("Y-m-d");

        $eklemeSorgu = $db->db->prepare("insert into appointments (created_at,students_id,teachers_id,place,status) values ('".$created_at."','".$students_id."','".$teachers_id."','".$place."','".$status."')");
        $result = $eklemeSorgu->execute(array($created_at,$students_id,$teachers_id,$place,$status));

        $appointments_id = $db->db->lastInsertId();


        $appointments = $db->db->prepare("select * from appointments where id=LAST_INSERT_ID()");
        $appointments->execute();
        $appointmentsInfo = $appointments->fetchAll(PDO::FETCH_ASSOC);
        $returnDataArray = [];
        foreach ($appointmentsInfo as $key => $value) {
            $teachers_id = $value['teachers_id'];
            $students_id = $value['students_id'];
            $place=$value['place'];
        }

        $calenders = $db->db->prepare("select * from calenders where teachers_id=?");
        $calenders->execute(array($teachers_id));
        $calendersInfo = $calenders->fetchAll(PDO::FETCH_ASSOC);
        foreach ($calendersInfo as $key => $value) {
            $date = $value['date'];
            $time = $value['time'];
            $hour=$value['hour'];
        }


        $teachers = $db->db->prepare("select * from teachers where id=?");
        $teachers->execute(array($teachers_id));
        $teachersInfo = $teachers->fetchAll(PDO::FETCH_ASSOC);
        foreach ($teachersInfo as $key => $value) {
            $teachersnamesurname=$value['name']." ".$value['surname'];
            $lessons_id=$value['lessons_id'];
            $price=$value['price'];
        }
        $lessons = $db->db->prepare("select * from lessons where id=?");
        $lessons->execute(array($lessons_id));
        $lessonsInfo = $lessons->fetchAll(PDO::FETCH_ASSOC);
        foreach ($lessonsInfo as $key => $value) {
            $lessonname=$value['name'];
        }


        $eklemeLesson = $db->db->prepare("insert into mylessons(lessonname,teachers,hour,price,place,date,time,lessons_id,teachers_id,students_id,status,appointments_id) values(?,?,?,?,?,?,?,?,?,?,?,?)");
        $sonuc = $eklemeLesson->execute(array($lessonname,$teachersnamesurname,$hour,$price,$place,$date,$time,$lessons_id,$teachers_id,$students_id,$status,$appointments_id));






    if($result)
        {
            $returnArray['status'] = true;
            $returnArray['message'] = "Randevu Başarıyla Oluşturuldu.";
        }
        else
        {
            $returnArray['status'] = false;
            $returnArray['message'] = "Randevu Oluşturulamadı.";
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