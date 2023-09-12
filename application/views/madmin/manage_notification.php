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
                    &nbsp;>&nbsp;<a><?= $page_title ?></a>
                </li>
            </ol>
        </div>
         <div class="">
            <button class="btn btn-primary" onclick="location.href='<?=base_url()."".admin_ctrl()."/add_notification"?>'"><i class="fa fa-plus"></i>&nbsp;<?= $page_title ?></button>
        </div>	
    </div>
    
    
   
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">
                    <div class="table-responsive">
                        <table class="dataTables-example table-striped">
                            <thead>
                            <tr>
                                <th><?="No."?></th>
                                <th><?=get_phrase("title")?></th>
                                <th><?=get_phrase("description")?></th>
                                <th><?=get_phrase("image")?></th>
                                <th><?=get_phrase("read_status")?></th>
                                <th><?=get_phrase("created_at")?></th>
                                
                                <!--th><?php echo get_phrase('action'); ?></th--->
                               </tr>
                            </thead>
                            <tbody class="">
                            <?php
                            $i = 0;
                            if(!empty($table_data)){
                            foreach ($table_data as $data) {$i++; ?>
                                <tr class="gradeX">
                                    <td><?= $i ?></td>
                                    <td><?= $data['notification_title'] ?></td>
                                    <td><?= $data['description'] ?></td>
                                    <td>
                                        <?php if(!empty($data['image'])){ ?>
                                        <img src="<?= $data['image'] ?> "  class="image_size" alt="<?= $data['notification_title'] ?>" />
                                        <?php }else{?>
                                        <img src="https://shkalah.mjcoders.com/assets/admin/img/upload.png"  class="image_size" alt="<?= $data['notification_title'] ?>" />
                                        <?php } ?>
                                    </td>
                                    <td><?= $data['read_status'] ?></td>
                                    <td><?= $data['created_at'] ?></td>
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
<!--        Body End-->