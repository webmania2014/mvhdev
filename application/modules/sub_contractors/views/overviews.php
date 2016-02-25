<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Sub-contractors</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Reg Code</th>
                                <th>Address</th>
                                <th>Responsible person</th>
                                <th>Phone</th>
                                <th>Email</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                             <?php  if(isset($sub_contractors)):  ?>
                                <?php foreach($sub_contractors as $sub_contractor ): ?>
                                    <tr onclick="viewData(<?php echo $sub_contractor->id;  ?>);">
                                        <td><?php echo $sub_contractor->name; ?></td>
                                        <td><?php echo $sub_contractor->reg_code; ?></td>
                                        <td><?php echo $sub_contractor->address; ?></td>
                                        <td><?php echo $sub_contractor->responsible_person; ?></td>
                                        <td><?php echo $sub_contractor->phone; ?></td>
                                        <td><?php echo $sub_contractor->email; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif;?>
                                              
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-form col-st">                        
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Create/Edit Sub-contractor</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
                    <form action="<?php echo base_url();?>sub_contractors/edit" class="form-horizontal row-border" data-validate="parsley" id="validate-form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="sub_contractor_id" id="sub_contractor_id"/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" id="name_sub" name="name_sub">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Reg Code</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" id="reg_code" name="reg_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" placeholder="" id="address" name="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Person</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" placeholder="" id="contact" name="contact">
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone Number</label>
                            <div class="col-sm-6">
                                <input type="text" ata-type="phone" placeholder="(XXX) XXXX XXX" required="required" class="form-control parsley-validated" id="phone_number" name="phone_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text"  data-type="email" placeholder="Email address" required="required" class="form-control parsley-validated" id="email" name="email">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email for reports</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated"  id="email_report" name="email_report">
                            </div>
                        </div>   
            
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="logo">Logo</label>
                            <div class="col-sm-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput" id="logo_att_pic_image">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                    <div>
                                      <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                                      <span class="fileinput-exists">Change</span>
                                      <input type="file" name="logo_attach"/></span>
                                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                <img src="" class="display_image_exist" style="width: 200px; height: 150px;" id="display_image_exist" />
                                <a class="att_button_delete_pic btn btn-danger" onclick="deletePicture('logo')" >Delete</a>
                            </div>
                        </div>        
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-3">
                                <div class="btn-toolbar">
                                    <input type="submit" class="btn-primary btn" onclick="javascript:$('#validate-form').parsley( 'validate' );" name="action" value="Save" />
                                    <!-- <input type="submit" class="btn-danger  btn" name="action" value="Delete" /> -->
                                    <button class="btn-default btn">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div> 
         	<!-- container -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function viewData(id){
        var url = "<?php echo base_url(); ?>sub_contractors/get_by_id?id=" + id;
        $.ajax({
         type: "GET",
         url: url, 
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                  var sub_contractor = jQuery.parseJSON(data);
                  $('#sub_contractor_id').val(sub_contractor['id']);
                  $('#name_sub').val(sub_contractor['name']);
                  $('#reg_code').val(sub_contractor['reg_code']);
                  $('#address').val(sub_contractor['address']);
                  $('#contact').val(sub_contractor['responsible_person']);
                  $('#email').val(sub_contractor['email']);
                  $('#phone_number').val(sub_contractor['phone']);
                  $('#email_report').val(sub_contractor['email_report']);
                  $('#logo').val(sub_contractor['invoice_adress']);
                  if(sub_contractor['logo'] != ''){
                        $('#logo_att_pic_image').hide();
                        $('.att_button_delete_pic').show();
                        $( "#display_image_exist").attr("src", sub_contractor["logo"]) ;
                        $( "#display_image_exist" ).show();
                    }else{
                        $('#logo_att_pic_image').show();
                        $('.att_button_delete_pic').hide();
                        $( "#display_image_exist" ).hide();
                    }
              }

    });
}

function deletePicture(field_upload){
    var sub_contractor_id = $('#sub_contractor_id').val();
    var url = "<?php echo base_url(); ?>sub_contractors/delete_attach_picture?sub_contractor_id=" + sub_contractor_id + "&field_attach=" + field_upload;
    $.ajax({
    type: "GET",
    url: url, 
    dataType: "text",  
    cache:false,
    success: 
        function(data){
            viewData(sub_contractor_id);
        }
    });
}

$(document).ready(function(){   
    $('.att_button_delete_pic').hide();
    $( "#display_image_exist" ).hide();
});
</script>
   