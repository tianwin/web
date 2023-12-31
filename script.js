



// Get the toggle button element
const toggleButton = document.getElementById('toggleButton');

// Function to toggle inverted colors
function toggleInvertedColors() {
    document.body.classList.toggle('inverted');
}

// Add a click event listener to the button
toggleButton.addEventListener('click', toggleInvertedColors);

// Function to increment and display the access count
function updateAccessCount() {
    // Check if the access count is stored in local storage
    if (localStorage.getItem("accessCount") === null) {
        // If not, initialize it to 1
        localStorage.setItem("accessCount", "1");
    } else {
        // If it exists, increment it by 1
        var currentCount = parseInt(localStorage.getItem("accessCount"));
        currentCount++;
        localStorage.setItem("accessCount", currentCount.toString());
    }

    // Display the access count in the "accessCount" span
    document.getElementById("accessCount").textContent = localStorage.getItem("accessCount");
}

// Call the updateAccessCount function when the page loads
updateAccessCount();

