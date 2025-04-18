document.getElementById("upload").addEventListener("click", function () {
  const stream = document.getElementById("js-stream").value.trim();
  const title = document.getElementById("js-title").value.trim();
  const course_code = document.getElementById("js-code").value.trim();

  if (!stream || !title || !course_code) {
    alert("Please fill in all fields before uploading.");
    return;
  }

  const data = {
    stream: stream,
    course_code: course_code,
    title: title,
    units: [],
    syllabus: []
  };

  let allUnits = document.querySelectorAll("#js-unit-adder-son");

  for (let i = 0; i < allUnits.length; i++) {
    let unit = allUnits[i];

    let unit_name = unit.querySelector("input").value.trim();
    let topics = unit.querySelector("textarea").value.trim();

    data.units.push(unit_name);
    data.syllabus.push(topics);
  }

  localStorage.setItem("courseData", JSON.stringify(data));
  console.log("Data Stored in LocalStorage:", data); // Debugging check

  window.location.href = "preview.html"; 
});
