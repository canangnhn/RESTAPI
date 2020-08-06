<?php
    $teachers_id = mHelper::getIntegerVariable('teachers_id');

    $list = $db->db->prepare('select * from appointments where teachers_id = ?');
    $list->execute(array($teachers_id));
    $result=$list->fetchAll(PDO::FETCH_ASSOC);
    $count=$list->rowCount();


    if ($count==0){
        $returnArray["message"]="Randevu listesi boş";
    }

else {
    /*Data Düzenleme*/
    $returnDataArray = [];
    foreach ($result as $key => $value) {

        $calenders = $db->db->prepare("select * from calenders where teachers_id=?");
        $calenders->execute(array($value['teachers_id']));
        $calendersInfo = $calenders->fetch(PDO::FETCH_ASSOC);

        $students_id= $value['students_id'];
        $students = $db->db->prepare("select * from students where id=?");
        $students->execute(array($value['students_id']));
        $studentsInfo = $students->fetch(PDO::FETCH_ASSOC);


        $returnDataArray[$key]['id'] = $value['id'];
        $returnDataArray[$key]['student info']=$studentsInfo['name']." ".$studentsInfo['surname'];
        $returnDataArray[$key]['date'] = $calendersInfo['date'];
        $returnDataArray[$key]['time'] = $calendersInfo['time'];
        $returnDataArray[$key]['place'] = $value['place'];
        $returnDataArray[$key]['status'] = $value['status'];

    }

    $returnArray['data'] = $returnDataArray;
}
?>