<?php
require_once '../vendor/autoload.php';
require_once '../config/dotenv.php';

class DataController

{
public ReturnInterface $returnMethod;

    public function __construct($format)
    {
        if($format==="json"){
            $this->returnMethod= new ReturnJson();
        }
        if($format==="csv"){
            $this->returnMethod = new ReturnCsv();
        }


    }



    public function index($filter = null)
    {

        $db = new Db();
        $sql = "select * from dataset";

        if (isset($filter['age'])) {
            $sql = "SELECT *, ((YEAR(CURRENT_DATE) - YEAR(birthDate)) - (DATE_FORMAT(CURRENT_DATE, '%m%d') 
                    < DATE_FORMAT(birthDate, '%m%d'))) AS age FROM dataset";
            if (isset($filter['age_end'])) {
                $sql_end = "  HAVING age BETWEEN " . $filter['age'] . " AND " . $filter['age_end'];
                unset($filter['age_end']);
            } else {
                $sql_end = "  HAVING age = " . $filter['age'];
            }
            unset($filter['age']);
        } else $sql = "SELECT * FROM dataset";
        $count = count($filter);

        if ($count > 0) {
            $sql .= " where ";
            $i = 0;
            foreach ($filter as $key => $option) {
                $sql .= $key . "=" . "'" . $option . "'";
                $i++;
                if ($i != $count) {
                    $sql .= " and ";
                }
            }
            if (isset($sql_end)) {
                $sql .= $sql_end;
            }


        }
        $stmt = $db->dbh->prepare($sql);
        $stmt->execute();

        return $this->returnMethod->return($stmt);


    }



}


