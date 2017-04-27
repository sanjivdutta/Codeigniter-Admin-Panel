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
                            Events
                            <small>View all added events here.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <a href="<?php base_url(); ?>events/add" class="btn btn-primary waves-effect pull-right">ADD NEW EVENT</a>
                        <br/><br/><br/>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CKEditor -->
    </div>
</section>

    <?php include(dirname(__FILE__).'/../include/footer.php'); ?>
    </body>

<script>

    $(document).ready(function() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '<?php echo date('Y-m-d') ?>',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: [
                <?php foreach($events as $event){ ?>
                {
                    id: <?php echo $event['id']; ?>,
                    title: '<?php echo $event['title']; ?>',
                    start: '<?php echo $event['start_date']; ?>',
                    <?php if($event['end_date']!='0000-00-00 00:00:00'){ ?>
                        end: '<?php echo $event['end_date']; ?>',
                    <?php } ?>
                    //url: '<?php //echo base_url()."admin/viewEvent/".$event['id']; ?>'
                    url: '#'
                },
                <?php } ?>
            ]
        });

    });

</script>
</html>
