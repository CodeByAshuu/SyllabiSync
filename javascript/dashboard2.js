
const teacherNameElement = document.getElementById("profile-link");

async function fetchTeacherFirstName() {
    try {
        // 1. Make the API request
        const response = await fetch('get_teacher_profile.php');
        
        // 2. Check if the request was successful
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        // 3. Parse the JSON response
        const result = await response.json();
        
        // 4. Check if the API call was successful and data exists
        if (result.success && result.data) {
            // 5. Access the firstName from the data object
            teacherNameElement.textContent = result.data.firstName;
        } else {
            console.error('API error:', result.error || 'No data returned');
            teacherNameElement.textContent = "Teacher"; // Fallback
        }
    } catch (error) {
        console.error('Error fetching teacher name:', error);
        teacherNameElement.textContent = "Teacher"; // Fallback
    }
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', fetchTeacherFirstName);