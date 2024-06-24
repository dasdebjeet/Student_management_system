<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (basename(__FILE__, '.php') == 'index'){echo 'Student DBMS | '.'Login';}else{echo 'Student DBMS | '.ucfirst(basename(__FILE__, '.php'));}?></title>

    <link rel="stylesheet" href="./css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="stylesheet" href="./css/dashboard.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">

    <!-- css -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="./js/dashboard.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>


    <!-- bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="dashboard_con flexc">
                <div class="sub_grp1 flexc">
                    <div class="dashboard_navbar flexc">
                        <div class="icon_con flexc active" icon-name="report"><i class='bx bx-bar-chart'></i></div>
                        <div class="icon_con flexc" icon-name="report"><i class='bx bx-file'></i></div>
                        <div class="icon_con flexc" icon-name="report"><i class='bx bx-calendar' ></i></div>
                        <div class="icon_con flexc" icon-name="report"><i class='bx bx-cog' ></i></div>
                    </div>
                    <div class="dashboard_report_con">
                        <h1 class="heading anton_font">Hola <span class="student_name anton_font">Buddy</span> 👋</h1>
                        <p class="head_subtitle">Let's do some productive activities today.</p>
                        <div class="summary_report">
                            <h2 class="">Summary Report</h2>
                            <div class="summary_report_data flexc">
                                <div class="report_data">
                                    <div class="title">Attendence</div>
                                    <div class="count"><span class="anton_font">70</span> / 89</div>
                                    <p class="details">Great, you always attending class, keep it up!</p>
                                </div>
                                <div class="report_data">
                                    <div class="title">Task</div>
                                    <div class="count"><span class="anton_font">156</span> / 190</div>
                                    <p class="details">Don't forget to turn in your task</p>
                                </div>
                                <div class="report_data">
                                    <div class="title">Test</div>
                                    <div class="count"><span class="anton_font">12</span> / 15</div>
                                    <p class="details">You have done 12 test in this semester</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub_grp2 flexc">
                    <div class="student_profile_con flexc">
                        <img src="" alt="" class="student_img">
                        <div class="profile_details flexc">
                            <div class="student_fullname anton_font">John Doe</div>
                            <div class="student_course"></div>
                            <div class="student_yearSem"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>