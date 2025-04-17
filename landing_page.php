
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>SyllabiSync</title>
</head>

<body class="font-[Poppins]">
    

    <!-- NAVBAR -->
    <nav class="fixed top-0 w-full bg-white shadow-md shadow-gray-400/50 z-50">
        <div class="container mx-auto flex items-center justify-between p-5">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <span class="text-2xl text-white bg-blue-600 px-2 py-1 rounded-md font-semibold">Syllabi</span>
                <span class="text-2xl text-blue-600 font-semibold">Sync</span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8">
                <a href="landing_page.php" class="relative text-lg text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Home</a>
                <a href="about.php" class="relative text-lg text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">About</a>
                <a href="#" class="relative text-lg text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Curriculum</a>
                <a href="institute.php" class="relative text-lg text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Institution</a>
                <a href="contact.php" class="relative text-lg text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Contact</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-gray-800 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class=" md:hidden flex flex-col items-center bg-white shadow-lg p-4 space-y-4">
            <a href="#" class="text-lg text-gray-800 hover:text-blue-500">Home</a>
            <a href="#" class="text-lg text-gray-800 hover:text-blue-500">About</a>
            <a href="#" class="text-lg text-gray-800 hover:text-blue-500">Curriculum</a>
            <a href="#" class="text-lg text-gray-800 hover:text-blue-500">Institution</a>
            <a href="contact.php" class="text-lg text-gray-800 hover:text-blue-500">Contact</a>
        </div>
    </nav>

    <!-- Script for Mobile Menu -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>


    <!-- Hero image -->
    <div class="flex w-fit mx-auto mt-10 gap-50 mb-10">
        <div class="flex flex-col justify-evenly gap-3 w-105">
            <p class="text-6xl font-bold">Welcome to <span class="text-blue-700">Curricullum Management Portal</span></p>
            <p class="font-semibold text-2xl text-gray-700">Your one stop for managing all curricullum from different AICTE universities</p>
        </div>
        <div class="w-180">
            <img class="h=[600px]" src="assets\image\hero1.png" alt="">
        </div>
    </div>


    <!-- FEATURES SECTION  -->
    <section class="py-10 bg-gray-100">
    <h1 class="text-5xl font-semibold text-center mt-5 py-10">Key <span class="text-blue-600">Features</span></h1>
        <div class="container mx-auto px-4">
        
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436873.png" alt="Standardization" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Standardized Curriculum</h3>
                    <p class="text-gray-600 text-center">Ensure consistency across all technical institutions</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436876.png" alt="Quality" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Quality Assurance</h3>
                    <p class="text-gray-600 text-center">Maintain high educational standards through structured frameworks</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436875.png" alt="Updates" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Easy Updates</h3>
                    <p class="text-gray-600 text-center">Seamless curriculum updates and version control</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436877.png" alt="Sharing" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Resource Sharing</h3>
                    <p class="text-gray-600 text-center">Collaborate and share resources across institutions</p>
                </div>
            </div>
        </div>
    </section>

    <div class="relative h-60 w-auto bg-[url('/assets/image/homebanner.jpg')] bg-cover bg-center">
        <div class="absolute inset-0 bg-black/50 flex flex-col justify-center items-center">
            <h1 class="text-white text-lg py-2">AICTE Approved Excellence!</h1>
            <h1 class="text-white text-lg font-bold py-2" >Bridging the<span class="text-red-500 text-lg font-bold py-2"> Gap</span> in Technical Education.</h1>
            <button class="bg-white px-3 py-2 m-2 text-lg font-light rounded-sm text-black hover:bg-amber-500 hover:text-white">Learn More</button>
        </div>
    </div>

    <!-- Stats section -->
    <section class="py-20 bg-primary text-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436871.png" alt="Buildings" class="h-16 w-16 mb-4 mx-auto">
                    <span class="text-4xl font-bold mb-2 block text-blue-600">10,000+</span>
                    <span class="text-lg text-blue-600">Approved Institutions</span>
                </div>
                <div>
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436870.png" alt="Students" class="h-16 w-16 mb-4 mx-auto">
                    <span class="text-4xl font-bold mb-2 block text-blue-600">1M+</span>
                    <span class="text-lg text-blue-600">Students Impacted</span>
                </div>
                <div>
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436872.png" alt="Curriculum" class="h-16 w-16 mb-4 mx-auto">
                    <span class="text-4xl font-bold mb-2 block text-blue-600">500+</span>
                    <span class="text-lg text-blue-600">Curriculum Models</span>
                </div>
            </div>
        </div>
    </section>

    

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
</body>

</html>