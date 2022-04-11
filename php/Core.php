<?php

namespace classes;

class Core
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function valuepost($attrname)
    {
        if (isset($_POST[$attrname])) {
            return $_POST[$attrname];
        } else {
            return false;
        }
    }

    public function postSelected($attrname, $value = null)
    {
        if (isset($_POST[$attrname])) {
            if ($_POST[$attrname] == $value) {
                return "selected";
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function itemSelected($item, $value = null)
    {
        if ($item == $value) {
            return "selected";
        } else {
            return false;
        }
    }

    public function itemChecked($database_items, $itemarry, $value = null)
    {
        foreach ($database_items as $key => $item) {
            if ($value == null) {
                if (!in_array($item, $itemarry)) {
                    return $item;
                }
            } else {
                if ($item == $value) {
                    return 'checked';
                }
            }
        }
        return false;
    }

    public function postChecked($attr, $value = null)
    {
        if ($value != null) {
            $array = [];
            foreach ($_POST[$attr] as $item){
                $array[] = $item;
            }
            if (in_array($value, $array)) {
                return 'checked';
            }
        }
        return false;
    }
}