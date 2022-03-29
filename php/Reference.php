<?php


namespace classes;


class Reference
{
    public $err;
    public $succ;

    public $db;
    public $response;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function store($data){
        $source =  $this->db->realString($data['source']);
        $source_date =  $this->db->realString($data['source_date']);
        $country =  $this->db->realString($data['country']);
        $material =  $this->db->realString($data['material_type']);
        $title =  $this->db->realString($data['title']);
        $document_page =  $this->db->realString($data['document_page']);
        $expiry_date =  $this->db->realString($data['expiry_date']);
        $status_record =  $this->db->realString($data['status_record']);
        $asnaf_id =  $this->db->realString($data['asnaf_id']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($source)) {
            $this->response['message'] = 'Please enter Source';
        } elseif (empty($source_date)) {
            $this->response['message'] = "Enter Source Date!";
        } elseif (empty($country)) {
            $this->response['message'] = "Enter your country";
        } elseif (empty($material)) {
            $this->response['message'] = "Select Material Type";
        } elseif (empty($document_page)) {
            $this->response['message'] = "Type Document Page";
        } elseif (empty($expiry_date)) {
            $this->response['message'] = "Select Expiry Date";
        } elseif (empty($expiry_date)) {
            $this->response['message'] = "Select Expiry Date";
        } elseif (empty($status_record)) {
            $this->response['message'] = "Status record is required";
        }
        $this->response['url'] = 'references.php';
        if (!isset($this->response['message'])) {
            $sql = "INSERT INTO `asnaf_references`(`asnaf_id`, `source`, `source_date`, `material_type`, `title`, `doc_page`, `country`, `expiry_date`, `status_record`) VALUES ('$asnaf_id','$source', '$source_date', '$material','$title','$document_page', '$country', '$expiry_date', '$status_record')";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Reference added successfully';
            } else {
                $this->response['message'] = 'Reference could not be saved!';
                $this->response['message'] = $this->db->con->error;
            }
        }
        return $this->response;
    }
    public function update($data){
        $source =  $this->db->realString($data['source']);
        $source_date =  $this->db->realString($data['source_date']);
        $country =  $this->db->realString($data['country']);
        $material =  $this->db->realString($data['material_type']);
        $title =  $this->db->realString($data['title']);
        $document_page =  $this->db->realString($data['document_page']);
        $expiry_date =  $this->db->realString($data['expiry_date']);
        $status_record =  $this->db->realString($data['status_record']);
        $reference =  $this->db->realString($data['reference']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($source)) {
            $this->response['message'] = 'Please enter Source';
        } elseif (empty($source_date)) {
            $this->response['message'] = "Enter Source Date!";
        } elseif (empty($country)) {
            $this->response['message'] = "Enter your country";
        } elseif (empty($material)) {
            $this->response['message'] = "Select Material Type";
        } elseif (empty($document_page)) {
            $this->response['message'] = "Type Document Page";
        } elseif (empty($expiry_date)) {
            $this->response['message'] = "Select Expiry Date";
        } elseif (empty($expiry_date)) {
            $this->response['message'] = "Select Expiry Date";
        } elseif (empty($status_record)) {
            $this->response['message'] = "Status record is required";
        }
        $this->response['url'] = 'references.php';
        if (!isset($this->response['message'])) {
            $sql = "UPDATE `asnaf_references` SET `source`='$source', `source_date`='$source_date', `material_type`='$material', `title`='$title', `doc_page`='$document_page', `country`='$country', `expiry_date`='$expiry_date', `status_record`='$status_record' WHERE `id`='$reference'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Reference Updated successfully';
            } else {
                $this->response['message'] = 'Reference could not be saved!';
                $this->response['message'] = $this->db->con->error;
            }
        }
        return $this->response;
    }

    public function delete($data){
        $reference_id = $data['reference_id'];
        $sql = "DELETE FROM `asnaf_references` WHERE `id`='$reference_id'";
        $query = $this->db->runquery($sql);
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($query) {
            $this->response['status'] = 1;
            $this->response['type'] = 'warning';
            $this->response['row'] = '#row' . $reference_id;
            $this->response['message'] = 'Reference Deleted successfully';
        } else {
            $this->response['message'] = 'Reference could not be Deleted!';
//            $this->response['message'] = $this->db->con->error;
        }
        return $this->response;
    }

}