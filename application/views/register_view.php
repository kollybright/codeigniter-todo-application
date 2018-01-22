
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
            background:darkslategray;
            color: #ffffff;

        }

        .container{

            margin-top: 2.5em;
            margin-left: 1em;
            height: auto;
            width: auto;
        }
        #php{
            color: indianred;
            font-size: 19px;
        }
        a:hover{
            color:cyan;
        }



    </style>
</head>

<body>
<div class="container">
    <form id="form" action="<?php  echo site_url('todo/register') ?>" method="post">
        <div class="form-group">
            <h1>Sign Up|<?php echo anchor('todo/signin','Registered?','title="login page"')?></h1>

            <div class="row">
                <div class="col-sm-5">
                    <hr>
                    <p id="php">
                        <?php  echo isset($error)? $error:'' ?>
                    </p>
                    <hr>
                    <label for="username" class="form-">Username:</label>
                    <input type="text" class="form-control" name="username" id="username">

                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-5">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email"  id="email">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-5">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col-sm-5">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" class="form-control" name="cpassword" id="cpassword">
                </div>
            </div>
        </div>
        <!--        <div class="g-recaptcha" data-sitekey="6LdXR0AUAAAAACmw0v5RI8ZjWyTuJyCY9hAaI8iV"></div><br>-->
        <div class="form-group" >
            <input type="submit" class="btn btn-lg btn-success" value="Submit" id="submit" name="submit">
        </div>
    </form>
</div>
</body>
</html>
