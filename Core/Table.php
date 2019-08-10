<?php

class Table
{
    protected $db = null;
    protected $table = "";

    public function __construct($table)
    {
        require_once "Core/Database.php";

        $db = new Database();

        $this->db = $db->startConnection();

        if (!$db->isView($table)) {
            $this->table = $table . "s";
        } else {
            $this->table = "vw_" . $table;
        }
    }

    // 將資料行轉換成為關聯式陣列
    protected function rowToArray($row, $noUseData = [])
    {
        $arr = [];

        foreach ($row as $field => $value) {
            if (isset($noUseData)) {
                if (in_array($field, $noUseData)) {
                    continue;
                }
            }
            $arr[$field] = $value;
        }

        return $arr;
    }
}
