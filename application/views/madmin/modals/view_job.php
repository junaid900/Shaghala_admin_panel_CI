<?php 
    $details = $this->db->get_where('brinkman_job_apply', array('job_apply_id'=>$param1))->row_array(); 
    $job = $this->db->get_where('brinkman_job',array('job_id'=>$details['job_id']))->row()->en_name;
?>
<style>
	.bold_font {
		font-weight: bold;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card m-b-30">
			<h4 class="card-header mt-0"><i class="fa fa-eye"></i> 
			    <?php echo $job;?>
			</h4> 
			<div class="card-body">
			
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("user_name")?></label>
					<div class="col-sm-8">
						<label class="col-form-label"><?php echo $details['user_name']; ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("dob")?></label>
					<div class="col-sm-8">
						<label class="col-form-label"><?php echo $details['dob']; ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("phone")?></label>
					<div class="col-sm-8">
						<label class="col-form-label"><?php echo $details['phone']; ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("location")?></label>
					<div class="col-sm-8">
						<label class="col-form-label"><?php echo $details['location']; ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("experience")?></label>
					<div class="col-sm-8">
						<label class="col-form-label"><?php echo $details['experience']; ?></label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("award_record")?></label>
					<div class="col-sm-8">
						<label class="col-form-label"><?php echo $details['award_record']; ?></label>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("title")?></label>
					<div class="col-sm-8">
					    <?php foreach(json_decode($details['title']) as $key=>$dt){  $key++; ?>
						<label class="col-form-label"><?php echo $dt; ?>,</label>
						<?php } ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("year")?></label>
					<div class="col-sm-8">
					    <?php foreach(json_decode($details['year']) as $key=>$dt){  $key++; ?>
						<label class="col-form-label"><?php echo $dt; ?>,</label>
						<?php } ?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("location")?></label>
					<div class="col-sm-8">
					    <?php foreach(json_decode($details['locations']) as $key=>$dt){  $key++; ?>
						<label class="col-form-label"><?php echo $dt; ?>,</label>
						<?php } ?>
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-sm-4 bold_font col-form-label"><?=get_phrase("last_time")?></label>
					<div class="col-sm-8">
						<label class="col-form-label"><?php echo $details['date_added']; ?></label>
					</div>
				</div>
				
				
            </div>
        </div>
    </div>
</div> 
