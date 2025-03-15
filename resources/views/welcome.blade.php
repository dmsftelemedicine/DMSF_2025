<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diabetes Teleconsultation</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Nunito', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="relative flex flex-col items-center min-h-screen bg-cover bg-center pt-20" style="background-image: url('/images/login_background.jpg');">
       
        <div class="relative z-10 text-center text-white py-20">
            <h1 class="text-4xl font-extrabold">Your Health, Your Convenience</h1>
            <p class="mt-4 text-lg">Reliable teleconsultation services for diabetic patients from the comfort of your home.</p>
            <div class="mt-6">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-500 text-white font-bold rounded-lg shadow-md hover:bg-blue-600">Register</a>
                <a href="{{ route('login') }}" class="ml-4 px-6 py-3 border border-white text-white font-bold rounded-lg hover:bg-white hover:text-gray-900">Log In</a>
            </div>
        </div>
        <section class="container mx-auto py-20 px-6 text-center">
            <h2 class="text-3xl font-bold">Why Choose Our Teleconsultation?</h2>
            <div class="flex flex-wrap justify-center mt-10">
                <div class="w-full md:w-1/3 p-6">
                    <div class="p-6 bg-white shadow-lg rounded-lg">
                        <h3 class="text-xl font-semibold">Expert Doctors</h3>
                        <p class="mt-2 text-gray-600">Connect with top specialists for diabetes management.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 p-6">
                    <div class="p-6 bg-white shadow-lg rounded-lg">
                        <h3 class="text-xl font-semibold">24/7 Availability</h3>
                        <p class="mt-2 text-gray-600">Access consultations anytime, anywhere.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 p-6">
                    <div class="p-6 bg-white shadow-lg rounded-lg">
                        <h3 class="text-xl font-semibold">Easy Prescription Access</h3>
                        <p class="mt-2 text-gray-600">Get prescriptions and recommendations instantly.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    
</body>
</html>
