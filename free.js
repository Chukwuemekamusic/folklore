document.addEventListener("DOMContentLoaded", function () {
    // the continue button
    const seatButtons = document.querySelectorAll('.seat-button');
    // const continueButton = document.getElementById('submit-seat-btn');
    const continueButton = document.querySelector('#submit-seat-btn');
    const selectedSeatInput = document.querySelector('#selected-seat-input');
    let lastSelectedSeat = '';
    let lastSelectedSeatButton = '';

    // Add event listener to each seat button
    seatButtons.forEach((button) => {
        if (button.id !== 'seat-button-booked') { // exclude the button with ID 'seat-button-booked'
            button.addEventListener('click', () => {
                //get the last selected button value
                lastSelectedSeat = button.value;

                //add the class 'selected' to new button cliked to change color
                // but first we have remove the class 'selected' from any previously selected button
                const selectedButton = document.querySelector('.seat-button.selected');
                if (selectedButton) {
                    selectedButton.classList.remove('selected');
                }

                // add selected class to clicked button
                button.classList.add('selected');

                //get the last selected button value
                lastSelectedSeat = button.value;

                // Show the "Continue" button
                continueButton.style.display = 'block';
            });
        }
    });

    // Add event listener to the button with ID 'seat-button-booked'
    const bookedButton = document.querySelector('#seat-button-booked');
    bookedButton.addEventListener('click', (event) => {
        event.preventDefault(); // prevent default behavior of the button (going to a new page)
        alert('This seat is already booked'); // display a message to the user
    });

    continueButton.addEventListener('click', () => {
        selectedSeatInput.value = lastSelectedSeat;
        if (selectedSeatInput) {
            document.querySelector('#submit_seat_selection').submit();
        } else {
            // handle error - no seat selected
            console.error('No seat selected')
        }
    });
});
