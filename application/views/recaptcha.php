<! DOCTYPE hmt>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>ReCAPTCHA</title>
    <meta charset="utf-8">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
    <script src="<?php echo base_url('assets/jquery-3.2.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>

        body{
            width: 100%;
            height: 100%;
            background-color: #242429;
        }

        .flex-container {
            display: flex;
            height: 20em;
            justify-content: center;
            align-items: center;
            color: #ffffff;
        }


    </style>
</head>
<body>
<div class="flex-container">
<?= form_open('todo/login')?>
    <h3>Confirm, you are not a robot</h3>
<div class="g-recaptcha" data-sitekey="6LdXR0AUAAAAACmw0v5RI8ZjWyTuJyCY9hAaI8iV"></div>
</div>
</form>
</body>


</html>