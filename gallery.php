


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

<script type="text/javascript" src="script.js"></script>



<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thumbnail Gallery</h1>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="This is my title" data-caption="Some lovely red flowers" data-image="http://onelive.us/wp-content/uploads/2014/08/flower-delivery-online.jpg" data-target="#image-gallery">
                <img class="img-responsive" src="http://onelive.us/wp-content/uploads/2014/08/flower-delivery-online.jpg" alt="Short alt text">
            </a>
        </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="The car i dream about" data-caption="If you sponsor me, I can drive this car" data-image="http://www.picturesnew.com/media/images/car-image.jpg" data-target="#image-gallery">
                <img class="img-responsive" src="http://www.picturesnew.com/media/images/car-image.jpg" alt="A alt text">
            </a>
        </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice" data-caption="And if there is money left, my girlfriend will receive this car" data-image="http://upload.wikimedia.org/wikipedia/commons/7/78/1997_Fiat_Panda.JPG" data-target="#image-gallery">
                <img class="img-responsive" src="http://upload.wikimedia.org/wikipedia/commons/7/78/1997_Fiat_Panda.JPG" alt="Another alt text">
            </a>
        </div>
</div>


<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive" src="">
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image">Previous</button>
                </div>

                <div class="col-md-8 text-justify" id="image-gallery-caption">
                    This text will be overwritten by jQuery
                </div>

                <div class="col-md-2">
                    <button type="button" id="show-next-image" class="btn btn-default">Next</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>


