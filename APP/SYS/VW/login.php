<?php
    session_start();
    if(isset($_SESSION['u'])) header('Location:home');
?>
<link rel="stylesheet" type="text/css" href="APP/RES/CSS/login.css">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-4 col-md-6 col-sm-8 col-xs-10 col-lg-offset-4 col-md-offset-3 col-sm-offset-2 col-xs-offset-1" style="margin-top: 100px;">
                <div class="account-wall">
                    <div id="app_name">
                    <h3 class="text-center"><?php echo APP_NAME;?></h3>
                </div>
                <img class="profile-img" src="APP/RES/IMG/favicon-512.png"
                alt="">
                    <form id="form-login" class="form-signin">
                    <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <button id="btn-login" class="btn btn-block btn-lg btn-danger" data-loading-text="Signing in..." type="submit">
                    Sign in</button>
                    <span class="clearfix"></span>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="APP/RES/JS/login.js"></script>