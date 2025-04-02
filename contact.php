<!-- form submission using php by sagar -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // echo "All fields are required!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // echo "Invalid email format!";
        exit;
    }

    $to = "sagarsahu5976@gmail.com"; //replacing with my email
    $headers = "From: $email\r\nReply-To: $email\r\n";
    $body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "success";  // js will read this
    } else {
        error_log("Mail sending failed.", 3, "error_log.txt");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="/assets/styles.css">
    <link rel="stylesheet" href="/src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>
<body class="font-[Poppins] flex flex-col min-h-screen">

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
                <a href="#" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Institution</a>
                <a href="contact.php" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Contact</a>
            </div>
        </div>
    </nav>

    <!-- MAIN BANNER -->
    <section id="page-header" class="contact-header">
        <h2 class="font-bold">#let's_talk</h2>
        <p>LEAVE A MESSAGE, WE LOVE TO HEAR FROM YOU!</p>
    </section>

    <!-- CONTACT US -->
    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2 class="font-bold">Visit one of our agency locations or contact us today</h2>
            <h3 class="font-bold">Head Office</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>Jalandhar - Delhi, Grand Trunk Rd,Phagwara, Punjab</p>
                </li>

                <li>
                    <i class="fal fa-envelope"></i>
                    <p>contact@example.com</p>
                </li>

                <li>
                    <i class="fal fa-phone-alt"></i>
                    <p>contact@example.com</p>
                </li>

                <li>
                    <i class="fal fa-clock"></i>
                    <p>Monday to Sunday: 9.00am to 16.00pm</p>
                </li>

            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6821.539321670383!2d75.69947334407317!3d31.2547991973461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5f5e9c489cf3%3A0x4049a5409d53c300!2sLovely%20Professional%20University!5e0!3m2!1sen!2sin!4v1701365479707!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    
    <!-- FORM SECTION -->
    <section id="form-details">
        <form action="" id="contactForm" method="POST">
            <span>LEAVE A MESSAGE</span>
            <h2 class="font-bold">We Love To Hear From You</h2>
            <input type="text" id="name" name="name" placeholder="Your Name">
            <input type="email" id="email" name="email" placeholder="Your E-mail">
            <input type="text" id="subject" name="subject" placeholder="Your Subject">

            <textarea name="message" id="message" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button type="submit" class="bg-blue-400 rounded-lg px-6 py-3">Submit</button>
        </form>
        <div class="people">
            <div>
                <img src="assets/image/people/1.png" alt="">
                <p><span>John Doe</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br>Email: contact@example.com</p>
            </div>

            <div>
                <img src="assets/image/people/2.png" alt="">
                <p><span>William Smith</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br>Email: contact@example.com</p>
            </div>

            <div>
                <img src="assets/image/people/3.png" alt="">
                <p><span>Emma Stone</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br>Email: contact@example.com</p>
            </div>

        </div>
    </section>

    <!-- NEWSLETTER -->
    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For News Letters</h4>
            <p>Get E-mail Updates About Our Latest Syllabus And <span>Special Curriculum.</span></p>    
        </div>

        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    
    </section>

    <!-- FOOTER -->
    <footer class=" bg-gray-900 text-white ">
        <div class="mx-auto px-4">
            <div class="grid grid-cols-4 gap-18">
                <div class="py-4" class="footer-inner">
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
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> CTRL+C. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- form validation using javascript by sagar (still need some work)-->
    <script>
    document.getElementById("contactForm").addEventListener("submit", function(event) {
        let name = document.getElementById("name").value.trim();
        let email = document.getElementById("email").value.trim();
        let subject = document.getElementById("subject").value.trim();
        let message = document.getElementById("message").value.trim();
        
        if (name === "" || email === "" || subject === "" || message === "") {
            alert("All fields are required!");
            event.preventDefault();
        } else if (!email.includes("@")) {
            alert("Please enter a valid email address!");
            event.preventDefault();
        }
    });
    </script>

</body>
</html>