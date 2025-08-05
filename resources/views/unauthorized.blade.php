<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>401 Unauthorized</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 0.8s ease-in-out;
    }
  </style>
</head>
<body class="bg-purple-50 flex items-center justify-center min-h-screen">
  <div class="text-center fade-in">
    <div class="mx-auto mb-6">
      <div class="w-19 h-19 rounded-full  flex items-center justify-center mx-auto">
         <svg width="205px" height="205px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#8e56e1" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 8.99999V12M12 15H12.01M20 12C20 16.4611 14.54 19.6937 12.6414 20.683C12.4361 20.79 12.3334 20.8435 12.191 20.8712C12.08 20.8928 11.92 20.8928 11.809 20.8712C11.6666 20.8435 11.5639 20.79 11.3586 20.683C9.45996 19.6937 4 16.4611 4 12V8.21759C4 7.41808 4 7.01833 4.13076 6.6747C4.24627 6.37113 4.43398 6.10027 4.67766 5.88552C4.9535 5.64243 5.3278 5.50207 6.0764 5.22134L11.4382 3.21067C11.6461 3.13271 11.75 3.09373 11.857 3.07827C11.9518 3.06457 12.0482 3.06457 12.143 3.07827C12.25 3.09373 12.3539 3.13271 12.5618 3.21067L17.9236 5.22134C18.6722 5.50207 19.0465 5.64243 19.3223 5.88552C19.566 6.10027 19.7537 6.37113 19.8692 6.6747C20 7.01833 20 7.41808 20 8.21759V12Z" stroke="#dfbaf2" stroke-width="1.296" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
    
      </div>
      
    </div>
    <h1 class="text-6xl font-bold text-purple-600 mb-4">401</h1>
    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Hold It Right There, Partner</h2>
    <p class="text-gray-600 mb-6">Sorry, but you don't have permission to access this page. Please try again or contact Admin if you think this is a mistake.</p>
    <a href="/dashboard" class="inline-block bg-white text-purple-600 border border-purple-600 px-6 py-2 rounded-md hover:bg-purple-100 transition">&larr; Back to login</a>
  </div>
</body>
</html>
