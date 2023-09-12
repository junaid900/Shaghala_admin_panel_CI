<?php $cssScriptDir = base_url() . "assets/admin/";?>
<script src="<?php echo $cssScriptDir;?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/jquery-ui.js"></script>
<script src="<?php echo $cssScriptDir;?>js/popper.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/bootstrap.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo $cssScriptDir;?>js/plugins/dataTables/datatables.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo $cssScriptDir;?>js/inspinia.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/pace/pace.min.js"></script>

 <!-- Switchery -->
<script src="<?php echo $cssScriptDir;?>js/plugins/switchery/switchery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.6/bootstrap-growl.min.js"></script>
<script src="<?php echo $cssScriptDir;?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $cssScriptDir;?>notification/notification.js"></script>
<script src="<?php echo $cssScriptDir;?>notification/notification.js"></script>
<!-- SUMMERNOTE -->
<script src="<?php echo $cssScriptDir;?>js/plugins/summernote/summernote-bs4.js"></script>
    
    <!-- Chosen -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/chosen/chosen.jquery.js"></script>

   <!-- JSKnob -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/jsKnob/jquery.knob.js"></script>

   <!-- Input Mask-->
    <script src="<?php echo $cssScriptDir;?>js/plugins/jasny/jasny-bootstrap.min.js"></script>

   <!-- Data picker -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/datapicker/bootstrap-datepicker.js"></script>

   <!-- NouSlider -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/nouslider/jquery.nouislider.min.js"></script>

   <!-- Switchery -->
   <script src="<?php echo $cssScriptDir;?>js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Tags Input -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- Dual Listbox -->
    <script src="<?php echo $cssScriptDir;?>js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
     <!-- notification js -->
    <script type="text/javascript" src="<?php echo $cssScriptDir;?>bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="<?php echo $cssScriptDir;?>notification/notification.js"></script>
    <script>
        <?php if($this->session->flashdata('msg_success')){ ?>
    		notify('fa fa-comments', 'success', 'Title ', '<?php echo $this->session->flashdata("msg_success")?>');
    	<?php } else if($this->session->flashdata('msg_error')){ ?>
    		notify('fa fa-comments', 'danger', 'Title ', '<?php echo $this->session->flashdata("msg_error")?>');
    	<?php } else if($this->session->flashdata('msg_warning')){ ?>
    		notify('fa fa-comments', 'warning', 'Title ', '<?php echo $this->session->flashdata("msg_warning")?>');
    	<?php } else if($this->session->flashdata('msg_info')){ ?>
    		notify('fa fa-comments', 'info', 'Title ', '<?php echo $this->session->flashdata("msg_info")?>');
    	<?php } ?>
    </script>
    <script>
    function changeLanguage(lang){
         $.ajax({
                    type : 'POST',
                    url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?='change_language'?>',
                    data : {'lang':lang},
                    success: function(response) {
                        if(response == 'success'){
                            notify('fa fa-comments', 'success', 'Title ', 'Updated Successfully!');
                        }else{
                            notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                        }
                        location.reload();
                        //$('#modal_ajax').toggle();
                    }
            });
        }
          $(document).on('click','.cb-value',function() {
        var mainParent = $(this).parent('.toggle-btn1');
        console.log($('.cb-value'));
        
        if($(mainParent).find('input.cb-value').is(':checked')) {
           // alert('1');
            $(mainParent).addClass('active');
            var user_id = $(this).val();
            //var user_id    =  $(this).attr('title');
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Active'},
                success: function(response) {
                    //alert(response);
                    if(response == 'success'){
                        notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    }else{
                        notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    //$('#modal_ajax').toggle();
                }
            });
        } else {
            $(mainParent).removeClass('active');
            var user_id = $(this).val();
            //var user_id    =  $(this).attr('title');
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url(); ?><?=admin_ctrl()?>/<?=$page_name?>/update_status',
                data : {'id':user_id,'status':'Inactive'},
                success: function(response) {
                    console.log(response);
                    if(response == 'success'){
                        notify('fa fa-comments', 'success', 'Title ', 'Status Updated Successfully!');
                    }else{
                        notify('fa fa-comments', 'danger', 'Title ', 'Oops!something went wrong!');
                    }
                    //$('#modal_ajax').toggle();
                }
            });
        }

    })
    </script>
    <script>
        $(document).ready(function(){
          //Chosen
          $(".multipleChosen").chosen({
              placeholder_text_multiple: "choose related news" //placeholder
        	});
          //Select2
          $(".multipleSelect2").select2({
            placeholder: "choose days" //placeholder
          });
          <?php if(!empty($page_name) && $page_name == 'manage_pubs' || $page_name == 'manage_job' || $page_name == 'manage_products'){  ?>
          setTimeout(function(){ 
          
             $('.html5buttons').html('<div class="row" style="margin-left: 1em;"><a class="btn btn-danger" href="javascript:;" onclick="showAjaxModal(\'<?php echo base_url(); ?>modal/popup/excel_import/<?php if(!empty($page_name)){ echo $page_name; } ?>\')">Import</a><a href="<?php echo base_url(); ?>admin/<?php if(!empty($page_name)){ echo $page_name; } ?>/excel_export" class="btn btn-danger">Export</a></div>'); 
          }, 100);
	
        	 $('#import_form').on('submit', function(event){
              event.preventDefault();
              $.ajax({
               url:"<?php echo base_url(); ?>admin/<?php if(!empty($page_name)){ echo $page_name; } ?>/excel_import",
               method:"POST",
               data:new FormData(this),
               contentType:false,
               cache:false,
               processData:false,
               success:function(data){
                $('#file').val('');
                 console.log(data);
               }
              })
             });
        	<?php } ?>
        })

    </script>
   

<!-- Page-Level Scripts -->
<script>
<?php if($page_name != "manage_users"){?>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });
<?php } ?>
</script>


<script type="text/javascript">
  
    
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            console.log(selectedData);
            var id;
            var count = 1;
            $('.row_position>tr').each(function() {
                id = $(this).attr("id");
                $('#counter_'+id).text(count++);
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"<?php echo base_url().admin_ctrl(); ?>/<?php if(!empty($page_name)){ echo $page_name; } ?>/sort",
            type:'post',
            data:{position:data},
            success:function(response){
                console.log(response)
                notify('fa fa-comments', 'success', 'Title ', 'your change successfully saved');
            }
        })
    }
     
</script>
<script>

    $('.cb-value1').click(function() {
        var mainParent = $(this).parent('.toggle-btn2');
        if($(mainParent).find('input.cb-value1').is(':checked')) {
            $(mainParent).addClass('active');

        } else {
            $(mainParent).removeClass('active');

        }

    })


</script>
<script>
    $('.clockpicker').clockpicker();
    $('.clockpicker2').clockpicker();
    var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    var mem2 = $('#data_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
<?php if($page_name == "edit_product"){?>
$("#pc_button_item").sortable({
    revert: true,
    stop: function() {
            var id;
            var i = 0;
            var tempArray = new Array();
            $('.drg-sub-div>input').each(function() {
                id = $(this).attr("id");
                $("#"+id).attr("name" ,"p_cat["+i+"]");
                var d = attrArray.filter(function (d) {
                    return d.id == $("#"+id).val();
                });
                tempArray.push(d[0]);
                i++;
            });
            attrArray = tempArray;
        }
});
<?php } ?>

</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
$(document).ready(function(){
   $('#userTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'<?=base_url().admin_ctrl()."/customer_list/get_ajax" ?>'
      },
      'columns': [
          { data: 'users_system_id' },
         { data: 'name' },
         { data: 'email' },
         { data: 'mobile' },
         { data: 'sp_points' },
         { data: 'status' },
         { data: 'action' },
      ]
   });
});
</script>
<script>
 $(document).ready(function(){

  $('.summernote').summernote();

 });
</script>