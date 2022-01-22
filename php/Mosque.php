<?php

namespace classes;

class Mosque
{
    public $err;
    public $succ;

    public $db;
    public $response;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveNew(array $data)
    {
        $mosque_name = $this->db->realString($data['mosque_name']);
        $address1 = $this->db->realString($data['address1']);
        $address2 = $this->db->realString($data['address2']);
        $areas = $data['area'];
        $city = $this->db->realString($data['city']);
        $postcode = $this->db->realString($data['postcode']);
        $state = $this->db->realString($data['state']);
        $country = $this->db->realString($data['country']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($mosque_name)) {
            $this->response['message'] = 'Please enter Mosque name';
        } elseif ($this->db->checkUniqe("mosques", 'mosque_name', $mosque_name)) {
            $this->response['message'] = "Mosque already exists!";
        } elseif (!isset($areas)) {
            $this->response['message'] = "Please select an Area!";
        } elseif (empty($city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($postcode)) {
            $this->response['message'] = "Post code is required!";
        } elseif (empty($state)) {
            $this->response['message'] = "State is required!";
        } elseif (empty($country)) {
            $this->response['message'] = "Please enter Country!";
        }

        if (!isset($this->response['message'])) {
            $sql = "INSERT INTO `mosques`(`mosque_name`, `address1`, `address2`, `city`, `postcode`, `state`, `country`) VALUES ('$mosque_name','$address1', '$address2', '$city','$postcode','$state','$country')";
            $query = $this->db->runquery($sql);
            
            $mosque_id = $this->db->lastid();

            foreach ($areas as $key => $area) {
                $this->db->runquery("INSERT INTO `mosque_area`(`mosque_id`, `area_id`) VALUES ('$mosque_id','$area')");
            }
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Mosque added successfully';
            } else {
                $this->response['message'] = 'Mosque could not be saved!';
                $this->response['message'] = $this->db->con->error;
            }
        }
        return $this->response;
    }

    public function updateOld(array $data)
    {
        $mosque_name = $this->db->realString($data['mosque_name']);
        $address1 = $this->db->realString($data['address1']);
        $address2 = $this->db->realString($data['address2']);
        // $area = $this->db->realString($data['area']);
        $city = $this->db->realString($data['city']);
        $postcode = $this->db->realString($data['postcode']);
        $state = $this->db->realString($data['state']);
        $country = $this->db->realString($data['country']);
        $mosque_id = $this->db->realString($data['mosque_id']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($mosque_name)) {
            $this->response['message'] = 'Please enter Mosque name';
        } elseif ($this->db->checkUniqe("mosques", 'mosque_name', $mosque_name, 'mosque_id', $mosque_id)) {
            $this->response['message'] = "Mosque already exists!";
        } elseif (!isset($area)) {
            $this->response['message'] = "Please select Area!";
        } elseif (empty($city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($postcode)) {
            $this->response['message'] = "Post code is required!";
        } elseif (empty($state)) {
            $this->response['message'] = "State is required!";
        } elseif (empty($country)) {
            $this->response['message'] = "Please enter Country!";
        }

        if (!isset($this->response['message'])) {
            $sql = "UPDATE `mosques` SET `mosque_name`='$mosque_name',`address1`='$address1',`address2`='$address2',`city`='$city',`postcode`='$postcode',`state`='$state',`country`='$country' WHERE `mosque_id`='$mosque_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Mosque Updated successfully';
            } else {
                $this->response['message'] = 'Mosque could not be updated!';
            }
        }
        return $this->response;
    }

    public function deleteData(array $data)
    {
        $mosque_id = $data['mosque_id'];
        $sql = "DELETE FROM `mosques` WHERE `mosque_id`='$mosque_id'";
        $query = $this->db->runquery($sql);
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($query) {
            $this->response['status'] = 1;
            $this->response['type'] = 'success';
            $this->response['message'] = 'Mosque Deleted successfully';
            $this->response['row'] = '#row' . $mosque_id;
            $this->response['url'] = 'mosques.php';
        } else {
            $this->response['message'] = 'Mosque could not be deleted!';
        }
        return $this->response;
    }
}