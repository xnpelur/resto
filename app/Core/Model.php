<?php

namespace App\Core;

class Model
{
    protected Database $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    public function getFieldsFrom($tableName, $where = '')
    {
        $sql = "SELECT * FROM $tableName";
        if ($where !== '') {
            $sql .= " WHERE " . $where;
        }

        return $this->db->query($sql);
    }
}