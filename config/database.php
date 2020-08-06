<?php
class Database
{
   public $db;

    function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=her_yerde_egitim;charset=utf8', "root", "");
          /* foreach($this->db->query('SELECT * from teachers') as $row) {
               print_r($row);
           }*/
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

}