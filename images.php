


<?php

include_once 'includes/log_in.html';
include_once 'core/init.php';
$user = new User();
$user_id = $user->data()->id;
$gallery = new Gallery($user_id);



$data = $gallery->data();

for ($i = 0; $i < count($data); $i++) {
    $reference = $data[$i]->image;
    $image = basename($reference);
    $image_size = getimagesize($reference);
    $file_size = round((filesize($reference)) / 1024) . "kb";
    //$image = urlencode($image);
    echo "<div class='col-md-3 col-sm-4 col-xs-6'><a href=\"javascript:create_window('$image',$image_size[0],$image_size[1])\" ><img class='img-responsive' src=\"{$reference}\"/></a></div>";
}
echo "</div></div>";


?>
<script language="JavaScript">
    <!-- // Hide from old browsers.
    // Make a pop-up window function:
    function create_window(image, width, height) {

        // Add some pixels to the width and height:
        width = width + 100;
        height = height + 100;

        // If the window is already open,
        // resize it to the new dimensions:
        if (window.popup && !window.popup.closed) {
            window.popup.resizeTo(width, height);
        }

        var specs = "location=no, scrollbars=no, menubars=no, toolbars=no, resizable=yes, left=0, top=0, width=" + width + ", height=" + height;

        // Set the URL:
        var url = "show_image.php?image=" + image;

        // Create the pop-up window:
        popup = window.open(url, "ImageWindow", specs);
        popup.focus();

    } // End of function.
    //--></script>