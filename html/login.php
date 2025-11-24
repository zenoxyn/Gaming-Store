<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../html/head.html'; ?>
    <title>Gaming Store - Login</title>
</head>

<body class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <!-- Background Blur -->
    <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://wallpapercave.com/wp/wp5648753.jpg');">
    </div>
    <div class="absolute inset-0 backdrop-blur-2xl bg-black/60"></div>

    <!-- MAIN LOGIN BOX -->
    <div class="relative z-10 flex w-[950px] h-[600px] bg-[#2b0054]/70 shadow-2xl rounded-xl overflow-hidden">

        <!-- LEFT SIDE (BANNER) -->
        <div class="w-1/2 bg-cover bg-center"
            style="background-image: url('https://wallpapercave.com/wp/wp5648753.jpg');">
            <div class="bg-black/50 w-full h-full flex flex-col justify-center items-center text-center p-8">
                <img src="https://i.ibb.co/1XvM1V7/zeusx-logo.png" class="w-40 mb-6">
                <h2 class="text-white font-bold text-3xl leading-tight">Marketplace For All Gamers</h2>
                <p class="text-gray-300 mt-3">Buy, Sell and Earn With Our Services</p>
            </div>
        </div>

        <!-- RIGHT SIDE (LOGIN BOX) -->
        <div class="w-1/2 p-12 text-white">
            <h2 class="text-3xl font-bold mb-2">Welcome to ZeusX</h2>
            <p class="text-gray-300 mb-6">Sign in to continue</p>

            <form>
                <label class="block mb-1">Username</label>
                <input type="text" placeholder="Username"
                    class="w-full bg-[#3d0072] p-3 rounded-lg outline-none mb-4 focus:ring-2 focus:ring-purple-500">

                <label class="block mb-1">Password</label>
                <input type="password" placeholder="Min 8 characters"
                    class="w-full bg-[#3d0072] p-3 rounded-lg outline-none mb-2 focus:ring-2 focus:ring-purple-500">

                <a href="#" class="text-purple-300 text-sm block text-right mb-5 hover:underline">Forgot Password?</a>

                <button
                    class="w-full bg-linear-to-r from-purple-500 to-pink-500 py-3 rounded-lg font-semibold mb-4">
                    Sign In
                </button>

                <div class="flex items-center my-4">
                    <div class="grow border-t border-gray-600"></div>
                    <span class="mx-3 text-gray-400">Or</span>
                    <div class="grow border-t border-gray-600"></div>
                </div>

                <button class="w-full bg-[#5662ff] py-3 rounded-lg mb-3">Sign In with Discord</button>
                <button class="w-full bg-[#1877f2] py-3 rounded-lg mb-3">Sign In with Facebook</button>
                <button class="w-full bg-white text-black py-3 rounded-lg">Login dengan Google</button>
            </form>

            <p class="mt-5 text-gray-300 text-sm text-center">
                Don't have an account?
                <a href="#" class="text-purple-400 hover:underline">Sign Up Here</a>
            </p>
        </div>

    </div>
</body>

</html>
