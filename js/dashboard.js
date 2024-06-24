// $(document).ready(function() {
//     setTimeout(function() {
//         var username = sessionStorage.getItem('username');

//         if (username) {
//             $.ajax({
//                 type: 'POST',
//                 url: './includes/get_dashboard.php',
//                 data: { 'username': username },
//                 dataType: 'json', // Specify JSON dataType for proper parsing
//                 success: function(response) {
//                     // console.log(response); // Log the entire response for debugging

//                     if (response.success === true) { // Check response.success as boolean
//                         console.log('Dashboard data fetched successfully.')

//                         var data = response.data
//                         load_data(data.username, data.name, data.course, data.year, data.semester, data.image_name)
//                         console.log(data)
//                     } else {
//                         console.error('Error fetching dashboard data:', response.message);
//                     }
//                 },
//                 error: function(jqXHR, textStatus, errorThrown) {
//                     console.error('AJAX request failed:', jqXHR, textStatus, errorThrown);
//                     showError('A network error occurred. Please try again.');
//                 }
//             });
//         } else {
//             console.error("Error: Username not found in sessionStorage.");
//             // Handle the scenario where username is not found in sessionStorage
//             // showError('Username not found.');
//         }
//     }, 300); // Delayed execution of AJAX request (300 milliseconds)

//     var load_data = (username, name, course, year, semester, filename) => {
//         console.log(username, name, course, year, semester, filename)

//         $(".student_img").attr("src", './uploads/' + filename)
//         $(".student_name").text(username)
//         $(".student_fullname").text(name)
//         $(".student_course").text(course)
//         $(".student_yearSem").html('<span class="student_sem">'+ semester +'</span> | <span class="student_year">'+ year +'</span>')
//     }
// });
