
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--    <meta http-equiv="refresh" content="10">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
    <!--    <link rel="stylesheet" type="text/css" href="style.css">-->
    <script src="<?php echo base_url('assets/jquery-3.2.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <style>
        body{
            height: 100%;
            width: 100%;
            /*background:darkslategray;*/
            /*background-color: #245269;*/
            background-color: #122b40;
            color: #ffffff;

        }

        .container{

            margin-top: 1.5em;
            margin-left: 1em;
            height: auto;
            width: auto;
        }

        a:hover{
            color:darkcyan;
            text-decoration: none;
        }

  .error{
      color:indianred;

  }

    </style>
</head>

<body>
<div class="container">
    <h1>Sign Up|<?php echo anchor('todo/signin','login?','title="login page"')?></h1>
    <?= form_open('todo/register') ?>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="username" class="form-">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username')?>">
                    <span class="error"><?php echo form_error('username') ?></span>
                </div>

            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email"  id="email"  value="<?= set_value('email')?>">
                    <span class="error"><?php echo form_error('email') ?></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password"  value="<?= set_value('password')?>">
                    <span class="error"><?php echo form_error('password') ?></span>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword"  value="<?= set_value('cpassword')?>">
                    <span class="error"><?php echo form_error('cpassword') ?></span>
                </div>
            </div>
        </div>
                <div class="g-recaptcha" data-sitekey="6LdXR0AUAAAAACmw0v5RI8ZjWyTuJyCY9hAaI8iV"></div><p class="error"><?= isset($error)?$error:'';?></p><br>

        <div class="form-group" >
            <input type="submit" class="btn btn-lg btn-primary" value="Submit" id="submit" name="submit">
        </div>
    </form>
</div>
</body>
</html>
