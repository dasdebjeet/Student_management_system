<?php
require_once "../config/setting.php";

class Password extends database {    
    public function new_password($username, $student_id, $password){
        $stmt = $this->connect()->prepare("INSERT INTO `student_credentials` (`credential_id`, `student_id`, `password`) VALUES (NULL, ?, ?)");
        $flag = $stmt->execute([$student_id, $password]);
        if($flag){
            $stmt = $this->connect()->prepare("UPDATE `student_data` SET username=? WHERE student_id=? LIMIT 1;");
            $stmt->execute([$username, $student_id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($flag){
                return '{"success": "true", "message": "Successfully created new password!"}';
            }else{
                return '{"success": "false", "message": "Failed to created new password!"}';
            }
        }
    }
}

if ($_POST['form_name'] == 'cpassword_form') {    
    if (isset($_POST['username']) && isset($_POST['new_password']) && isset($_POST['confirm_password']) && $_POST['username']!='' && $_POST['new_password']!='' && $_POST['confirm_password']!='') {
        $username = $_POST['username'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $student_id = $_POST['student_id'];
        
        if ($new_password != $confirm_password){
            header('Content-Type: application/json');
            $response = '{"success": "false", "message": "Password mismatch!"}';
            echo json_encode($response);
        }else{
            $password_hash = password_hash($confirm_password, PASSWORD_DEFAULT);

            $obj = new Password();
            $result = $obj->new_password($username, $student_id, $password_hash);
            echo $result;
        }
    } else {
        header('Content-Type: application/json');
        $response = '{"success": "false", "message": "Invalid credentials!"}';
        echo json_encode($response);
    }
}
?>