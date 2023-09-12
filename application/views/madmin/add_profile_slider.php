<?php include 'theme/onpagecss.php'; ?>
<div class="row wrapper page-heading">
    <div class="col-md-12">
        <div class="alert alert-info" style="width:100%">
            <h2><?= $page_title ?></h2>

            <p><?php echo get_phrase('shakhala_website_to_bring_home_workers_with_the_best_skills.it_aims_to_facilitate_the_procedures_for_the_recruitment_of_domestic_workers_and_increase_the_level_of_protection_of_rights.'); ?></p>
            <br>
            <div class="row mb_min" role="group" aria-label="Basic example">
                <div class="trapezoid active"><span><?= $page_title ?></span></div>
            </div>
        </div>
        <div class="row col-md-12">
            <span class="page-main-heading"><?php echo $page_sub_title; ?></span>
            <ol class="page_tree">
                <li class="breadcrumb-item">
                    &nbsp;>&nbsp;<a>Add <?= $page_title ?></a>
                </li>
            </ol>
        </div>

    </div>



</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <form role="form" method="post" action="<?= base_url() . admin_ctrl() . "/" . $page_name . "/save" ?>" enctype="multipart/form-data">
                <div id="card" class="row card">
                <div class="row input-container">
                    <img id="image" src="<?php echo base_url(); ?>assets/admin/img/upload.png" style="width:200px;">
                </div>
                <div>
                    <div class="input-group  col-md-12 col-md-offset-1">
                        <span class="input-group-addon"><i class="fa fa-image"></i></span>
                        <input id="inp_pic" onchange="onImageChange()" type="file" name="img" class="form-control" required />
                    </div>
                </div>
                <div>
                    <h4 class="">Title:</h4>
                    </div>
                <div class="row input-container">
                    
                        <input type="text" placeholder="Enter Slider's Title" name="title" class="form-control col-md-12" required>
                    
                </div>


                
                
                  <div>
                    <h4>Status:</h4>
                   </div>
                <div class="row input-container">
                    <div class="toggle-btn2 active">
                        <input type="checkbox" class="cb-value1" name="status" value="Active" checked />
                        <span class="round-btn"></span>
                    </div>
                </div>
                <div class="col-md-12" style="margin-bottom:10px;">
                    <button class="btn btn-lg btn-primary m-l-md " type="submit">
                        <strong><?= get_phrase("save") ?></strong>
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function onImageChange(){

        console.log($('#inp_pic'));
        var element = $('#inp_pic')[0];
        var file = element.files[0];
  var reader = new FileReader();
  reader.onloadend = function() {
    console.log('RESULT', reader.result);
    document.getElementById('image').src = reader.result;
  }
  reader.readAsDataURL(file);
    }
</script>