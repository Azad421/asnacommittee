<?php

namespace classes;

use mysqli;

class Database
{
    public $con;
    public $res;
    public $err;
    public $suc;

    function __construct()
    {
        $this->conn();
    }
    public function conn()
    {
        $this->con = new mysqli(HOST, DBU, PASS, DBN);
        if ($this->con->connect_errno) {
            return $this->err = "Database could not be connected";
        } else {
            return $this->suc = "successs";
        }
    }

    public function runquery($query)
    {
        $run = $this->con->query($query);
        if ($run) {
            $this->err = $this->con->connect_error;
            return $run;
        } else {
            return false;
            $this->con->error;
        }
    }
    public function realString($data)
    {
        return mysqli_real_escape_string($this->con, $data);
    }
    public function lastid()
    {
        return $this->con->insert_id;
    }

    public function itemId($table, $column, $prefix, $zLenth = null)
    {
        $query = $this->con->query('Select Max(' . $column . ') as user_id from ' . $table);
        $m = $query->fetch_assoc()['user_id'];
        if (!empty($m)) {
            $mlen = strlen($m);
            $len = strlen($prefix);
            $zLenth = $mlen - $len;
            $n = substr($m, $len) + 1;
            $id = sprintf($prefix . '%0' . $zLenth . 'd', $n);
            return $id;
        } else {
            return false;
        }
    }

    public function checkUniqe($table, $column, $string, $column2 = null, $id = null)
    {
        $sql = "SELECT * FROM `{$table}` WHERE `{$column}`='{$string}' ";
        if ($id != null && $column2 != null) {
            $sql .= "AND NOT `{$column2}`='{$id}'";
        }
        $query = $this->runquery($sql);
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
