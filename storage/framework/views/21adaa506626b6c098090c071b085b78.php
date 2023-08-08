<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FOOD||RECOMENDATION</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a href="#" class="nav-link active " aria-current="page">
      <img src="image/logo.jpg" alt width="45" height="45" style="margin:-7; padding: 5px;">
    </a>
    <b class="navbar-brand">Food Recommedation</b>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo e(route('home')); ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo e(route('login')); ?>">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo e(route('register')); ?>">Register</a>
        </li>
        <li class="nav-item ms-auto">
          <?php if(Route::has('login')): ?>
              <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block" >
                  <?php if(auth()->guard()->check()): ?>
                      <a class="nav-link active" aria-current="page" href="<?php echo e(url('/dashboard')); ?>" style="text-decoration:none">Dashboard</a>
                  <?php endif; ?>
              </div>    
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <body class="antialiased">
<div class="d-flex justify-content-center">
                                    <marquee direction="left">
                                        <h3><b>Welcome to Food Recommendation System</b></h3>
                                    </marquee>
</div>
    <div id="carouselExampleFade" class="carousel slide carousel-fade mx-auto" data-bs-ride="carousel">
                <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="image/img1.jpg" class="d-block w-100" alt="img1" style="max-width: 1500px; max-height: 400px;">
                        </div>
                        <div class="carousel-item">
                            <img src="image/img2.jpg" class="d-block w-100" alt="img2" style="max-width: 1500px; max-height: 400px;">
                        </div>
                        <div class="carousel-item">
                            <img src="image/img3.jpg" class="d-block w-100" alt="img3" style="max-width: 1500px; max-height: 400px;">
                        </div>
                        <div class="carousel-item">
                            <img src="image/img4.jpg" class="d-block w-100" alt="img4" style="max-width: 1500px; max-height: 400px;">
                        </div>
                        <div class="carousel-item">
                            <img src="image/img5.jpg" class="d-block w-100" alt="img5" style="max-width: 1500px; max-height: 400px;">
                        </div>
                        <div class="carousel-item">
                            <img src="image/img6.jpg" class="d-block w-100" alt="img5" style="max-width: 1500px; max-height: 400px;">
                        </div>
                </div>
    
    </div>
    </body>
</html>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH F:\Softwar\XAMPP\htdocs\food\resources\views/welcome.blade.php ENDPATH**/ ?>