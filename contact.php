<!-- form submission using php by sagar -->
<?php
session_start(); // Start the session at the very beginning
require 'vendor/autoload.php'; // Load Composer's autoloader


// Initialize variables
$name = $email = $subject = $message = '';
$errors = [];
$success_message = $error_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) > 100) {
        $errors[] = "Name must be less than 100 characters";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($message)) {
        $errors[] = "Message is required";
    } elseif (strlen($message) > 1000) {
        $errors[] = "Message must be less than 1000 characters";
    }
    
    // If no errors, proceed with sending email
    if (empty($errors)) {
        try {
            // Load Composer's autoloader
            require 'vendor/autoload.php';

            // Create an instance of PHPMailer
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Use Gmail SMTP server
            $mail->SMTPAuth = true;
            include 'pass.php'; // Include your config file for email credentials
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('sagarsahu5976@gmail.com');  // Where you want to receive emails

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject ?: "Contact Form Submission";
            $mail->Body = "
                <h2>Contact Form Submission</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <p><strong>Message:</strong></p>
                <p>" . nl2br($message) . "</p>
            ";

            $mail->send();
            $_SESSION['success_message'] = "Thank you for contacting us. We will get back to you soon!";
            // Clear form fields after successful submission
            $name = $email = $subject = $message = '';
            // Redirect to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (Exception $e) {
            $error_message = "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}

// Get success message from session and clear it
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
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
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 0,
                disable: 'mobile'
            });
        });
    </script>
</head>
<body class="font-[Poppins] flex flex-col min-h-screen">

    <!--NAVBAR -->
    <nav class="flex justify-around gap-10 fixed top-0 h-20 w-full p-6 text-center items-center shadow-md shadow-gray-400/50 bg-white z-50">
        <div class="container mx-auto flex items-center justify-between p-5">    
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <span class="text-2xl text-white bg-blue-600 px-2 py-1 rounded-md font-semibold">Syllabi</span>
                <span class="text-2xl text-blue-600 font-semibold">Sync</span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex justify-between space-x-9 gap-18 font-semibold ">
                <a href="landing_page.php" class="relative text-sm text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Home</a>
                <a href="about.php" class="relative text-sm text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">About</a>
                <a href="#" class="relative text-sm text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Curriculum</a>
                <a href="institute.php" class="relative text-sm text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Institution</a>
                <a href="contact.php" class="relative text-sm text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Contact</a>
            </div>
        </div>
    </nav>


    <!-- MAIN BANNER -->
    <div id="page-header" class="w-full h-[50vh] bg-cover flex justify-center text-center flex-col p-4 text-white bg-[url('/assets/image/banner/banner.png')] shadow-lg mt-20">
        <h2 class="text-white text-shadow-md text-5xl font-bold mb-4">#let's_talk</h2>
        <p class="text-white text-shadow-md">LEAVE A MESSAGE, WE LOVE TO HEAR FROM YOU!</p>
    </div>


    <!-- CONTACT US -->
    <section id="contact-details" class="section-p1" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
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

    <!-- Error Messages -->
    <?php if (!empty($errors)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <strong>Please correct the following errors:</strong>
        <ul class="list-disc pl-5 mt-2">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Success Message -->  
    <?php if (!empty($success_message)): ?>
        <div class="fixed top-30 right-5 z-50 ">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg shadow-lg" role="alert">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Success!</p>
                        <p><?php echo htmlspecialchars($success_message); ?></p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Mail Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
    
    <!-- FORM SECTION -->
    <section id="form-details" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="contactForm" method="POST">
            <span>LEAVE A MESSAGE</span>
            <h2 class="font-bold">We Love To Hear From You</h2>

            <input type="text" id="name" name="name" placeholder="Your Name" required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition duration-300"><span class="text-red-500">*</span>
            <input type="email" id="email" name="email" placeholder="Your E-mail" required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition duration-300"><span class="text-red-500">*</span>
            <input type="text" id="subject" name="subject" placeholder="Your Subject" required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition duration-300"><span class="text-red-500">*</span>

            <textarea id="message" name="message" cols="30" rows="10" placeholder="Your Message"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-400 transition duration-300"></textarea>
            <button type="submit" name="submit" 
                class="w-full bg-indigo-600 text-white rounded-lg px-6 py-3 hover:bg-indigo-700 transition duration-300">
                Submit
            </button>
        </form>

        <!-- people -->
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
            <h4>Looking For News Letters?</h4>
            <p>Get E-mail Updates About Our Latest Syllabus And <span>Special Curriculum.</span></p>    
        </div>

        <div class="pr-0 mr-0">
            <!-- <input type="text" placeholder="Your email address"> -->
            <a class="w-64 h-15 bg-blue-500 rounded-sm text-white font-medium text-xl flex justify-center items-center" href="https://facilities.aicte-india.org/AICTEConnect/FEB2025/#p=1" target="_blank">Newsletter</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white">
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

    <!-- Form validation -->
    <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        let valid = true;
        
        // Validate name
        const name = document.getElementById('name');
        if (name.value.trim() === '') {
            valid = false;
            name.classList.add('border-red-500');
        } else {
            name.classList.remove('border-red-500');
        }
        
        // Validate email
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            valid = false;
            email.classList.add('border-red-500');
        } else {
            email.classList.remove('border-red-500');
        }
        
        // Validate message
        const message = document.getElementById('message');
        if (message.value.trim() === '') {
            valid = false;
            message.classList.add('border-red-500');
        } else {
            message.classList.remove('border-red-500');
        }
        
        if (!valid) {
            e.preventDefault();
        }
    });
    </script>

</body>
</html>