<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Upload Files</strong></div>
        <div class="panel-body">

            <?php
            require_once 'core/init.php';
            require_once 'includes/log_in.html';
            $user = new User();

            $gallery = new Gallery($user->data()->id);

            if (!$user->isLoggedIn()) {
                Redirect::to('login.php');
            }

            # Script 10.3 - upload_image.php
            // Check if the form has been submitted:
            if (isset($_POST['submitted'])) {
// Check for an uploaded file:
                if (isset($_FILES['upload'])) {

                    $allowed = array('image/jpeg',
                        'image/jpeg', 'image/jpeg',
                        'image/JPG', 'image/X-PNG',
                        'image/PNG', 'image/png',
                        'image/x-png');


                    if (in_array($_FILES['upload']['type'], $allowed)) {

                        $img_name = "{$_FILES['upload']['name']}";
                        $path = "uploads/{$user->data()->id}";
                        $reference = "{$path}/{$img_name}";
                        $description = "";
                        $order = 0;
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        if($gallery->exists($reference)){
                            $message ="foto name: " . basename($reference) . " already exist";
                            Session::flash('error', $message);
                            Redirect::to('upload_image.php');
                        }
                        if (move_uploaded_file($_FILES['upload']['tmp_name'], $reference)) {

                            try {

                                $img_data = array(
                                    'image' => $reference,
                                    'description' => $description,
                                    'order' => $order,
                                    'user_id' => $user->data()->id

                                );
                                $gallery->create($img_data);

                                Session::flash('success', 'Your details have been updated.');
                                Redirect::to('upload_image.php');

                            } catch (Exception $e) {
                                die($e->getMessage());
                            }

                        } // End of move... IF.
                    } else { // Invalid type.

                        echo "<a href='#' class='list-group-item list-group-item-danger'>Please upload a JPEG or PNG image.</a><br>";


                    }
                } // End of isset($_FILES['upload']) IF.
// Check for an error:
                if ($_FILES['upload']['error'] > 0) {
                    echo '<p class="error">The file could not be uploaded because: <strong>';
// Print a message based upon the error

                    switch ($_FILES['upload']['error']) {
                        case 1:
                            print 'The file exceeds the upload_max_filesize setting php.ini.';
                            break;
                        case 2:
                            print 'The file exceeds the MAX_FILE_SIZE setting in the L form.';
                            break;
                        case 3:
                            print 'The file was only partially uploaded.';
                            break;
                        case 4:
                            print 'No file was uploaded.';
                            break;
                        case 6:
                            print 'No temporary folder was available.';
                            break;
                        case 7:
                            print 'Unable to write to the disk.';
                            break;
                        case 8:
                            print 'File upload stopped.';
                            break;
                        default:
                            print 'A system error ocurred.';
                            break;
                    } // End of switch.
                    print '</strong> </p>';
                } // End of error IF.
// Delete the file if it still exists:
                if (file_exists($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
                    unlink($_FILES['upload']['tmp_name']);
                }
            } // End of the submitted conditional.

            ?>


            <legend>Select a JPEG or PNG image of 512KB or smaller to be uploaded:</legend>
            <form action="upload_image.php" method="post" enctype="multipart/form-data" id="js-upload-form">
                <div class="form-inline">
                    <div class="form-group">
                        <input type="file" name="upload" id="js-upload-files" multiple>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                    <input type="hidden" name="submitted" value="TRUE"/>
                </div>
            </form>

            <!-- Drop Zone -->
            <h4>Or drag and drop files below</h4>

            <div class="upload-drop-zone" id="drop-zone">
                Just drag and drop files here
            </div>

            <!-- Progress Bar -->


            <!-- Upload Finished -->
            <div class="js-upload-finished">
                <div class="list-group">
                    <?php
                    if (Session::exists('success')) {
                        echo "<a href='images.php' class='list-group-item list-group-item-success'><span class='badge alert-success pull-right'>Success</span>" . Session::flash('success') . "</a>";
                    }else
                    if(Session::exists('error')){
                        echo "<a href='images.php' class='list-group-item list-group-item-warning'><span class='badge alert-warning pull-right'>Warning</span>" . Session::flash('error') . "</a>";
                    }

                    ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /container -->


</body>
</html>