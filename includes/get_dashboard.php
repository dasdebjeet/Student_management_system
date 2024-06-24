<?php
require_once "../config/setting.php";

class StudentInfo extends database {    
    public function student_details($username){
        $stmt = $this->connect()->prepare("SELECT * FROM `student_data` WHERE username=? LIMIT 1");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if($result){
            return json_encode(["success" => true, "data" => $result]);
        } else {
            return json_encode(["success" => false, "message" => "Failed to fetch student details."]);
        }
    }
}

// Check if the POST parameter 'username' is set
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    
    $obj = new StudentInfo();
    $result = $obj->student_details($username);
    echo $result;
} else {
    // Return an error JSON response if 'username' is not set
    echo json_encode(["success" => false, "message" => "Username parameter is missing."]);
}
?>
