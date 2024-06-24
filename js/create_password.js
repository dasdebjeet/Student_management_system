$(document).ready(() => {
    $(".cpassword_form").on('submit', (e) => {
        e.preventDefault();
        // Get the current URL
        let currentUrl = window.location.href;

        // Use a function to extract the query parameter
        function getUrlParameter(name) {
            name = name.replace(/[\[\]]/g, '\\$&');
            let regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(currentUrl);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        let code = getUrlParameter('code');
        const formData = $(".cpassword_form").serialize() + '&form_name=cpassword_form' + '&student_id=' + code;

        // Make an AJAX POST request
        $.ajax({
            type: 'POST',
            url: './includes/get_password.php',
            data: formData
        }).done((response) => {
            console.log(response)
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
                window.location.href = "index.php";
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
})