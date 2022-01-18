<?php

namespace classes;

class Donor
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
        $donor_name = $this->db->realString($data['donor_name']);
        $telephone = $this->db->realString($data['telephone']);
        $area = $this->db->realString($data['area']);
        $area_city = $this->db->realString($data['area_city']);
        $area_state = $this->db->realString($data['area_state']);
        $donate_asnaf = $data['donate_asnaf'];
        $donate_to_jalaria = $data['donate_to_jalaria'];

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($donor_name)) {
            $this->response['message'] = 'Please enter Donor name';
        } elseif ($this->db->checkUniqe("donors", 'donor_name', $donor_name)) {
            $this->response['message'] = "Donor already exists!";
        } elseif (empty($telephone)) {
            $this->response['message'] = "Please enter Telephone!";
        } elseif (empty($area)) {
            $this->response['message'] = "Please enter Area!";
        } elseif (empty($area_city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($area_state)) {
            $this->response['message'] = "Area State is required!";
        }else if (!empty($donate_to_jalaria)) {
            if(!is_numeric($donate_to_jalaria)){
                $this->response['message'] = "Donate to Jalaria must be a decimal number!";
            }
        } else  if (empty($donate_asnaf)) {
            $this->response['message'] = "Donate to Asnaf is required!";
        } else if(!empty($donate_asnaf)){
            if(!is_numeric($donate_asnaf)){
                $this->response['message'] = "Donate to Asnaf must be a decimal number!";
            }
        }

        if(isset($data['items_to_donate'])){
            $items_to_donate = implode(',', $data['items_to_donate']) ;
        }else{
            $items_to_donate = '' ;
        }

        if (!isset($this->response['message'])) {
            $sql = "INSERT INTO `donors`(`donor_name`, `telephone`, `area`, `area_city`, `area_state`, `donate_asnaf`, `items_to_donate`, `donate_to_jalaria`) VALUES ('$donor_name','$telephone','$area','$area_city','$area_state','$donate_asnaf','$items_to_donate','$donate_to_jalaria')";
            $query = $this->db->runquery($sql);

            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Registered successfully';
            } else {
                $this->response['message'] = 'Something is wrong!';
                $this->response['message'] = $this->db->con->error;
            }
        }
        return $this->response;
    }

    public function updateOld(array $data)
    {
        $donor_name = $this->db->realString($data['donor_name']);
        $area = $this->db->realString($data['area']);
        $area_city = $this->db->realString($data['area_city']);
        $area_state = $this->db->realString($data['area_state']);
        $donate_asnaf = $this->db->realString($data['donate_asnaf']);
        $telephone = $this->db->realString($data['telephone']);
        $donor_id = $this->db->realString($data['donor_id']);
        $donate_to_jalaria = $this->db->realString($data['donate_to_jalaria']);

       

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($donor_name)) {
            $this->response['message'] = 'Please enter Donor name';
        } elseif ($this->db->checkUniqe("donors", 'donor_name', $donor_name, 'donor_id', $donor_id)) {
            $this->response['message'] = "Donor already exists!";
        } elseif (empty($telephone)) {
            $this->response['message'] = "Please enter Telephone!";
        } elseif (empty($area)) {
            $this->response['message'] = "Please enter Area!";
        } elseif (empty($area_city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($area_state)) {
            $this->response['message'] = "Area State is required!";
        }else if (!empty($donate_to_jalaria)) {
            if(!is_numeric($donate_to_jalaria)){
                $this->response['message'] = "Donate to Jalaria must be a decimal number!";
            }
        } else  if (empty($donate_asnaf)) {
            $this->response['message'] = "Donate to Asnaf is required!";
        } else if(!empty($donate_asnaf)){
            if(!is_numeric($donate_asnaf)){
                $this->response['message'] = "Donate to Asnaf must be a decimal number!";
            }
        }
        
        if(isset($data['items_to_donate'])){
            $items_to_donate = implode(',', $data['items_to_donate']) ;
        }else{
            $items_to_donate = '' ;
        }

        if (!isset($this->response['message'])) {
            $sql = "UPDATE `donors` SET `donor_name`='$donor_name',`telephone`='$telephone',`area`='$area',`area_city`='$area_city',`area_state`='$area_state',`donate_asnaf`='$donate_asnaf',`items_to_donate`='$items_to_donate',`donate_to_jalaria`='$donate_to_jalaria' WHERE `donor_id`='$donor_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Donar Updated successfully';
            } else {
                $this->response['message'] = 'Donar could not be updated!';
            }
        }
        return $this->response;
    }

    public function deleteData(array $data)
    {
        $donor_id = $data['donor_id'];
        $sql = "DELETE FROM `donors` WHERE `donor_id`='$donor_id'";
        $query = $this->db->runquery($sql);
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($query) {
            $this->response['status'] = 1;
            $this->response['type'] = 'success';
            $this->response['message'] = 'Donor Deleted successfully';
            $this->response['row'] = '#row' . $donor_id;
            $this->response['url'] = 'donors.php';
        } else {
            $this->response['message'] = 'Donor could not be deleted!';
        }
        return $this->response;
    }
}