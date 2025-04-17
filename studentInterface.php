<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend_backend";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stream = isset($_GET['stream']) ? $_GET['stream'] : '';
$subject = isset($_GET['subject_name']) ? $_GET['subject_name'] : '';

$query = "SELECT * FROM syllabus_approvals WHERE status='Approved'";
if (!empty($stream)) {
    $query .= " AND stream = '" . mysqli_real_escape_string($conn, $stream) . "'";
}
if (!empty($subject)) {
    $query .= " AND subject_name = '" . mysqli_real_escape_string($conn, $subject) . "'";
}
$result = mysqli_query($conn, $query);

$stream_options = mysqli_query($conn, "SELECT DISTINCT stream FROM syllabus_approvals WHERE status='Approved'");
$subject_options = mysqli_query($conn, "SELECT DISTINCT subject_name FROM syllabus_approvals WHERE status='Approved'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Curriculum Viewer</title>
    <link rel="stylesheet" href="/src/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <h1 class="text-4xl font-bold text-blue-800 mb-10 text-center flex items-center justify-center gap-3">
        <i class="fas fa-book-open text-blue-700 text-3xl"></i>
        Curriculum Viewer
    </h1>

    <form method="GET" class="mb-12 flex justify-center gap-6 flex-wrap">
        <select name="stream" class="px-4 py-2 rounded-md border border-gray-300 w-60 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">Select Stream</option>
            <?php while ($row = mysqli_fetch_assoc($stream_options)) { ?>
                <option value="<?php echo $row['stream']; ?>" <?php echo ($stream == $row['stream']) ? 'selected' : ''; ?>>
                    <?php echo $row['stream']; ?>
                </option>
            <?php } ?>
        </select>
        <select name="subject_name" class="px-4 py-2 rounded-md border border-gray-300 w-60 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">Select Subject</option>
            <?php while ($row = mysqli_fetch_assoc($subject_options)) { ?>
                <option value="<?php echo $row['subject_name']; ?>" <?php echo ($subject == $row['subject_name']) ? 'selected' : ''; ?>>
                    <?php echo $row['subject_name']; ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300 flex items-center gap-2">
            <i class="fas fa-filter"></i> Filter
        </button>
    </form>

    <div class="max-w-7xl mx-auto">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="bg-white border border-gray-200 p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <h2 class="text-xl font-semibold text-blue-700 mb-2">
                            <?php echo $row['university_name']; ?>
                        </h2>
                        <p class="text-gray-700 mb-1"><span class="font-medium">Subject:</span> <?php echo $row['subject_name']; ?></p>
                        <p class="text-gray-700 mb-1"><span class="font-medium">Stream:</span> <?php echo $row['stream']; ?></p>
                        <p class="text-gray-700 mb-4"><span class="font-medium">Uploaded:</span> <?php echo date('Y-m-d', strtotime($row['uploaded_at'])); ?></p>
                        <a href="viewCurriculum.php?id=<?php echo $row['id']; ?>" target="_blank" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                            <i class="fas fa-file-pdf mr-2"></i> View PDF
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="text-center text-red-600 text-lg font-medium mt-10">No records found</div>
        <?php } ?>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
