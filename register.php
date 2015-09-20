<?php
include_once 'includes/log_out.html';
require_once 'core/init.php';


if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $errors = array();
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'firstname' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            ),
            'email' => array(
                'required' => true,
                'min' => 2,
                'unique' => 'users',
                'email' => Input::get('email')
            )

        ));


        if ($validation->passed()) {
            $user = new User();
            $salt = Hash::salt(32);
            $a = Hash::active();
            $email = Input::get('email');
            $data = array(
                'username' => Input::get('username'),
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'phonenumber' => Input::get('phonenumber'),
                'email' => $email,
                'password' => Hash::make(Input::get('password'), $salt),
                'salt' => $salt,
                'active' => $a,
                'joined' => date('Y-m-d H:i:s'),
            );
            try {
                $user->create($data);

                $body = "Thank you for registering at http://gallerybank.com.ua. To activate your account, please click on this link:\n\n";
                $body .= 'http://' . $_SERVER['SERVER_NAME'] . '/activate.php?x=' . urlencode($email) . "&y=$a";

                mail($email, 'Registration Confirmation', $body, 'From: NazarSosnovsk@gmail.com');
                Session::flash('home', '<div class="message">Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</div>');
                Redirect::to('index.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $errors = $validation->errors();
        }
    }
}

?>


<div class="container">

    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
            <ul id="nav_left" class="nav navbar-nav pull-right">
                <li class=""><a href="login.php">Log in</a></li>
            </ul>

        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Enter the email you signed up with</label>
                    <input type="email" placeholder="Email"/>
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm"/>
                </div>
            </div>
            <div class="wrap">
                <p class="form-title">
                    Registration</p>

                <form class="login" id="form" method="post">
                    <label id="error" for="firstname"><?php if (isset($errors['firstname'])) {
                            echo $errors['firstname'];
                        }; ?></label>
                    <input type="text" name="firstname" id="firstname" placeholder="First name"
                           value="<?php echo escape(Input::get('firstname')) ?>">

                    <label id="error" for="lastname"><?php if (isset($errors['lastname'])) {
                            echo $errors['lastname'];
                        }; ?></label>
                    <input type="text" name="lastname" id="lastname" placeholder="Last name"
                           value="<?php echo escape(Input::get('lastname')) ?>">

                    <label id="error" for="username"><?php if (isset($errors['username'])) {
                            echo $errors['username'];
                        }; ?></label>
                    <input type="text" name="username" id="username" placeholder="Chose you username"
                           autocomplete="off" value="<?php echo escape(Input::get('username')) ?>"/>

                    <label id="error" for="password"><?php if (isset($errors['password'])) {
                            echo $errors['password'];
                        }; ?></label>
                    <input type="password" name="password" id="password" placeholder="Create a password"
                           autocomplete="off"/>

                    <label id="error" for="password_again"><?php if (isset($errors['password_again'])) {
                            echo $errors['password_again'];
                        }; ?></label>
                    <input type="password" name="password_again" id="password_again" placeholder="Confirm you password">

                    <label id="error" for="email"><?php if (isset($errors['email'])) {
                            echo $errors['email'];
                        }; ?></label>
                    <input type="text" name="email" id="email" placeholder="Email"
                           value="<?php echo escape(Input::get('email')) ?>">

                    <label id="error" for="phonenumber"><?php if (isset($errors['phonenumber'])) {
                            echo $errors['phonenumber'];
                        }; ?></label>
                    <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone number"
                           value="<?php echo escape(Input::get('phonenumber')) ?>">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input type="submit" value="Register" class="btn btn-success btn-sm"/>

                </form>
            </div>
        </div>
    </div>
    <div class="posted


