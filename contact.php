<!-- form submission using php by sagar -->
<?php
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
        // Recipient email address
        $to = "sagarsahu5976@gmail.com";
        
        // Subject line based on the selected subject
        $subject_line = "Contact Form Submission: " . ($subject ? $subject : "General Inquiry");

        // Email headers
        $headers = "From: $name <$email>" . "\r\n";
        $headers .= "Reply-To: $email" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Email body
        $email_body = "
        <html>
        <head>
            <title>$subject_line</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                table { border-collapse: collapse; width: 100%; max-width: 600px; }
                th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
                th { background-color: #f2f2f2; width: 30%; }
            </style>
        </head>
        <body>
            <h2>Contact Form Submission</h2>
            <table>
                <tr>
                    <th>Name:</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>$email</td>
                </tr>
                <tr>
                    <th>Subject:</th>
                    <td>$subject_line</td>
                </tr>
                <tr>
                    <th>Message:</th>
                    <td>" . nl2br($message) . "</td>
                </tr>
            </table>
        </body>
        </html>
        ";
        
        // Send email
        try {
            $mail_sent = mail($to, $subject_line, $email_body, $headers);
            
            if ($mail_sent) {
                $success_message = "Thank you for contacting us. We will get back to you soon!";
                // Clear form fields after successful submission
                $name = $email = $subject = $message = '';
            } else {
                $error_message = "Sorry, there was an error sending your message. Please try again later.";
            }
        } catch (Exception $e) {
            $error_message = "Mailer Error: " . $e->getMessage();
        }
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
                <a href="institute.php" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Institution</a>
                <a href="contact.php" class="relative text-base text-gray-800 hover:text-blue-500 after:block after:h-[2px] after:w-0 after:bg-blue-500 after:transition-all after:duration-300 hover:after:w-full">Contact</a>
            </div>
        </div>
    </nav>


    <!-- MAIN BANNER -->
    <div id="page-header" class="w-full h-[50vh] bg-cover flex justify-center text-center flex-col p-4 text-white bg-[url('/assets/image/banner/banner.png')] shadow-lg">
        <h2 class="text-white text-shadow-md text-5xl font-bold mb-4">#let's_talk</h2>
        <p class="text-white text-shadow-md">LEAVE A MESSAGE, WE LOVE TO HEAR FROM YOU!</p>
    </div>


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
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <?php echo htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>

    <!-- Mail Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
    
    <!-- FORM SECTION -->
    <section id="form-details">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="contactForm" method="POST">
            <span>LEAVE A MESSAGE</span>
            <h2 class="font-bold">We Love To Hear From You</h2>

            <input type="text" id="name" name="name" placeholder="Your Name" required><span class="text-red-500">*</span>
            <input type="email" id="email" name="email" placeholder="Your E-mail" required><span class="text-red-500">*</span>
            <input type="text" id="subject" name="subject" placeholder="Your Subject" required><span class="text-red-500">*</span>

            <textarea id="message" name="message" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button type="submit" name="submit" class="bg-indigo-600 rounded-lg px-6 py-3">Submit</button>
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