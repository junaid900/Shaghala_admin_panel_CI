
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
            <span class="page-main-heading">Add <?php echo $page_title; ?></span>
            <!--ol class="page_tree">
                <li class="breadcrumb-item">
                    &nbsp;>&nbsp;<a>Add <?= $page_title ?></a>
                </li>
            </ol-->
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
      <div>
         <div class="col-sm-6 col-md-6 col-lg-6">
                <form role="form" method="post"
                      action="<?= base_url() . admin_ctrl() . "/" . $page_name . "/save" ?>"
                      enctype="multipart/form-data">
                    <div id="card" class="row card">
                    
                    <div style="margin-left:10px">
                        <label>Users:</label>
                        <div class="row col-md-12">
                            <select class="form-control col-md-12" name="user_id">
                               <option value="all">All User</option> 
                                <?php foreach($user_data as $data){?>
                               <option value="<?php echo $data['user_id']; ?>"><?php echo $data['name']; ?></option>
                               <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="" style="margin-left:10px">
                        <label class=""><?= get_phrase("title") ?></label>
                        <div class="row col-md-12">
                            <input type="text"
                               placeholder="<?= get_phrase("title") ?>"
                               name="title"
                               class="form-control col-md-12" required>
                        </div>
                    </div>
                    
                    <div class="row input-container">
                        <label class=""><?= get_phrase("image") ?></label>
                        <div class="row col-md-12">
                            <input type="text"
                               placeholder="<?= get_phrase("image") ?>"
                               name="image"
                               class="form-control col-md-12" >
                        </div>
                    </div>
                    
                    <div class="row input-container">
                        <label class=""><?= get_phrase("description") ?></label>
                        <div class="row col-md-12">
                            <textarea
                               placeholder="<?= get_phrase("description") ?>"
                               name="description"
                               class="form-control col-md-12" required></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:10px">
                        <button class="btn btn-lg btn-primary m-l-md " type="submit">
                            <strong><?= get_phrase("send") ?></strong>
                        </button>
                    </div>
                    </div>
                  
                    
                    </div>
                </form>
            </div>
    </div>
</div>