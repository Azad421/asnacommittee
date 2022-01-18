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
        $state_since = $this->db->realString($data['state_since']);
        $race = $this->db->realString($data['race']);
        $edu = $this->db->realString($data['edu']);
        $edu_others = $this->db->realString($data['edu_others']);
        $health_good = $this->db->realString($data['health_good']);
        $health_cri_iii = $this->db->realString($data['health_cri_iii']);
        $health_cri_iii_cost = $this->db->realString($data['health_cri_iii_cost']);
        $health_dis = $this->db->realString($data['health_dis']);
        $health_dis_rea = $this->db->realString($data['health_dis_rea']);
        $health_dis_severe = $this->db->realString($data['health_dis_severe']);
        $health_dis_cost = $this->db->realString($data['health_dis_cost']);
        $health_old = $this->db->realString($data['health_old']);
        $health_old_cost = $this->db->realString($data['health_old_cost']);
        $house_acc = $this->db->realString($data['house_acc']);
        $house_prov = $this->db->realString($data['house_prov']);
        $house_land = $this->db->realString($data['house_land']);
        $house_land_others = $this->db->realString($data['house_land_others']);
        $house_type = $this->db->realString($data['house_type']);
        $house_type_others = $this->db->realString($data['house_type_others']);
        $house_made_of = $this->db->realString($data['house_made_of']);
        $house_condition = $this->db->realString($data['house_condition']);
        $house_water = $this->db->realString($data['house_water']);
        $house_water_bill = $this->db->realString($data['house_water_bill']);
        $house_electric = $this->db->realString($data['house_electric']);
        $house_electric_bill = $this->db->realString($data['house_electric_bill']);
        $house_maint = $this->db->realString($data['house_maint']);
        $house_maint_bill = $this->db->realString($data['house_maint_bill']);
        $basic_skills = $this->db->realString($data['basic_skills']);
        $basic_skills_others = $this->db->realString($data['basic_skills_others']);
        $liquid_assets = $this->db->realString($data['liquid_assets']);
        $total_fixed_assets = $this->db->realString($data['total_fixed_assets']);
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
        } 

        if(empty($health_cri_iii_cost)){
            $health_cri_iii_cost = 0;
        }
        if(empty($health_dis_cost)){
            $health_dis_cost = 0;
        }
        if(empty($health_old_cost)){
            $health_old_cost = 0;
        }
        if(empty($house_water_bill)){
            $house_water_bill = 0;
        }
        if(empty($liquid_assets)){
            $liquid_assets = 0;
        }
        if(empty($total_fixed_assets)){
            $total_fixed_assets = 0;
        }
        
        if(empty($house_electric_bill)){
            $house_electric_bill = 00.00;
        }
        if(empty($house_maint_bill)){
            $house_maint_bill = 00.00;
        }

        if(empty($birth_date)){
            $birth_date = date("Y-m-d",strtotime('01-01-0001'));
        }
      
        if(empty($state_since)){
            $state_since = date("Y-m-d",strtotime('01-01-0001'));
        }

        if(empty($convert_date)){
            $convert_date = date("Y-m-d",strtotime('01-01-0001'));
        }
        
        if (!isset($this->response['message'])) {
            $sql = "INSERT INTO `all_members`(`name`, `mosque_id`, `address1`, `address2`, `area`, `city`, `postcode`, `state`, `country`, `telephone`, `id_type`, `id_no`, `id_international`, `birth_date`,`birth_state`, `birth_country`, `married_status`, `convert_date`, `citizenship`, `state_since`, `race`, `edu`, `edu_others`, `health_good`, `health_cri_iii`, `health_cri_iii_cost`, `health_dis`, `health_dis_rea`, `health_dis_severe`, `health_dis_cost`, `health_old`, `health_old_cost`, `house_acc`, `house_prov`, `house_land`, `house_land_others`, `house_type`, `house_type_others`, `house_made_of`, `house_condition`, `house_water`, `house_water_bill`, `house_electric`, `house_electric_bill`, `house_maint`, `house_maint_bill`, `basic_skills`, `basic_skills_others`, `liquid_assets`, `total_fixed_assets`, `family_head_name`, `head_id_type`, `head_id_no`, `family_head_relation`, `family_head_relation_other`, `pay_method`, `pay_method_reason`, `bank_name`, `bank_account_no`, `bank_account_holder_name`, `notes`, `life_condition`,`nick_name`) VALUES ('$name','$mosque_id','$address1','$address2','$area','$city','$postcode','$state','$country','$telephone','$id_type','$id_no','$id_international','$birth_date','$birth_state','$birth_country','$married_status','$convert_date','$citizenship','$state_since','$race','$edu','$edu_others','$health_good','$health_cri_iii','$health_cri_iii_cost','$health_dis','$health_dis_rea','$health_dis_severe','$health_dis_cost','$health_old','$health_old_cost','$house_acc','$house_prov','$house_land','$house_land_others','$house_type','$house_type_others','$house_made_of','$house_condition','$house_water','$house_water_bill','$house_electric','$house_electric_bill','$house_maint','$house_maint_bill','$basic_skills','$basic_skills_others','$liquid_assets','$total_fixed_assets','$family_head_name','$head_id_type','$head_id_no','$family_head_relation','$family_head_relation_other','$pay_method','$pay_method_reason','$bank_name','$bank_account_no','$bank_account_holder_name','$notes', '$life_condition','$nick_name')";
            $query = $this->db->runquery($sql);
            $this->response['sql'] = $sql;
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'User added successfully';
            } else {
                $this->response['message'] = 'User could not be saved!';
                $this->response['message'] = $this->db->con->error;
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
        $state_since = $this->db->realString($data['state_since']);
        $race = $this->db->realString($data['race']);
        $edu = $this->db->realString($data['edu']);
        $edu_others = $this->db->realString($data['edu_others']);
        $health_good = $this->db->realString($data['health_good']);
        $health_cri_iii = $this->db->realString($data['health_cri_iii']);
        $health_cri_iii_cost = $this->db->realString($data['health_cri_iii_cost']);
        $health_dis = $this->db->realString($data['health_dis']);
        $health_dis_rea = $this->db->realString($data['health_dis_rea']);
        $health_dis_severe = $this->db->realString($data['health_dis_severe']);
        $health_dis_cost = $this->db->realString($data['health_dis_cost']);
        $health_old = $this->db->realString($data['health_old']);
        $health_old_cost = $this->db->realString($data['health_old_cost']);
        $house_acc = $this->db->realString($data['house_acc']);
        $house_prov = $this->db->realString($data['house_prov']);
        $house_land = $this->db->realString($data['house_land']);
        $house_land_others = $this->db->realString($data['house_land_others']);
        $house_type = $this->db->realString($data['house_type']);
        $house_type_others = $this->db->realString($data['house_type_others']);
        $house_made_of = $this->db->realString($data['house_made_of']);
        $house_condition = $this->db->realString($data['house_condition']);
        $house_water = $this->db->realString($data['house_water']);
        $house_water_bill = $this->db->realString($data['house_water_bill']);
        $house_electric = $this->db->realString($data['house_electric']);
        $house_electric_bill = $this->db->realString($data['house_electric_bill']);
        $house_maint = $this->db->realString($data['house_maint']);
        $house_maint_bill = $this->db->realString($data['house_maint_bill']);
        $basic_skills = $this->db->realString($data['basic_skills']);
        $basic_skills_others = $this->db->realString($data['basic_skills_others']);
        $liquid_assets = $this->db->realString($data['liquid_assets']);
        $total_fixed_assets = $this->db->realString($data['total_fixed_assets']);
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
        } elseif (empty($state)) {
            $this->response['message'] = "State is required!";
        } elseif (empty($country)) {
            $this->response['message'] = "Please enter Country!";
        } elseif (empty($telephone)) {
            $this->response['message'] = "Telephone is required!";
        } elseif (empty($birth_date)) {
            $this->response['message'] = "Birth Date is required!";
        } elseif (empty($convert_date)) {
            $this->response['message'] = "Convert Date is required!";
        } elseif (empty($state_since)) {
            $this->response['message'] = "Sate Since Date is required!";
        }

        if(empty($health_cri_iii_cost)){
            $health_cri_iii_cost = 0;
        }
        if(empty($health_dis_cost)){
            $health_dis_cost = 0;
        }
        if(empty($health_old_cost)){
            $health_old_cost = 0;
        }
        if(empty($house_water_bill)){
            $house_water_bill = 0;
        }
        if(empty($liquid_assets)){
            $liquid_assets = 0;
        }
        if(empty($total_fixed_assets)){
            $total_fixed_assets = 0;
        }
        
        if(empty($house_electric_bill)){
            $house_electric_bill = 00.00;
        }
        if(empty($house_maint_bill)){
            $house_maint_bill = 00.00;
        }

        if (!isset($this->response['message'])) {
            $sql = "UPDATE `all_members` SET `name`='$name',`mosque_id`='$mosque_id',`address1`='$address1',`address2`='$address2',`area`='$area',`city`='$city',`postcode`='$postcode',`state`='$state',`country`='$country',`telephone`='$telephone',`id_type`='$id_type',`id_no`='$id_no',`id_international`='$id_international',`birth_date`='$birth_date',`birth_state`='$birth_state',`birth_country`='$birth_country',`married_status`='$married_status',`convert_date`='$convert_date',`citizenship`='$citizenship',`state_since`='$state_since',`race`='$race',`edu`='$edu',`edu_others`='$edu_others',`health_good`='$health_good',`health_cri_iii`='$health_cri_iii',`health_cri_iii_cost`='$health_cri_iii_cost',`health_dis`='$health_dis',`health_dis_rea`='$health_dis_rea',`health_dis_severe`='$health_dis_severe',`health_dis_cost`='$health_dis_cost',`health_old`='$health_old',`health_old_cost`='$health_old_cost',`house_acc`='$house_acc',`house_prov`='$house_prov',`house_land`='$house_land',`house_land_others`='$house_land_others',`house_type`='$house_type',`house_type_others`='$house_type_others',`house_made_of`='$house_made_of',`house_condition`='$house_condition',`house_water`='$house_water',`house_water_bill`='$house_water_bill',`house_electric`='$house_electric',`house_electric_bill`='$house_electric_bill',`house_maint`='$house_maint',`house_maint_bill`='$house_maint_bill',`basic_skills`='$basic_skills',`basic_skills_others`='$basic_skills_others',`liquid_assets`='$liquid_assets',`total_fixed_assets`='$total_fixed_assets',`family_head_name`='$family_head_name',`head_id_type`='$head_id_type',`head_id_no`='$head_id_no',`family_head_relation`='$family_head_relation',`family_head_relation_other`='$family_head_relation_other',`pay_method`='$pay_method',`pay_method_reason`='$pay_method_reason',`bank_name`='$bank_name',`bank_account_no`='$bank_account_no',`bank_account_holder_name`='$bank_account_holder_name',`notes`='$notes',`nick_name`='$nick_name',`life_condition`='$life_condition' WHERE `Identification_id`= $Identification_id";
            $query = $this->db->runquery($sql);
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
            $sql = "DELETE FROM `all_members` WHERE `Identification_id`='$Identification_id'";
            $query = $this->db->runquery($sql);
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