<?php
$base = '/dhakar-chaka/public/'; // my project root relative to localhost
include '../../includes/db_connect.php';
session_start();
echo $_SESSION['login_error']
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Dhakar Chaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input:focus, textarea:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-gray-50">
    <?php include '../../includes/header.php'; ?>
    
    <main class="min-h-screen flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-extrabold text-blue-800">
                    Create Your Account
                </h2>
                <p class="mt-2 text-lg text-gray-600">
                    Join Dhakar Chaka for reliable, quality car services.
                </p>
            </div>
            
            <form class="space-y-6 bg-white p-10 rounded-xl shadow-2xl border border-gray-100" action="<?= $base ?>signup/process.php" method="POST">
                <div class="space-y-5">
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                        <input id="name" name="name" type="text" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Enter your full name">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                        <input id="phone" name="phone" type="tel" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="e.g., +880 1XXXXXXXXX">
                    </div>
                    
                    <div>
                        <label for="city" class="block text-sm font-semibold text-gray-700">City</label>
                        <input id="city" name="city" type="text" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Enter your city">
                    </div>
                    
                    <div>
                        <label for="area" class="block text-sm font-semibold text-gray-700">Area/Locality</label>
                        <input id="area" name="area" type="text" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Enter your area or locality">
                    </div>
                    
                    <div>
                        <label for="street" class="block text-sm font-semibold text-gray-700">Street Address</label>
                        <input id="street" name="street" type="text" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="House/Building number and street">
                    </div>
                    
                    <div>
                        <label for="postal_code" class="block text-sm font-semibold text-gray-700">Postal Code</label>
                        <input id="postal_code" name="postal_code" type="text"
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Enter postal code (optional)">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Create a strong password">
                    </div>
                    
                    <div>
                        <label for="confirm-password" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                        <input id="confirm-password" name="confirm_password" type="password" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Confirm your password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-lg font-bold rounded-lg text-white bg-blue-700 shadow-md hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Register Account
                    </button>
                </div>
                
                <div class="text-center pt-2">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="<?= $base ?>login/" class="font-bold text-blue-700 hover:text-blue-900 transition duration-150">
                            Sign in here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </main>
    
    <?php include '../../includes/footer.php'; ?>
</body>

</html>