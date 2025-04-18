<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend&backend";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = "WHERE status = 'approved'";
if (!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $where .= " AND (subject_name LIKE '%$search%' 
                OR stream LIKE '%$search%' 
                OR university_name LIKE '%$search%'
                OR teacher_id LIKE '%$search%')";
}

// Pagination
$limit = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM syllabus_approvals $where LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Total rows for pagination
$total_query = "SELECT COUNT(*) as total FROM syllabus_approvals $where";
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
    <title>Approved Curriculum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-item {
            transition: all 0.2s ease;
        }
        .sidebar-item:hover {
            transform: translateX(3px);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

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
            <a href="admin.php" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
            <a href="pendingApproval.html" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg">
                <i class="fas fa-clock w-5 text-center"></i>
                <span>Pending Approval</span>
            </a>
            <a href="approvedCurriculum.php" class="flex items-center gap-3 p-3 sidebar-item bg-blue-700 rounded-lg">
                <i class="fas fa-check-circle w-5 text-center"></i>
                <span>Approved Curriculum</span>
            </a>
            <a href="userManagement.php" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg">
                <i class="fas fa-users w-5 text-center"></i>
                <span>User Management</span>
            </a>
            <a href="#" class="flex items-center gap-3 p-3 sidebar-item hover:bg-blue-700 rounded-lg mt-8">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                Approved Curriculum
            </h1>
            
            <!-- Search Bar -->
            <form method="GET" action="" class="flex items-center">
                <div class="relative">
                    <input type="text" name="search" placeholder="Search..." 
                           value="<?php echo htmlspecialchars($search); ?>"
                           class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Search
                </button>
                <?php if (!empty($search)): ?>
                    <a href="approvedCurriculum.php" class="ml-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                        Clear
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Approved Curriculum List -->
        <div class="bg-white p-6 rounded-lg shadow-md overflow-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="px-6 py-3">Subject Name</th>
                        <th class="px-6 py-3">Stream</th>
                        <th class="px-6 py-3">University</th>
                        <th class="px-6 py-3">Teacher ID</th>
                        <th class="px-6 py-3">Approval Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-800">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4"><?php echo htmlspecialchars($row['subject_name'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo htmlspecialchars($row['stream'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo htmlspecialchars($row['university_name'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo htmlspecialchars($row['teacher_id'] ?? 'N/A'); ?></td>
                                <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime($row['processed_at'] ?? $row['uploaded_at'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No approved curriculum found <?php echo !empty($search) ? 'matching your search' : ''; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="mt-6 flex justify-center">
            <nav class="inline-flex rounded-md shadow">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" 
                       class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php endif; ?>
                
                <?php 
                // Show page numbers
                $start = max(1, $page - 2);
                $end = min($total_pages, $page + 2);
                
                if ($start > 1) {
                    echo '<a href="?page=1&search='.urlencode($search).'" class="px-3 py-2 border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">1</a>';
                    if ($start > 2) echo '<span class="px-3 py-2 border border-gray-300 bg-white text-gray-500">...</span>';
                }
                
                for ($i = $start; $i <= $end; $i++) {
                    $active = $i == $page ? 'bg-blue-600 text-white' : 'bg-white text-gray-500 hover:bg-gray-50';
                    echo '<a href="?page='.$i.'&search='.urlencode($search).'" class="px-3 py-2 border border-gray-300 '.$active.'">'.$i.'</a>';
                }
                
                if ($end < $total_pages) {
                    if ($end < $total_pages - 1) echo '<span class="px-3 py-2 border border-gray-300 bg-white text-gray-500">...</span>';
                    echo '<a href="?page='.$total_pages.'&search='.urlencode($search).'" class="px-3 py-2 border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">'.$total_pages.'</a>';
                }
                ?>
                
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>" 
                       class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </nav>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>