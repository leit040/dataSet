<?php

require_once '../vendor/autoload.php';
require_once '../config/dotenv.php';


class Db
{

    public PDO $dbh;

    public function __construct()
    {
        $this->dbh = new PDO("mysql:host=" . getenv("DB_HOST") . "; dbname=" . getenv("DB_NAME"), getenv("DB_USER"), getenv("DB_PASSWORD"));
    }

    public function createTable()
    {

        $query_create_table = "DROP TABLE IF EXISTS dataset; CREATE TABLE `dataset` (
`id` bigint NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL, 
  `gender` varchar(30) NOT NULL,
  `birthDate` date NOT NULL, 
  PRIMARY KEY (`id`)
  
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

        $stmt = $this->dbh->prepare($query_create_table);
        $stmt->execute();
    }


}

