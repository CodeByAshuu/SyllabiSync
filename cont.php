<?php
// Initialize variables
$name = $email = $subject = $message = '';
$errors = [];
$success_message = $error_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get and sanitize form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
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
        $subject_line = "Contact Form: ";
        
        
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Santosh Vastralay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .contact-hero {
            background: linear-gradient(rgba(49, 46, 129, 0.8), rgba(49, 46, 129, 0.8)), 
                        url('https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }
        .map-container {
            height: 400px;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
        }
        .error {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-indigo-800">Santosh Vastralay</h1>
            </div>
            <nav class="hidden md:flex space-x-8">
                <a href="/santoshvas/Ecommerce/index.php" class="text-gray-700 hover:text-indigo-600 transition">Home</a>
                <a href="/santoshvas/Ecommerce/Home/landingpage.php" class="text-gray-700 hover:text-indigo-600 transition">Shop</a>
                <a href="/santoshvas/Ecommerce/Home/about.html" class="text-gray-700 hover:text-indigo-600 transition">About Us</a>
                <a href="/santoshvas/Ecommerce/Home/contact.php" class="text-indigo-600 font-semibold border-b-2 border-indigo-600">Contact</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 transition"><i class="fas fa-search"></i></a>
                <a href="/santoshvas/Ecommerce/Home/cart.php" class="text-gray-700 hover:text-indigo-600 transition relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </a>
            </nav>
            <button class="md:hidden text-gray-700" id="mobile-menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="contact-hero relative text-white py-24">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Santosh Vastralay</h1>
            <p class="text-xl max-w-2xl mx-auto">We'd love to hear from you! Reach out for inquiries, feedback, or styling advice.</p>
        </div>
    </section>

    <!-- Contact Section with PHP Integration -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Contact Form -->
                <div class="lg:w-1/2">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-indigo-800 mb-6">Send Us a Message</h2>

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
                        
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="mb-6">
                                <label for="name" class="block text-gray-700 font-medium mb-2">Your Name <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>" required>
                            </div>
                            <div class="mb-6">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="mb-6">
                                <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($phone); ?>">
                                <p class="text-gray-500 text-sm mt-1">Optional, but helpful for us to contact you quickly</p>
                            </div>
                            <div class="mb-6">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                                <select id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition">
                                    <option value="" <?php echo (!isset($subject) || $subject === '') ? 'selected' : ''; ?>>Select a subject</option>
                                    <option value="order" <?php echo (isset($subject) && $subject === 'order') ? 'selected' : ''; ?>>Order Inquiry</option>
                                    <option value="return" <?php echo (isset($subject) && $subject === 'return') ? 'selected' : ''; ?>>Returns & Exchange</option>
                                    <option value="feedback" <?php echo (isset($subject) && $subject === 'feedback') ? 'selected' : ''; ?>>Feedback</option>
                                    <option value="styling" <?php echo (isset($subject) && $subject === 'styling') ? 'selected' : ''; ?>>Styling Advice</option>
                                    <option value="other" <?php echo (isset($subject) && $subject === 'other') ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">Your Message <span class="text-red-500">*</span></label>
                                <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none input-focus transition" placeholder="Type your message here..." required><?php echo htmlspecialchars($message); ?></textarea>
                            </div>
                            <button type="submit" name="submit" class="w-full bg-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 transition shadow-md">
                                Send Message <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="lg:w-1/2">
                    <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                        <h2 class="text-2xl font-bold text-indigo-800 mb-6">Contact Information</h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4 flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Our Store</h3>
                                    <p class="text-gray-600">Bishunpura<br>Gopalganj, Bihar 841407</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4 flex-shrink-0">
                                    <i class="fas fa-phone-alt text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Phone Numbers</h3>
                                    <p class="text-gray-600">
                                        <a href="tel:+919006645817" class="hover:text-indigo-600 transition">+91 9006645817</a><br>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4 flex-shrink-0">
                                    <i class="fas fa-envelope text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Email Address</h3>
                                    <p class="text-gray-600">
                                        <a href="mailto:santoshvastralay@gmail.com" class="hover:text-indigo-600 transition">santoshvastralay@gmail.com</a><br>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-indigo-100 p-3 rounded-full mr-4 flex-shrink-0">
                                    <i class="fas fa-clock text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-1">Opening Hours</h3>
                                    <p class="text-gray-600">
                                        Monday - Sunday: 8:00 AM - 9:00 PM<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-indigo-800 mb-6">Connect With Us</h2>
                        <p class="text-gray-600 mb-6">Follow us on social media for the latest collections, offers, and fashion tips.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-pink-600 text-white p-3 rounded-full hover:bg-pink-700 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="bg-blue-800 text-white p-3 rounded-full hover:bg-blue-900 transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="pb-16">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3575.8696053798653!2d84.61605887479361!3d26.33072148486018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3993210031313fb3%3A0xa46287f5a7be8f20!2sSantosh%20Vastralay!5e0!3m2!1sen!2sin!4v1744655950826!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-indigo-800 mb-2">Find Us on Map</h2>
                    <p class="text-gray-600">Our store is conveniently located in the heart of Gopalganj's fashion district, easily accessible by public transport.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-indigo-800 mb-12">Frequently Asked Questions</h2>
            <div class="max-w-3xl mx-auto space-y-4">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 text-left faq-toggle">
                        <h3 class="text-lg font-semibold">What are your store timings?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="px-6 pb-6 hidden faq-content">
                        <p class="text-gray-600">We're open Monday to Sunday from 8:00 AM to 9:00 PM.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 text-left faq-toggle">
                        <h3 class="text-lg font-semibold">Do you offer home delivery?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="px-6 pb-6 hidden faq-content">
                        <p class="text-gray-600">Yes, we offer home delivery across Gopalganj. Standard delivery takes 2-3 business days.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 text-left faq-toggle">
                        <h3 class="text-lg font-semibold">What is your return policy?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="px-6 pb-6 hidden faq-content">
                        <p class="text-gray-600">We accept returns within 7 days of purchase with the original tags and receipt. Items must be unworn and in original condition.</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 text-left faq-toggle">
                        <h3 class="text-lg font-semibold">Do you offer customization services?</h3>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="px-6 pb-6 hidden faq-content">
                        <p class="text-gray-600">Yes, we provide customization services for many of our traditional outfits. Please visit our store or contact us for more details.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1595341595379-cf1cd0fb7fb3?ixlib=rb-1.2.1&auto=format&fit=crop&w=50&h=50&q=80" alt="Santosh Vastralay Logo" class="h-10 w-10 rounded-full object-cover mr-3">
                        <h3 class="text-xl font-bold">Santosh Vastralay</h3>
                    </div>
                    <p class="text-gray-400 mb-4">Where Fashion Meets Tradition.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 uppercase">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="/santoshvas/Ecommerce/index.php" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Home</a></li>
                        <li><a href="/santoshvas/Ecommerce/Home/landingpage.php" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Shop</a></li>
                        <li><a href="/santoshvas/Ecommerce/Home/about.html" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> About Us</a></li>
                        <li><a href="/santoshvas/Ecommerce/Home/contact.php" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 uppercase">Categories</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Sarees</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Salwar Suits</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Lehengas</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Kurtas</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i> Western Wear</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 uppercase">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Subscribe to get updates on new arrivals and special offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-lg w-full focus:outline-none text-gray-900" required>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> Santosh Vastralay. All Rights Reserved. | Designed with <i class="fas fa-heart text-red-500"></i> by Aditya Gupta</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="fixed bottom-6 right-6 bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-indigo-700 transition transform hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            // You would implement mobile menu functionality here
            console.log('Mobile menu button clicked');
        });

        // FAQ toggle functionality
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('i');
                
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        // Form validation
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