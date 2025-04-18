document.addEventListener("DOMContentLoaded", function () {
  const courseData = JSON.parse(localStorage.getItem("courseData"));

  if (!courseData) {
    alert("No data found! Redirecting...");
    window.location.href = "index.html";
    return;
  }


  document.getElementById("preview-code").value = courseData.course_code || "No Course Code";
  document.getElementById("preview-title").value = courseData.title || "No Title Provided";
  document.getElementById("preview-stream").value = courseData.stream || "No Stream Selected";

  const unitContainer = document.getElementById("preview-units");

  courseData.units.forEach((unit, index) => {
    const unitDiv = document.createElement("div");
    unitDiv.className = "bg-gray-100 p-4 rounded-lg shadow-md mb-4";

    unitDiv.innerHTML = `
      <label class="block text-gray-700 font-medium">Unit Name:</label>
      <input type="text" value="${unit}" class="unit-input w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">

      <label class="block text-gray-700 font-medium mt-2">Topics:</label>
      <textarea class="topic-input w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500">${courseData.syllabus[index]}</textarea>
    `;

    unitContainer.appendChild(unitDiv);
  });

  
  document.getElementById("edit").addEventListener("click", function () {
    const firstUnitInput = document.querySelector(".unit-input");
    if (firstUnitInput) {
      firstUnitInput.focus();
    }
  });

  // Save Updated Data
  document.getElementById("save").addEventListener("click", function () {
    const updatedUnits = [];
    const updatedTopics = [];

    document.querySelectorAll(".unit-input").forEach((input) => updatedUnits.push(input.value.trim()));
    document.querySelectorAll(".topic-input").forEach((textarea) => updatedTopics.push(textarea.value.trim()));

    courseData.units = updatedUnits;
    courseData.syllabus = updatedTopics;

    localStorage.setItem("courseData", JSON.stringify(courseData));

    alert("Changes Saved!");
  });

  // Go Back to Edit
  document.getElementById("back").addEventListener("click", function () {
    window.location.href = "index.html";
  });
});


