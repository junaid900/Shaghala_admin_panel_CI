<div class="row wrapper page-heading">
    <div class="col-md-12">
        <div class="alert alert-info" style="width:100%">
    	  <h2><?= $page_title ?></h2>
    	  
    	  <p><?php echo get_phrase('shakhala_website_to_bring_home_workers_with_the_best_skills.it_aims_to_facilitate_the_procedures_for_the_recruitment_of_domestic_workers_and_increase_the_level_of_protection_of_rights.'); ?></p>
            <br>
    	    <div class="row mb_min" role="group" aria-label="Basic example">
              <div class="trapezoid active"><span style="font-size: 11px;"><?= $page_title ?></span></div>
            </div>
    	</div>
    	<div class="row col-md-12">
            <span class="page-main-heading" ><?php echo get_phrase($page_sub_title); ?></span>
            <ol class="page_tree">
                <li class="breadcrumb-item">
                    &nbsp;>&nbsp;<a><?= $page_title ?></a>
                </li>
            </ol>
        </div>
    </div>
</div>
<!--Body -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">
                    <div class="table-responsive">
                        <table class="dataTables-example table-striped">
                            <thead>
                            <tr>
                              	<th>#</th>
    				
                				<th><?php echo get_phrase('translation'); ?></th>
                
                				<th><?php echo get_phrase('phrase'); ?></th>
                				
                				
                				<th><?php echo get_phrase('action'); ?></th>
                            </tr>
                            </thead>
                              <tbody>

                    				<?php $lang = $this->db->get('shkalah_language')->result_array(); ?>
                    				<?php $count= 1; foreach($lang as $l){ ?>
                    				<tr>
                    
                    					<td><?php echo $count++; ?></td>
                    
                    					<td><input id="phrase_<?php echo $l['phrase_id']; ?>" class="form-control" value="<?php echo $l[$param1]; ?>" ></td>
                    					
                    					<td>													
                                    		<button class="btn btn-success" onclick="save_language(<?php echo $l['phrase_id']; ?>,'<?php echo $param1; ?>')"><?php echo get_phrase('save'); ?></button>
                                    	</td>
                    					<td><?php echo $l['phrase']; ?></td>
                    				</tr>
                    				<?php } ?>
                    
                    			 </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function save_language(phase){
    var val = $('#phrase_'+phase).val();
     $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/edit',
                data : {'phrase_id':phase,'lang':'<?=$param1?>','phrase_value':val},
                success: function(response) {
                    console.log(response);
                    if(response == 'success'){
                        notify('fa fa-comments', 'success', 'Title ', 'Updated Successfully!');
                    }else{
                        notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    //$('#modal_ajax').toggle();
                }
            });
}
</script>
<!--Body End-->