<?php
require_once 'core/init.php';
include_once 'includes/log_in.html';
$user = new User();
if ($user->isLoggedIn()) {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo "{$user->data()->firstname}  {$user->data()->lastname}"?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Fist name</td>
                                        <td><?php echo  $user->data()->firstname;?></td>
                                    </tr>
                                    <tr>
                                        <td>Last name</td>
                                        <td><?php echo  $user->data()->lastname;?></td>
                                    </tr>

                                    <tr>
                                        <td>User name</td>
                                        <td><?php echo  $user->data()->username;?></td>
                                    </tr>

                                    <tr>
                                        <td>Email</td>
                                        <td><a href="mailto:info@support.com"><?php echo  $user->data()->email;?></a></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo  $user->data()->phonenumber;?></td>
                                    </tr>
                                    <tr>
                                        <td>Joined</td>
                                        <td><?php echo  $user->data()->joined;?></td>
                                    </tr>

                                    </tbody>
                                </table>

                                <a href="update.php" class="btn btn-primary">update name</a>
                                <a href="changepassword.php" class="btn btn-primary">update password</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    Redirect::to('index.php');
}
?>


<?php
/*require_once 'core/init.php';

if(!$username = Input::get('user')){
   // Redirect::to('index.php');
}else {
    $user = new User($username);
   if(!$user->exists()){
       Redirect::to(404);
   } else {
       $data = $user->data();
   }
    */ ?><!--
<h3><?php /*echo escape($data->username); */ ?></h3>
    <p>Full name: <?php /*echo escape($data->firstname); */ ?></p>
--><?php
/*}

*/ ?>