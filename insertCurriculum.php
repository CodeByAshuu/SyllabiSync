<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect("localhost", "root", "", "curriculum_admin");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $course_name = $_POST['course_name'];
    $department = $_POST['department'];
    $university = $_POST['university'];
    $status = 'Pending';
    $admin_name = NULL;
    $updated_at = date('Y-m-d H:i:s');

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $pdf = file_get_contents($_FILES['pdf']['tmp_name']);
        $pdf_type = $_FILES['pdf']['type'];

        $stmt = mysqli_prepare($conn, "INSERT INTO course_curriculums (course_name, department, university, status, admin_name, updated_at, curriculum_pdf, curriculum_pdf_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssssss", $course_name, $department, $university, $status, $admin_name, $updated_at, $pdf, $pdf_type);
        mysqli_stmt_send_long_data($stmt, 6, $pdf);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "Curriculum inserted successfully.";
    } else {
        echo "Error uploading PDF.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Curriculum</title>
</head>
<body>
    <h2>Insert Curriculum</h2>
    <form action="insertCurriculum.php" method="POST" enctype="multipart/form-data">
        <label>Course Name:</label><br>
        <input type="text" name="course_name" required><br><br>
        <label>Department:</label><br>
        <input type="text" name="department" required><br><br>
        <label>University:</label><br>
        <input type="text" name="university" required><br><br>
        <label>Upload Curriculum PDF:</label><br>
        <input type="file" name="pdf" accept="application/pdf" required><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
