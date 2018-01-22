<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--    <meta http-equiv="refresh" content="10">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
    <!--    <link rel="stylesheet" type="text/css" href="style.css">-->
    <script src="<?php echo base_url('assets/jquery-3.2.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        body{
            height: 100%;
            width: 100%;
            margin: 0 auto;
            background:darkslategray;
            color: #ffffff;

        }
        .container{
            margin-top: 2.5em;
            height: auto;
            width: auto;
        }



        #butn{
            color: red;
            font-size: 17px;

        }
        a:hover{
            color: cyan;
        }
        #php{
            color: indianred;
            font-size: 21px;
        }


    </style>
</head>

<body>
<div class="container">

    <form action="<?php echo site_url('todo/login') ?>" method="post">
        <h1>Login| <?php echo anchor('todo','Sign Up','title="Sign up page"')?></h1>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <hr>
                    <p id="php">
                        <?php echo isset($error)?$error:''?>
                    </p>
                    <hr>
                    <label for="username" class="form-">Username:</label>
                    <input type="text" class="form-control" name="username" value="<?php echo  isset($_COOKIE['username']) ? $_COOKIE['username']: ''; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <label for="password" class="form-">Password:</label>
                    <input type="password" class="form-control" name="password" value="<?php  echo isset($_COOKIE['password'])?  $_COOKIE['password']: ''; ?>">
                </div>
            </div>
            <br>
            <!--            <div class="g-recaptcha" data-sitekey="6LdXR0AUAAAAACmw0v5RI8ZjWyTuJyCY9hAaI8iV"></div><br>-->

            <input type="checkbox" name="rem" <?php echo  (isset($_COOKIE['username'])&& isset($_COOKIE['password'])) ?  "checked": '';?>> Remember me
            <br>
        </div>
        <div class="form-group" id="butn">
            <input type="submit" class="btn btn-lg btn-success" value="Login" name="login">


        </div>

    </form>
    <div id="php">


    </div>

</body>
</html>