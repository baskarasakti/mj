<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
    <meta name="keywords" content="login, signin">

    <title>Megahjaya - Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">

    <!-- Styles -->
    <link href="<?= base_url() ?>assets/css/core.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/app.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/style.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/img/apple-touch-icon.png">
    <link rel="icon" href="<?= base_url() ?>assets/img/favicon.png">
  </head>

  <body>


    <div class="row no-gutters min-h-fullscreen bg-white">
      <div class="col-md-6 col-lg-7 col-xl-8 d-none d-md-block bg-img" style="background-image: url(<?= base_url() ?>assets/img/printing.jpg)" data-overlay="5">

        <div class="row h-100 pl-50">
          <div class="col-md-10 col-lg-8 align-self-end">
            <h1 class="text-white"><b>Megahjaya</b></h1>
            <!-- <h3 class="text-white">Tetaplah Menjadi Pahlawan Masa Depan Indonesia</h3> -->
            <br><br><br>  
            <br><br>
          </div>
        </div>

      </div>



      <div class="col-md-6 col-lg-5 col-xl-4 align-self-center">
        <div class="px-80 py-30">
          <div class="">
            <!-- <span class="" ><img class="" src="#" alt="..."></span> -->
          </div>
          
          <br>
          <h4>Login</h4>
          <p><small>Sign into your account</small></p>
          <br>

          <?php if (validation_errors()) : ?>
            <p class="login-box-msg">
              <font color="red"><center><?= validation_errors() ?></center></font>
            </p>
          <?php endif; ?>
          <?php if (isset($error)) : ?>
            <p class="login-box-msg">
              <font color="red"><center><?= $error ?></center></font>
            </p>
          <?php endif; ?>

          <form class="form-type-material" action="<?= base_url()."user/login" ?>" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" id="username" name="username">
              <label for="username">Username</label>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password">
              <label for="password">Password</label>
            </div>

            <div class="form-group flexbox">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Remember me</span>
              </label>
            </div>

            <div class="form-group">
              <button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
            </div>
          </form>

          <hr class="w-30px">
        </div>
      </div>
    </div>




    <!-- Scripts -->
    <script src="<?= base_url() ?>assets/js/core.min.js"></script>
    <script src="<?= base_url() ?>assets/js/app.min.js"></script>
    <script src="<?= base_url() ?>assets/js/script.min.js"></script>

  </body>
</html>

