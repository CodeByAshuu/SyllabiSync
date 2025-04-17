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
    <style>
        .aurora-text {
            background: linear-gradient(45deg,#FF0080, #7928CA, #0070F3, #38bdf8);
            background-size: 400%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: aurora 7s linear infinite;
            text-shadow: 0 0 10px rgba(255,255,255,0.3);
        }

        @keyframes aurora {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="font-[Poppins]">
    

    <!-- NAVBAR -->
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

    <!-- Mobile Menu Button -->
    <button id="menu-toggle" class="md:hidden text-gray-800 focus:outline-none">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class=" md:hidden flex flex-col items-center bg-white shadow-lg p-4 space-y-4">
        <a href="#" class="text-lg text-gray-800 hover:text-blue-500">Home</a>
        <a href="#" class="text-lg text-gray-800 hover:text-blue-500">About</a>
        <a href="#" class="text-lg text-gray-800 hover:text-blue-500">Curriculum</a>
        <a href="#" class="text-lg text-gray-800 hover:text-blue-500">Institution</a>
        <a href="contact.php" class="text-lg text-gray-800 hover:text-blue-500">Contact</a>
    </div>

    <!-- Hero image -->
    <div class="flex w-fit mx-auto mt-10 gap-50 mb-10 min-h-screen" data-aos="fade-up" data-aos-duration="1000">
        <div class="flex flex-col justify-evenly gap-3 w-105">
            <p class="text-6xl font-bold" data-aos="fade-right" data-aos-delay="200">Welcome to <span class="aurora-text">Curriculum Management Portal</span></p>
            <p class="font-semibold text-2xl text-gray-700" data-aos="fade-right" data-aos-delay="400">Your one stop for managing all curriculum from different AICTE universities</p>
        </div>
        <div class="w-180" data-aos="fade-left" data-aos-delay="600">
            <img class="h=[600px]" src="assets\image\hero1.png" alt="">
        </div>
    </div>


    <!-- FEATURES SECTION  -->
    <section class="py-10 bg-gray-100" data-aos="fade-up" data-aos-once="false">
        <h1 class="text-5xl font-semibold text-center mt-5 py-10">Key <span class="text-blue-600">Features</span></h1>
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-once="false" data-aos-delay="100">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436873.png" alt="Standardization" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Standardized Curriculum</h3>
                    <p class="text-gray-600 text-center">Ensure consistency across all technical institutions</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-once="false" data-aos-delay="200">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436876.png" alt="Quality" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Quality Assurance</h3>
                    <p class="text-gray-600 text-center">Maintain high educational standards through structured frameworks</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-once="false" data-aos-delay="300">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436875.png" alt="Updates" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Easy Updates</h3>
                    <p class="text-gray-600 text-center">Seamless curriculum updates and version control</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-once="false" data-aos-delay="400">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436877.png" alt="Sharing" class="h-16 w-16 mb-4 mx-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Resource Sharing</h3>
                    <p class="text-gray-600 text-center">Collaborate and share resources across institutions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner Section -->
    <div class="relative h-60 w-auto bg-[url('/assets/image/homebanner.jpg')] bg-cover bg-center">
        <div class="absolute inset-0 bg-black/50 flex flex-col justify-center items-center">
            <h1 class="text-white text-lg py-2">AICTE Approved Excellence!</h1>
            <h1 class="text-white text-lg font-bold py-2">Bridging the<span class="text-red-500 text-lg font-bold py-2"> Gap</span> in Technical Education.</h1>
            <a href="about.php" class="bg-white px-3 py-2 m-2 text-lg font-light rounded-sm text-black hover:bg-amber-500 hover:text-white">Learn More</a>
        </div>
    </div>

    <!-- Stats section -->
    <section class="py-20 bg-primary text-white" data-aos="fade-up" data-aos-once="false">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="transform hover:scale-110 transition-transform duration-300" data-aos="zoom-in" data-aos-once="false" data-aos-delay="100">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436871.png" alt="Buildings" class="h-16 w-16 mb-4 mx-auto">
                    <span class="text-4xl font-bold mb-2 block text-blue-600 counter" data-target="10000">0</span>
                    <span class="text-lg text-blue-600">Approved Institutions</span>
                </div>
                <div class="transform hover:scale-110 transition-transform duration-300" data-aos="zoom-in" data-aos-once="false" data-aos-delay="200">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436870.png" alt="Students" class="h-16 w-16 mb-4 mx-auto">
                    <span class="text-4xl font-bold mb-2 block text-blue-600 counter" data-target="1000000">0</span>
                    <span class="text-lg text-blue-600">Students Impacted</span>
                </div>
                <div class="transform hover:scale-110 transition-transform duration-300" data-aos="zoom-in" data-aos-once="false" data-aos-delay="300">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436872.png" alt="Curriculum" class="h-16 w-16 mb-4 mx-auto">
                    <span class="text-4xl font-bold mb-2 block text-blue-600 counter" data-target="500">0</span>
                    <span class="text-lg text-blue-600">Curriculum Models</span>
                </div>
            </div>
        </div>
    </section>

    <!-- AICTE Initiatives Section -->
    <section class="py-16 bg-white overflow-hidden" data-aos="fade-up" data-aos-once="false">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">AICTE <span class="text-blue-600">Initiatives</span></h2>
            <div class="relative">
                <div class="flex space-x-8 overflow-x-auto pb-8 scrollbar-hide" id="initiatives-slider">
                    <a href="https://www.aicte-india.org/Initiatives/smart-india-hackathon" target="_blank">
                    <div class="flex-none w-80 bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-right" data-aos-once="false" data-aos-delay="100">
                        <img src="https://cdn-icons-png.flaticon.com/512/2436/2436874.png" alt="Smart India Hackathon" class="h-16 w-16 mb-4 mx-auto">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Smart India Hackathon</h3>
                        <p class="text-gray-600 text-center">Promoting innovation and problem-solving among students</p>
                    </div>
                    </a>
                    <a href="https://www.msde.gov.in/offerings/schemes-and-services/details/pradhan-mantri-kaushal-vikas-yojana-4-0-pmkvy-4-0-2021" target="_blank">
                    <div class="flex-none w-80 bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-right" data-aos-once="false" data-aos-delay="200">
                        <img src="https://cdn-icons-png.flaticon.com/512/2436/2436878.png" alt="Pradhan Mantri Kaushal Vikas Yojana" class="h-16 w-16 mb-4 mx-auto">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">PMKVY</h3>
                        <p class="text-gray-600 text-center">Skill development initiative for technical education</p>
                    </div>
                    </a>
                    <a href="https://unnatbharatabhiyan.gov.in/" target="_blank">
                    <div class="flex-none w-80 bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-right" data-aos-once="false" data-aos-delay="300">
                        <img src="https://cdn-icons-png.flaticon.com/512/2436/2436879.png" alt="Unnat Bharat Abhiyan" class="h-16 w-16 mb-4 mx-auto">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Unnat Bharat Abhiyan</h3>
                        <p class="text-gray-600 text-center">Connecting institutions with rural development</p>
                    </div>
                    </a>
                    <a href="https://www.india.gov.in/atal-ranking-institutions-innovation-achievements-ariia" target="_blank">
                    <div class="flex-none w-80 bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-right" data-aos-once="false" data-aos-delay="400">
                        <img src="https://cdn-icons-png.flaticon.com/512/2436/2436880.png" alt="Atal Ranking" class="h-16 w-16 mb-4 mx-auto">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Atal Ranking</h3>
                        <p class="text-gray-600 text-center">Institution ranking framework for quality assurance</p>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <!-- AICTE Quality Parameters -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12" data-aos="fade-up">Quality <span class="text-blue-600">Parameters</span></h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Faculty Quality</h3>
                    <p class="text-gray-600 text-center">Highly qualified and experienced faculty members</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="100">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-flask text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Research Facilities</h3>
                    <p class="text-gray-600 text-center">State-of-the-art research laboratories and equipment</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="200">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-book text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Curriculum Design</h3>
                    <p class="text-gray-600 text-center">Industry-aligned and regularly updated curriculum</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="300">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Placement Records</h3>
                    <p class="text-gray-600 text-center">Excellent placement opportunities and industry connections</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Initialize AOS with custom settings
        AOS.init({
            duration: 1000,
            once: false,
            offset: 100,
            mirror: true,
            easing: 'ease-in-out'
        });

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    element.textContent = Math.floor(current).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target.toLocaleString();
                }
            };

            updateCounter();
        }

        // Intersection Observer for counter animation
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        // Observe all counter elements
        document.querySelectorAll('.counter').forEach(counter => {
            counterObserver.observe(counter);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Refresh AOS on scroll
        window.addEventListener('scroll', () => {
            AOS.refresh();
        });
    </script>

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
                        <li><a href="landing_page.php" class="hover:text-orange-300">Home</a></li>
                        <li><a href="about.php" class="hover:text-orange-300">About</a></li>
                        <li><a href="#" class="hover:text-orange-300">Curriculum</a></li>
                        <li><a href="contact.php" class="hover:text-orange-300">Contact</a></li>
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