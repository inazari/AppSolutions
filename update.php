<?php
require_once 'core/init.php';
include_once 'includes/log_in.html';
$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'firstname' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if ($validation->passed()) {
            try {
                $user->update(array(
                    'firstname' => Input::get('firstname')
                ));

                Session::flash('home', '<div class="message">Your details have been updated.</div>');
                Redirect::to('index.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }

        }
    }
}

?>
<div class="container">
    <div class="row">
        <div
            class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "{$user->data()->firstname}  {$user->data()->lastname}" ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-9 col-lg-9 ">
                            <form class="login" id="form" method="post">

                                <label id="error" for="firstname"><?php if (isset($errors['firstname'])) {
                                        echo $errors['firstname'];
                                    }; ?></label>
                                <input type="firstname" name="firstname" id="firstname"
                                       placeholder="<?php echo escape($user->data()->firstname); ?>"/>
                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                <input type="submit" value="change" class="btn btn-success btn-sm"/>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>