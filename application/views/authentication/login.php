<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset_url($logo->logo_path);?>">
    <title><?=$title;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= asset_url('bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?= asset_url('plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css');?>" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= asset_url('css/animate.css');?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= asset_url('css/style.css'); ?>" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= asset_url('css/colors/blue.css');?>" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" method="post" action="<?=site_url('login/check_login');?>">
					<a href="javascript:void(0)" class="text-center db"><img height="70" src="<?= asset_url($logo->logo_path); ?>" alt="Home" />
                        <br/><img height="21" width="108" src="<?= asset_url($logo->logo_title_path); ?>" alt="Home" /></a>
					<div class="text-center" style="color: red; margin-top:10px;">
						<?php 
						if($this->session->flashdata('login_error')){
							echo $this->lang->line('login_error');
						}
						?>
					</div>
					<div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" required="" placeholder="<?=$this->lang->line('username');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="<?=$this->lang->line('password');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> <?=$this->lang->line('remember');?> </label>
                            </div>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> <?=$this->lang->line('forgot');?></a> </div>
					</div>
					<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>">
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"><?=$this->lang->line('login');?></button>
                        </div>
					</div>
					<div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="<?=site_url('registration');?>" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
					</div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="<?= asset_url('plugins/bower_components/jquery/dist/jquery.min.js');?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= asset_url('bootstrap/dist/js/tether.min.js');?>"></script>
    <script src="<?= asset_url('bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset_url('plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js');?>"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= asset_url('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js');?>"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= asset_url('js/jquery.slimscroll.js');?>"></script>
    <!--Wave Effects -->
    <script src="<?= asset_url('js/waves.js');?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= asset_url('js/custom.min.js');?>"></script>
    <!--Style Switcher -->
    <script src="<?= asset_url('plugins/bower_components/styleswitcher/jQuery.style.switcher.js');?>"></script>
</body>

</html>
