<?php 
    // echo "here";
?>
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
                            if(!empty($table_data)){
                            foreach ($table_data as $data) {$i++;
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
                                        <div class="d-flex justify-content-center">
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
                                                <button class="btn btn-success btn-sm mr-2"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/user_comments/<?php echo $data['user_id'].'/Active'; ?>', 'Shkalah');">Accept</button>
                                                <button class="btn btn-info btn-sm col-md-5 mr-2" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/user_comments/<?php echo $data['user_id'].'/Reject'; ?>', 'Shkalah');">Reject</button>
                                            </div>
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
        </div>
    </div>
</div>
<!--        Body End-->