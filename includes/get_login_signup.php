<?php
require_once "../config/setting.php";

class LoginSignup extends database {
    public function login($username, $password){
        $stmt = $this->connect()->prepare("SELECT `student_id` FROM `student_data` WHERE username=? LIMIT 1");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $student_id = $result['student_id'];

            $stmt = $this->connect()->prepare("SELECT `password` FROM `student_credentials` WHERE student_id=? LIMIT 1");
            $stmt->execute([$student_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $result['password'])){
                header('Content-Type: application/json');
                $response = '{"success": "true", "message": "Successfully logged in!"}';
                $response = json_encode($response);
                echo $response;
            } else {
                header('Content-Type: application/json');
                $response = '{"success": "false", "message": "Incorrect Password!"}';
                $response = json_encode($response);
                echo $response;
            }
        }else{
            header('Content-Type: application/json');
            $response = '{"success": "false", "message": "Incorrect Username!"}';
            $response = json_encode($response);
            echo $response;
        }             
    }
    
    public function signup($student_id, $name, $ph_number, $email, $dob, $address, $city, $state, $zip_code, $country, $course, $semester, $year, $session, $newFileName){
        $stmt = $this->connect()->prepare("INSERT INTO `student_data` (`student_id`, `username`, `name`, `number`, `email`, `dob`, `address`, `city`, `state`, `zip_code`, `country`, `course`, `semester`, `year`, `session`, `image_name`) VALUES (?, NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $flag = $stmt->execute([$student_id, $name, $ph_number, $email, $dob, $address, $city, $state, $zip_code, $country, $course, $semester, $year, $session, $newFileName]);
        if($flag){
            return TRUE;
        }
    }
}

if ($_POST['form_name'] == 'login_form') {    
    if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!='' && $_POST['password']!='') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $obj = new LoginSignup();
        $result = $obj->login($username, $password);
        echo $result;
    } else {
        header('Content-Type: application/json');
        $response = '{"success": "false", "message": "Incorrect credentials!"}';
        echo json_encode($response);
    }
}

if ($_POST['form_name'] === 'signup_form') {
    // Initialize variables with default values
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $ph_number = $_POST['number'] ?? '';
    $email = $_POST['email'] ?? '';
    $day = $_POST['day'] ?? '';
    $month = $_POST['month'] ?? '';
    $year = $_POST['year'] ?? '';
    $address_line1 = $_POST['address-line1'] ?? '';
    $address_line2 = $_POST['address-line2'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $zip_code = $_POST['postal-code'] ?? '';
    $country = $_POST['country'] ?? '';
    $course = $_POST['course'] ?? '';
    $course_year = $_POST['course-year'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $session = $_POST['session'] ?? '';
    
    $newFileName = '';
    if (!empty($firstname) && !empty($lastname) && !empty($ph_number) && !empty($email) && !empty($day) && !empty($month) && !empty($year) && !empty($address_line1) && !empty($city) &&
        !empty($state) && !empty($zip_code) && !empty($country) && !empty($course) && !empty($course_year) && !empty($semester) && !empty($session) && isset($_FILES['image'])) {

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            $allowedTypes = ['jpg', 'jpeg', 'png'];

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($_FILES['image']['name']);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array(strtolower($fileType), $allowedTypes)) {
                $newFileName = uniqid() . '.' . $fileType;
                $uploadFilePath = $uploadDir . $newFileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath)) {
                    $imagePath = $uploadFilePath;

                    header('Content-Type: application/json');
                    $response = '{"success": "true", "message": "Image successfully uploaded '.$imagePath.'"}';
                    // echo json_encode($response);
                } else {
                    header('Content-Type: application/json');
                    $response = '{"success": "false", "message": "Failed to move uploaded file."}';
                    // echo json_encode($response);
                }
            } else {
                header('Content-Type: application/json');
                $response = '{"success": "false", "message": "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed."}';
                // echo json_encode($response);
            }
        } else {
            $imagePath = null;
        }

        // Insert new student
        $student_id = $firstname[0].$day.substr($ph_number, -2);
        $name = $firstname . ' ' . $lastname;
        $dob = $day . '/' . $month . '/' . $year;

        if (!empty($address_line2)) {
            $address = $address_line1 . ', ' . $address_line2;
        } else {
            $address = $address_line1;
        }        

        $obj = new LoginSignup();
        $result = $obj->signup($student_id, $name, $ph_number, $email, $dob, $address, $city, $state, $zip_code, $country, $course, $semester, $course_year, $session, $newFileName);
        if($result){
            header('Content-Type: application/json');
            $response = '{"success": "true", "message": "Signup successful!", "code": "'.$student_id.'"}';
            echo json_encode($response);
        }else{
            header('Content-Type: application/json');
            $response = '{"success": "false", "message": "Signup failed!"}';
            echo json_encode($response);
        }
    } else {
        header('Content-Type: application/json');
        $response = '{"success": "false", "message": "All fields are required!"}';
        echo json_encode($response);
    }
}
?>


