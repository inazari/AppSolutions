<?php

require_once 'core/init.php';
include_once 'includes/header.html';
$user = new User();
$errors = array();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_current' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
            ),
        ));

        if($validation->passed()){
            if(Hash::make(Input::get('password_current'), $user->data()->salt) != $user->data()->password){
                echo 'Yor current password is wrong';
            }else{
                $salt = Hash::salt(32);

                $user->update(array(
                    'password' => Hash::make(Input::get('password_new'), $salt),
                    'salt' => $salt
                ));

                Session::flash('home', 'Your password has been changed!');
                Redirect::to('index.php');
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
            <div class="wrap">
                <p class="form-title">
                    Change Password</p>

                <form class="login" id="form" method="post">

                    <label id="error" for="password_current"><?php if (isset($errors['password_current'])) {
                            echo $errors['password_current'];
                        }; ?></label>
                    <input type="password" name="password_current" id="password_current" placeholder="Old Password:"
                           autocomplete="off" value="<?php echo escape(Input::get('password_current')) ?>"/>

                    <label id="error" for="password_new"><?php if (isset($errors['password_new'])) {
                            echo $errors['password_new'];
                        }; ?></label>
                    <input type="password" name="password_new" id="password_new" placeholder="New Password:"
                           autocomplete="off" />

                    <label id="error" for="password_new_again"><?php if (isset($errors['password_new_again'])) {
                            echo $errors['password_new_again'];
                        }; ?></label>
                    <input type="password" name="password_new_again" id="password_new_again" placeholder="New Password (confirm):">


                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input type="submit" value="Register" class="btn btn-success btn-sm"/>

                </form>
            </div>
        </div>
    </div>