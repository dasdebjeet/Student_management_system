<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>cpassword | Student DBMS</title> -->
    <title><?php if (str_replace('_', ' ', basename(__FILE__, '.php')) == 'index'){echo 'Student DBMS | '.'cpassword';}else{echo 'Student DBMS | '.ucfirst(str_replace('_', ' ', basename(__FILE__, '.php')));}?></title>

    <link rel="stylesheet" href="./css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="stylesheet" href="./css/login_signup.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">

    <!-- css -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./js/create_password.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>


    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper flexc" style="background: url('./assests/cpassword_page_bg.jpg') no-repeat; background-position: center;">
        <div class="error_msg_con flexc">
            <i class='bx bx-error'></i>
            <p class="error_msg"></p>
        </div>

        <div class="container flexc">
            <form class="cpassword_form" autocomplete="new-password">
                <h1 class="cpassword_head flexc">Create password</h1>
                <p class="cpassword_info flexc">Hey enter your details to create new password</p>
                <div class="label_grp1 flexc" style="margin-bottom: 20px;">
                    <i class='bx bx-user'></i>
                    <input type="text" name="username" id="username" placeholder="Enter new username" autocomplete="username">
                </div>
                <div class="label_grp1 flexc">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="new_password" id="new_password" placeholder="Enter new your password" autocomplete="new-password">
                </div>
                <div class="label_grp1 flexc">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" autocomplete="new-password">
                </div>
                <button class="cpassword_btn" type="Submit">Create</button>
                <p class="signup_info">Go back to <a href="./index.php" id="signupLink">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>