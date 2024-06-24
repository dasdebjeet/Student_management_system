<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Login | Student DBMS</title> -->
    <title><?php if (basename(__FILE__, '.php') == 'index'){echo 'Student DBMS | '.'Login';}else{echo 'Student DBMS | '.ucfirst(basename(__FILE__, '.php'));}?></title>

    <link rel="stylesheet" href="./css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="stylesheet" href="./css/login_signup.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">

    <!-- css -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./js/login_signup.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>


    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper flexc">
        <div class="error_msg_con flexc">
            <i class='bx bx-error'></i>
            <p class="error_msg"></p>
        </div>
        <div class="container flexc">
            
            <form class="login_form" autocomplete="new-password">
                <h1 class="login_head flexc">Student Login</h1>
                <p class="login_info flexc">Hey enter your details to sign in to your account</p>
                <div class="label_grp1 flexc">
                    <i class='bx bx-user'></i>
                    <input type="text" name="username" id="username" placeholder="Enter your username" autocomplete="new-password">
                </div>
                <div class="label_grp1 flexc">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password" id="password" placeholder="Enter your password" autocomplete="new-password">
                </div>
                <button class="login_btn" type="Submit">Login</button>
                <p class="signup_info">Don't have a account? <span href="" id="signupLink">Signup Now</span></p>
            </form>
            
            <form class="signup_form" autocomplete="new-password" enctype="multipart/form-data">
                <p class="go_backLink flexc"><i class='bx bx-arrow-back'></i>Go back to login</p>
                <h1 class="signup_head">Student Registration Form</h1>
                <p class="signup_head_info">Hey enter your details to register to your account</p>

                <div class="basic_info">
                    <h2 class="basic_info_head">Basic Information</h2>

                    <div class="block flexc">
                        <div class="label_grp2">
                            <label for="">Student Name</label>
                            <div class="sub_grp1 flexc">
                                <div class="input_wrap" placeholder="First Name"><input class="form-control" type="text" name="firstname" id="firstname" autocomplete="given-name"></div>
                                <div class="input_wrap" placeholder="Last Name"><input class="form-control" type="text" name="lastname" id="lastname" autocomplete="family-name"></div>
                            </div>
                            <div class="sub_grp2">
                                <label for="">Student Number</label>
                                <div class="input_wrap" placeholder="e.g. 91 9075926458"><input class="form-control" type="text" name="number" id="number" autocomplete="tel"></div>
                            </div>                            
                        </div>
                        <div class="photo_con">
                            <label for="studentPhoto">Photo</label>
                            <div class="student_photo_preview" id="studentPhotoPreview"></div>
                            <input type="file" name="image" id="studentPhoto" style="display: none;">
                            <div class="student_photo_upload_btn" id="uploadBtn">Upload Photo</div>
                        </div>
                    </div>

                    <div class="label_grp2">
                        <label for="">Student Email</label>
                        <div class="input_wrap" placeholder="e.g. myname@example.com"><input class="form-control" type="text" name="email" id="email" autocomplete="email"></div>
                    </div>

                    <div class="label_grp2 birth_date">
                        <label for="">Birth Date</label>
                        <div class="sub_grp1 flexc">
                            <div class="input_wrap custom_select" placeholder="Day">
                                <select class="form-select day-select" name="day" autocomplete="bday-day">
                                    <option value="">Please select a day</option>
                                </select>
                            </div>
                            <div class="input_wrap custom_select" placeholder="Month">
                                <select class="form-select month-select" name="month" autocomplete="bday-month">
                                    <option value="">Please select a month</option>
                                </select>
                            </div>
                            <div class="input_wrap custom_select" placeholder="Year">
                                <select class="form-select year-select" name="year" autocomplete="bday-year">
                                    <option value="">Please select a year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="address_info">
                    <h2 class="address_info_head">Address Information</h2>
                    <div class="label_grp2 address">
                        <label for="">Present Address</label>
                        <div class="input_wrap" placeholder="Street Address"><input class="form-control" type="text" id="address-line1" name="address-line1" autocomplete="address-line1" enterkeyhint="next"></div>
                        <div class="input_wrap" placeholder="Street Address line 2"><input class="form-control" type="text" id="address-line2" name="address-line2" autocomplete="address-line2" enterkeyhint="next"></div>
                        <div class="sub_grp1 flexc">
                            <div class="input_wrap" placeholder="City"><input class="form-control" type="text" name="city" autocomplete="address-level2" enterkeyhint="next"></div>
                            <div class="input_wrap" placeholder="State / Province"><input class="form-control" type="text" name="state" id="state"></div>
                        </div>
                        <div class="sub_grp1 flexc">
                            <div class="input_wrap" placeholder="Postal / Zip Code"><input class="form-control" type="text" name="postal-code" autocomplete="postal-code" enterkeyhint="next"></div>
                            <div class="input_wrap custom_select" placeholder="Country">
                                <select class="form-select country-select" name="country">
                                    <option value="">Please select a country</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="academic_info">
                    <h2 class="academic_info_head">Academic Details</h2>
                    <div class="label_grp2 academic">
                        <div class="sub_grp2 flexc">
                            <div class="sub_grp3">
                                <label for="">Course</label>
                                <div class="input_wrap" placeholder="">
                                    <select class="form-select course-select" name="course">
                                        <option value="">Please select</option>
                                        <option value="M. Tech in Computer Science and Engineering">M. Tech in Computer Science and Engineering</option>
                                        <option value="M. Tech in Information Technology">M. Tech in Information Technology</option>
                                        <option value="B. Tech in Computer Science and Engineering">B. Tech in Computer Science and Engineering</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sub_grp3">
                                <label for="">Semester</label>
                                <div class="input_wrap" placeholder="">
                                    <select class="form-select semester-select" name="semester">
                                        <option value="">Please select</option>
                                        <option value="1st Semester">1st Semester</option>
                                        <option value="2nd Semester">2nd Semester</option>
                                        <option value="3rd Semester">3rd Semester</option>
                                        <option value="4th Semester">4th Semester</option>
                                        <option value="5th Semester">5th Semester</option>
                                        <option value="6th Semester">6th Semester</option>
                                        <option value="7th Semester">7th Semester</option>
                                        <option value="8th Semester">8th Semester</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="label_grp2 academic">
                        <div class="sub_grp2 flexc">
                            <div class="sub_grp3">
                                <label for="">Year</label>
                                <div class="input_wrap" placeholder="">
                                    <select class="form-select cyear-select" name="course-year">
                                        <option value="">Please select</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sub_grp3">
                                <label for="">Session</label>
                                <div class="input_wrap" placeholder="e.g. 2024-2026"><input class="form-control" type="text" name="session" id="session" autocomplete="new-password"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="signup_submit_btn_con flexc">
                    <!-- <button type="">Print</button> -->
                    <button type="Submit">Submit Application</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>