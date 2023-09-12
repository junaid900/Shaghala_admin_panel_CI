 <?php 
    $cssScriptDir = base_url() . "assets/admin/";
   $system_image = $this->db->get_where('shkalah_system_settings',array('type'=>'system_image'))->row()->description; ?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="text-center">
                <?php if(!empty($system_image)){ ?>
                <img src="<?php echo base_url(); ?>uploads/admin/<?php echo $system_image; ?>" style="width: 60%;height: 64px;" alt="image">
                <?php }else{ ?>
                <img src="https://via.placeholder.com/70" width="100%" height="64px" alt="">
                <?php } ?>
            </li>
            <!--li class="<?=$page_name == "dashboard"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/dashboard' ?>"><img src="<?=base_url(); ?>assets/admin/img/user.png" class="mr_1" /> <span class="nav-label">Home</span></a>
            </li-->
           
           <!-- <li class="<?=$main_page_name == "manage_visitor" || $page_name == "view_vistor" || $page_name == "view_bartender" || $page_name == "view_baradmin"?"active":"" ?>"> 
                <a href="#" class="parent_item"><img src="<?=base_url(); ?>assets/admin/img/user.png" class="mr_1" /> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=$page_name == "manage_visitor"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_visitor' ?>"><?=get_phrase("visitor")?></a></li>
                    <li class="<?=$page_name == "manage_bartender"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_bartender' ?>"><?=get_phrase("bartender")?></a></li>
                    <li class="<?=$page_name == "manage_baradmin"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_baradmin' ?>"><?=get_phrase("bar_admin")?></a></li>
                    <li class="<?=$page_name == "manage_wholesaler"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_wholesaler' ?>"><?=get_phrase("wholesaler")?></a></li>
                </ul>
            </li> -->
            <!--<li class="<?=$main_page_name == "manage_sub_origin" || $main_page_name == "manage_sub_category" || $main_page_name == "manage_products" || $main_page_name == 'manage_origin' || $main_page_name == "manage_sub_brands" || $main_page_name == "manage_category" || $main_page_name == "manage_documents" || $main_page_name == "manage_brands"?"active":"" ?>">-->
            <!--    <a href="#" class="parent_item"><img src="<?=base_url(); ?>assets/admin/img/products.png" class="mr_1" /> <span class="nav-label">Products</span><span class="fa arrow"></span></a>-->
            <!--    <ul class="nav nav-second-level">-->
                    <!-- <li class="<?=$main_page_name == "manage_documents"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_documents' ?>"><?=get_phrase("documents")?></a></li> -->
                    <!-- <li class="<?=$main_page_name == "manage_brands"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_brands' ?>"><?=get_phrase("brands")?></a></li> -->
                    <!-- <li class="<?=$main_page_name == "manage_sub_brands"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_sub_brands' ?>"><?=get_phrase("sub_brands")?></a></li> -->
                    <!--<li class="<?=$main_page_name == "manage_category"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_category' ?>"><?=get_phrase("category")?></a></li>-->
                    <!--<li class="<?=$main_page_name == "manage_sub_category"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_sub_category' ?>"><?=get_phrase("sub_category")?></a></li>-->
                    <!-- <li class="<?=$main_page_name == "manage_origin"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_origin' ?>"><?=get_phrase("origin")?></a></li> -->
                    <!-- <li class="<?=$main_page_name == "manage_sub_origin"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_sub_origin' ?>"><?=get_phrase("sub_origin")?></a></li> -->
                    <!--<li class="<?=$main_page_name == "manage_products"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_products' ?>"><?=get_phrase("products")?></a></li>-->
            <!--    </ul>-->
            <!--</li>-->
            <!-- <li class="<?=$main_page_name == "manage_events_category" || $main_page_name == "manage_events"?"active":"" ?>">
                <a href="#" class="parent_item"><img src="<?=base_url(); ?>assets/admin/img/events.png" class="mr_1" /> <span class="nav-label">Events</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=$main_page_name == "manage_events_category"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_events_category' ?>"><?=get_phrase("events_category")?></a></li>
                    <li class="<?=$main_page_name == "manage_events"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_events' ?>"><?=get_phrase("events")?></a></li>
                </ul>
            </li>
            
            <li class="<?=$main_page_name == "manage_pubs_category" || $main_page_name == "manage_pubs"?"active":"" ?>">
                <a href="#" class="parent_item"><img src="<?=base_url(); ?>assets/admin/img/pubs.png" class="mr_1" /> <span class="nav-label">Bars</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=$main_page_name == "manage_pubs_category"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_pubs_category' ?>"><?=get_phrase("bars_category")?></a></li>
                    <li class="<?=$main_page_name == "manage_pubs"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_pubs' ?>">Bars</a></li>
                </ul>
            </li>
            
             <li class="<?=  $main_page_name == "manage_apply_jobs" || $main_page_name == "manage_job_category" || $main_page_name == "manage_job"?"active":"" ?>">
                <a href="#" class="parent_item"><img src="<?=base_url(); ?>assets/admin/img/job.png" class="mr_1" /> <span class="nav-label">Job</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?=$main_page_name == "manage_job_category"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_job_category' ?>"><?=get_phrase("job_category")?></a></li>
                    <li class="<?=$main_page_name == "manage_job"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_job' ?>"><?=get_phrase("job")?> &nbsp;&nbsp;</a></li>
                    <li class="<?=$main_page_name == "manage_apply_jobs"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_apply_jobs' ?>"><?=get_phrase("apply_jobs")?></a></li>
                    <li class="<?=$main_page_name == "manage_banner"?"active":"" ?>"><a href="<?=base_url().admin_ctrl(). '/manage_banner' ?>">Banners</a></li>
                </ul>
            </li>
            <li class="<?=$page_name == "manage_banner"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_banner' ?>"><i class="fa fa-image"></i>  <span class="nav-label"><?=get_phrase("banners")?></span></a>
            </li> -->
            <li class="<?=$page_name == "dashboard"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/dashboard' ?>"><i class="fa fa-home"></i> <span class="nav-label"><?=get_phrase('Dashboard')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_slider"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_slider' ?>"><i class="fa fa-sliders"></i> <span class="nav-label"><?=get_phrase('slider')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_profile_slider"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_profile_slider' ?>"><i class="fa fa-slideshare"></i> <span class="nav-label"><?=get_phrase('profile_slider')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_education"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_education' ?>"><i class="fa fa-graduation-cap"></i> <span class="nav-label"><?=get_phrase('education')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_dept"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_dept' ?>"><i class="fa fa-building"></i> <span class="nav-label"><?=get_phrase('department')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_skills"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_skills' ?>"><i class="fa fa-cubes"></i> <span class="nav-label"><?=get_phrase('workes_can_do')?>!</span></a>
            </li>
            <li class="<?=$page_name == "manage_user_system"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_user_system' ?>"><i class="fa fa-users"></i> <span class="nav-label"><?=get_phrase('users')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_worker"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_worker/worker' ?>"><i class="fa fa-user-circle-o"></i> <span class="nav-label"><?=get_phrase('worker_ads')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_company_worker"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_worker/company' ?>"><i class="fa fa-building"></i> <span class="nav-label"><?=get_phrase('company_ads')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_complain"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_complain' ?>"><i class="fa fa-cubes"></i> <span class="nav-label"><?=get_phrase('complains')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_notification"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/add_notification' ?>"><i class="fa fa-bell"></i> <span class="nav-label"><?=get_phrase('notifications')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_reservation"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_reservation' ?>"><i class="fa fa-table"></i> <span class="nav-label"><?=get_phrase('reservation')?></span></a>
            </li>
            <li class="<?=$page_name == "manage_language"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/language' ?>"><i class="fa fa-language"></i> <span class="nav-label"><?=get_phrase('languages')?></span></a>
            </li>
            <li class="<?=$page_name == "system_settings"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/system_settings' ?>"><img src="<?=base_url(); ?>assets/admin/img/settings.png" class="mr_1" /> <span class="nav-label"><?=get_phrase("settings")?></span></a>
            </li>
            
            <!--li class="<?=$page_name == "manage_users"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/customer_list' ?>"><i class="fa fa-user-o"></i> <span class="nav-label"><?=get_phrase('customers')?></span></a>
            </li>
           
            <li class="<?=$page_name == "manage_roles"?"active":"" ?>">
                <a href="<?=base_url().admin_ctrl(). '/manage_roles' ?>"><i class="fa fa-ravelry"></i> <span class="nav-label">Roles</span></a>
            </li-->
            
            
        </ul>

    </div>
</nav>
