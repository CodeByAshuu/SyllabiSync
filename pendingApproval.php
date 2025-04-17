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
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM syllabus_approvals WHERE status = 'Pending' ORDER BY uploaded_at DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $query);

$totalQuery = "SELECT COUNT(*) as total FROM syllabus_approvals WHERE status = 'Pending'";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalPages = ceil($totalRow['total'] / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Approvals</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script>
        function openRejectModal(id) {
            document.getElementById("rejectModal").classList.remove("hidden");
            document.getElementById("rejectId").value = id;
        }
        function closeRejectModal() {
            document.getElementById("rejectModal").classList.add("hidden");
        }
    </script>
</head>
<body class="bg-gray-100 font-[Poppins]">
<div class="flex h-screen overflow-hidden">
    <div class="bg-blue-800 w-72 flex flex-col text-white p-6">
        <div class="flex items-center gap-3 border-b border-white pb-4">
            <i class="fa-solid fa-circle-user text-4xl"></i>
            <p class="text-2xl font-semibold">Admin Name</p>
        </div>
        <nav class="mt-6 space-y-4">
            <a href="admin.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="pendingApproval.php" class="flex items-center gap-4 p-3 bg-blue-600 rounded-lg"><i class="fa-solid fa-clock"></i> Pending Approval</a>
            <a href="approvedCurriculum.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-check"></i> Approved Curriculum</a>
            <a href="userManagement.php" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-user"></i> User Management</a>
            <a href="#" class="flex items-center gap-4 p-3 hover:bg-blue-600 rounded-lg"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </nav>
    </div>

    <div class="flex-1 p-8 content-wrapper">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Pending Approvals</h1>
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-blue-800 text-white">
                    <tr>
                        <th class="px-6 py-3">Subject</th>
                        <th class="px-6 py-3">Stream</th>
                        <th class="px-6 py-3">University</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-800">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4"><?php echo $row['subject_name']; ?></td>
                            <td class="px-6 py-4"><?php echo $row['stream']; ?></td>
                            <td class="px-6 py-4"><?php echo $row['university_name']; ?></td>
                            <td class="px-6 py-4"><?php echo date('Y-m-d', strtotime($row['uploaded_at'])); ?></td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">
                                    <form method="POST" action="approve.php">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md">Approve</button>
                                    </form>
                                    <button onclick="openRejectModal(<?php echo $row['id']; ?>)" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md">Reject</button>
                                    <form method="GET" action="view_pdf.php" target="_blank">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="text-blue-600 hover:text-blue-800 text-xl"><i class="fa-solid fa-file-pdf"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="flex justify-center mt-6">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <a href="?page=<?php echo $i; ?>" class="mx-1 px-4 py-2 rounded-md 
                        <?php echo $i == $page ? 'bg-blue-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-blue-100'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md shadow-lg w-96">
        <form method="POST" action="reject.php">
            <input type="hidden" name="id" id="rejectId">
            <label class="block mb-2 text-gray-700 font-semibold">Reason for rejection</label>
            <textarea name="admin_feedback" required class="w-full border border-gray-300 rounded-md p-2 mb-4"></textarea>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Reject</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
<?php mysqli_close($conn); ?>
