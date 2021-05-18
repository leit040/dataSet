<?php
require_once '../vendor/autoload.php';
require_once '../config/dotenv.php';


class Parser
{
    private array $key_array = array('category', 'firstname', 'lastname', 'email', 'gender', 'birthDate');
    private Db $db;

    public function __construct()
    {
        $this->db = new \Db();
        $handle = fopen('../source/dataset.txt', 'r');
        while ($dataset = fgetcsv($handle, 0, ",")) {
            $this->save(array_combine($this->key_array, $dataset));
        }


    }

    public function save($data)
    {

        $query = "INSERT INTO dataset (`category`,`firstname`,`lastname`,`email`,`gender`,`birthDate`) values (:category,:firstname,:lastname,:email,:gender,:birthDate)";
        $stmt = $this->db->dbh->prepare($query);
        $stmt->execute($data);
    }
}




