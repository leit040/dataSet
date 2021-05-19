<?php
require_once '../vendor/autoload.php';
require_once '../config/dotenv.php';
//Please add your Db configuration to .env file (.env_example )


/*//Create DB table;
$dd = new Db();
$dd->createTable();

//Parsing dataset.txt
$parcer = new Parser();*/

//You need call index method from DataController.php with 2 parameters : array $filter, like as
// this example: $filter = ['category' => 'handmade', 'gender' => 'male', 'age' => 25, 'age_end' => 26]
// and string $format (it can be 'json' or 'csv'). If you choose 'csv' - you can get your cvs file on 'output' directory,
//and  in 'json' format  - json will be returned from method;


$filter = ['category' => 'handmade', 'gender' => 'male', 'age' => 25, 'age_end' => 26];
$test = new DataController('csv');
var_dump($test->index($filter));
//$test->index($filter);