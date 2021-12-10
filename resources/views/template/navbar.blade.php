<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
      <nav class="flex items-center justify-between flex-wrap p-6 bg-gradient-to-r from-indigo-500 to-white">
          <div class="text-3xl font-black lg:flex-grow tracking-wide">
            <a href="#" 
              class="block mt-4 lg:inline-block lg:mt-0 text-white mr-4 rounded focus:outline-none focus:shadow-outline" >
              Accedo </a>
          </div>
          <div class="text-lg tracking-wide font-bold text-indigo-500 lg:flex-shrink">
            <a href="{{ route('login') }}"class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter mr-4 rounded focus:outline-none focus:shadow-outline">
              Login</a>
            <a href="{{ route('register') }}" class=" block mt-4 lg:inline-block lg:mt-0 text-teal-lighter mr-4 rounded focus:outline-none focus:shadow-outline">
              Register </a>
          </div>
      </nav>
    </body>
</html>