<!--        Page Heeder-->
<div class="row wrapper border-bottom page-heading">
    <div>
        <h2 class="page-main-heading"><?= get_phrase($page_sub_title) ?></h2>
        <ol class="page_tree">
            <li class="breadcrumb-item">
                <a><?= $page_title ?></a>
            </li>
       
        </ol>
    </div>

    <div class="vl-hr">
    </div>
    <div class="header-add-btn">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="">

                    <div class="table-responsive">
                        <table class="table table-striped dataTables-example">
                            <thead>
                            <tr>
                               	<th>#</th>
            					<th><?php echo get_phrase('complain_no'); ?></th>
            					<th><?php echo get_phrase('message'); ?></th>
            					<th><?php echo get_phrase('department'); ?></th>
            					<th><?php echo get_phrase('type'); ?></th>
            					<!--<th><?php echo get_phrase('status'); ?></th>-->
            					<th><?php echo get_phrase('user'); ?></th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                	<?php 
                						$count=0; 
                						if(!empty($complain_data)){
                						    foreach($complain_data as $complain): $count++;  
                					?> 
                					<tr>
                						<td><?php echo $count; ?></td>
                						<td><span class = "badge bg-primary">COM-<?php echo $complain['complain_id']; ?></span></td>
                						<td><?php echo $complain['message']; ?></td>
                						<td><span class = "badge bg-danger"><?php echo $complain['dept_name']; ?> </span></td>
                						<td><span class = "badge bg-<?=$complain['type'] == "Suggestion"? "success":"danger" ?>"><?php echo $complain['type']; ?></span></td>
                						<!--<td><?php echo $complain['status']; ?></td>-->
                						<td> 
                						    <?php if(!empty($complain['name'])){ ?>
                						        <a data-toggle="popover" data-trigger="hover" title="User" data-content="VIEW USER DETAILS?" href = "<?=base_url().admin_ctrl().'/view_user/'.$complain['user_id'] ?>"><span style = "font-size: 12px;font-weight: 900;"><?= $complain['name'] ? $complain['name'] : $complain['user_id']  ?></span></a>
                                            <?php  }else{ ?>
                                                <?= $complain['user_id'] ?>
                                            <?php } ?>
                					 </td>
                					
                					</tr>
                						<?php endforeach; }?>
                        

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--        Body End-->