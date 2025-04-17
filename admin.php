<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend_backend";

$conn = mysqli_connect("localhost", "root", "", "frontend_backend");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM syllabus_approvals ORDER BY processed_at DESC LIMIT 5";
$result = mysqli_query($conn, $query);

$countPending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM syllabus_approvals WHERE status='Pending'"))['total'];
$countApproved = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM syllabus_approvals WHERE status='Approved'"))['total'];
$countRejected = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM syllabus_approvals WHERE status='Rejected'"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/src/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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
            <a href="admin.php" class="flex items-center gap-4 p-3 bg-blue-600 rounded-lg">Dashboard</a>
            <a href="pendingApproval.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg">Pending Approval</a>
            <a href="approvedCurriculum.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg">Approved Curriculum</a>
            <a href="userManagement.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg">User Management</a>
            <a href="#" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 content-wrapper">
        <h1 class="text-4xl font-bold text-gray-800">Dashboard</h1>

        <!-- Summary Cards -->
        <div class="flex gap-6 mt-6">
            <div class="flex-1 p-6 bg-yellow-500 text-white rounded-lg shadow-lg text-center">
                <p class="text-3xl font-semibold uppercase">Pending</p>
                <p class="text-4xl"><?php echo $countPending; ?></p>
            </div>
            <div class="flex-1 p-6 bg-green-500 text-white rounded-lg shadow-lg text-center">
                <p class="text-3xl font-semibold uppercase">Approved</p>
                <p class="text-4xl"><?php echo $countApproved; ?></p>
            </div>
            <div class="flex-1 p-6 bg-red-500 text-white rounded-lg shadow-lg text-center">
                <p class="text-3xl font-semibold uppercase">Rejected</p>
                <p class="text-4xl"><?php echo $countRejected; ?></p>
            </div>
        </div>

        <!-- Recent Activity Logs -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-lg content-wrapper">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
            <div class="space-y-3">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="flex justify-between items-center border-b pb-3">
                        <div class="flex items-center gap-3">
                            <?php
                            $status = strtolower(trim($row['status']));
                            $emoji = '⏳';
                            if ($status === 'approved') $emoji = '✅';
                            elseif ($status === 'rejected') $emoji = '❌';
                            ?>
                            <span class="text-lg"><?php echo $emoji; ?></span>
                            <p class="text-gray-700 text-sm">
                                <strong>Admin</strong>
                                <?php echo strtolower($row['status']); ?> 
                                <strong><?php echo $row['subject_name'] . " (" . $row['stream'] . ") - " . $row['university_name']; ?></strong>
                            </p>
                        </div>
                        <span class="text-gray-500 text-xs"><?php echo $row['processed_at']; ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php mysqli_close($conn); ?>
