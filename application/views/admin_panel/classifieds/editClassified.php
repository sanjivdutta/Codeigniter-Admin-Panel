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
                            Edit Business
                            <small></small>
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        echo $this->session->flashdata('post_submit');
                        ?>
                        <?php
                        $attributes = array('id' => 'form_validation_add_post');
                        echo form_open_multipart('admin/updateClassified', $attributes);
                        ?>
                            <h2>Free User</h2>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Business Name" value="<?php echo $clasiDet->business_name; ?>" name="business_name" required />
                                    <input type="hidden" class="form-control" value="<?php echo customEncrypt($clasiDet->id); ?>" name="postID" />
                                </div><?php echo form_error('business_name'); ?>
                            </div>
                            <div class="form-group form-float">
                                <select class="form-control show-tick" name="classifiedCat" data-live-search="true">
                                    <option value=''>Search category here..</option>
                                    <?php foreach($categories as $cat){ ?>
                                    <option <?php if($cat['id']==$clasiDet->classifiedCat){ echo 'selected'; } ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('classifiedCat'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <div id="locationField">
                                        <input id="autocomplete" name="address" placeholder="Business Address" value="<?php echo $clasiDet->address; ?>" class="form-control" onFocus="geolocate()" type="text" required />
                                    </div>
                                </div><?php echo form_error('address'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Suburb" value="<?php echo $clasiDet->suburb; ?>" name="suburb" />
                                </div><?php echo form_error('suburb'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="City" value="<?php echo $clasiDet->city; ?>" name="city" />
                                </div><?php echo form_error('city'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="State" value="<?php echo $clasiDet->state; ?>" name="state" />
                                </div><?php echo form_error('state'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Postcode" value="<?php echo $clasiDet->postcode; ?>" name="postcode" />
                                </div><?php echo form_error('postcode'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Business Phone" value="<?php echo $clasiDet->phone; ?>" name="phone" required />
                                </div><?php echo form_error('phone'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" placeholder="Business Email" value="<?php echo $clasiDet->email; ?>" name="email" readonly required />
                                </div><?php echo form_error('email'); ?>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Business Website" value="<?php echo $clasiDet->website; ?>" name="website" />
                                </div><?php echo form_error('website'); ?>
                            </div>
                            <div class="form-group">
                                <textarea id="ckeditor" name="business_desc" placeholder="Enter Description Here"><?php echo $clasiDet->business_name; ?></textarea>
                            </div>

                            <!-- Golden Users -->
                            
                            <h2>Golden User</h2>
                            <div class="form-group form-float">
                                <div class="form-line1">
                                    <label for="radio_1">Are you a member of Australian Funeral Directors Association (AFDA)?</label>
                                    <input name="afda_member" id="radio_1" value="Y" class="with-gap" <?php if($clasiDet->afda_member=='Y'){ ?> checked="" <?php } ?> type="radio">
                                    <label for="radio_1">Yes</label>
                                    <input name="afda_member" id="radio_2" value="N" class="with-gap" <?php if($clasiDet->afda_member=='N'){ ?> checked="" <?php } ?>  type="radio">
                                    <label for="radio_2">No</label>
                                    <div class="clearfix"></div>
                                    
                                    <label class="form-label" id="afda_logo_label" <?php if($clasiDet->afda_member=='N'){ ?> style="display: none;" <?php } ?>>Upload Business Logo</label>
                                    
                                    <?php if($clasiDet->afda_logo!=''){ ?>
                                    <div class="form-group form-float imgDiv">
                                        <img class="customImg" src="<?php echo base_url().'uploads/business_logo/'.$clasiDet->afda_logo ?>" alt="img_edt_txt" />
                                        <br/><small>Upload new logo to replace the current logo</small>
                                    </div>
                                    <?php } ?>
                                    
                                    <input type="file" class="form-control" name="afda_logo" id="afda_logo" <?php if($clasiDet->afda_member=='N'){ ?> style="display: none;" <?php } ?> />
                                    <br/>
                                    <label class="form-label" id="business_logo_label" <?php if($clasiDet->afda_member=='N'){ ?> style="display: none;" <?php } ?>>Upload AFDA Logo</label>
                                     <?php if($clasiDet->business_logo!=''){ ?>
                                    <div class="form-group form-float imgDiv">
                                        <img class="customImg" src="<?php echo base_url().'uploads/business_logo/'.$clasiDet->business_logo ?>" alt="img_edt_txt" />
                                        <br/><small>Upload new logo to replace the current logo</small>
                                    </div>                                    
                                    <?php } ?>
                                    <input type="file" class="form-control" name="business_logo" id="business_logo" <?php if($clasiDet->afda_member=='N'){ ?> style="display: none;" <?php } ?> />
                                </div>
                            </div>

                            <!-- Platinum Users -->
                            <h2>Platinum User</h2>

                            <div class="form-group ">
                                <?php
                                foreach($businessImages as $img){
                                    ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="text-align: center;">
                                        <img class="img-responsive thumbnail" src="<?php echo base_url().'uploads/business_logo/'.$img['image_name']; ?>">
                                        <a href="<?php echo base_url().'admin/classified/image_delete/'.customEncrypt($img['id']); ?>" class="btn bg-red waves-effect imgRmv" onclick="return confirm('Do you really want to delete this image?');">
                                            Remove Image
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <?php if(count($businessImages)<5): ?>
                            <div class="form-group form-float">
                                <div class="form-line1">
                                    <label class="form-label">Upload Images</label>
                                    <input type="file" class="form-control" name="gal_images[]" id="gal_images" multiple="multiple" accept="image/jpg, image/jpeg" />
                                    <?php 
                                        $max = 5-count($businessImages); 
                                        if($max>0 and $max<=5): 
                                    ?>
                                    <small>You can upload <?php echo $max; ?> more image(s)!</small>
                                    <?php endif; ?>
                                    <small id="img_noti"></small>
                                </div>
                            </div>
                        <?php endif; ?>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?php echo $clasiDet->fb_link; ?>" name="fb_link" placeholder="Facebook Link" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?php echo $clasiDet->twitter_link; ?>" name="twitter_link" placeholder="Twitter Link" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?php echo $clasiDet->youtube_link; ?>" name="youtube_link" placeholder="Youtube Link" />
                                        </div>
                                    </div>
                                </div>
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
        $('input[name="afda_member"]').click(function(){
            //$('.nxtDiv').addClass('form-line');
            if(this.id=='radio_1'){
                $('#afda_logo').show(100);
                $('#business_logo').show(100);   
                $('#afda_logo_label').show(100);
                $('#business_logo_label').show(100);      
                $('.imgDiv').show(100);      
            }
            if(this.id=='radio_2'){
                $('#afda_logo').hide(100);
                $('#business_logo').hide(100);
                $('#afda_logo_label').hide(100);
                $('#business_logo_label').hide(100);
                $('.imgDiv').hide(100); 
            }
        });
    });
</script>
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
