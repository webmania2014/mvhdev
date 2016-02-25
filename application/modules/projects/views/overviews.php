<div class="container">
    <div class="row">
      <div class="col-md-6">
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Data Projects</h4>
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
                                <th>Project Number</th>
                                <th>Client</th>
                                <th>Site</th>
                                <th>Responsible person</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>$$</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php  if(isset($projects)):  ?>
                                <?php foreach($projects as $project ): ?>
                                    <tr onclick="viewData(<?php echo $project->id;  ?>);">
                                        <td><?php echo $project->project_number; ?></td>
                                        <td><?php echo $project->client_name; ?></td>
                                        <td><?php echo $project->site; ?></td>
                                        <td><?php echo $project->contact_person; ?></td>
                                        <td><?php echo $project->phone_number; ?></td>
                                        <td><?php echo $project->email; ?></td>
                                        <td>10$</td>
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
                    <h4>Create/Edit Project</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
            
                    <form action="<?php echo base_url();?>projects/edit" class="form-horizontal row-border" data-validate="parsley" id="validate-form" method="POST">
                        <input type="hidden" name="project_id" id="project_id"/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Project Number</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" id="project_number" name="project_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Client Name</label>
                            <div class="col-sm-6">
                                <?php get_clients_dropdown(); ?>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Invoice Address</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" id="invoice_address" name="invoice_address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Order Number</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" placeholder="" id="order_number" name="order_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Clients work Number</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" placeholder="" id="client_number" name="client_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Person</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" id="contact_person" name="contact_person">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Seller</label>
                            <div class="col-sm-6">
                                <?php get_users_dropdown(); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Responsible SV</label>
                            <div class="col-sm-6">
                                <input type="text" required="required" class="form-control parsley-validated" id="email" name="email">
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
    var url = "<?php echo base_url(); ?>projects/get_project_id?id=" + id;
    $.ajax({
     type: "GET",
     url: url, 
     dataType: "text",  
     cache:false,
     success: 
          function(data){
              var project = jQuery.parseJSON(data);
              $('#project_id').val(project['id']);
              $('#project_number').val(project['project_number']);
              $('#client_id').val(project['client_id']);
              $('#invoice_address').val(project['invoice_address']);
              $('#client_number').val(project['client_number']);
              $('#email').val(project['email']);
              $('#phone_number').val(project['phone_number']);
              $('#site').val(project['site']);
              $('#order_number').val(project['order_number']);
              $('#user_id').val(project['seller']);
              $('#contact_person').val(project['contact_person']);
          }

    });
}

$( "#client_id" ).change(function() {
    var client_id = $('#client_id').val();
    var url = "<?php echo base_url(); ?>offers/get_info_client?client_id=" + client_id;
    $.ajax({
         type: "GET",
         url: url, 
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                  var client = jQuery.parseJSON(data);
                  $('#client_id').val(client['id']);
                  $('#client_name').val(client['client_name']);
                  $('#invoice_address').val(client['invoice_address']);
                  $('#client_number').val(client['client_number']);
                  $('#email').val(client['email']);
                  $('#contact_person').val(client['contact_person']);
              }

    });
});

$(document).ready(function(){   
    
});
</script>
   