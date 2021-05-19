<?php


class ReturnJson implements ReturnInterface
{

    public function return(PDOStatement $stmt)
    {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($data);
    }
}