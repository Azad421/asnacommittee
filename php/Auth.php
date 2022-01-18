<?php



namespace classes;



class Auth

{

    public $db;
    public $response;



    public function __construct($db)
    {
        $this->db = $db;
    }


    public function userLogin($data)
    {
        $user_name = $this->db->realString($data['user_name']);
        $password = $this->db->realString($data['user_password']);
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($user_name)) {
            $this->response['message'] = "Please enter User name!";
        } elseif (empty($password)) {
            $this->response['message'] = "Please enter a valid password!";
        }

        if (!isset($this->response['message'])) {
            $sql = "SELECT * FROM `commitee` INNER JOIN `all_members` ON commitee.Identification_id = all_members.Identification_id  WHERE `asnaf_name`='$user_name'";
            $query = $this->db->runquery($sql);
            if ($query->num_rows == 1) {
                $row = $query->fetch_assoc();
                $hass_pas = $row['password'];
                if (password_verify($password, $hass_pas)) {
                    $loggedin['user_logged_in'] = true;
                    $loggedin['logged_in_id'] = $row['committee_id'];
                    $loggedin['logged_in_mosque'] = $row['mosque_Id'];
                    $_SESSION['loggedin'] = $loggedin;
                    $this->response['status'] = 1;
                    $this->response['type'] = 'success';
                    $this->response['message'] = "Logged in successfully";
                } else {
                    $this->response['message'] = "Please enter a valid User Name or password";
                }
            } else {
                $this->response['message'] = "Please enter a valid User Name or password";
            }
        }
        return $this->response;
    }



    public function adminLogin($data)

    {
        $user_name = $this->db->realString($data['user_name']);
        $password = $this->db->realString($data['user_password']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($user_name)) {
            $this->response['message'] = "Please enter User name!";
        } elseif (empty($password)) {
            $this->response['message'] = "Please enter a valid password!";
        }

        if (!isset($this->response['message'])) {
            $sql = "SELECT * FROM `admin`  WHERE `admin_name`='$user_name' AND `password`='$password'";
            $query = $this->db->runquery($sql);
            if ($query->num_rows == 1) {
                $row = $query->fetch_assoc();
                $loggedin['admin_logged_in'] = true;
                $loggedin['logged_in_id'] = $row['admin_id'];
                $_SESSION['admin_loggedin'] = $loggedin;
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = "Logged in successfully";
            } else {
                $this->response['message'] = "Please enter a valid User Name or password";
            }
        }
        return $this->response;
    }
}
