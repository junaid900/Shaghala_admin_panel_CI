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
         <!--div class="">
            <button class="btn btn-primary" onclick="location.href='<?=base_url()."".admin_ctrl()."/add_dept"?>'"><i class="fa fa-plus"></i>&nbsp;<?= $page_title ?></button>
        </div-->	
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
                                <th><?=get_phrase("user")?></th>
                                <th><?=get_phrase("worker")?></th>
                                <th><?=get_phrase("days")?></th>
                                <th><?=get_phrase("reserve_exp_date")?></th>
                                <th><?=get_phrase("status")?></th>
                                <th><?=get_phrase("action")?></th>
                               </tr>
                            </thead>
                            <tbody class="row_position">
                            <?php
                            $i = 0;
                            if(!empty($table_data)){
                            foreach ($table_data as $data) {$i++; ?>
                                <tr class="gradeX row_<?php echo $data['status']; ?>"
                                    id="<?php echo $data['reservation_id']; ?>">
                                    <td><?= $i ?></td>
                                    <td><?= $data['user_name'] ?></td>
                                    <td><?= $data['worker_name'] ?></td>
                                    <td><?= $data['days'] ?></td>
                                    <td><?= $data['reserve_exp_date'] ?></td>
                                    <td>
                                        <div class="table-toggle">
                                            <div class="toggle-btn1 <?php if ($data['status'] == 'Active') {
                                                echo 'active';
                                            } ?>">
                                                <input type="checkbox" class="cb-value"
                                                       value="<?php echo $data['reservation_id']; ?>" <?php if ($data['status'] == 'Active') {
                                                    echo 'checked';
                                                } ?>/>
                                                <span class="round-btn"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="center">
                                        <!--a href="<?=base_url().admin_ctrl().'/edit_dept/'.$data['reservation_id']; ?>">
                                            <img src="<?=base_url(); ?>assets/admin/img/edit.png" class="mr_1" /> 
                                        </a-->
                                        <a href="javascript:;"
                                        onclick="confirm_modal_action('<?php echo base_url() . admin_ctrl() ?>/<?= $page_name ?>/delete/<?php echo $data['reservation_id']; ?>');">
                                        <img src="<?=base_url(); ?>assets/admin/img/bin.png" class="mr_1" /> 
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