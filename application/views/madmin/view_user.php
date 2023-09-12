<div class="row wrapper page-heading">
    <div class="col-md-12">
        <div class="alert alert-info" style="width:100%">
    	  <h2><?= $page_title ?></h2>
    	  
    	  <p><?php echo get_phrase('shakhala_website_to_bring_home_workers_with_the_best_skills.it_aims_to_facilitate_the_procedures_for_the_recruitment_of_domestic_workers_and_increase_the_level_of_protection_of_rights.'); ?></p>
            <br>
    	    <div class="row mb_min" role="group" aria-label="Basic example">
              <div class="trapezoid active"><span>Workers</span></div>
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
              <section id="view_details">     
                <div class="row pd_row">
                    <div class="col-md-3 card pad_btm">
                        <img src="<?php echo base_url(); ?><?=$view_data->user_image?>"  onerror="this.src = '/uploads/users/user-image.png'" class="worker_image" />
                        <h1><?php echo $view_data->name;?></h1>
                       
                    </div>
                    <div class="col-md-1">
                        
                    </div>
                    <div class="col-md-8 card card_height">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <h1 style="text-align:center;"><?=get_phrase('further_details')?>:</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('contact_no')?>&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class = "badge bg-info"><?php echo $view_data->phone;?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('email')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="badge bg-danger"><?php echo $view_data->email;?></h4>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('is_subscribed')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="badge badge-lg bg-<?= $view_data->is_subscribe ? "primary" : "danger" ?>"><?=$view_data->is_subscribe ? "Yes" :"No"  ?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('admin_verified')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                <h4 class="badge badge-lg bg-<?= $view_data->admin_status == "Active" ? "primary" : "danger" ?>"><?= $view_data->admin_status == "Active" ? "Yes" : "No" ?>&nbsp;
                                </h4>
                                <span><a style="color:blue; margin-left:4px;margin-top:2px"  data-toggle="modal" data-target="#exampleModal">Change Status</a></span>
                                
                            </div>
                            <!-- Button trigger modal -->
                                    <!--<button type="button" class="btn btn-primary">-->
                                    <!--  Launch demo modal-->
                                    <!--</button>-->
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <!--<div class="modal-header">-->
                                          <!--  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                                          <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                                          <!--    <span aria-hidden="true">&times;</span>-->
                                          <!--  </button>-->
                                          <!--</div>-->
                                          <div class="modal-body">
                                            Are you sure?
                                          </div>
                                          <div class="modal-footer p-4">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick='location.href="<?=base_url() . admin_ctrl() . "/view_user/update_admin_status/".$view_data->user_id."/".$view_data->admin_status?>"'>Yes</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!--END MODAL-->
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('email_verified')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="badge badge-lg bg-<?= $view_data->is_email_verified == "Yes" ? "primary" : "danger" ?>"><?=$view_data->is_email_verified ?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('phone_verified')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="badge badge-lg bg-<?= $view_data->is_phone_verified == "Yes" ? "primary" : "danger" ?>"><?= $view_data->is_phone_verified ?>&nbsp;</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('account_type')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="badge bg-primary"><?php echo $view_data->type;?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('posted_workers')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data->no_of_workers->val;?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('live_workers')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data->live_workers->val;?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('created_at')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data->user_created_at;?></h4>
                            </div>
                        </div>
                        <?php 
                            if($view_data->type == "Company"){
                        ?>
                         <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('click_here_to_see_document')?>:&nbsp;</h4>
                            </div>
                            <?php if(!empty($view_data->company_doc_url)){  ?>
                            <div class="col-md-3 d-flex">
                                <a data-toggle="popover" data-trigger="hover" title="Company Documents" data-content="VIEW DOCUMENT?" target="_blank" href="<?php echo base_url(); ?><?php echo $view_data->company_doc_url;?>"><img src="<?=base_url(); ?>assets/admin/img/download.png" class="mr_1" /></a>
                            </div>
                            <?php }else{ ?>
                            <div>
                                No Document uploaded
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <br>
                        <div>
                            <h3><?=get_phrase('transaction_history')?></h3>
                        </div>
                        <div class="row p-4">
                            <div class="table-responsive">
                                <table class = "table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?=get_phrase('id')?>.</th>
                                            <th><?=get_phrase('description')?></th>
                                            <th><?=get_phrase('amount')?></th>
                                            <th><?=get_phrase('type')?></th>
                                            <th><?=get_phrase('token')?></th>
                                            <th><?=get_phrase('tr_id')?>.</th>
                                            <th><?=get_phrase('date')?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach($tr_data as $tr){
                                    ?>
                                        <tr>
                                            <td><?=$tr->transaction_id?></td>
                                            <td><?=$tr->description?></td>
                                            <td>
                                                <span><?=$tr->amount?></span>
                                            </td>
                                            <td>
                                                <span class = "badge bg-primary"><?=$tr->type?></span>
                                            </td>
                                            <td><?=$tr->token?></td>
                                            <td><?=$tr->tr_id?></td>
                                            <td><?=$tr->created_at?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!--        Body End-->