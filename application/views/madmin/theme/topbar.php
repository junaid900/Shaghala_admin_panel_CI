 <?php 
    $cssScriptDir = base_url() . "assets/admin/";
    $user_data = $this->db->get_where('shkalah_user',array('user_id'=>$this->session->userdata('users_id')))->row();
  //echo $this->session->userdata('users_id');
 // print_r($user_data);
  //exit;
    ?>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header d-flex align-items-center">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-danger " style = 'height: 29px;' href="#"><i class="fa fa-bars"></i> </a>
            <select onchange="changeLanguage(this.value)" class = "form-control" style="margin-top: 10px;padding:0px">
                <option value="" disabled>Choose Language</option>
                <option value="english" <?php if($this->session->userdata('current_language') == 'english'){ echo 'selected'; }?>>English</option>
                <option value="arb" <?php if($this->session->userdata('current_language') == 'arb'){ echo 'selected'; }?>>Arabic</option>
            </select>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <?php if(!empty($user_data->user_image)){ ?>
                <img src="<?php echo base_url(); ?>uploads/users/<?php echo $user_data->user_image; ?>" class="rounded-circle profile_icon" alt="">
                <?php }else{ ?>
                <img src="https://via.placeholder.com/30" class="rounded-circle profile_icon" alt="">
                <?php } ?>
            </li>
            <li>
                <div class="dropdown profile-element">
                    
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="text-muted text-xs block">&nbsp;&nbsp;<?php echo $user_data->name; ?> <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="<?=base_url().admin_ctrl(). '/myprofile' ?>">Profile</a></li>
                        <!--li><a class="dropdown-item" href="contacts.html">Help Center</a></li-->
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url().admin_ctrl(). '/logout' ?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
        </ul>

    </nav>
</div>
