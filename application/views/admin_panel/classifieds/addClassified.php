<?php include(dirname(__FILE__).'/../include/header.php'); ?>
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
                            Add Business
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('post_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/submitClassified', $attributes);
                        ?>
                            <!-- Free Users -->
                            <h2>Free User</h2>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="business_name" required />
                                    <label class="form-label">Business Name</label>
                                </div><?php echo form_error('business_name'); ?>
                            </div>
                            <div class="form-group form-float">
                                <select class="form-control show-tick" name="classifiedCat" data-live-search="true">
                                    <option value=''>Search category here..</option>
                                    <?php foreach($categories as $cat){ ?>
                                    <option value="<?php echo $cat['id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('classifiedCat'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <div id="locationField">
                                        <input id="autocomplete" name="address" class="form-control" onFocus="geolocate()" type="text" required />
                                    </div>
                                </div><?php echo form_error('address'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="suburb" />
                                    <label class="form-label">Suburb</label>
                                </div><?php echo form_error('suburb'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="city" />
                                    <label class="form-label">City</label>
                                </div><?php echo form_error('city'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="state" />
                                    <label class="form-label">State</label>
                                </div><?php echo form_error('state'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="postcode" />
                                    <label class="form-label">Postcode</label>
                                </div><?php echo form_error('postcode'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="phone" required />
                                    <label class="form-label">Phone</label>
                                </div><?php echo form_error('phone'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" required />
                                    <label class="form-label">Email</label>
                                </div><?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="website" />
                                    <label class="form-label">Website</label>
                                </div><?php echo form_error('website'); ?>
                            </div>
                            <div class="form-group">
                                <textarea id="ckeditor" name="business_desc" placeholder="Enter Description Here"></textarea>
                            </div>

                            <!-- Golden Users -->
                            
                            <h2>Golden User</h2>
                            <div class="form-group form-float">
                                <div class="form-line1">
                                    <label for="radio_1">Are you a member of Australian Funeral Directors Association (AFDA)?</label>
                                    <input name="afda_member" id="radio_1" value="Y" class="with-gap" type="radio">
                                    <label for="radio_1">Yes</label>
                                    <input name="afda_member" id="radio_2" value="N" class="with-gap" checked="" type="radio">
                                    <label for="radio_2">No</label>
                                    <div class="clearfix"></div>
                                    <label class="form-label" id="afda_logo_label" style="display: none;">Upload Business Logo</label>
                                    <input type="file" class="form-control" name="afda_logo" id="afda_logo" style="display: none;" />
                                    <label class="form-label" id="business_logo_label" style="display: none;">Upload AFDA Logo</label>
                                    <input type="file" class="form-control" name="business_logo" id="business_logo" style="display: none;" />
                                </div>
                            </div>

                            <!-- Platinum Users -->
                            <h2>Platinum User</h2>
                            <div class="form-group form-float">
                                <div class="form-line1">
                                    <label class="form-label">Upload Images</label>
                                    <input type="file" class="form-control" name="gal_images[]" id="gal_images" multiple="multiple" accept="image/jpg, image/jpeg" />
                                    <small id="img_noti"></small>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="fb_link" />
                                            <label class="form-label">Facebook Link</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="twitter_link" />
                                            <label class="form-label">Twitter Link</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="youtube_link" />
                                            <label class="form-label">Youtube Link</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT BUSINESS</button>
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
    $("#gal_images").on("change", function() {
         if($("#gal_images")[0].files.length > 5); {
                   $("#img_noti").text("Please select maximum 5 images! Otherwise only 5 images will be uploaded!");
                   $("#img_noti").css('color','red');
         } 
    });
</script>
<script>
    $(document).ready(function(){
        $('input[name="afda_member"]').click(function(){
            //$('.nxtDiv').addClass('form-line');
            if(this.id=='radio_1'){
                $('#afda_logo').show(100);
                $('#business_logo').show(100);   
                $('#afda_logo_label').show(100);
                $('#business_logo_label').show(100);            
            }
            if(this.id=='radio_2'){
                $('#afda_logo').hide(100);
                $('#business_logo').hide(100);
                $('#afda_logo_label').hide(100);
                $('#business_logo_label').hide(100);
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
