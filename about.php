<html>
<head>
    <title>About SyllabiSync</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="/assets/styles.css">
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

    <!-- MAIN BANNER -->
    <section id="page-header" class="about-header w-full h-[50vh] bg-cover flex justify-center text-center flex-col p-4 text-white bg-[url('/assets/image/banner/banner.png')] shadow-lg">
        <h2 class="font-bold text-5xl text-white text-shadow-md">#KnowUs</h2>
        <p class="text-white text-shadow-md">LET ME TELL YOU ABOUT OURSELVES</p>
    </section>


    <!-- WHO ARE WE -->
    <section id="about-head" class="section-p1">
        <img src="assets/image/about/a1.jpg" alt="">
        <div>
            <h2 class="font-bold text-5xl text-blue-600">Who We Are</h2>
            <p>We are a team of passionate B.Tech Computer Science students from section KM010 (P123), currently studying at Lovely Professional University. <strong>SyllabiSync</strong> is a web platform we built as part of our CA2 project for the course <em>INT219 - Front-End Web Development & INT220 - Server Side Scripting</em>.
            Our mission is to simplify and unify access to academic curricula across various institutions. We aim to make it easier for students, faculty, and institutions to access, compare, and manage curriculum content seamlessly and efficiently.</p>
            
            <abbr title="">SyllabiSync simplifies academic management by enabling quick curriculum access, updates, and synchronization across institutions.</abbr>
            <br><br>

            <marquee bgcolor="#ccc" loop="-1" scrollamount="10" width="100%">Empowering institutions to stay updated, stay synced, and stay ahead with standardized curriculum solutions — SyllabiSync</marquee>
        </div>
    </section>
    
    <!-- OUR MISSION -->
    <section class="p-12 md:p-15">
        <h2 class="font-bold text-4xl text-blue-600 flex justify-center mb-20">Our Mission</h2>
        <blockquote class="text-lg text-gray-700 text-center max-w-3xl m-10 p-12">
            At SyllabiSync, our mission is to bring consistency and transparency to academic programs. 
            We envision a future where students and institutions can collaborate and innovate on a shared academic foundation.
        </blockquote>
    </section>
    

    <!-- WHAT WE OFFER -->
    <h2 class="font-bold text-4xl text-blue-600 mt-10">What We Offer</h2>
    <ul class="list-disc ml-6 text-gray-700">
    <li>Standardized curriculum viewing and sharing</li>
    <li>Institution-specific curriculum comparison</li>
    <li>Easy navigation across different academic streams</li>
    <li>Resource sharing between students and faculty</li>
    </ul>




    <!-- ABOUT APP -->
    <section id="about-app" class="section-p1">
        <h1>Download Our <a href="#" class="font-bold text-blue-600">App</a></h1>
        <div class="video">
            <video autoplay muted loop src="img/about/1.mp4"></video>
        </div>
    </section>

    <!-- FEATURES SECTION (issue) -->
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

    <!-- NEWSLETTER -->
    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For News Letters</h4>
            <p>Get E-mail Updates About Our Latest Shop And <span>Special Offers.</span></p>    
        </div>

        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>

    </section>


    <!-- FOOTER -->
    <footer class=" bg-gray-900 text-white ">
        <div class="mx-auto px-4">
            <div class="grid grid-cols-4 gap-18" id="footer-inner">
                <div>
                    <h4 class="text-sm font-semibold mb-4 ">About AICTE</h4>
                    <p class="text-gray-400">
                        All India Council for Technical Education (AICTE) is the statutory body and a national-level council for technical education.
                    </p>
                </div>
                <div class="p-12">
                    <h4 class="text-base font-semibold mb-4 ">Quick Links</h4>
                    <ul class="space-y-12 text-gray-400 flex flex-col justify-between">
                        <li><a href="landing_page.php" class="hover:text-orange-300">Home</a></li>
                        <li><a href="about.php" class="hover:text-orange-300">About</a></li>
                        <li><a href="curriculum.php" class="hover:text-orange-300">Curriculum</a></li>
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
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400 special">
                <p>&copy; <?php echo date('Y'); ?> CTRL+C. All rights reserved.</p>
            </div>
        </div>
    </footer>

    </body>
</html>