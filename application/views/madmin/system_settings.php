
<!--<div class="row wrapper border-bottom page-heading">-->
<!--    <div>-->
<!--        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>-->
<!--        <ol class="page_tree">-->
<!--            <li class="breadcrumb-item">-->
<!--                <a><?= $page_title ?></a>-->
<!--            </li>-->
<!--        </ol>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="wrapper wrapper-content animated fadeInRight">-->
<!--    <div class="alert alert-info" style="width:100%">-->
<!--	  <strong><?php echo get_phrase('info!'); ?></strong> <?php echo get_phrase('this_page_allows_you_to_edit_system_information'); ?>-->
<!--	</div>-->
       <div class="row wrapper page-heading">
    <div class="col-md-12">
        <div class="alert alert-info" style="width:100%">
    	  <h2><?= $page_title ?></h2>
    	  
    	  <p><?php echo get_phrase('shakhala_website_to_bring_home_workers_with_the_best_skills.it_aims_to_facilitate_the_procedures_for_the_recruitment_of_domestic_workers_and_increase_the_level_of_protection_of_rights.'); ?></p>
            <br>
    	    <div class="row mb_min" role="group" aria-label="Basic example">
              <div class="trapezoid active"><span>Update System</span></div>
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
   
    <form role="form" method="POST" action="<?php echo base_url().admin_ctrl(); ?>/system_settings/update"  enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                  <?php echo get_phrase('general_settings'); ?>
                </header>
                
                <div class="panel-body">
                       <div class="form-group">
                             <label for="name"><?php echo get_phrase('company_name'); ?>:</label>
                            <input type="text" name="system_name" class="form-control" placeholder="" value="<?php echo $system_data['system_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="home_page_SEO_title"><?php echo get_phrase('home_page_SEO_title'); ?></label>
                            <input type="text" name="home-page-seo-title" class="form-control" placeholder="" value="<?php echo $system_data['home-page-seo-title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="home_page_SEO_description"><?php echo get_phrase('home_page_SEO_description'); ?></label>
                            <input type="text"  name="home-page-seo-description" class="form-control" placeholder="" value="<?php echo $system_data['home-page-seo-description']; ?>" >
                        </div>
                         <div class="form-group">
                            <label for="stripe_secret_key"><?php echo get_phrase('stripe_secret_key'); ?></label>
                            <input type="text"  name="stripe_secret_key" class="form-control" placeholder="" value="<?php echo $system_data['stripe_secret_key']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="stripe_publish_key"><?php echo get_phrase('stripe_publish_key'); ?></label>
                            <input type="text"  name="stripe_publish_key" class="form-control" placeholder="" value="<?php echo $system_data['stripe_publish_key']; ?>" >
                        </div>
                        
                        <div class="form-group">
                            <label for="sub_amount"><?php echo get_phrase('subscription_amount'); ?> (USD)</label>
                            <input type="number"  name="sub_amount" class="form-control" placeholder="" value="<?php echo $system_data['sub_amount']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="sami_sub_amount"><?php echo get_phrase('sami_subscription_amount'); ?> (USD)</label>
                            <input type="number"  name="sami_sub_amount" class="form-control" placeholder="" value="<?php echo $system_data['sami_sub_amount']; ?>" >
                        </div>
                        
                         <div class="form-group">
                            <label for="individual_amount"><?php echo get_phrase('individual_amount'); ?> (USD)</label>
                            <input type="number"  name="individual_amount" class="form-control" placeholder="" value="<?php echo $system_data['individual_amount']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="sami_individual_amount"><?php echo get_phrase('sami_individual_amount'); ?> (USD)</label>
                            <input type="number"  name="sami_individual_amount" class="form-control" placeholder="" value="<?php echo $system_data['sami_individual_amount']; ?>" >
                        </div>
                        
                        <div class="form-group">
                            <label for="sub_amount"><?php echo get_phrase('individual_reservation_amount'); ?> (USD)</label>
                            <input type="number"  name="individual_reservation_amount" class="form-control" placeholder="" value="<?php echo $system_data['individual_reservation_amount']; ?>" >
                        </div>
                        
                        <div class=" ">
                        	<b><?php echo get_phrase('contact_settings'); ?></b>
                        	<hr>
                        </div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('email'); ?></label>
                            <input type="text"  name="email" class="form-control" placeholder="" value="<?php echo $system_data['email']; ?>"  required>
						</div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('phone'); ?></label>
                            <input type="text"  name="phone" class="form-control" placeholder="" value="<?php echo $system_data['phone']; ?>"required>
						</div>
                        
                        <div class="form-group">
                            <label><?php echo get_phrase('address'); ?></label>
                        	<textarea rows="5" cols="5" name="address" class="form-control" placeholder="Address" required><?php echo $system_data['address']; ?></textarea>
                        </div>
						<div class=" ">
						    <hr>
                        	<b>Privacy</b>
                        	<hr>
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('en_description'); ?></label>
                        	<textarea rows="5" cols="5" name="privacy_en_description" class="form-control" placeholder="description" required><?php echo $system_data['privacy_en_description']; ?></textarea>
                        </div>
                         <div class="form-group">
                            <label><?php echo get_phrase('ar_description'); ?></label>
                        	<textarea rows="5" cols="5" name="privacy_ch_description" class="form-control" placeholder="description" required><?php echo $system_data['privacy_ch_description']; ?></textarea>
                        </div>
		            	<div class=" ">
		            	    <hr>
							<b><?php echo get_phrase('terms_and_conditions'); ?></b>
							<hr>
						</div>
						 <div class="form-group">
                            <label><?php echo get_phrase('en_description'); ?></label>
                        	<textarea rows="5" cols="5" name="terms_en_description" class="form-control" placeholder="description" required><?php echo $system_data['terms_en_description']; ?></textarea>
                        </div>
                         <div class="form-group">
                            <label><?php echo get_phrase('ar_description'); ?></label>
                        	<textarea rows="5" cols="5" name="terms_ch_description" class="form-control" placeholder="description" required><?php echo $system_data['terms_ch_description']; ?></textarea>
                        </div>
                        <div class=" ">
						    <hr>
                        	<b>Social Links</b>
                        	<hr>
                        </div>
                        <div class="form-group">
                            <label><?php echo get_phrase('facebook'); ?></label>
                            <input type="text"  name="facebook" class="form-control" placeholder="" value="<?php echo $system_data['facebook']; ?>"  required>
						</div>
                        <div class="form-group">
                            <label><?php echo get_phrase('linkdin'); ?></label>
                            <input type="text"  name="linkdin" class="form-control" placeholder="" value="<?php echo $system_data['linkdin']; ?>"  required>
						</div>
						<!--<div class="form-group">-->
      <!--                      <label><?php echo get_phrase('wechat'); ?></label>-->
      <!--                      <input type="text"  name="wechat" class="form-control" placeholder="" value="<?php echo $system_data['wechat']; ?>"  required>-->
						<!--</div>-->
						<!--<div class="form-group">-->
      <!--                      <label><?php echo get_phrase('youtube'); ?></label>-->
      <!--                      <input type="text"  name="youtube" class="form-control" placeholder="" value="<?php echo $system_data['wechat']; ?>"  required>-->
						<!--</div>-->
						<div class="form-group">
                            <label><?php echo get_phrase('tiktok'); ?></label>
                            <input type="text"  name="tiktok" class="form-control" placeholder="" value="<?php echo $system_data['tiktok']; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('instagram'); ?></label>
                            <input type="text"  name="instagram" class="form-control" placeholder="" value="<?php echo $system_data['instagram']; ?>"  required>
						</div>
						<div class="form-group">
                            <label><?php echo get_phrase('twitter'); ?></label>
                            <input type="text"  name="twitter" class="form-control" placeholder="" value="<?php echo $system_data['twitter']; ?>"  required>
						</div>
						<!--<div class="form-group">-->
      <!--                      <label><?php echo get_phrase('youku'); ?></label>-->
      <!--                      <input type="text"  name="youku" class="form-control" placeholder="" value="<?php echo $system_data['youku']; ?>"  required>-->
						<!--</div>-->
						 <button type="submit" class="btn btn-primary"><?php echo get_phrase('update_system'); ?></button>
                       
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    Profile Image
                </header>
                <div class="panel-body">
                    <center>
						<?php if(empty($system_data['system_image'])){ ?>
							<img src="<?php echo base_url(); ?>assets/admin/images/admin.png" style="width:200px;">
						<?php }else{ ?>
							<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_data['system_image']; ?>" style="width:210px;">
						<?php } ?>
						<br/>
						<br/>
						<div class="input-group  col-md-10 col-md-offset-1">
							<span class="input-group-addon"><i class="fa fa-image"></i></span>
							<input type="file" name="system_image" class="form-control"/>
						</div>
					</center>
                </div>
            </section>
        </div>
    </div>
    </form>
    
</div>
