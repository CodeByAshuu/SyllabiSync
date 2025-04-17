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
    <title>Institute Explorer - SyllabiSync</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="flex justify-around gap-10 fixed top-0 h-20 w-full p-6 text-center items-center shadow-md shadow-gray-400/50 bg-white z-50">
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

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 mt-20">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Explore Institutes</h1>
            <p class="text-gray-600">Discover AICTE-approved institutes across India</p>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <input type="text" id="searchInput" placeholder="Search institutes..." 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <select id="stateFilter" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All States</option>
                    </select>
                </div>
                <div>
                    <select id="categoryFilter" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Categories</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Institutes Grid -->
        <div id="institutesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Institutes will be loaded here -->
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="hidden flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        </div>

        <!-- Pagination -->
        <div id="pagination" class="mt-8 flex justify-center">
            <!-- Pagination will be loaded here -->
        </div>
    </div>

    <!-- Institute Details Modal -->
    <div id="instituteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-900">Institute Details</h2>
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div id="modalContent"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample JSON data (replace with actual API call)
        const institutesData = {
            "institutes": [
                {
                    "id": 1,
                    "name": "Indian Institute of Technology Delhi",
                    "city": "New Delhi",
                    "state": "Delhi",
                    "category": "Engineering",
                    "type": "Public",
                    "established_year": "1961",
                    "approved_intake": "1200",
                    "website": "https://www.iitd.ac.in",
                    "address": "Hauz Khas, New Delhi - 110016",
                    "contact": "+91-11-2659-7135"
                },
                // Add more institutes here
            ],
            "states": ["Delhi", "Maharashtra", "Karnataka", "Tamil Nadu", "West Bengal"],
            "categories": ["Engineering", "Management", "Pharmacy", "Architecture", "Hotel Management"]
        };

        // Initialize page
        $(document).ready(function() {
            loadFilters();
            loadInstitutes();
        });

        // Load filters
        function loadFilters() {
            const states = institutesData.states;
            const categories = institutesData.categories;

            states.forEach(state => {
                $('#stateFilter').append(`<option value="${state}">${state}</option>`);
            });

            categories.forEach(category => {
                $('#categoryFilter').append(`<option value="${category}">${category}</option>`);
            });
        }

        // Load institutes
        function loadInstitutes() {
            $('#loadingSpinner').removeClass('hidden');
            $('#institutesGrid').empty();

            // Simulate API call delay
            setTimeout(() => {
                institutesData.institutes.forEach(institute => {
                    const card = `
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-bold text-gray-900">${institute.name}</h3>
                                    <span class="text-sm text-gray-500">Est. ${institute.established_year}</span>
                                </div>
                                <div class="space-y-3 text-gray-600 mb-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                                        <span>${institute.city}, ${institute.state}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-graduation-cap text-blue-600 mr-2"></i>
                                        <span>${institute.category}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-university text-blue-600 mr-2"></i>
                                        <span>${institute.type} University</span>
                                    </div>
                                </div>
                                <button onclick="showInstituteDetails(${institute.id})"
                                        class="w-full px-4 py-2 bg-white text-black border-2 border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                                    View Details
                                </button>
                            </div>
                        </div>
                    `;
                    $('#institutesGrid').append(card);
                });

                $('#loadingSpinner').addClass('hidden');
            }, 1000);
        }

        // Show institute details
        function showInstituteDetails(id) {
            const institute = institutesData.institutes.find(i => i.id === id);
            if (!institute) return;

            const modalContent = `
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

            $('#modalContent').html(modalContent);
            $('#instituteModal').removeClass('hidden');
        }

        // Close modal
        function closeModal() {
            $('#instituteModal').addClass('hidden');
        }

        // Event listeners for filters
        $('#searchInput, #stateFilter, #categoryFilter').on('input change', function() {
            loadInstitutes();
        });

        // Close modal when clicking outside
        $('#instituteModal').click(function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>
    