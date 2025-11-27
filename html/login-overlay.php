<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.html"; ?>
    <title>Gaming Store - Login</title>
</head>

<body>

    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

        <!-- Card Login -->
        <div class="bg-[#3a0ca3] w-[850px] rounded-xl flex overflow-hidden">

            <!-- Kiri (Poster / Gambar) -->
            <div class="w-1/2 bg-cover bg-center" style="background-image: url('../image/cat-1.png');">
            </div>

            <!-- Kanan (Form Login) -->
            <div class="w-1/2 p-10 text-white">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold">Welcome to ZeusX</h2>
                    <button class="text-2xl hover:text-red-400">&times;</button>
                </div>

                <label class="text-sm">Username</label>
                <input type="text" class="w-full mt-1 mb-4 p-3 rounded-lg bg-[#4b1fc6] placeholder-gray-300">

                <label class="text-sm">Password</label>
                <input type="password" class="w-full mt-1 p-3 rounded-lg bg-[#4b1fc6] placeholder-gray-300">

                <a href="#" class="text-sm mt-2 inline-block hover:underline">Forgot password?</a>

                <button class="w-full mt-6 p-3 rounded-lg bg-linear-to-r from-purple-500 to-pink-500 font-semibold">
                    Sign In
                </button>

                <div class="flex items-center gap-4 my-6">
                    <div class="flex-grow border-t border-white/40"></div>
                </div>

                <p class="mt-6 text-sm text-center">Don't have an account? <a href="#" class="underline">Sign Up Here</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>