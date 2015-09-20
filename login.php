<?php
include_once 'includes/log_out.html';

require_once 'core/init.php';
$login = true;
if (Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $errors = array();
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));


        if ($validation->passed()) {
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if ($login) {
                Session::flash('home', '<div class="message">welcome</div>');
                Redirect::to('index.php');
            } else {

                $login = false;
            }
        } else {
            $errors = $validation->errors();

        }
    }
}
?>
<!---->


<div class="container">
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
            <ul id="nav_left" class="nav navbar-nav pull-right">
                <li class=""><a href="register.php">Registration</a></li>
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
                    Sign In</p>

                <form class="login" id="form" method="post">
                    <label id="error" for="username"><?php if (isset($errors['username'])) {
                            echo $errors['username'];
                        }; ?></label>
                    <input type="text" name="username" id="username" placeholder="Username"
                           value="<?php echo escape(Input::get('username')); ?>"/>
                    <label id="error" for="password"><?php if (isset($errors['password'])) {
                            echo $errors['password'];
                        }; ?></label>
                    <input type="password" name="password" id="password" placeholder="Password"/>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input type="submit" id="button" value="Sign In" class="btn btn-success btn-sm"/>
                    <?php if (!$login) {
                       /* if ($user->activate(Input::get('username'))) {
                            echo '<div id = "log_fail"> Sorry, your account is not activated.</div >';
                        } else*/ {
                            echo '<div id = "log_fail"> Sorry, loggin in failed .</div >';
                        }
                    }
                    ?>
                    <div class="remember-forgot">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" id="remember"/>Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="posted-by">Posted By: <a href="http://www.jquery2dotnet.com">Nazar</a></div>
</div>
