<html>
<head>
    <title>My Form</title>
</head>
<style>
    p{
        color: red;
    }
</style>
<body>

<!--<pre style=" color: red">--><?php //echo validation_errors(); ?><!--</pre>-->

<?php echo form_open('form'); ?>

<h5>Username</h5>
<input type="text" name="username" value="<?= set_value('username');?>" size="50" />
<p><?php echo form_error('username'); ?></p>
<h5>Password</h5>
<input type="text" name="password" value="<?= set_value('password');?>" size="50" />
  <p><?php echo form_error('password'); ?></p>

<h5>Password Confirm</h5>
<input type="text" name="passconf" value="<?= set_value('passconf');?>" size="50" />
<p><?php echo form_error('passconf'); ?></p>

<h5>Email Address</h5>
<input type="text" name="email" value="<?= set_value('email');?>" size="50" />
<p><?php echo form_error('email'); ?></p>

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>