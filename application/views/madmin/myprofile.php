
<div class="row wrapper page-heading">
    <div class="col-md-12">
        <div class="alert alert-info" style="width:100%">
    	  <h2><?= $page_title ?></h2>
    	  
    	  <p><?php echo get_phrase('shakhala_website_to_bring_home_workers_with_the_best_skills.it_aims_to_facilitate_the_procedures_for_the_recruitment_of_domestic_workers_and_increase_the_level_of_protection_of_rights.'); ?></p>
            <br>
    	    <div class="row mb_min" role="group" aria-label="Basic example">
              <div class="trapezoid active"><span>Update Profile</span></div>
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
    <form role="form" method="POST" action="<?php echo base_url().admin_ctrl(); ?>/myprofile/update"  enctype="multipart/form-data">
        <div class="row animated fadeInRight">
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                   Manage Your Profile
                </header>
                <div class="panel-body">
                       <div class="form-group">
                            <input type="hidden" name="admin_id" value="<?php echo $profile_data->user_id; ?>" required>
                            <label for="name"><?php echo get_phrase('full_name'); ?>:</label>
                            <input type="text" class="form-control"  name="name" placeholder="Enter name" value="<?php echo $profile_data->name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo get_phrase('email'); ?></label>
                            <input type="email" class="form-control" name="email" value="<?php echo $profile_data->email; ?>" readonly placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="Password"><?php echo get_phrase('password'); ?></label>
                            <input type="password"  name="password" class="form-control"  placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('phone'); ?></label>
                            <input type="text" name="phone" class="form-control" placeholder="" value="<?php echo $profile_data->phone; ?>" required>
						</div>
                        
                        <button type="submit" class="btn btn-primary"><?php echo get_phrase('update_profile'); ?></button>
                    
    
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    Profile Image
                </header>
                <div class="panel-body">
                    	<center>
    						<?php if(empty($profile_data->user_image)){ ?>
    							<img src="<?php echo base_url(); ?>assets/icon.jpg" style="width:200px;">
    						<?php }else{ ?>
    							<img src="<?php echo base_url(); ?>uploads/users/<?php echo $profile_data->user_image; ?>" style="width:200px;">
    						<?php } ?>
    						<br/>
    						<br/>
    						<div class="input-group  col-md-10 col-md-offset-1">
    							<span class="input-group-addon"><i class="fa fa-image"></i></span>
    							<input type="file" name="user_image" class="form-control"/>
    						</div>
    					</center>
                </div>
            </section>
        </div>
        </div>
    </form>
</div>
