<?php

namespace classes;

class Report
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
        $reporter_name = $this->db->realString($data['reporter_name']);
        $reporter_telephone = $this->db->realString($data['reporter_telephone']);
        $reportasnaf_name = $this->db->realString($data['reportasnaf_name']);
        $report_asnaf_telephone = $this->db->realString($data['report_asnaf_telephone']);
        $report_asnaf_address = $this->db->realString($data['report_asnaf_address']);
        $report_asnaf_condition = $this->db->realString($data['report_asnaf_condition']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($reporter_name)) {
            $this->response['message'] = 'Please enter Reporter name';
        } elseif (empty($reporter_telephone)) {
            $this->response['message'] = "Please enter Reporter Telephone!";
        } elseif (empty($reportasnaf_name)) {
            $this->response['message'] = "Please enter Report Asnaf Name!";
        } elseif (empty($report_asnaf_telephone)) {
            $this->response['message'] = "Report Asnaf Telephone is Required!";
        } elseif (empty($report_asnaf_address)) {
            $this->response['message'] = "Report Asnaf Address is required!";
        }

        if (!isset($this->response['message'])) {
            $sql = "INSERT INTO `reports`(`reporter_name`, `reporter_telephone`, `reportasnaf_name`, `report_asnaf_telephone`, `report_asnaf_address`, `report_asnaf_condition`) VALUES ('$reporter_name','$reporter_telephone','$reportasnaf_name','$report_asnaf_telephone','$report_asnaf_address','$report_asnaf_condition')";
            $query = $this->db->runquery($sql);

            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Report Submitted Successfully';
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
        $items_to_donate = $this->db->realString($data['items_to_donate']);
        $telephone = $this->db->realString($data['telephone']);
        $donate_to_jalaria = $this->db->realString($data['donate_to_jalaria']);
        $donor_id = $this->db->realString($data['donor_id']);

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