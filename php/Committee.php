<?php

namespace classes;

class Committee
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function removeCommitte($data)
    {
        $committee_id = $data['committee_id'];
        $sql = "DELETE FROM `commitee` WHERE `committee_id`='$committee_id'";
        $query = $this->db->runquery($sql);
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($query) {
            $this->response['status'] = 1;
            $this->response['type'] = 'success';
            $this->response['message'] = 'Successfully Removed From Committee';
            $this->response['url'] = 'committee.php';
        } else {
            $this->response['message'] = 'Mosque could not be Removed!';
        }
        return $this->response;
    }

    public function updateData($data)
    {
        $committee_id = $data['committee_id'];
        $mosque_id = $this->db->realString($data['mosque_id']);
        $asnaf_name = $this->db->realString($data['asnaf_name']);
        $position = $this->db->realString($data['position']);
        $Identification_id = $this->db->realString($data['Identification_id']);
        if (empty($mosque_id) || empty($asnaf_name) || empty($position)) {
            $this->response['message'] = "Filedes are required!";
        } elseif ($this->db->checkUniqe("commitee", 'asnaf_name', $asnaf_name, 'committee_id', $committee_id)) {
            $this->response['message'] = "Login Id already already exists!";
        }
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (!isset($this->response['message'])) {
            $sql = "UPDATE `commitee` SET `mosque_Id`='$mosque_id',`asnaf_name`='$asnaf_name',`position`='$position' WHERE `committee_id`='$committee_id' AND `Identification_id`='$Identification_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Committee Successfully Updated';
                $this->response['url'] = 'committee.php';
            } else {
                $this->response['message'] = 'Committee could not be updated!';
            }
        }
        return $this->response;
    }

    public function adminCnagepassword($data)
    {
        $committee_id = $data['committee_id'];
        $new_passowrd = $this->db->realString($data['new_passowrd']);
        $confirm_password = $this->db->realString($data['confirm_password']);
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($new_passowrd) || empty($confirm_password)) {
            $this->response['message'] = "Filedes are required!";
        } elseif ($new_passowrd !== $confirm_password) {
            $this->response['message'] = "Password didn't match please try the same password!";
        }
        if (!isset($this->response['message'])) {
            $new_passowrd = password_hash($new_passowrd, PASSWORD_DEFAULT);
            $sql = "UPDATE `commitee` SET `password`='$new_passowrd' WHERE `committee_id`='$committee_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Password Successfully Changed';
                $this->response['url'] = 'committee.php';
            } else {
                $this->response['message'] = 'Password could not be Changed!';
            }
        }
        return $this->response;
    }

    public function updateLoginId($data)
    {
        $committee_id = $data['committee_id'];
        $asnaf_name = $this->db->realString($data['login_id']);
        if (empty($asnaf_name)) {
            $this->response['message'] = "Filedes are required!";
        } elseif ($this->db->checkUniqe("commitee", 'asnaf_name', $asnaf_name, 'committee_id', $committee_id)) {
            $this->response['message'] = "Login Id already already exists!";
        }
        if (!isset($this->response['message'])) {
            $sql = "UPDATE `commitee` SET`asnaf_name`='$asnaf_name' WHERE `committee_id`='$committee_id' ";
            $query = $this->db->runquery($sql);
            $this->response['status'] = 0;
            $this->response['type'] = 'error';
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Committee Successfully Updated';
                $this->response['url'] = 'update.php';
            } else {
                $this->response['message'] = 'Committee could not be updated!';
            }
        }
        return $this->response;
    }


    public function cnagepassword($data)

    {
        $old_password = $this->db->realString($data['old_password']);
        $new_password = $this->db->realString($data['new_password']);
        $confirm_password = $this->db->realString($data['confirm_password']);
        $committee_id = $this->db->realString($data['committee_id']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($old_password)) {
            $this->response['message'] = "Please enter Old password!";
        } elseif (empty($new_password)) {
            $this->response['message'] = "Please enter New password!";
        } elseif (empty($confirm_password)) {
            $this->response['message'] = "Please enter Confirm Password!";
        } elseif ($new_password !== $confirm_password) {
            $this->response['message'] = "Confirm password did not mathed!";
        }

        if (!isset($this->response['message'])) {
            $sql = "SELECT * FROM `commitee`  WHERE `committee_id`='$committee_id'";
            $query = $this->db->runquery($sql);
            if ($query->num_rows == 1) {
                $row = $query->fetch_assoc();
                $user_pass = $row['password'];
                if (password_verify($old_password, $user_pass)) {
                    $confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);
                    $sql = "UPDATE `commitee` SET `password`='$confirm_password' WHERE `committee_id`='$committee_id'";
                    $query = $this->db->runquery($sql);
                    if ($query) {
                        $this->response['status'] = 1;
                        $this->response['type'] = 'success';
                        $this->response['message'] = "Password changed successfully!";
                        $this->response['url'] = "update.php";
                    } else {
                        $this->response['message'] = "Something is worng please try again!";
                    }
                } else {
                    $this->response['message'] = "Old password is not correct!";
                }
            } else {
                $this->response['message'] = "Something is worng please try again!";
            }
        }
        return $this->response;
    }
}
