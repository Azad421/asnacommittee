<?php

namespace classes;

class User
{
    public $err;
    public $succ;

    public $db;
    public $response;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveNewUser(array $data)
    {
        $name = $this->db->realString($data['name']);
        $address1 = $this->db->realString($data['address1']);
        $address2 = $this->db->realString($data['address2']);
        $area = $this->db->realString($data['area']);
        $city = $this->db->realString($data['city']);
        $postcode = $this->db->realString($data['postcode']);
        $state = $this->db->realString($data['state']);
        $country = $this->db->realString($data['country']);
        $telephone = $this->db->realString($data['telephone']);
        $mosque_id = $this->db->realString($data['mosque_id']);
        $id_type = $this->db->realString($data['id_type']);
        $id_no = $this->db->realString($data['id_no']);
        $id_international = $this->db->realString($data['id_international']);
        $birth_date = $this->db->realString($data['birth_date']);
        $birth_state = $this->db->realString($data['birth_state']);
        $birth_country = $this->db->realString($data['birth_country']);
        $married_status = $this->db->realString($data['married_status']);
        $convert_date = $this->db->realString($data['convert_date']);
        $citizenship = $this->db->realString($data['citizenship']);
        $race = $this->db->realString($data['race']);
        $religion = $this->db->realString($data['religion']);
        $basic_skills = $this->db->realString($data['basic_skills']);
        $basic_skills_others = $this->db->realString($data['basic_skills_others']);
        $family_head_name = $this->db->realString($data['family_head_name']);
        $head_id_type = $this->db->realString($data['head_id_type']);
        $head_id_no = $this->db->realString($data['head_id_no']);
        $family_head_relation = $this->db->realString($data['family_head_relation']);
        $family_head_relation_other = $this->db->realString($data['family_head_relation_other']);
        $pay_method = $this->db->realString($data['pay_method']);
        $pay_method_reason = $this->db->realString($data['pay_method_reason']);
        $bank_name = $this->db->realString($data['bank_name']);
        $bank_account_no = $this->db->realString($data['bank_account_no']);
        $bank_account_holder_name = $this->db->realString($data['bank_account_holder_name']);
        $nick_name = $this->db->realString($data['nick_name']);
        $life_condition = $this->db->realString($data['life_condition']);
        $notes = $this->db->realString($data['notes']);
        $income_explain = $this->db->realString($data['income_explain']);
        $planned_action = $this->db->realString($data['planned_action']);
        $help_needed = $this->db->realString($data['help_needed']);
        $start_collect = $this->db->realString($data['date_start_donation']);
        $end_collect = $this->db->realString($data['date_end_donation']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($name)) {
            $this->response['message'] = 'Please enter user name';
        } elseif (!preg_match('/[A-Za-z]/', $name)) {
            $this->response['message'] = "User name must be Alphabetical";
        } elseif ($this->db->checkUniqe("all_members", 'name', $name)) {
            $this->response['message'] = "User already exists!";
        } elseif (empty($address1)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($address2)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($area)) {
            $this->response['message'] = "Please enter Area!";
        } elseif (empty($city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($postcode)) {
            $this->response['message'] = "Post code is required!";
        } elseif (empty($state)) {
            $this->response['message'] = "State is required!";
        } elseif (empty($country)) {
            $this->response['message'] = "Please enter Country!";
        } elseif (empty($telephone)) {
            $this->response['message'] = "Telephone is required!";
        } elseif (empty($start_collect)) {
            $this->response['message'] = "Start Collect Date is required!";
        } elseif (empty($end_collect)) {
            $this->response['message'] = "End Collect Date is required!";
        } elseif (empty($help_needed)) {
            $this->response['message'] = "Help Needed is required!";
        }


        if (empty($birth_date)) {
            $birth_date = date("Y-m-d", strtotime('01-01-0001'));
        }


        if (empty($convert_date)) {
            $convert_date = date("Y-m-d", strtotime('01-01-0001'));
        }

        if (!isset($this->response['message'])) {
            $sql = "INSERT INTO `all_members`(`name`, `mosque_id`, `address1`, `address2`, `area`, `city`, `postcode`, `state`, `country`, `telephone`, `id_type`, `id_no`, `id_international`, `birth_date`,`birth_state`, `birth_country`, `married_status`, `convert_date`, `citizenship`, `race`, `religion`,`basic_skills`, `basic_skills_others`,`family_head_name`, `head_id_type`, `head_id_no`, `family_head_relation`, `family_head_relation_other`, `pay_method`, `pay_method_reason`, `bank_name`, `bank_account_no`, `bank_account_holder_name`, `notes`, `life_condition`,`nick_name`, `income_explain`, `planned_action`, `help_needed`) VALUES ('$name','$mosque_id','$address1','$address2','$area','$city','$postcode','$state','$country','$telephone','$id_type','$id_no','$id_international','$birth_date','$birth_state','$birth_country','$married_status','$convert_date','$citizenship','$race', '$religion','$basic_skills','$basic_skills_others','$family_head_name','$head_id_type','$head_id_no','$family_head_relation','$family_head_relation_other','$pay_method','$pay_method_reason','$bank_name','$bank_account_no','$bank_account_holder_name','$notes', '$life_condition','$nick_name', '$income_explain', '$planned_action', '$help_needed')";
            $query = $this->db->runquery($sql);
            $member_id = $this->db->lastid();
            if ($query) {
                $this->db->runquery("INSERT INTO `donation_project`(`member_id`, `amount_target`, `start_collect`, `end_collect`, `help_needed`) VALUES ('$member_id', '0.00', '$start_collect', '$end_collect', '$help_needed')");
                if (isset($data['help_category'])) {
                    foreach ($data['help_category'] as $helpCategory) {
                        $sql = "INSERT INTO `members_help_category`(`member_id`, `help_category_id`) VALUE ('$member_id', '$helpCategory')";
                        $this->db->runquery($sql);
                    }
                }
                for ($a = 0; $a < 5; $a++) {
                    $sql = "INSERT INTO `images`(`user_id`, `image_name`) VALUE ('$member_id', '')";
                    $this->db->runquery($sql);
                }
                $images = [];
                $selectIm = $this->db->runquery("SELECT `id` FROM `images` WHERE `user_id`='$member_id'");
                $images = $selectIm->fetch_all(MYSQLI_ASSOC);
                foreach ($_FILES['image']['name'] as $key => $image_name) {
                    $id = $images[$key]['id'];
                    if (!empty($image_name)) {
                        $file = $_FILES['image'];
                        $file_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $image = 'member-' . md5(time().$key) . '.' . $file_ext;
                        move_uploaded_file($file['tmp_name'][$key], dirname(__DIR__) . '/images/' . $image);

                    } else {
                        $image = $data['oldImage'][$key];
                    }
                    $sql = "UPDATE `images` SET `image_name`='$image' WHERE `id`='$id'";
                    $this->db->runquery($sql);
                }

                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'User added successfully';
            } else {
                $this->response['message'] = 'User could not be saved!';
//                $this->response['message'] = $this->db->con->error;
            }
        }
        return $this->response;
    }

    public function makeAsnaf(array $data)
    {
        $agency_name = $this->db->realString($data['agency_name']);
        $agency_id = $this->db->realString($data['agency_id']);
        $mosque_id = $this->db->realString($data['mosque_id']);
        $Identification_id = $data['Identification_id'];

        $sql = "INSERT INTO `asnaf`(`Identification_id`, `mosque_id`, `agancy_name`, `agency_id`) VALUES ('$Identification_id','$mosque_id','$agency_name','$agency_id')";
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($this->db->runquery($sql)) {
            $this->response['status'] = 1;
            $this->response['type'] = 'success';
            $this->response['message'] = 'Asnaf selected successfully';
        } else {
            $this->response['message'] = 'Something is wrong please try again!';
        }
        return $this->response;
    }

    public function makeCommittee($data)
    {
        $mosque_id = $this->db->realString($data['mosque_id']);
        $asnaf_name = $this->db->realString($data['asnaf_name']);
        $position = $this->db->realString($data['position']);
        $password = $this->db->realString($data['password']);
        $Identification_id = $data['Identification_id'];
        if (empty($mosque_id) || empty($asnaf_name) || empty($position) || empty($password)) {
            $this->response['message'] = "Filedes are required!";
        } elseif ($this->db->checkUniqe("commitee", 'asnaf_name', $asnaf_name)) {
            $this->response['message'] = "Login Id already already exists!";
        }
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($this->response['message'])) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `commitee`(`Identification_id`, `mosque_Id`, `asnaf_name`, `position`, `password`) VALUES ('$Identification_id','$mosque_id','$asnaf_name','$position','$password')";

            if ($this->db->runquery($sql)) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Committee selected successfully';
            } else {
                $this->response['message'] = 'Something is wrong please try again!';
            }
        }
        return $this->response;
    }

    public function updateData(array $data)
    {
        $name = $this->db->realString($data['name']);
        $address1 = $this->db->realString($data['address1']);
        $address2 = $this->db->realString($data['address2']);
        $area = $this->db->realString($data['area']);
        $city = $this->db->realString($data['city']);
        $postcode = $this->db->realString($data['postcode']);
        $state = $this->db->realString($data['state']);
        $country = $this->db->realString($data['country']);
        $telephone = $this->db->realString($data['telephone']);
        $mosque_id = $this->db->realString($data['mosque_id']);
        $Identification_id = $this->db->realString($data['Identification_id']);

        $id_type = $this->db->realString($data['id_type']);
        $id_no = $this->db->realString($data['id_no']);
        $id_international = $this->db->realString($data['id_international']);
        $birth_date = $this->db->realString($data['birth_date']);
        $birth_state = $this->db->realString($data['birth_state']);
        $birth_country = $this->db->realString($data['birth_country']);
        $married_status = $this->db->realString($data['married_status']);
        $convert_date = $this->db->realString($data['convert_date']);
        $citizenship = $this->db->realString($data['citizenship']);
        $race = $this->db->realString($data['race']);
        $religion = $this->db->realString($data['religion']);
        $basic_skills = $this->db->realString($data['basic_skills']);
        $basic_skills_others = $this->db->realString($data['basic_skills_others']);
        $family_head_name = $this->db->realString($data['family_head_name']);
        $head_id_type = $this->db->realString($data['head_id_type']);
        $head_id_no = $this->db->realString($data['head_id_no']);
        $family_head_relation = $this->db->realString($data['family_head_relation']);
        $family_head_relation_other = $this->db->realString($data['family_head_relation_other']);
        $pay_method = $this->db->realString($data['pay_method']);
        $pay_method_reason = $this->db->realString($data['pay_method_reason']);
        $bank_name = $this->db->realString($data['bank_name']);
        $bank_account_no = $this->db->realString($data['bank_account_no']);
        $bank_account_holder_name = $this->db->realString($data['bank_account_holder_name']);
        $nick_name = $this->db->realString($data['nick_name']);
        $life_condition = $this->db->realString($data['life_condition']);
        $notes = $this->db->realString($data['notes']);
        $income_explain = $this->db->realString($data['income_explain']);
        $planned_action = $this->db->realString($data['planned_action']);
        $help_needed = $this->db->realString($data['help_needed']);

        $start_collect = $this->db->realString($data['date_start_donation']);
        $end_collect = $this->db->realString($data['date_end_donation']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($name)) {
            $this->response['message'] = 'Please enter user name';
        } elseif (!preg_match('/[A-Za-z]/', $name)) {
            $this->response['message'] = "User name must be Alphabetical";
        } elseif ($this->db->checkUniqe("all_members", 'name', $name, 'Identification_id', $Identification_id)) {
            $this->response['message'] = "User already exists!";
        } elseif (empty($address1)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($address2)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($area)) {
            $this->response['message'] = "Please enter Area!";
        } elseif (empty($city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($postcode)) {
            $this->response['message'] = "Post code is required!";
        } elseif (empty($country)) {
            $this->response['message'] = "Please enter Country!";
        } elseif (empty($telephone)) {
            $this->response['message'] = "Telephone is required!";
        } elseif (empty($birth_date)) {
            $this->response['message'] = "Birth Date is required!";
        } elseif (empty($convert_date)) {
            $this->response['message'] = "Convert Date is required!";
        } elseif (empty($start_collect)) {
            $this->response['message'] = "Start Collect Date is required!";
        } elseif (empty($end_collect)) {
            $this->response['message'] = "End Collect Date is required!";
        } elseif (empty($help_needed)) {
            $this->response['message'] = "Help Needed is required!";
        }


        if (!isset($this->response['message'])) {
            $sql = "UPDATE `all_members` SET `name`='$name',`mosque_id`='$mosque_id',`address1`='$address1',`address2`='$address2',`area`='$area',`city`='$city',`postcode`='$postcode',`state`='$state',`country`='$country',`telephone`='$telephone',`id_type`='$id_type',`id_no`='$id_no',`id_international`='$id_international',`birth_date`='$birth_date',`birth_state`='$birth_state',`birth_country`='$birth_country',`married_status`='$married_status',`convert_date`='$convert_date',`citizenship`='$citizenship',`race`='$race', `religion`='$religion', `basic_skills`='$basic_skills',`basic_skills_others`='$basic_skills_others',`family_head_name`='$family_head_name',`head_id_type`='$head_id_type',`head_id_no`='$head_id_no',`family_head_relation`='$family_head_relation',`family_head_relation_other`='$family_head_relation_other',`pay_method`='$pay_method',`pay_method_reason`='$pay_method_reason',`bank_name`='$bank_name',`bank_account_no`='$bank_account_no',`bank_account_holder_name`='$bank_account_holder_name',`notes`='$notes',`nick_name`='$nick_name',`life_condition`='$life_condition',`income_explain`='$income_explain',`planned_action`='$planned_action', `help_needed`='$help_needed' WHERE `Identification_id`= $Identification_id";
            $query = $this->db->runquery($sql);
            if (isset($data['help_category'])) {
                $category = implode("'` ,'", $data['help_category']);
                $this->db->runquery("DELETE FROM `members_help_category` WHERE `member_id`='$Identification_id' AND `help_category_id` NOT IN('$category')");
                foreach ($data['help_category'] as $helpCategory) {
                    $select = $this->db->runquery("SELECT * FROM `members_help_category` WHERE `member_id`='$Identification_id' AND `help_category_id`='$helpCategory'");
                    if ($select->num_rows == 0) {
                        $sql = "INSERT INTO `members_help_category`(`member_id`, `help_category_id`) VALUE ('$Identification_id', '$helpCategory')";
                        $this->db->runquery($sql);
                    }
                }
            }
            $images = [];
            $selectC = $this->db->runquery("SELECT `id` FROM `images` WHERE `user_id`='$Identification_id'");
            for ($a = 0; $a < 5 - $selectC->num_rows; $a++) {
                $this->db->runquery("INSERT INTO `images`(`user_id`, `image_name`) VALUE ('$Identification_id', '')");
            }
            $images = $selectC->fetch_all(MYSQLI_ASSOC);
            foreach ($_FILES['image']['name'] as $key => $image_name) {
                $id = $images[$key]['id'];
                $image = $data['oldImage'][$key];
                if (!empty($image_name)) {
                    $file = $_FILES['image'];
                    $file_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    if (file_exists(dirname(__DIR__) . '/images/' . $image)) {
                        unlink(dirname(__DIR__) . '/images/' . $image);
                    }

                    $image = 'member-' . md5(time().$key) . '.' . $file_ext;
                    move_uploaded_file($file['tmp_name'][$key], dirname(__DIR__) . '/images/' . $image);

                } else {
                    $image = $data['oldImage'][$key];
                }
                $sql = "UPDATE `images` SET `image_name`='$image' WHERE `id`='$id'";
                $this->db->runquery($sql);
            }
            $selectD = $this->db->runquery("SELECT * FROM `donation_project` WHERE `member_id`='$Identification_id'");
            if ($selectD->num_rows > 0) {
                $this->db->runquery("UPDATE `donation_project` SET `start_collect`='$start_collect', `end_collect`='$end_collect', `help_needed`='$help_needed' WHERE `member_id`='$Identification_id'");
            } else {
                $this->db->runquery("INSERT INTO `donation_project`(`member_id`, `start_collect`, `end_collect`, `help_needed`) VALUES ('$Identification_id', '$start_collect', '$end_collect', '$help_needed')");
            }
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['url'] = 'members.php';
                $this->response['message'] = 'User Upadated successfully';
            } else {
                $this->response['message'] = 'User could not be Updated!';
            }
        }
        return $this->response;
    }

    public function deleteData(array $data)
    {
        $Identification_id = $data['Identification_id'];
        $select = $this->db->runquery("SELECT * FROM `commitee` WHERE `Identification_id`='$Identification_id'");
        $select2 = $this->db->runquery("SELECT * FROM `asnaf` WHERE `Identification_id`='$Identification_id'");


        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($select->num_rows > 0 || $select2->num_rows > 0) {
            $this->response['message'] = 'First remove from asnaf or committee!';
        }
        if (!isset($this->response['message'])) {
            $selectC = $this->db->runquery("SELECT * FROM `images` WHERE `user_id`='$Identification_id'");
            $images = $selectC->fetch_all(MYSQLI_ASSOC);
            foreach ($images as $key => $image) {
                $id = $image['id'];
                if (file_exists(dirname(__DIR__) . '/images/' . $image['image_name'])) {
                    unlink(dirname(__DIR__) . '/images/' . $image['image_name']);
                }

                $this->db->runquery("DELETE FROM `images` WHERE `id`='$id'");
            }
            $this->db->runquery("DELETE FROM `members_help_category` WHERE `member_id`='$Identification_id'");

            $sql = "DELETE FROM `all_members` WHERE `Identification_id`='$Identification_id'";
            $query = $this->db->runquery($sql);
            echo $this->db->con->error;

            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Member Deleted successfully';
                $this->response['row'] = '#row' . $Identification_id;
            } else {
                $this->response['message'] = 'Member could not be deleted!';
            }
        }
        return $this->response;
    }

    public function deleteAsnaf(array $data)
    {
        $asnaf_id = $data['asnaf_id'];
        $this->response['status'] = 0;
        $this->response['type'] = 'error';

        $select2 = $this->db->runquery("SELECT * FROM `asnaf` WHERE `Identification_id`='$Identification_id'");


        if ($select2->num_rows > 0 || $select2->num_rows > 0) {
            $this->response['message'] = 'First remove asnaf From Reference!';
        }
        if (!isset($this->response['message'])) {
            $sql = "DELETE FROM `asnaf` WHERE `asnaf_id`='$asnaf_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Member Deleted successfully';
                $this->response['row'] = '#row' . $asnaf_id;
            } else {
                $this->response['message'] = 'Member could not be deleted!';
            }
        }
        return $this->response;
    }
}