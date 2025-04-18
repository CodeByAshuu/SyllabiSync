<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend&backend";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM syllabus_approvals ORDER BY uploaded_at DESC LIMIT 5";
$result = mysqli_query($conn, $query);

// Get counts for summary cards
$pendingQuery = "SELECT COUNT(*) as count FROM syllabus_approvals WHERE status = 'pending'";
$pendingResult = mysqli_query($conn, $pendingQuery);
$pendingCount = mysqli_fetch_assoc($pendingResult)['count'];

$approvedQuery = "SELECT COUNT(*) as count FROM syllabus_approvals WHERE status = 'approved'";
$approvedResult = mysqli_query($conn, $approvedQuery);
$approvedCount = mysqli_fetch_assoc($approvedResult)['count'];

$rejectedQuery = "SELECT COUNT(*) as count FROM syllabus_approvals WHERE status = 'rejected'";
$rejectedResult = mysqli_query($conn, $rejectedQuery);
$rejectedCount = mysqli_fetch_assoc($rejectedResult)['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="/src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-item {
            transition: all 0.2s ease;
        }
        .sidebar-item:hover {
            transform: translateX(3px);
        }
        .summary-card {
            transition: all 0.3s ease;
        }
        .summary-card:hover {
            transform: translateY(-3px);
        }
        .activity-item {
            transition: all 0.2s ease;
        }
        .activity-item:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">
    <!-- Sidebar Navigation -->
    <div class="bg-blue-800 w-64 flex flex-col text-white p-6 fixed h-full">
        <div class="flex items-center gap-3 border-b border-blue-600 pb-4">
            <i class="fas fa-user-circle text-4xl text-blue-200"></i>
            <div>
                <p class="text-lg font-semibold">Admin Panel</p>
                <p class="text-sm text-blue-200">Administrator</p>
            </div>
        </div>
        <nav class="mt-6 space-y-2">
            <a href="admin.php" class="flex items-center gap-3 p-3 sidebar-item bg-blue-700 rounded-lg">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
            <a href="pendingApproval.html" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg">
                <i class="fas fa-clock w-5 text-center"></i>
                <span>Pending Approval</span>
            </a>
            <a href="approvedCurriculum.php" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg">
                <i class="fas fa-check-circle w-5 text-center"></i>
                <span>Approved Curriculum</span>
            </a>
            <a href="userManagement.php" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg">
                <i class="fas fa-users w-5 text-center"></i>
                <span>User Management</span>
            </a>
            <a href="index.html" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg mt-8">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                    Dashboard Overview
                </h1>
                <p class="text-gray-600">Welcome back, Administrator</p>
            </div>
            <!-- <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow transition duration-200 flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button> -->
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="summary-card bg-yellow-500 hover:shadow-lg text-white p-6 rounded-lg shadow-md transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-semibold uppercase">Pending</p>
                        <p class="text-3xl font-bold mt-2"><?php echo $pendingCount; ?></p>
                    </div>
                    <i class="fas fa-clock text-3xl opacity-70"></i>
                </div>
                <div class="mt-4 pt-2 border-t border-yellow-400">
                    <a href="pendingApproval.html" class="text-yellow-100 hover:text-white text-sm flex items-center gap-1" >
                        View all <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            
            <div class="summary-card bg-green-500 hover:shadow-lg text-white p-6 rounded-lg shadow-md transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-semibold uppercase">Approved</p>
                        <p class="text-3xl font-bold mt-2"><?php echo $approvedCount; ?></p>
                    </div>
                    <i class="fas fa-check-circle text-3xl opacity-70"></i>
                </div>
                <div class="mt-4 pt-2 border-t border-green-400">
                    <a href="approvedCurriculum.php" class="text-green-100 hover:text-white text-sm flex items-center gap-1">
                        View all <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            
            <div class="summary-card bg-red-500 hover:shadow-lg text-white p-6 rounded-lg shadow-md transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg font-semibold uppercase">Rejected</p>
                        <p class="text-3xl font-bold mt-2"><?php echo $rejectedCount; ?></p>
                    </div>
                    <i class="fas fa-times-circle text-3xl opacity-70"></i>
                </div>
                <div class="mt-4 pt-2 border-t border-red-400">
                    <a href="#" class="text-red-100 hover:text-white text-sm flex items-center gap-1">
                         
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-history text-blue-600 mr-2"></i>
                    Recent Activity
                </h2>
            </div>
            
            <div class="space-y-4">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="activity-item p-4 border-b border-gray-100 hover:bg-gray-50 rounded-lg transition duration-200">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3">
                            <div class="mt-1">
                                <?php if ($row['status'] == 'approved') { ?>
                                    <div class="bg-green-100 p-2 rounded-full">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                <?php } elseif ($row['status'] == 'rejected') { ?>
                                    <div class="bg-red-100 p-2 rounded-full">
                                        <i class="fas fa-times text-red-600"></i>
                                    </div>
                                <?php } else { ?>
                                    <div class="bg-yellow-100 p-2 rounded-full">
                                        <i class="fas fa-clock text-yellow-600"></i>
                                    </div>
                                <?php } ?>
                            </div>
                            <div>
                                <p class="text-gray-800 font-medium">
                                    <?php 
                                    if ($row['status'] == 'approved') {
                                        echo "Approved syllabus for ";
                                    } elseif ($row['status'] == 'rejected') {
                                        echo "Rejected syllabus for ";
                                    } else {
                                        echo "New syllabus submitted for ";
                                    }
                                    echo $row['subject_name'] ? htmlspecialchars($row['subject_name']) : 'Unknown Subject'; 
                                    ?>
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <?php if ($row['stream']) echo htmlspecialchars($row['stream']); ?>
                                    <?php if ($row['university_name']) echo " • " . htmlspecialchars($row['university_name']); ?>
                                </p>
                                <?php if ($row['status'] == 'rejected' && $row['admin_feedback']) { ?>
                                    <p class="text-sm text-red-500 mt-1">
                                        <strong>Feedback:</strong> <?php echo htmlspecialchars($row['admin_feedback']); ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 whitespace-nowrap">
                            <?php 
                            $date = $row['processed_at'] ? $row['processed_at'] : $row['uploaded_at'];
                            echo date('M j, Y g:i A', strtotime($date)); 
                            ?>
                        </span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Notification Pop-Up -->
    <div id="notification" class="fixed bottom-4 right-4 bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hidden">
        <div class="flex items-center gap-3">
            <i class="fas fa-bell"></i>
            <span>New curriculum has been submitted for approval!</span>
        </div>
    </div>

    <script>
        // Show notification (example)
        setTimeout(() => {
            document.getElementById('notification').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('notification').classList.add('hidden');
            }, 5000);
        }, 1000);
    </script>
</body>
</html>

<?php mysqli_close($conn); ?>