<?php
require_once 'core/init.php';
if (Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();
if ($user->isLoggedIn()) {
    include_once 'includes/log_in.html';
    ?>


    <?php

} else {
    include_once 'includes/log_out.html';
    ?>


   <!-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap">
                    <button type="button" onclick="window.location.href='login.php'"
                            class="btn btn-outlined btn-theme btn-lg">Login
                    </button>
                    <button type="button" onclick="window.location.href='register.php'"
                            class="btn btn-outlined btn-theme btn-lg">Registration
                    </button>

                </div>
            </div>
        </div>
    </div>-->
    <?php
}
?>
