$(document).ready(() => {
    $('#signupLink').click(function(e) {
        e.preventDefault();
        $('.container').addClass('transition-active');
    });

    $('.go_backLink').click(function(e) {
        e.preventDefault();
        $('.container').removeClass('transition-active');
    });

    // Photo uploader
    $('#uploadBtn').on('click', function() {
        $('#studentPhoto').click();
    });

    $('#studentPhoto').on('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#studentPhotoPreview').html('<img src="' + e.target.result + '" alt="Photo">');
            }
            reader.readAsDataURL(file);
        }
    });


    // Handle form submission
    $(".login_form").on('submit', (e) => {
        e.preventDefault();
        // Serialize the form data
        const formData = $(".login_form").serialize() + '&form_name=login_form';

        // Make an AJAX POST request
        $.ajax({
            type: 'POST',
            url: './includes/get_login_signup.php',
            data: formData
        }).done((response) => {
            // console.log(response)
            let data;
            try {
                data = JSON.parse(response);
            } catch (error) {
                console.error('Error parsing JSON:', error);
                showError('An unexpected error occurred.');
                return;
            }

            // Check if the login was successful
            if (data.success === "true") {
                var username = $('#username').val();
                // sessionStorage.setItem('username', username);

                $('html').load("dashboard.php")
                // window.location.href = "dashboard.php";

                // load dashboard 
                if (username) {
                    $.ajax({
                        type: 'POST',
                        url: './includes/get_dashboard.php',
                        data: { 'username': username },
                        dataType: 'json', // Specify JSON dataType for proper parsing
                        success: function(response) {
                            // console.log(response); // Log the entire response for debugging
        
                            if (response.success === true) { // Check response.success as boolean
                                // console.log('Dashboard data fetched successfully.')
        
                                var data = response.data
                                load_data(data.username, data.name, data.course, data.year, data.semester, data.image_name)
                                console.log(data)
                            } else {
                                console.error('Error fetching dashboard data:', response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // console.error('AJAX request failed:', jqXHR, textStatus, errorThrown);
                            showError('A network error occurred. Please try again.');
                        }
                    });
                } else {
                    console.error("Error: Username not found in sessionStorage.");
                }
        
                var load_data = (username, name, course, year, semester, filename) => {
                    // console.log(username, name, course, year, semester, filename)
            
                    $(".student_img").attr("src", './uploads/' + filename)
                    $(".student_name").text(username)
                    $(".student_fullname").text(name)
                    $(".student_course").text(course)
                    $(".student_yearSem").html('<span class="student_sem">'+ semester +'</span> | <span class="student_year">'+ year +'</span>')
                }
            } else {
                showError(data.message);
            }
        }).fail((jqXHR, textStatus, errorThrown) => {
            console.error('AJAX request failed:', jqXHR, textStatus, errorThrown);
            showError('A network error occurred. Please try again.');
        });
    });



    $(".signup_form").on('submit', (e) => {
        e.preventDefault();
        const formData = new FormData($(".signup_form")[0]);
        formData.append('form_name', 'signup_form');
        $.ajax({
            type: 'POST',
            url: './includes/get_login_signup.php',
            data: formData,
            contentType: false,
            cache: false,
            processData:false
        }).done((response) => {
            // console.log(response)
            let data;
            try {
                data = JSON.parse(response);
            } catch (error) {
                console.error('Error parsing JSON:', error);
                showError('An unexpected error occurred.');
                return;
            }
            // Check if the login was successful
            if (data.success == "true") {
                window.location.href = "create_password.php?code="+data.code;
                // console.log(response)
            } else {
                showError(data.message);
            }
        }).fail((jqXHR, textStatus, errorThrown) => {
            console.error('AJAX request failed:', jqXHR, textStatus, errorThrown);
            showError('A network error occurred. Please try again.');
        });
    });
    

    // Function to show error messages
    function showError(message) {
        $('.error_msg_con').addClass('visible');
        $(".error_msg").html('Error: ' + message);
        setTimeout(() => {
            $('.error_msg_con').removeClass('visible');
        }, 3000);
    }

    $('#number').on('input', function(e) {
        var inputValue = $(this).val().replace(/[^\d]/g, ''); // Remove non-numeric characters
        
        if (inputValue.length > 0) {
            var formattedNumber = '+' + inputValue.slice(0, 2) + ' ' + inputValue.slice(2, 12);
            $(this).val(formattedNumber);
        }
    });

    $('#number').on('keydown', function(e) {
        if (e.key === 'Backspace' || e.key === 'Delete') {
            var inputValue = $(this).val().replace(/[^\d]/g, ''); // Remove non-numeric characters
            
            if (e.key === 'Backspace') {
                inputValue = inputValue.slice(0, -1); // Remove the last character for Backspace
            } else if (e.key === 'Delete') {
                inputValue = inputValue.slice(0, -2) + inputValue.slice(-1); // Remove second last character for Delete
            }
            
            if (inputValue.length === 0) {
                $(this).val(''); // Clear the input if no characters left
            } else {
                var formattedNumber = '+' + inputValue.slice(0, 2) + ' ' + inputValue.slice(2, 12);
                $(this).val(formattedNumber);
            }
        }
    });

    $('#session').on('input', function(e) {
        var inputValue = $(this).val().replace(/[^\d-]/g, ''); // Remove non-numeric and non-dash characters
        
        if (inputValue.length > 0) {
            var formattedSession = inputValue.slice(0, 9).replace(/(\d{4})(\d{0,4})?/, function(match, p1, p2) {
                if (p2) {
                    return p1 + '-' + p2.slice(0, 4); // Format as "2023-2025"
                } else {
                    return p1; // Keep the value as-is if not enough numbers
                }
            });
            $(this).val(formattedSession);
        }
    });

    $('#session').on('keydown', function(e) {
        if (e.key === 'Backspace' || e.key === 'Delete') {
            var inputValue = $(this).val().replace(/[^\d-]/g, ''); // Remove non-numeric and non-dash characters
            
            if (inputValue.length === 1) {
                $(this).val(''); // Clear the input if only one character left
            } else if (inputValue.length > 1) {
                var formattedSession = inputValue.slice(0, 9).replace(/(\d{4})(\d{0,4})?/, function(match, p1, p2) {
                    if (p2) {
                        return p1 + '-' + p2.slice(0, 4); // Format as "2023-2025"
                    } else {
                        return p1; // Keep the value as-is if not enough numbers
                    }
                });
                $(this).val(formattedSession);
            }
        }
    });

    // Populate day options
    const $daySelect = $('.day-select');
    for (let day = 1; day <= 31; day++) {
        $daySelect.append(new Option(day, day));
    }

    // Populate month options
    const $monthSelect = $('.month-select');
    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    months.forEach((month, index) => {
        $monthSelect.append(new Option(month, index + 1));
    });

    // Populate year options
    const $yearSelect = $('.year-select');
    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 100;
    for (let year = currentYear; year >= startYear; year--) {
        $yearSelect.append(new Option(year, year));
    }

    // Populate country options
    const $countrySelect = $('.country-select');
    const countries = [
        "India", "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
        "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain",
        "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan",
        "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria",
        "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada",
        "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros",
        "Congo, Democratic Republic of the", "Congo, Republic of the", "Costa Rica",
        "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
        "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea",
        "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia",
        "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana",
        "Haiti", "Honduras", "Hungary", "Iceland", "Indonesia", "Iran", "Iraq", "Ireland",
        "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
        "Korea, North", "Korea, South", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia",
        "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg",
        "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands",
        "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia",
        "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal",
        "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Macedonia",
        "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru",
        "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda",
        "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",
        "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
        "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia",
        "South Africa", "Spain", "Sri Lanka", "Sudan", "Sudan, South", "Suriname", "Sweden",
        "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste",
        "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu",
        "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States",
        "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen",
        "Zambia", "Zimbabwe"
    ];
    countries.forEach((country) => {
        $countrySelect.append(new Option(country, country));
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
});
