<?php

namespace classes;

class Donor
{
    public $err;
    public $succ;

    public $db;
    public $response;
    public $order_id;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveNew(array $data)
    {
        $donor_name = $this->db->realString($data['donor_name']);
        $nick_name = $this->db->realString($data['nick_name']);
        $telephone = $this->db->realString($data['telephone']);
        $reg_no = $this->db->realString($data['gov_reg_no']);
        $areas = $data['area'];
        $area_city = $this->db->realString($data['area_city']);
        $area_state = $this->db->realString($data['area_state']);
        $bank_name = $this->db->realString($data['bank_name']);
        $account_holder = $this->db->realString($data['account_holder']);
        $bank_account_no = $this->db->realString($data['bank_account_no']);
        $donate_details = $this->db->realString($data['donate_details']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($donor_name)) {
            $this->response['message'] = 'Please enter Donor name';
        }

        if (isset($areas)) {
            $i = 0;
            foreach ($areas as $key => $area) {
                if (!empty($area)) {
                    $i = 1;
                }
                $this->response['area_id'][] = $area;
            }
            if ($i == 0) {
                $this->response['message'] = "Please Select Area!";
            }
        } else {
            $this->response['message'] = "Please Select Area!";
        }

        if (!isset($this->response['message'])) {

            $logo = '';
            if (isset($_FILES['logo']) && !empty($_FILES['logo']['name'])) {
                $file = $_FILES['logo'];
                $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $logo = 'donor-logo-' . md5(time()) . '.' . $file_ext;
                move_uploaded_file($file['tmp_name'], dirname(__DIR__) . '/images/' . $logo);
            }
            $sql = "INSERT INTO `donors`(`donor_name`, `nick_name`, `telephone`, `gov_reg_no`, `logo`,`area_city`, `area_state`, `donate_details`, `bank_name`, `account_holder`, `bank_account_no`) VALUES ('$donor_name', '$nick_name','$telephone', '$reg_no','$logo','$area_city','$area_state', '$donate_details', '$bank_name', '$account_holder','$bank_account_no')";
            $query = $this->db->runquery($sql);
            $donor_id = $this->db->lastid();

            $area = implode("' ,'", array_unique($data['area']));
            $this->db->runquery("DELETE FROM `donor_area` WHERE `donor_id`='$donor_id' AND `area_id` NOT IN('$area')");
            foreach ($data['area'] as $areId) {
                if (!empty($areId)) {
                    $select = $this->db->runquery("SELECT * FROM `donor_area` WHERE `donor_id`='$donor_id' AND `area_id`='$areId'");
                    if ($select->num_rows == 0) {
                        $sql = "INSERT INTO `donor_area`(`donor_id`, `area_id`) VALUE ('$donor_id', '$areId')";
                        $this->db->runquery($sql);
                    }
                }
            }

            if (isset($data['help_category'])) {
                $category = implode("'` ,'", $data['help_category']);
                $this->db->runquery("DELETE FROM `donor_help_categories` WHERE `donor_id`='$donor_id' AND `help_category_id` NOT IN('$category')");
                foreach ($data['help_category'] as $helpCategory) {
                    $select = $this->db->runquery("SELECT * FROM `donor_help_categories` WHERE `donor_id`='$donor_id' AND `help_category_id`='$helpCategory'");
                    if ($select->num_rows == 0) {
                        $sql = "INSERT INTO `donor_help_categories`(`donor_id`, `help_category_id`) VALUE ('$donor_id', '$helpCategory')";
                        $this->db->runquery($sql);
                    }
                }
            }

            for ($a = 0; $a < 5; $a++) {
                $sql = "INSERT INTO `donor_images`(`donor_id`, `image_name`) VALUE ('$donor_id', '')";
                $this->db->runquery($sql);
            }
            $images = [];
            $selectC = $this->db->runquery("SELECT `id` FROM `donor_images` WHERE `donor_id`='$donor_id'");
            $images = $selectC->fetch_all(MYSQLI_ASSOC);
            foreach ($_FILES['image']['name'] as $key => $image_name) {
                $id = $images[$key]['id'];
                $image = $data['oldImage'][$key];
                if (!empty($image_name)) {
                    if (file_exists(dirname(__DIR__) . '/images/' . $image)) {
                        unlink(dirname(__DIR__) . '/images/' . $image);
                    }
                    $file = $_FILES['image'];
                    $file_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image = 'donor-' . md5(time().$key) . '.' . $file_ext;
                    move_uploaded_file($file['tmp_name'][$key], dirname(__DIR__) . '/images/' . $image);

                } else {
                    $image = $data['oldImage'][$key];
                }
                $sql = "UPDATE `donor_images` SET `image_name`='$image' WHERE `id`='$id'";
                $this->db->runquery($sql);
            }


            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Donor Added successfully';
            } else {
                $this->response['message'] = 'Something is wrong!';
                $this->response['message'] = $this->db->con->error;
            }
        }
        return $this->response;
    }

    public function updateOld(array $data)
    {
        $donor_id = $data['donor_id'];
        $donor_name = $this->db->realString($data['donor_name']);
        $nick_name = $this->db->realString($data['nick_name']);
        $telephone = $this->db->realString($data['telephone']);
        $reg_no = $this->db->realString($data['gov_reg_no']);
        $areas = $data['area'];
        $area_city = $this->db->realString($data['area_city']);
        $area_state = $this->db->realString($data['area_state']);
        $bank_name = $this->db->realString($data['bank_name']);
        $account_holder = $this->db->realString($data['account_holder']);
        $bank_account_no = $this->db->realString($data['bank_account_no']);
        $donate_details = $this->db->realString($data['donate_details']);


        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($donor_name)) {
            $this->response['message'] = 'Please enter Donor name';
        }


        if (isset($data['items_to_donate'])) {
            $items_to_donate = implode(',', $data['items_to_donate']);
        } else {
            $items_to_donate = '';
        }

        if (!isset($this->response['message'])) {
            $logo = $data['oldLogo'];
            if (isset($_FILES['donor_logo']) && !empty($_FILES['donor_logo']['name'])) {
                $file = $_FILES['donor_logo'];
                $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                if (file_exists(dirname(__DIR__) . '/images/' . $logo)) {
                    unlink(dirname(__DIR__) . '/images/' . $logo);
                }
                $logo = 'donor-logo-' . md5(time()) . '.' . $file_ext;
                move_uploaded_file($file['tmp_name'], dirname(__DIR__) . '/images/' . $logo);
            }

            $sql = "UPDATE `donors` SET `donor_name`='$donor_name', `nick_name`='$nick_name',`telephone`='$telephone', `gov_reg_no`='$reg_no', `logo`='$logo', `area_city`='$area_city',`area_state`='$area_state', `donate_details`='$donate_details',`bank_name`='$bank_name',`account_holder`='$account_holder',`bank_account_no`='$bank_account_no' WHERE `donor_id`='$donor_id'";
            $query = $this->db->runquery($sql);


            $area = implode("' ,'", array_unique($data['area']));
            $this->db->runquery("DELETE FROM `donor_area` WHERE `donor_id`='$donor_id' AND `area_id` NOT IN('$area')");
            foreach ($data['area'] as $areId) {
                if (!empty($areId)) {
                    $select = $this->db->runquery("SELECT * FROM `donor_area` WHERE `donor_id`='$donor_id' AND `area_id`='$areId'");
                    if ($select->num_rows == 0) {
                        $sql = "INSERT INTO `donor_area`(`donor_id`, `area_id`) VALUE ('$donor_id', '$areId')";
                        $this->db->runquery($sql);
                    }
                }
            }

            if (isset($data['help_category'])) {
                $category = implode("'` ,'", $data['help_category']);
                $this->db->runquery("DELETE FROM `donor_help_categories` WHERE `donor_id`='$donor_id' AND `help_category_id` NOT IN('$category')");
                foreach ($data['help_category'] as $helpCategory) {
                    $select = $this->db->runquery("SELECT * FROM `donor_help_categories` WHERE `donor_id`='$donor_id' AND `help_category_id`='$helpCategory'");
                    if ($select->num_rows == 0) {
                        $sql = "INSERT INTO `donor_help_categories`(`donor_id`, `help_category_id`) VALUE ('$donor_id', '$helpCategory')";
                        $this->db->runquery($sql);
                    }
                }
            }

            for ($a = 0; $a < 5; $a++) {
                $sql = "INSERT INTO `donor_images`(`donor_id`, `image_name`) VALUE ('$donor_id', '')";
                $this->db->runquery($sql);
//                echo $this->db->con->error;
            }
            $images = [];
            $selectC = $this->db->runquery("SELECT `id` FROM `donor_images` WHERE `donor_id`='$donor_id'");
            $images = $selectC->fetch_all(MYSQLI_ASSOC);
            foreach ($_FILES['image']['name'] as $key => $image_name) {
                $id = $images[$key]['id'];
                $image = $data['oldImage'][$key];
                if (!empty($image_name)) {
                    if (file_exists(dirname(__DIR__) . '/images/' . $image)) {
                        unlink(dirname(__DIR__) . '/images/' . $image);
                    }
                    $file = $_FILES['image'];
                    $file_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image = 'donor-' . md5(time().$key) . '.' . $file_ext;
                    move_uploaded_file($file['tmp_name'][$key], dirname(__DIR__) . '/images/' . $image);

                } else {
                    $image = $data['oldImage'][$key];
                }
                $sql = "UPDATE `donor_images` SET `image_name`='$image' WHERE `id`='$id'";
                $this->db->runquery($sql);
            }
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Donor Updated successfully';
            } else {
                $this->response['message'] = 'Donor could not be updated!';
            }
        }
        return $this->response;
    }

    public function deleteData(array $data)
    {
        $donor_id = $data['donor_id'];

        $logo = $this->db->runquery("SELECT * FROM `donors`  WHERE `donor_id`='$donor_id'")->fetch_assoc()['logo'];
        if (file_exists(dirname(__DIR__) . '/images/' . $logo)) {
            unlink(dirname(__DIR__) . '/images/' . $logo);
        }
        $selectIm = $this->db->runquery("SELECT * FROM `donor_images` WHERE `donor_id`='$donor_id'");
        $images = $selectIm->fetch_all(MYSQLI_ASSOC);
        foreach ($images as $key => $image) {
            $id = $image['id'];
            if (file_exists(dirname(__DIR__) . '/images/' . $image['image_name'])) {
                unlink(dirname(__DIR__) . '/images/' . $image['image_name']);
            }

            $this->db->runquery("DELETE FROM `images` WHERE `id`='$id'");
        }
        $this->db->runquery("DELETE FROM `donor_help_categories` WHERE `donor_id`='$donor_id'");
        $this->db->runquery("DELETE FROM `donor_area` WHERE `donor_id`='$donor_id'");


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