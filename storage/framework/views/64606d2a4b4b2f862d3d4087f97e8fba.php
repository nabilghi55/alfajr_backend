<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Backend Alfajar</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- LEXEND FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-700 via-orange-800 to-yellow-900">

    <div class="w-full max-w-md bg-white/10 backdrop-blur-xl shadow-2xl border border-white/20 rounded-2xl p-10 text-white">

        <!-- LOGO SECTION -->
        <div class="flex justify-center mb-6">
            <div class="bg-white/20 backdrop-blur-md p-4 rounded-full border border-white/30 shadow-lg">
                <img src="/logo.png" class="h-16 w-16 object-contain" alt="Logo Alfajar">
            </div>
        </div>

        <!-- TITLE -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-semibold">Selamat Datang</h1>
            <p class="text-orange-200 text-sm mt-1">Silakan masuk ke akun Anda</p>
        </div>

        <!-- FORM -->
        <form method="POST" action="/login">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div class="mb-5">
                <label class="block mb-1 font-medium text-orange-100">Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="email@example.com"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 placeholder-orange-200 text-white focus:ring-2 focus:ring-orange-400 focus:outline-none"
                >
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="block mb-1 font-medium text-orange-100">Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-white/20 border border-white/30 placeholder-orange-200 text-white focus:ring-2 focus:ring-orange-400 focus:outline-none"
                >
            </div>

            <!-- Remember + Forgot -->
            

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-orange-500 hover:bg-orange-600 transition font-semibold text-white shadow-lg"
            >
                Masuk
            </button>
        </form>

    
    </div>

</body>
</html>
<?php /**PATH /home/u263514024/domains/adminside.alfajrumroh.co.id/public_html/resources/views/login.blade.php ENDPATH**/ ?>