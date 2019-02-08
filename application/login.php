<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Social Energy</title>
        <link id="base-style" href="<?= base_url() ?>public/css/login.css" rel="stylesheet">

    </head>
    <body>

        <div class="login-page">
            <div class="form">

                <?php
                $attributes = array('class' => 'register-form');
                $attributes_l = array('class' => 'login-form');
                ?>


                <form class="register-form">
                    <input type="text" placeholder="name"/>
                    <input type="password" placeholder="password"/>
                    <input type="text" placeholder="email address"/>
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

