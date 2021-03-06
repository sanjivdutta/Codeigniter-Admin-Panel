﻿<?php include(dirname(__FILE__).'/../include/header.php'); ?>
<?php include(dirname(__FILE__).'/../include/materials.php'); ?>
    <!-- Top Bar -->
    <?php include(dirname(__FILE__).'/../include/top_bar.php'); ?>
    <!-- #Top Bar -->
        <section>
        <!-- Left Sidebar -->
        <?php include(dirname(__FILE__).'/../include/left_menu.php'); ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <?php include(dirname(__FILE__).'/../include/right_bar.php'); ?>
        <!-- #END# Right Sidebar -->
        </section>


<section class="content">
    <div class="container-fluid">
        <!-- <div class="block-header">
            <h2>EDITORS</h2>
        </div> -->

        <!-- CKEditor -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit Product
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('post_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/updateProduct', $attributes);
                        ?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <?php echo $proDet->pid; ?>
                                    <input type="hidden" class="form-control" name="postID" value="<?php echo $this->uri->segment(4); ?>" >
                                </div><?php echo form_error('pid'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" value="<?php echo $proDet->pname; ?>" name="pname" required>
                                </div><?php echo form_error('pname'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="price" value="<?php echo $proDet->price; ?>" required>
                                </div><?php echo form_error('price'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input <?php  if($proDet->price_type=='radio_1'){ echo 'checked'; } ?> name="price_type" id="radio_1" value="radio_1" class="with-gap" checked="" type="radio">
                                    <label for="radio_1">Percentage Discount</label>
                                    <input <?php  if($proDet->price_type=='radio_2'){ echo 'checked'; } ?> name="price_type" id="radio_2" value="radio_2" class="with-gap" type="radio">
                                    <label for="radio_2">Rupee Discount</label>
                                    <input type="text" class="form-control" placeholder="Enter Discount Percentage" value="<?php echo $proDet->percent; ?>" name="percent" id="percent" <?php  if($proDet->price_type=='radio_2'){ ?>style="display: none;" <?php } ?> />
                                    <input type="text" class="form-control" placeholder="Enter Discounted Price" value="<?php echo $proDet->price_discount; ?>" name="price_discount" id="price_discount" <?php  if($proDet->price_type=='radio_1'){ ?>style="display: none;" <?php } ?> />
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <div id="locationField">
                                        <input id="autocomplete" name="address" class="form-control" placeholder="Enter your address" value="<?php echo $proDet->address; ?>" onFocus="geolocate()" type="text" />
                                    </div>
                                </div><?php echo form_error('address'); ?>
                            </div>

                            <div class="form-group form-float">
                                <select class="form-control show-tick" name="productCat" data-live-search="true">
                                    <option value=''>Search category here..</option>
                                    <?php foreach($categories as $cat){ ?>
                                    <option  <?php if($proDet->productCat==$cat['id']){ echo 'selected'; } ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="radio" name="status" id="active" value="1" class="with-gap" <?php  if($proDet->status=='1'){ echo 'checked'; } ?>>
                                <label for="active">Publish This Product</label>

                                <input type="radio" name="status" id="inactive" value="0" class="with-gap" <?php  if($proDet->status=='0'){ echo 'checked'; } ?>>
                                <label for="inactive" class="m-l-20">Don't Publish this post</label>

                            </div><?php echo form_error('status'); ?>
                            <div class="form-group form-float">
                                <p>Upload Images</p>
                                   <input type="file" class="form-control" name="product_images[]" multiple>
                                <span><?php if (isset($error)) { echo $error; } ?></span>
                            </div>

                            <div class="form-group ">
                                <?php
                                foreach($proImages as $img){
                                    ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="text-align: center;">
                                        <img class="img-responsive thumbnail" src="<?php echo base_url().'uploads/products/'.$img['image_name']; ?>">
                                        <a href="<?php echo base_url().'admin/product/image_delete/'.customEncrypt($img['id']); ?>" class="btn bg-red waves-effect imgRmv" onclick="return confirm('Do you really want to delete this image?');">
                                            Remove Image
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group">
                                <textarea id="ckeditor" name="desc" placeholder="Enter Description Here"><?php echo $proDet->desc; ?></textarea>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT PRODUCT</button>
                        <?php form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CKEditor -->
    </div>
</section>

    <?php include(dirname(__FILE__).'/../include/footer.php'); ?>

<script>
    $(document).ready(function(){
        $('input[name="price_type"]').click(function(){
            //$('.nxtDiv').addClass('form-line');
            if(this.id=='radio_1'){
                $('#percent').show('slow');
                $('#price_discount').hide();
                $("#percent").prop('required',true);
                $("#price_discount").prop('required',false);
            }
            if(this.id=='radio_2'){
                $('#price_discount').show('slow');
                $('#percent').hide();
                $("#price_discount").prop('required',true);
                $("#percent").prop('required',false);
            }
        });
    });
</script>

<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJkl1jDIlaWJhZbYXBKEz8EjoS5jwZiIk&libraries=places&callback=initAutocomplete" async defer></script>


</body>
</html>
