<?php
session_start();
$base = '/dhakar-chaka/public/'; // my project root relative to localhost
include '../includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhakar Chaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans text-gray-800">
    <?php include '../includes/header.php'; ?>
    <main>
        <!-- ----------------------- Hero Section ----------------------- -->
        <!-- ----------------------- Hero Section ----------------------- -->
        <!-- ----------------------- Hero Section ----------------------- -->
        <section id="#" class="bg-gray-50 py-24 sm:py-32 border-b border-gray-200">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-5xl font-extrabold mb-4 text-gray-900 leading-tight">Welcome to Dhakar Chaka</h1>
                <p class="text-xl text-gray-600 mb-10 max-w-3xl mx-auto">Your trusted, one-stop solution for all your
                    car maintenance and repair needs.</p>
                <a href="<?= $base ?>book_appointment/"
                    class="inline-block bg-blue-700 text-white font-semibold tracking-wide uppercase px-8 py-3 rounded-lg shadow-lg hover:bg-blue-800 transition duration-300 transform hover:scale-105">
                    Book a Service Today
                </a>
            </div>
        </section>

        <!-- ----------------------- Services ----------------------- -->
        <!-- ----------------------- Services ----------------------- -->
        <!-- ----------------------- Services ----------------------- -->
        <section id="services" class="bg-white py-20 sm:py-24">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold mb-4 text-blue-700">What We Can Do</h2>
                <p class="text-lg text-gray-600 mb-12 max-w-2xl mx-auto">Explore the essential services we offer to make
                    your experience unforgettable.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Emergency Services</h3>
                        <p class="text-gray-600">24/7 roadside assistance for all your emergency car troubles and needs.
                        </p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Wheel Alignment</h3>
                        <p class="text-gray-600">Professional alignment service for optimal handling and reduced tire
                            wear.</p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Brake Service</h3>
                        <p class="text-gray-600">Complete brake inspection, repair, and replacement services for safety.
                        </p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Car Painting</h3>
                        <p class="text-gray-600">Professional auto painting and bodywork for a seamless, fresh new look.
                        </p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Basic Care Service</h3>
                        <p class="text-gray-600">Regular maintenance including oil changes, tune-ups, and essential
                            fluid checks.</p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Car Wash</h3>
                        <p class="text-gray-600">Premium washing and detailing services to keep your vehicle sparkling
                            clean.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ----------------------- Why Choose Us ----------------------- -->
        <!-- ----------------------- Why Choose Us ----------------------- -->
        <!-- ----------------------- Why Choose Us ----------------------- -->
        <section id="why-choose-us" class="bg-gray-50 py-20 sm:py-24 border-t border-gray-200">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold mb-4 text-blue-700">Why Choose Us</h2>
                <p class="text-lg text-gray-600 mb-12 max-w-2xl mx-auto">Discover the benefits of choosing Dhakar Chaka
                    for reliable, high-quality car care.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Expert Technicians</h3>
                        <p class="text-gray-600">Our team consists of highly skilled, certified, and experienced
                            professionals.</p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Affordable Prices</h3>
                        <p class="text-gray-600">We offer competitive pricing and transparent quotes without
                            compromising on service quality.</p>
                    </div>

                    <div
                        class="bg-white p-8 rounded-xl border border-gray-100 shadow-md hover:shadow-xl transition duration-300">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Guaranteed Satisfaction</h3>
                        <p class="text-gray-600">We prioritize our customers' needs and strive for excellence in every
                            service we provide.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>

</html>