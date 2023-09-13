



// Get the toggle button element
const toggleButton = document.getElementById('toggleButton');

// Function to toggle inverted colors
function toggleInvertedColors() {
    document.body.classList.toggle('inverted');
}

// Add a click event listener to the button
toggleButton.addEventListener('click', toggleInvertedColors);
