<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Social Energy</title>
        <link id="base-style" href="<?= base_url() ?>public/css/login.css" rel="stylesheet">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

			<link type="text/css" rel="stylesheet" href="<?= base_url() ?>public/assets/css/materialize.min.css"  />

			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    </head>
    <body>

        <div class="login-page">
            <div class="form">

				<?php
				if (isset($successOn)) {

					echo "<script type='text/javascript'>Materialize.toast('You have succesfully create a new account, try to login!', 5000, 'green rounded');</script>";
				}


				if (isset($formOn) && ($formOn == "on")) {

					$attributes = array('class' => 'login-form');
					$attributes_l = array('class' => 'register-form');
				} else {

					$attributes = array('class' => 'register-form');
					$attributes_l = array('class' => 'login-form');
				}
				?>


				<?= form_open('AddUsert/create', $attributes); ?>
                <form class="register-form">
					<input type="text" name="username1" id="username1" placeholder="username" value="<?= isset($username1) ? $username1 : ""; ?>"/>
				<?= form_error('username1'); ?> <?= isset($userNameBugUsername) ? $userNameBugUsername : ""; ?>
					<input type="email" name="useremail1" id="useremail1" placeholder="email address" value="<?= isset($useremail1) ? $useremail1 : ""; ?>"/>
				<?= form_error('useremail1'); ?>
                    <input type="password" name="password1" id="password1" placeholder="password"/>
				<?= form_error('password1'); ?>
                    <input type="text" name="firtName1" id="firtName1" placeholder="Firt Name" value="<?= isset($firtName1) ? $firtName1 : ""; ?>"/>
                <?= form_error('firtName1'); ?>
					<input type="text" name="lastName1" id="lastName1" placeholder="Last Name" value="<?= isset($lastName1) ? $lastName1 : ""; ?>"/>
					<?= form_error('lastName1'); ?>
                    <button>create</button>
                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                </form>
					<?= form_open('Login/auth', $attributes_l); ?>
                <input name="nameID" type="text" placeholder="username"/>
                <label for="nameID"><?= isset($userName) ? $userName : ""; ?></label>     
                <input name="passwordID" type="password" placeholder="password"/>
                <label for="passwordID"><?= isset($passWord) ? $passWord : ""; ?></label>
                <button>login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
                <p class="message"><a href="#">Login with facebook account</a></p>
                <p class="message">or</p>
                <p class="message"><a href="#">Login with twitter account</a></p>
                </form>
            </div>
        </div>


        <script src="<?= base_url() ?>public/js/jquery.js"></script>
        <script src="<?= base_url() ?>public/js/login.js"></script>

    </body>





</html>

