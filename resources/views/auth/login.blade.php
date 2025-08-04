<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes rise {
            0% { transform: translateY(0); opacity: 0.2; }
            100% { transform: translateY(-120vh); opacity: 0; }
        }
        @keyframes diagonal {
            0% { transform: translate(0, 0); opacity: 0.2; }
            100% { transform: translate(50vw, -120vh); opacity: 0; }
        }
        @keyframes drift {
            0% { transform: translate(0, 0); opacity: 0.2; }
            100% { transform: translate(-50vw, -100vh); opacity: 0; }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
        .bubble {
            animation: rise 15s linear infinite;
        }
        .bubble-diagonal {
            animation: diagonal 18s linear infinite;
        }
        .bubble-drift {
            animation: drift 20s linear infinite;
        }
        .input-field:focus-within {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .google-btn:hover {
            box-shadow: 0 2px 10px rgba(66, 133, 244, 0.3);
        }
    </style>
</head>
<body class="bg-stone-800 min-h-screen flex items-center justify-center p-4 overflow-hidden">
    <!-- Animated Bubbles Background -->
   <div class="absolute inset-0 -z-10">
  <!-- Top Left -->
  <div class="absolute top-10 left-5 w-24 h-24 bg-blue-300 rounded-full opacity-20 bubble" style="animation-delay: 0s;"></div>

  <!-- Mid Top -->
  <div class="absolute top-20 left-1/4 w-16 h-16 bg-blue-400 rounded-full opacity-20 bubble-diagonal" style="animation-delay: 0s;"></div>

  <!-- Center -->
  <div class="absolute top-1/2 left-1/2 w-20 h-20 bg-blue-200 rounded-full opacity-20 bubble" style="animation-delay: 0s;"></div>

  <!-- Lower Right -->
  <div class="absolute bottom-10 right-1/3 w-12 h-12 bg-blue-500 rounded-full opacity-20 bubble-drift" style="animation-delay: 0s;"></div>

  <!-- Bottom Left -->
  <div class="absolute bottom-8 left-10 w-28 h-28 bg-blue-300 rounded-full opacity-20 bubble" style="animation-delay: 0s;"></div>

  <!-- Extra Spread -->
  <div class="absolute top-1/3 right-5 w-16 h-16 bg-blue-400 rounded-full opacity-20 bubble" style="animation-delay: 0s;"></div>
  <div class="absolute top-1/4 left-1/2 w-12 h-12 bg-blue-500 rounded-full opacity-20 bubble-drift" style="animation-delay: 0s;"></div>
  <div class="absolute bottom-1/2 right-1/4 w-20 h-20 bg-blue-200 rounded-full opacity-20 bubble" style="animation-delay: 0s;"></div>
</div>


    <!-- Login Form Container -->
    <div class="bg-white rounded-xl shadow-2xl overflow-hidden w-full max-w-md animate-fade-in">
        <!-- Decorative Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-center relative">
            <div class="absolute -top-10 -left-10 w-20 h-20 bg-blue-400 rounded-full opacity-20 animate-float"></div>
            <div class="absolute -bottom-5 -right-5 w-24 h-24 bg-blue-300 rounded-full opacity-20 animate-float" style="animation-delay: 0.5s;"></div>
            <div class="flex">
                <div> 
                    <img src="ESEClogo.png" alt="" class="h-auto w-20">
                </div>
                <div class="ml-10 mt-2">
                    <h2 class="text-2xl font-bold text-white relative z-10">Welcome Back</h2>
                    <p class="text-blue-100 mt-1 relative z-10">Sign in to your account</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <a href="{{ route('google.login') }}">
                <button class="google-btn w-full flex items-center justify-center py-3 px-4 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-all duration-300 mb-6">
                    <img src="https://logowik.com/content/uploads/images/985_google_g_icon.jpg" alt="Google logo" class="h-8 w-10 mr-3">
                    Continue with Google
                </button>
            </a>
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="mx-4 text-gray-500 text-sm">OR</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Email & Password Form -->
            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf 
                <div class="input-field bg-gray-50 border border-gray-300 rounded-lg transition-all duration-300">
                    <label for="email" class="block text-xs text-gray-500 px-4 pt-3">Email Address</label>
                    <div class="flex items-center px-4 pb-2">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                        <input type="email" id="email" class="w-full py-2 outline-none bg-transparent" placeholder="you@example.com" name="email" :value="old('email')" required>
                    </div>
                </div>
                <div class="input-field bg-gray-50 border border-gray-300 rounded-lg transition-all duration-300">
                    <label for="password" class="block text-xs text-gray-500 px-4 pt-3">Password</label>
                    <div class="flex items-center px-4 pb-2">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>
                        <input type="password" id="password" class="w-full py-2 outline-none bg-transparent" placeholder="••••••••" name="password" required>
                        <button type="button" class="text-gray-400 hover:text-blue-500">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition-all duration-300 transform hover:scale-[1.02] shadow-md">
                    Sign In
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.querySelector('[type="button"]');
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
                });
            }
        });
    </script>
</body>
</html>
