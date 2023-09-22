// Function to increment and display the access count
function updateAccessCount() {
    // Check if the access count is stored in local storage
    if (localStorage.getItem("accessCount") === null) {
        // If not, initialize it to 1
        localStorage.setItem("accessCount", "1");
    } else {
        // If it exists, get the current count, increment it by 1, and store it
        var currentCount = parseInt(localStorage.getItem("accessCount"));
        currentCount++;
        localStorage.setItem("accessCount", currentCount.toString());
    }

    // Display the access count in the "accessCount" span
    document.getElementById("accessCount").textContent = localStorage.getItem("accessCount");
}

// Call the updateAccessCount function when the page loads
window.onload = updateAccessCount;
