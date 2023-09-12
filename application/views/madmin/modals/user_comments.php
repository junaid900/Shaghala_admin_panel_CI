<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-plus"></i> 
			    Add Remarks
			</h4>
			<form method="POST" action="<?php echo base_url().admin_ctrl(); ?>/manage_user_system/update_admin_status/<?php echo $param1; ?>"  enctype="multipart/form-data">
    			<div class="card-body" style="padding-top: 0px;">
    			    <input type="hidden" name="user_id" value="<?php echo $param2; ?>">
    			  
    				<div class="row my-2">
    					<div class="col-md-12">
    						<label class="col-form-label">Remarks<sup class="text-danger">*</sup>:</label>
    						<textarea name="comments" class="form-control" placeholder="" id="comments" value="" required></textarea>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col-sm-12 col-lg-12 text-right">
    						<button type="button" class="btn btn-primary waves-effect waves-light btn_right" onclick = "updateAdminStatus(<?=$param1?>,'<?=$param2?>','manage_user_system')">Save</button>
    					</div>
    				</div>
    			</div>
			</form>
        </div>
    </div>
</div> 