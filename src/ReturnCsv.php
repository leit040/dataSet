<?php


class ReturnCsv implements ReturnInterface
{

    public function return(PDOStatement $stmt)
    {
        $file = fopen('../output/' . time() . '.csv', 'w');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($file, $row);
    }
        }
}