<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend_backend";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM syllabus_approvals LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

$total_query = "SELECT COUNT(*) as total FROM syllabus_approvals";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_rows = $total_row['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div class="bg-blue-800 w-72 flex flex-col text-white p-6">
        <div class="flex items-center gap-3 border-b border-white pb-4">
            <i class="fa-solid fa-circle-user text-4xl"></i>
            <p class="text-2xl font-semibold">Admin Name</p>
        </div>
        <nav class="mt-6 space-y-4">
            <a href="admin.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="pendingApproval.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-clock"></i> Pending Approval</a>
            <a href="approvedCurriculum.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-check"></i> Approved Curriculum</a>
            <a href="userManagement.php" class="flex items-center gap-4 p-3 bg-blue-600 rounded-lg"><i class="fa-solid fa-user"></i> User Management</a>
            <a href="#" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-4xl font-bold text-gray-800">User Management</h1>

        <!-- User Table -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-lg overflow-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="px-6 py-3">Subject Name</th>
                        <th class="px-6 py-3">University</th>
                        <th class="px-6 py-3">Stream</th>
                        <th class="px-6 py-3">Teacher ID</th>
                        <th class="px-6 py-3 text-center">Uploaded At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-800">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4"><?php echo $row['subject_name']; ?></td>
                            <td class="px-6 py-4"><?php echo $row['university_name']; ?></td>
                            <td class="px-6 py-4"><?php echo $row['stream']; ?></td>
                            <td class="px-6 py-4"><?php echo $row['teacher_id']; ?></td>
                            <td class="px-6 py-4 text-center"><?php echo date('Y-m-d', strtotime($row['uploaded_at'])); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-2">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <a href="?page=<?php echo $i; ?>" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"><?php echo $i; ?></a>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
