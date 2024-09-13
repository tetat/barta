<!DOCTYPE html>
<html>
  
    <!-- head section -->
     @include('layouts/head')


  <body class="bg-gray-100">
    <header>
      <!-- Navigation -->
      @include('layouts/navbar')
    </header>

    <main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">

      @yield('content')
      
    </main>

    <!-- footer section -->
    @include('layouts/footer')
  </body>
</html>