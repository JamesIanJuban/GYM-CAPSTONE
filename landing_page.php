<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAP's Fitness Gym</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom background image */
        .bg-cover-custom {
            background-image: url('img/bg.jpg');
            background-size: cover;
            background-position: center;
        }

        .text-shadow {
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
        }

        /* Custom Scroll Behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-black text-yellow-400">

    <!-- Navigation Bar -->
    <nav class="bg-black text-yellow-400 p-4 fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <img src="img/logo.jpg" alt="PAP's Fitness Gym Logo" class="w-12 sm:w-16"> <!-- Corrected image path -->
            <div class="space-x-4">
                <a href="login.php" class="bg-yellow-400 text-black py-2 px-6 rounded-lg text-lg font-semibold hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition">Login</a>
                <a href="#about" class="text-yellow-300 hover:text-yellow-400 focus:text-yellow-500 transition">About</a>
                <a href="#pricing" class="text-yellow-300 hover:text-yellow-400 focus:text-yellow-500 transition">Pricing</a>
                <a href="#equipment" class="text-yellow-300 hover:text-yellow-400 focus:text-yellow-500 transition">Equipment</a> <!-- New Equipment Link -->
                <a href="#contact" class="text-yellow-300 hover:text-yellow-400 focus:text-yellow-500 transition">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative w-full h-screen bg-cover-custom">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="relative z-10 container mx-auto flex flex-col items-center justify-center h-full text-center">
            <img src="img/logo.jpg" alt="PAP's Fitness Gym Logo" class="w-48 sm:w-64 mb-6"> <!-- Corrected image path -->
            <h1 class="text-4xl sm:text-5xl font-bold text-yellow-400 mb-4 text-shadow">Welcome to PAP's Fitness Gym</h1>
            <p class="text-lg sm:text-xl text-yellow-300 mb-8 text-shadow">Join us to embark on your fitness journey with top-tier equipment, professional trainers, and the best workout experience.</p>
            <a href="#pricing" class="bg-yellow-400 text-black py-3 px-8 rounded-lg text-xl font-semibold hover:bg-yellow-500 transition">Get Started</a>
            <a href="login.php" class="mt-4 bg-yellow-500 text-black py-3 px-8 rounded-lg text-xl font-semibold hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition">Login</a>
        </div>
    </div>

    <!-- About Us Section -->
    <section id="about" class="bg-black py-20 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl sm:text-5xl font-semibold text-yellow-400 mb-8">About PAP's Fitness Gym</h2>
            <p class="text-lg text-yellow-300 mb-8">Located in Talisay, Cebu, PAP's Fitness Gym is dedicated to helping you achieve your fitness goals. We offer a variety of equipment, classes, and personalized training options to meet your fitness needs.</p>
            <a href="#contact" class="bg-yellow-400 text-black py-3 px-8 rounded-lg text-xl font-semibold hover:bg-yellow-500 transition">Contact Us</a>
        </div>
    </section>
    
     <!-- Pricing Section -->
     <section id="pricing" class="bg-black py-20 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl sm:text-5xl font-semibold text-yellow-400 mb-8">Our Membership Plans</h2>
            <div class="flex flex-col md:flex-row justify-center gap-8">
                <div class="w-full md:w-1/3 bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-yellow-400">Daily Pass</h3>
                    <p class="text-yellow-300 mt-4">₱35 per day</p>
                    <p class="text-yellow-300 mt-2">Perfect for occasional visitors.</p>
                </div>
                <div class="w-full md:w-1/3 bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-yellow-400">Monthly Membership</h3>
                    <p class="text-yellow-300 mt-4">₱600 per month</p>
                    <p class="text-yellow-300 mt-2">Ideal for committed gym-goers.</p>
                </div>
                <div class="w-full md:w-1/3 bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-yellow-400">Boxing Session</h3>
                    <p class="text-yellow-300 mt-4">₱100 per hour</p>
                    <p class="text-yellow-300 mt-2">One-on-one boxing training.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Equipment Section -->
    <section id="equipment" class="bg-black py-20 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl sm:text-5xl font-semibold text-yellow-400 mb-8">Our Equipment</h2>
            <p class="text-lg text-yellow-300 mb-8">We offer a wide variety of equipment to help you achieve your fitness goals, including strength training and cardio equipment.</p>

            <!-- Equipment Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- Equipment Card 1 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/benchpress.jpeg" alt="Bench Press" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Bench Press</h3>
                    <p class="text-yellow-300">A must-have for building upper body strength, the bench press is a classic exercise for chest and tricep development.</p>
                </div>

                <!-- Equipment Card 2 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/cable.jpeg" alt="Cable Machine" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Cable Machine</h3>
                    <p class="text-yellow-300">Versatile and effective for a full-body workout. The cable machine allows for various exercises to target multiple muscle groups.</p>
                </div>

                <!-- Equipment Card 3 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/dumbbells.jpeg" alt="Dumbbells" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Dumbbells</h3>
                    <p class="text-yellow-300">An essential for strength training, dumbbells help improve muscle tone and strength. Available in various weights.</p>
                </div>

                <!-- Equipment Card 4 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/excercisebike.jpeg" alt="Exercise Bike" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Exercise Bike</h3>
                    <p class="text-yellow-300">Perfect for cardio workouts, our exercise bikes offer a low-impact way to improve cardiovascular health and burn calories.</p>
                </div>

                <!-- Equipment Card 5 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/jumprose.jpeg" alt="Jump Rope" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Jump Rope</h3>
                    <p class="text-yellow-300">A simple yet effective cardio tool for improving endurance, coordination, and burning fat.</p>
                </div>

                <!-- Equipment Card 6 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/kettlebells.jpeg" alt="Kettlebells" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Kettlebells</h3>
                    <p class="text-yellow-300">Ideal for full-body workouts, kettlebells are great for building strength, improving endurance, and enhancing coordination.</p>
                </div>

                <!-- Equipment Card 7 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/legpress.jpeg" alt="Leg Press" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Leg Press</h3>
                    <p class="text-yellow-300">For targeting the lower body, the leg press machine helps strengthen quadriceps, hamstrings, and glutes.</p>
                </div>

                <!-- Equipment Card 8 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/plates.jpeg" alt="Weight Plates" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Weight Plates</h3>
                    <p class="text-yellow-300">Essential for progressive overload, our weight plates are perfect for adding intensity to your strength training routine.</p>
                </div>

                <!-- Equipment Card 9 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/pullupbar.jpeg" alt="Pull-up Bar" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Pull-up Bar</h3>
                    <p class="text-yellow-300">An effective tool for building upper body strength, especially for the back, biceps, and forearms.</p>
                </div>

                <!-- Equipment Card 10 -->
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="img/squatrock.jpeg" alt="Squat Rack" class="w-full h-48 object-cover mb-4 rounded-lg">
                    <h3 class="text-xl text-yellow-400 font-bold mb-2">Squat Rack</h3>
                    <p class="text-yellow-300">The squat rack is key for safely performing heavy squats and other barbell exercises to develop leg strength and power.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="bg-black py-20 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl sm:text-5xl font-semibold text-yellow-400 mb-8">Contact Us</h2>
            <p class="text-lg text-yellow-300 mb-4">We'd love to hear from you! Reach out for any questions or inquiries you have.</p>

            <!-- Success/Error Messages -->
            <?php if (isset($successMessage)) { ?>
                <div class="text-green-500 mb-4"><?php echo $successMessage; ?></div>
            <?php } ?>
            <?php if (isset($errorMessage)) { ?>
                <div class="text-red-500 mb-4"><?php echo $errorMessage; ?></div>
            <?php } ?>

            <form action="#" method="POST" class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg text-yellow-400">
                <div class="mb-4">
                    <input type="text" name="name" placeholder="Your Name" required class="w-full p-3 bg-gray-700 text-yellow-400 rounded">
                </div>
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Your Email" required class="w-full p-3 bg-gray-700 text-yellow-400 rounded">
                </div>
                <div class="mb-4">
                    <textarea name="message" rows="4" placeholder="Your Message" required class="w-full p-3 bg-gray-700 text-yellow-400 rounded"></textarea>
                </div>
                <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded-lg">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-black text-yellow-400 py-8">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; <?php echo date("Y"); ?> PAP's Fitness Gym. All rights reserved.</p>
            <div class="mt-4">
                <a href="#facebook" class="bg-yellow-400 rounded-full p-3 inline-block mr-2"><i class="fab fa-facebook text-black"></i></a>
                <a href="#twitter" class="bg-yellow-400 rounded-full p-3 inline-block mr-2"><i class="fab fa-twitter text-black"></i></a>
                <a href="#linkedin" class="bg-yellow-400 rounded-full p-3 inline-block"><i class="fab fa-linkedin text-black"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>
