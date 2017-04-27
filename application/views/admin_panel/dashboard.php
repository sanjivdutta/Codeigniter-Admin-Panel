<?php include('include/header.php'); ?>
<?php include('include/materials.php'); ?>
    <!-- Top Bar -->
    <?php include('include/top_bar.php'); ?>
    <!-- #Top Bar -->
        <section>
        <!-- Left Sidebar -->
        <?php include('include/left_menu.php'); ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <?php include('include/right_bar.php'); ?>
        <!-- #END# Right Sidebar -->
        </section>

    <section class="content">
        <div class="container-fluid">
            <!-- <div class="block-header">
                <h2>DASHBOARD</h2>
            </div> -->

            <!-- Widgets -->
            <?php $colsize = 4; ?>
            <div class="row clearfix">
                <div class="col-lg-<?php echo $colsize; ?> col-md-<?php echo $colsize; ?> col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">note_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Posts</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $totPost; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-<?php echo $colsize; ?> col-md-<?php echo $colsize; ?> col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">description</i>
                        </div>
                        <div class="content">
                            <div class="text">Categories</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $totCategory; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-<?php echo $colsize; ?> col-md-<?php echo $colsize; ?> col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">photo_camera</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Images</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $totImages; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-<?php echo $colsize; ?> col-md-<?php echo $colsize; ?> col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">perm_identity</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Users</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $totUser; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-<?php echo $colsize; ?> col-md-<?php echo $colsize; ?> col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Products</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $totProducts; ?>" data-speed="1200" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-<?php echo $colsize; ?> col-md-<?php echo $colsize; ?> col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">comment</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Testimonials</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $totTesti; ?>" data-speed="2500" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <?php if(!empty($sliderImg)){ ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Latest Images</h2>
                        </div>
                        <div class="body">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php
                                    $i=0;
                                    foreach($sliderImg as $img){
                                    ?>
                                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php if(1==$i) echo "active"; ?>"></li>
                                    <?php $i++; } ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <?php
                                        $i=1;
                                        foreach($sliderImg as $img){
                                    ?>
                                    <div class="item <?php if(1==$i) echo "active"; ?>">
                                        <img src="<?php echo base_url().'uploads/gallery/'.$img['img_name'] ?>" />
                                    </div>
                                    <?php $i++; } ?>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    } if(!empty($events)) {
                ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>Events List</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach($events as $val){ ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $val['title']; ?></td>
                                            <td><?php $dt=strtotime($val['start_date']); echo date('d F, Y', $dt); ?></td>
                                            <td>
                                                <?php if(strtotime($val['start_date']) > strtotime('now')){ ?>
                                                    <span class="label bg-green">Scheduled</span>
                                                <?php } else { ?>
                                                    <span class="label bg-red">Completed</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>


            <div class="row clearfix">
                <?php if(!empty($testimonial)){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Testimonials</h2>
                        </div>
                        <div class="body">
                            <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php
                                    $i=0;
                                    foreach($testimonial as $img){
                                    ?>
                                        <li data-target="#carousel-example-generic2" data-slide-to="<?php echo $i; ?>" class="<?php if(1==$i) echo "active"; ?>"></li>
                                    <?php $i++; } ?>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <?php
                                    $i=0;
                                    foreach($testimonial as $img){
                                    ?>
                                    <div class="item <?php if(1==$i) echo "active"; ?>">
                                        <img src="<?php echo base_url(); ?>admin_assets/images/feature-gradient.png" />
                                        <div class="carousel-caption">
                                            <h3><?php echo $img['title']; ?></h3>
                                            <p><?php echo $img['description_testi']; ?></p>
                                        </div>
                                    </div>
                                    <?php $i++; } ?>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                </div>

            <?php /* */?> <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>LINE CHART</h2>
                        </div>
                        <div class="body">
                            <canvas id="line_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CPU USAGE (%)</h2>
                            <div class="pull-right">
                                <div class="switch panel-switch-btn">
                                    <span class="m-r-10 font-12">REAL TIME</span>
                                    <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Visitors -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-pink">
                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                 data-fill-Color="rgba(0, 188, 212, 0)">
                                12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                            </div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-cyan">
                            <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    #socialtrends
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>
                                    #materialdesign
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>#adminbsb</li>
                                <li>#freeadmintemplate</li>
                                <li>#bootstraptemplate</li>
                                <li>
                                    #freehtmltemplate
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST MONTH
                                    <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST YEAR
                                    <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    ALL
                                    <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div> 

            <div class="row clearfix">
                <!-- Task Info -->
                <d
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>BROWSER USAGE</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div> <? /* */ ?>
        </div>
    </section>
    <?php include('include/footer.php'); ?>
    </body>
<script type="text/javascript">
    $(function () {
    new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line'));
});

function getChartJs(type) {
    var config = null;

    if (type === 'line') {
        config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
                datasets: [{
                    label: "My First dataset",
                    data: [randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100)],
                    borderColor: 'rgba(0, 188, 212, 0.75)',
                    //backgroundColor: 'rgba(0, 188, 212, 0.3)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                    pointBorderWidth: 1
                }, {
                        label: "My Second dataset",
                        data: [randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100), randomBetween(0,100)],
                        borderColor: 'rgba(233, 30, 99, 0.75)',
                        //backgroundColor: 'rgba(233, 30, 99, 0.3)',
                        pointBorderColor: 'rgba(233, 30, 99, 0)',
                        pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                        pointBorderWidth: 1,
                        pointHoverRadius: 10
                    }]
            },
            options: {
                responsive: true,
                legend: true,
            }
        }
    }    
    return config;
}

function randomBetween(min, +) {
    if (min < 0) {
        return min + Math.random() * (Math.abs(min)+max);
    }else {
        return min + Math.random() * max;
    }
}
</script>

</html>
