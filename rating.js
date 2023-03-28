$(function () {
    
    // Initialize RateYo
    $("#rating").rateYo({
        rating: 3.5,
        halfStar: true,
        precision: 1,
        onSet: function (rating, rateYoInstance) {
            // Set the rating input value when the rating is changed
            $('#rating-input').val(rating);
            // display result
            $('#results').text(rating);
        }
    });

    
    // Handle form submission
    $('#submit-btn').click(function(e) {
        e.preventDefault();

        if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false' ?>) {
            $('#error-message').css('display', 'block');
            return;
        }
        
        // Get the rating value and story ID
        var rating = $('#rating-input').val();
        var story_id = $('#story_id').val();
    
        // Post the rating to the server using AJAX
        $.ajax({
            url: './rate_story.php',
            type: 'POST',
            data: { rating: rating, story_id: story_id},
            success: function(data) {
                // Handle the server response
                console.log("Rating saved!");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ' + textStatus + ' ' + errorThrown);
            }
        });
    });
});
