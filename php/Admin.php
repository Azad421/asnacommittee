<?php



namespace classes;



class Admin

{

    public $db;
    public $response;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function changeUsername($data)
    {
        $admin_id = $this->db->realString($data['admin_id']);
        $user_name = $this->db->realString($data['user_name']);
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($user_name)) {
            $this->response['message'] = "Please enter User name!";
        }

        if (!isset($this->response['message'])) {
            $sql = "UPDATE `admin` SET `admin_name`='$user_name' WHERE `admin_id`='$admin_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = "User name updated";
                $this->response['url'] = "members.php";
            } else {
                $this->response['message'] = "User could not be updated";
            }
        }
        return $this->response;
    }



    public function adminCnagepassword($data)

    {
        $old_password = $this->db->realString($data['old_password']);
        $new_password = $this->db->realString($data['new_password']);
        $confirm_password = $this->db->realString($data['confirm_password']);
        $admin_id = $this->db->realString($data['admin_id']);

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
            $sql = "SELECT * FROM `admin`  WHERE `admin_id`='$admin_id'";
            $query = $this->db->runquery($sql);
            if ($query->num_rows == 1) {
                $row = $query->fetch_assoc();
                $user_pass = $row['password'];
                if ($old_password === $user_pass) {
                    $sql = "UPDATE `admin` SET `password`='$confirm_password' WHERE `admin_id`='$admin_id'";
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
