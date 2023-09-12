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
                        <img src="<?php echo base_url(); ?><?=$view_data['image']?>"class="worker_image" />
                        <h1><?php echo $view_data['en_name'];?></h1>
                        <div class="row">
                            <div class="col-md-6"><h4 class="headings"><?=get_phrase('age')?>:&nbsp;</h4></div>
                            <div class="col-md-6"><h4><?php echo $view_data['age'];?>&nbsp; <?=get_phrase('years')?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><h4 class="headings"><?=get_phrase('skin_color')?>:&nbsp;</h4></div>
                            <div class="col-md-6"><h4><?php echo $view_data['skin_color'];?></h4></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><h4 class="headings"><?=get_phrase('height')?>:&nbsp;</h4></div>
                            <div class="col-md-6"><h4><?php echo $view_data['height'];?>&nbsp;cm</h4></div>
                        </div>
                        <div class="row  m_btm">
                            <div class="col-md-6"><h4 class="headings"><?=get_phrase('weight')?>:&nbsp;</h4></div>
                            <div class="col-md-6"><h4><?php echo $view_data['weight'];?>&nbsp;kg</h4></div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        
                    </div>
                    <div class="col-md-8 card card_height">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <h1 style="text-align:center;"><?=get_phrase('futher_details')?>:</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('contact_number')?>&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['phone'];?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('religion')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['en_religion'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('arabic_level')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['arabic_level'];?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('is_married')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['is_married'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('no_of_childrens')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['have_childs'];?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('experience')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['experience'];?>&nbsp;<?=get_phrase('years')?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('qualification')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['degree_name'];?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('salary')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['salary'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('place_of_birth')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['place_of_birth'];?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('place_of_living')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['place_of_living'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('works_can_do')?>!:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['work'];?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('advertisement_type')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['advs_type'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('is_featured')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4><?php echo $view_data['is_featured'];?></h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('status')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                
                                <h4><?php echo $view_data['status'];?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('posted_by')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <a data-toggle="popover" data-trigger="hover" title="User" data-content="VIEW USER DETAILS?" href = "<?=base_url().admin_ctrl().'/view_user/'.$view_data['user_id'] ?>"><h3><?php echo $view_data['user_name'];?></h3></a>
                            </div>
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('admin_status')?>?:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex align-items-center">
                                    <h4 class="badge badge-lg bg-<?= $view_data['admin_status'] == "Active" ? "primary" : "danger" ?>"><?= $view_data['admin_status'] ?>&nbsp;
                                    </h4>
                                    <span>
                                        <a style="color:blue; margin-left:4px;margin-top:2px"  data-toggle="modal" data-target="#exampleModal">Change Status</a></span>
                                
                            </div>
                            <!-- Button trigger modal -->
                                    <!--<button type="button" class="btn btn-primary">-->
                                    <!--  Launch demo modal-->
                                    <!--</button>-->
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         
                                          <div class="modal-body">
                                            Are you sure?
                                          </div>
                                          <div class="modal-footer p-4">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick='location.href="<?=base_url() . admin_ctrl() . "/view_details/update_admin_status/".$view_data['worker_id']."/".$view_data['admin_status']?>"'>Yes</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 d-flex">
                                <h4 class="headings"><?=get_phrase('click_here_to_see_cv')?>:&nbsp;</h4>
                            </div>
                            <div class="col-md-3 d-flex">
                                <a data-toggle="popover" data-trigger="hover" title="CV" data-content="VIEW WORKER CV?" target="_blank" href="<?php echo base_url(); ?><?php echo $view_data['cv'];?>"><img src="<?=base_url(); ?>assets/admin/img/download.png" class="mr_1" /></a>
                            </div>
                        </div>
                         <div class="row card mrg_top">
                            <div class="col-md-12">
                                <h1 class="s_fs"><?=get_phrase('remarks')?>:&nbsp;</h1><h4 class="pad_left"><?php echo $view_data['remarks'];?></h4>
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