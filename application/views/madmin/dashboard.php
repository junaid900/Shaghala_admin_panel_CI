<?php $cssScriptDir = base_url() . "assets/admin/";?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link href="<?php echo $cssScriptDir; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="<?php echo $cssScriptDir; ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <link href="<?php echo $cssScriptDir; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo $cssScriptDir; ?>css/style.css" rel="stylesheet">
    <style>
        .ibox-title{
            background-color: #ffffff;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 2px 0 0; 
        }
        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            padding: 15px 20px 20px 20px;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }
        .pr_color{
            color:#39b4eb;
            font-weight: 400;
        }
        .light_pr{
            color:#9ad8f5;
        }
        .ibx{
            border-top: none;
            border-right: 1px solid #949494;
        }
        .rpv{
            border-top: 1px solid #949494;
            border-bottom: 1px solid #949494;
            padding: 11px 0px;
        }
        .btnone{
            border-top:none;
        }
        ul.lst_st{
            list-style: decimal;
            margin-top: 0px;
        }
        .bg_st{
            background: #23b08b;
            color: #fff;
            height: 90%;
            font-weight:600;
        }
        .bg_st_1{
            position: absolute;
            bottom: 1em;
            left: 0;
            right: 0;
        }
         .bg_st_2{
             padding-top:85%;
         }   
    </style>
</head>

<body>
    <div id="wrapper">
   <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/sidebar');?>

        <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view(strtolower($this->session->userdata('directory')).'/theme/topbar');?>
    
        <div class="wrapper wrapper-content">
           <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-success float-right"><?=get_phrase('all_time')?></span>
                                </div>
                                <h5><?=get_phrase('users')?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=$page_data['no_of_users']?></h1>
                                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                                <small><?=get_phrase('total_users')?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-info float-right"><?=get_phrase('all_time')?></span>
                                </div>
                                <h5><?=get_phrase('workers')?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=$page_data['no_of_workers']?></h1>
                                <!--<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>-->
                                <small><?=get_phrase('total_workers')?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label label-primary float-right"><?=get_phrase('all_time')?></span>
                                </div>
                                <h5><?=get_phrase('active_workers')?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?=$page_data['no_of_active_workers']?></h1>
                                <!--<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>-->
                                <small><?=get_phrase('total_active_workers')?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    <span class="label float-right"><?=get_phrase('all_time')?></span>
                                </div>
                                <h5><?=get_phrase('subscriptions')?></h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?= $page_data['total_sub_amount'] ?></h1>
                                <!--<div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>-->
                                <small><?=get_phrase('total_subscriptions')?></small>
                            </div>
                        </div>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><?=get_phrase('type_wise_workers')?>
                                <small><?=get_phrase('line_chart')?></small>
                            </h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="lineChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><?=get_phrase('type_wise_workers')?>
                                 <small><?=get_phrase('bar_chart')?></small>
                            </h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><?=get_phrase('advertisement_type')?></h5>

                        </div>
                        <div class="ibox-content">
                            <div class="text-center">
                                <canvas id="polarChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><?=get_phrase('country_wise_workers')?></h5>

                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="doughnutChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
         <!--Graph-->
        <div>
            <h2><?=get_phrase('pending_signup_requests')?></h2>
            <div style="overflow-x:auto">
                  <div class="table-reponsive">
                     <table class="table table-striped" >
                                    <thead>
                                    <tr>
                                        <th><?="No."?></th>
                                        <th><?=get_phrase("picture")?></th>
                                        <th><?=get_phrase("name")?></th>
                                        <th><?=get_phrase("email")?></th>
                                        <th><?=get_phrase("mobile")?></th>
                                        <th><?=get_phrase("city")?></th>
                                        <th><?=get_phrase("address")?></th>
                                        <th><?=get_phrase("type")?></th>
                                        <th><?=get_phrase("status")?></th>
                                        <th><?=get_phrase("admin_status")?></th>
                                        <th><?=get_phrase("action")?></th>
                                    </tr>
                                    </thead>
                                    <tbody class="row_position">
                                    <?php
                                    $i = 0;
                                    if(!empty($user_table_data)){
                                    foreach ($user_table_data as $data) {$i++;
                                       ?>
                                        <tr class="gradeX row_<?php echo $data['status']; ?>"
                                            id="<?php echo $data['user_id']; ?>">
                                            <td><?= $i ?></td>
                                            <td>
                                                <img src="<?php echo base_url();'/uploads/users' ?><?= $data['user_image'] ?> " onerror="this.src = '/uploads/users/user-image.png'" class="image_size" alt="<?= $data['name'] ?>" />
                                            </td>
                                            <td><?= $data['name'] ?></td>
                                            <td>
                                            <?= $data['email'] ?>
                                            </td>
                                            <td>
                                            <?= $data['phone'] ?>
                                            </td>
                                            <td>
                                            <?= $data['city'] ?>
                                            </td>
                                            <td>
                                            <?= $data['address'] ?>
                                            </td>
                                            
                                            
                                            
                                            <td>
                                                <?= $data['type'] ?>
                                            </td>
                                            <td>
                                                <div>
                                                    <span class="badge <?= $data['status']=='Active'? 'bg-success':'bg-danger'?>"><?= $data['status'] ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <?php 
                                                    if($data['admin_status'] != "Inactive"){
                                                ?>
                                                <div class="">
                                                    <span class="badge bg-<?= $data['admin_status'] == 'Active'? 'success':'danger'  ?>"><?= $data['admin_status'] == "Active"? 'Live':'Rejected'  ?></span>
                                                </div>
                                                <?php }else{ ?>
                                                        <!---onclick = "updateAdminStatus(<?=$data['user_id']?>,'Active','manage_user_system')"-->
                                                        <!---onclick = "updateAdminStatus(<?=$data['user_id']?>,'Reject','manage_user_system')"-->
                                                        <button class="btn btn-success btn-sm mr-2" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/user_comments/<?php echo $data['user_id'].'/Active'; ?>', 'Shkalah');" >Accept</button>
                                                        <button class="btn btn-info btn-sm mr-2" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/user_comments/<?php echo $data['user_id'].'/Reject'; ?>', 'Shkalah');" >Reject</button>
                                                <?php } ?>
                                            </td>
                                            <td class="center">
                                                <a href="<?=base_url().admin_ctrl().'/view_user/'.$data[USER_ALS.'_id']; ?>">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } 
                                    }
                                    ?>
                                    </tbody>
                                </table>
                     </div>
                </div>
             </div>
              <div>
            <h2><?=get_phrase('pending_worker_post_requests')?></h2>
            <div style="overflow-x:auto">
                  <div class="table-reponsive">
                    <table class="table table-striped">
                            <thead>
                             <tr>
                                <th><?="No."?></th> 
                                <th><?=get_phrase('image')?></th>
                                <th><?=get_phrase('en_name')?></th>
                                <th><?=get_phrase('phone')?></th>
                                <th><?=get_phrase('arabic_level')?></th>
                                <th><?=get_phrase('salary')?></th>
                                <th><?=get_phrase('advs_type')?></th>
                                <th><?=get_phrase('user_name')?></th>
                                <th><?=get_phrase('status')?></th>
                                <th><?=get_phrase('admin_status')?></th>
                                <th><?=get_phrase('Deleted?')?></th>
                                <th><?=get_phrase('worker_details')?></th>
                               </tr>
                            </thead>
                            <tbody class="row_position">
                            <?php
                            $i = 0;
                            if(!empty($worker_table_data)){
                            foreach ($worker_table_data as $data) {$i++; ?>
                                <tr class="gradeX row_<?php echo $data['status']; ?>"
                                    id="<?php echo $data['worker_id']; ?>">
                                    <td><?= $i ?></td>
                                    <td><img src="<?php echo base_url();'/uploads/worker' ?><?= $data['image'] ?> "  class="image_size" alt="<?= $data['en_name'] ?>" /></td>
                                    <td><?= $data['en_name'] ?></td>
                                    <td><?= $data['phone'] ?></td>
                                    <td><?= $data['arabic_level'] ?></td>
                                    <td><?= $data['salary'] ?></td>
                                    <td><?= $data['advs_type'] ?></td>
                                    <td><?= $data['user_name'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content-center" >
                                            <span class="badge <?= $data['status']=='Active'? 'bg-success':'bg-danger'?>"><?= $data['status'] ?></span>
                                        </div>
                                    </td>
                                     <td>
                                        <?php 
                                            if($data['admin_status'] != "Inactive"){
                                        ?>
                                        <div class="d-flex justify-content-center">
                                            <span class="badge bg-<?= $data['admin_status'] == 'Active'? 'success':'danger'  ?>"><?= $data['admin_status'] == "Active"? 'Live':'Rejected'  ?></span>
                                        </div>
                                        <?php }else{ ?>
                                            <div class = "row">
                                                <!--onclick = "updateAdminStatus(<?=$data['worker_id']?>,'Reject','manage_worker')"-->
                                                <button class="btn btn-success btn-sm mr-2" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/worker_comments/<?php echo $data['worker_id'].'/Active'; ?>', 'Shkalah');" >Accept</button>
                                                <button class="btn btn-info btn-sm col-md-5 mr-2" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/worker_comments/<?php echo $data['worker_id'].'/Reject'; ?>', 'Shkalah');" >Reject</button>
                                            </div>
                                        <?php } ?>
                                        <!--<div class="table-toggle">
                                            <div class="toggle-btn1 <?php if ($data['admin_status'] == 'Active') {
                                                echo 'active';
                                            } ?>">
                                                <input type="checkbox" class="cb-value"
                                                       value="<?php echo $data['worker_id']; ?>" <?php if ($data['admin_status'] == 'Active') {
                                                    echo 'checked';
                                                } ?>/>
                                                <span class="round-btn"></span>
                                            </div>
                                        </div>-->
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                        <span class="badge bg-<?= $data['is_deleted'] == '0'? 'success':'danger'  ?>"><?= $data['is_deleted'] == "1"? 'Yes':'No'  ?></span>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a href="<?=base_url().admin_ctrl().'/view_details/'.$data['worker_id']; ?>">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                            }
                            ?>
                            </tbody>
                        </table>
                     </div>
                </div>
             </div>
        </div>
    </div>
</div>

    <!-- Mainly scripts -->
    <script src="<?php echo $cssScriptDir; ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/popper.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/bootstrap.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/flot/curvedLines.js"></script>

    <!-- Peity -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $cssScriptDir; ?>js/inspinia.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo $cssScriptDir; ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <script src="<?php echo $cssScriptDir; ?>js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo $cssScriptDir; ?>js/demo/sparkline-demo.js"></script>
    
    <!-- ChartJS-->
    <script src="<?php echo $cssScriptDir; ?>js/plugins/chartJs/Chart.min.js"></script>
        <!-- Custom and plugin javascript -->
    <!--<script src="js/inspinia.js"></script>-->
    <!--<script src="<?php echo $cssScriptDir; ?>js/plugins/pace/pace.min.js"></script>-->

    <!-- ChartJS-->
    <!--<script src="js/plugins/chartJs/Chart.min.js"></script>-->
    <!--<script src="<?php echo $cssScriptDir; ?>js/demo/chartjs-demo.js"></script>-->
    
    <script>
     function updateAdminStatus(id,status,page){
             var comments = $('#comments').val();
             $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/'+page+'/update_admin_status',
                data : {'id':id,'status':status,'comments':comments},
                success: function(response) {
                    //alert(response);
                    if(response == 'success'){
                        // notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    }else{
                        // notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    location.reload();
                    //$('#modal_ajax').toggle();
                }
            });
        }
        $(function () {
    <?php 
        $data = $page_data['monlinedata'];
        $x = [];
        $y = [];
        $z = [];
        foreach($data as $k=>$d){
            $y[] = $k;
            $x[] = isset($d['comp'])?$d['comp']:0;
            $z[] = isset($d['ind'])?$d['ind']:0;
        }
    
    ?>
    
         var labels = <?= json_encode($y) ?>;
         var d1 = <?=json_encode($x)?>;
         var d2 = <?=json_encode($z)?>;
    
    var lineData = {
        labels: labels,
        datasets: [

            {
                label: "Company",
                backgroundColor: 'rgb(127, 19, 42 , .4)',
                borderColor: "rgb(127, 19, 42 , 1)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: d1
            },{
                label: "Individual",
                backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
                data: d2
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
       <?php 
        $data = $page_data['monlinedata'];
        $x = [];
        $y = [];
        $z = [];
        foreach($data as $k=>$d){
            $y[] = $k;
            $x[] = isset($d['comp'])?$d['comp']:0;
            $z[] = isset($d['ind'])?$d['ind']:0;
        }
    
    ?>
    var labels = <?=json_encode($y)?>;
    var d1 = <?=json_encode($x)?>;
    var d2 = <?=json_encode($z)?>;
    
    var barData = {
        labels: labels,
        datasets: [
            {
                label: "Company", 
                backgroundColor: 'rgba(220, 220, 220, 0.5)',
                pointBorderColor: "#fff",
                data: d1
            },
            {
                label: "Individual",
                backgroundColor: 'rgb(127, 19, 42 , 1)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: d2
            }
        ]
    };

    var barOptions = {
        responsive: true
    };


    var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
    <?php 
        $data = $page_data['advs_type'];
        $x = [];
        $y = [];
        foreach($data as $d){
            $y[] = $d->advs_type;
            $x[] = $d->count;
            
        }
    
    ?>
    var labels = <?=json_encode($y)?>;
    var data =   <?=json_encode($x)?>;
    labels.push('Other');
    data.push(0);
    //  var polarData = {
    //     datasets: [{
    //         data: [
    //             300,140,200
    //         ],
    //         backgroundColor: [
    //             "#a3e1d4", "#dedede", "#b5b8cf"
    //         ],
    //         label: [
    //             "My Radar chart"
    //         ]
    //     }],
    //     labels: [
    //         "App","Software","Laptop"
    //     ]
    // };

    var polarData = {
        datasets: [{
            data: data,
            backgroundColor: [
                "#7f132a", "#dedede"   ,212121             
                //"#7f132a", "#212121"
            ],
            label: labels
        }],
        labels: labels
    };

    var polarOptions = {
        segmentStrokeWidth: 2,
        responsive: true

    };

    var ctx3 = document.getElementById("polarChart").getContext("2d");
    new Chart(ctx3, {type: 'polarArea', data: polarData, options:polarOptions});
  <?php 
        $data = $page_data['place_of_living'];
        $x = [];
        $y = [];
        $clr = [];
        $i = 0;
        foreach($data as $d){
            $y[] = $d->country_name;
            $x[] = $d->count;
            $i++;
            $clr[] = $i%2 == 0 ? "#7f132a" : "#dedede";
        }
    
    ?>
    var labels = <?=json_encode($y)?>;
    var data =   <?=json_encode($x)?>;
    var clr =   <?=json_encode($clr)?>;
    var doughnutData = {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: clr
        }]
    } ;


    var doughnutOptions = {
        responsive: true
    };


    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});


    var radarData = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [
            {
                label: "My First dataset",
                backgroundColor: "rgba(220,220,220,0.2)",
                borderColor: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                backgroundColor: "rgba(26,179,148,0.2)",
                borderColor: "rgba(26,179,148,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    };

    var radarOptions = {
        responsive: true
    };

    var ctx5 = document.getElementById("radarChart").getContext("2d");
    new Chart(ctx5, {type: 'radar', data: radarData, options:radarOptions});

});
    </script>
    
    
    
	<?php $this->load->view('modal'); ?>
   
     <script>
        function changeLanguage(lang) {
            $.ajax({
                url:"<?php echo base_url().admin_ctrl(); ?>/change_language",
                type:'post',
                data:{lang:lang},
                success:function(response){
                    console.log(response)
                   location.reload();
                }
            })
        }
    </script>
  
    <script>
        $(document).ready(function() {
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
                [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
            ];

            var data3 = [
                [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
            ];


            var dataset = [
                {
                    label: "Number of orders",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Payments",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

         
        });
    </script>
</body>
</html>
