<?php
// require_once 'db/db.php';

// // Get filters
// $search = isset($_GET['search']) ? $_GET['search'] : '';
// $state = isset($_GET['state']) ? $_GET['state'] : '';
// $category = isset($_GET['category']) ? $_GET['category'] : '';
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $per_page = 20;
// $offset = ($page - 1) * $per_page;

// // Build query
// $where = [];
// $params = [];

// if ($search) {
//     $where[] = "name LIKE ?";
//     $params[] = "%$search%";
// }

// if ($state) {
//     $where[] = "state = ?";
//     $params[] = $state;
// }

// if ($category) {
//     $where[] = "category = ?";
//     $params[] = $category;
// }

// $where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// // Get total count
// $count_sql = "SELECT COUNT(*) FROM institutes $where_clause";
// $stmt = $pdo->prepare($count_sql);
// $stmt->execute($params);
// $total_records = $stmt->fetchColumn();
// $total_pages = ceil($total_records / $per_page);

// // Get institutes
// $sql = "SELECT * FROM institutes $where_clause LIMIT $per_page OFFSET $offset";
// $stmt = $pdo->prepare($sql);
// $stmt->execute($params);
// $institutes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // Get unique states and categories for filters
// $states = $pdo->query("SELECT DISTINCT state FROM institutes ORDER BY state")->fetchAll(PDO::FETCH_COLUMN);
// $categories = $pdo->query("SELECT DISTINCT category FROM institutes ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyllabiSync</title>
    <link rel="stylesheet" href="/src/output.css">
</head>
<body>
    <!--NAVBAR -->
    <nav class="flex justify-around gap-10 fixed top-0  h-20 w-full p-6 text-center items-center shadow-md shadow-gray-400/50 bg-white">
        <div class="container mx-auto flex items-center justify-between p-5">    
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <span class="text-2xl text-white bg-blue-600 px-2 py-1 rounded-md font-semibold">Syllabi</span>
                <span class="text-2xl text-blue-600 font-semibold">Sync</span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex justify-between space-x-8 gap-8 font-medium ">
                <a href="landing_page.php" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Home</a>
                <a href="about.php" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">About</a>
                <a href="#" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Curriculum</a>
                <a href="institute.php" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Institution</a>
                <a href="contact.php" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Contact</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Explore Institutes</h1>
            <p class="text-gray-600">Discover AICTE-approved institutes across India</p>
        </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form class="grid grid-cols-1 md:grid-cols-3 gap-4" method="GET">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input 
                    type="text" 
                    name="search" 
                    value="<?php echo htmlspecialchars($search); ?>"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search institutes..."
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                <select name="state" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All States</option>
                    <?php foreach ($states as $s): ?>
                        <option value="<?php echo htmlspecialchars($s); ?>" <?php echo $state === $s ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($s); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $c): ?>
                        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo $category === $c ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($c); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="md:col-span-3">
                <button type="submit" class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Results -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($institutes as $institute): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2"><?php echo htmlspecialchars($institute['name']); ?></h3>
                    <div class="text-gray-600 mb-4">
                        <p class="mb-1"><?php echo htmlspecialchars($institute['city']); ?>, <?php echo htmlspecialchars($institute['state']); ?></p>
                        <p class="mb-1">Category: <?php echo htmlspecialchars($institute['category']); ?></p>
                        <p>Type: <?php echo htmlspecialchars($institute['type']); ?></p>
                    </div>
                    <button 
                        onclick="showInstituteDetails(<?php echo $institute['id']; ?>)"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                    >
                        View Details
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="mt-8 flex justify-center">
            <div class="flex space-x-2">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a 
                        href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&state=<?php echo urlencode($state); ?>&category=<?php echo urlencode($category); ?>"
                        class="px-4 py-2 rounded-lg <?php echo $page === $i ? 'bg-blue-600 text-white' : 'bg-white text-blue-600 hover:bg-blue-50'; ?>"
                    >
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Institute Details Modal -->
    <div id="instituteModal" class="hidden fixed inset-0 bg-black bg-opacity-50">
        <div class="flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-900">Institute Details</h2>
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div id="modalContent"></div>
                </div>
            </div>
        </div>
    </div>
</main>


    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">About AICTE</h4>
                    <p class="text-gray-400">
                        All India Council for Technical Education (AICTE) is the statutory body and a national-level council for technical education.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-orange-300">Home</a></li>
                        <li><a href="#" class="hover:text-orange-300">About</a></li>
                        <li><a href="#" class="hover:text-orange-300">Curriculum</a></li>
                        <li><a href="#" class="hover:text-orange-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-orange-300">Documentation</a></li>
                        <li><a href="#" class="hover:text-orange-300">Guidelines</a></li>
                        <li><a href="#" class="hover:text-orange-300">FAQs</a></li>
                        <li><a href="#" class="hover:text-orange-300">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <address class="text-gray-400 not-italic">
                        Nelson Mandela Marg<br>
                        Vasant Kunj, New Delhi-110070<br>
                        India<br>
                        <a href="mailto:support@aicte-india.org" class="hover:text-orange-300">support@aicte-india.org</a>
                    </address>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> CTRL+C. All rights reserved.</p>
            </div>
        </div>
    </footer>

<script>
async function showInstituteDetails(id) {
    try {
        const response = await fetch(`get_institute_details.php?id=${id}`);
        const institute = await response.json();
        
        const modalContent = document.getElementById('modalContent');
        modalContent.innerHTML = `
            <div class="space-y-4">
                <h3 class="text-xl font-bold">${institute.name}</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="font-semibold">Location</p>
                        <p>${institute.city}, ${institute.state}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Category</p>
                        <p>${institute.category}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Type</p>
                        <p>${institute.type}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Established</p>
                        <p>${institute.established_year}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Approved Intake</p>
                        <p>${institute.approved_intake}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Website</p>
                        <p><a href="${institute.website}" class="text-blue-600 hover:underline" target="_blank">${institute.website}</a></p>
                    </div>
                </div>
                <div>
                    <p class="font-semibold">Address</p>
                    <p>${institute.address}</p>
                </div>
                <div>
                    <p class="font-semibold">Contact</p>
                    <p>${institute.contact}</p>
                </div>
            </div>
        `;
        
        document.getElementById('instituteModal').classList.remove('hidden');
    } catch (error) {
        console.error('Error fetching institute details:', error);
    }
}

function closeModal() {
    document.getElementById('instituteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('instituteModal').addEventListener('click', (e) => {
    if (e.target === e.currentTarget) {
        closeModal();
    }
});
</script>

</body>
</html>
    