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
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-black text-yellow-400">

    <!-- Hero Section -->
    <div class="relative w-full h-screen bg-cover-custom">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-60"></div>
        
        <!-- Hero Content -->
        <div class="relative z-10 container mx-auto flex flex-col items-center justify-center h-full text-center">
            <img src="logo.jpg" alt="PAP's Fitness Gym Logo" class="w-48 mb-6">
            <h1 class="text-5xl font-bold text-yellow-400 mb-4">Welcome to PAP's Fitness Gym</h1>
            <p class="text-lg text-yellow-300 mb-8">Join us to embark on your fitness journey with top-tier equipment, professional trainers, and the best workout experience.</p>
            <a href="#pricing" class="bg-yellow-400 text-black py-3 px-8 rounded-lg text-xl font-semibold hover:bg-yellow-500 transition">Get Started</a>
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

    <!-- Testimonials Section -->
    <section id="testimonials" class="bg-black py-20 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl sm:text-5xl font-semibold text-yellow-400 mb-8">What Our Members Say</h2>
            <div class="flex flex-col md:flex-row justify-center gap-8">
                <div class="w-full md:w-1/3 bg-gray-800 p-8 rounded-lg shadow-lg">
                    <p class="text-yellow-300 italic mb-4">"The best gym I've ever been to! The trainers are amazing, and the equipment is always clean and ready for use. Highly recommend!"</p>
                    <p class="text-yellow-400 font-bold">John Doe</p>
                    <p class="text-yellow-300">Regular Member</p>
                </div>
                <div class="w-full md:w-1/3 bg-gray-800 p-8 rounded-lg shadow-lg">
                    <p class="text-yellow-300 italic mb-4">"PAP's Fitness Gym has changed my life. The variety of classes, the community, and the trainers push me to be my best!"</p>
                    <p class="text-yellow-400 font-bold">Jane Smith</p>
                    <p class="text-yellow-300">Monthly Member</p>
                </div>
                <div class="w-full md:w-1/3 bg-gray-800 p-8 rounded-lg shadow-lg">
                    <p class="text-yellow-300 italic mb-4">"I love the boxing sessions! It's the best way to stay fit and challenge myself. Trainers are very supportive."</p>
                    <p class="text-yellow-400 font-bold">Mark Johnson</p>
                    <p class="text-yellow-300">Boxing Member</p>
                </div>
            </div>
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

    <!-- Contact Us Section -->
    <section id="contact" class="bg-black py-20 text-center">
        <div class="container mx-auto">
            <h2 class="text-4xl sm:text-5xl font-semibold text-yellow-400 mb-8">Contact Us</h2>
            <p class="text-lg text-yellow-300 mb-4">We'd love to hear from you! Reach out for any questions or inquiries you have.</p>
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
