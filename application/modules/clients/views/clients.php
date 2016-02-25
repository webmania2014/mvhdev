<div class="container">
            <div class="row">
              <div class="col-md-6">
                    <div class="panel panel-sky">
                        <div class="panel-heading">
                            <h4>Clients</h4>
                            <div class="options">   
                                <a href="javascript:;"><i class="fa fa-cog"></i></a>
                                <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                                <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Invoice Adress</th>
                                        <th>Site</th>
                                        <th>Responsible person</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  if(isset($clients)):  ?>
                                     <?php $count = 1; ?>
                                        <?php foreach($clients as $client ): ?>
                                            <tr onclick="viewData(<?php echo $client->id;  ?>);">
                                                <input type="hidden" value="<?php echo $client->id; ?>" name="client_id<?php echo $count;$count++; ?>"  />
                                                <td id="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></td>
                                                <td><?php echo $client->invoice_address; ?></td>
                                                <td><?php echo $client->site; ?></td>
                                                <td><?php echo $client->contact_person; ?></td>
                                                <td><?php echo $client->phone_number; ?></td>
                                                <td><a href="mailto:"><?php echo $client->email; ?></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif;?>
                                                           
                                
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </div>
   <div class="col-md-6 col-form col-st">                        
    <div class="panel panel-sky">
    <div class="panel-heading">
        <h4>Create/Edit Clients</h4>
        <div class="options">   
            <a href="javascript:;"><i class="fa fa-cog"></i></a>
            <a href="javascript:;"><i class="fa fa-wrench"></i></a>
            <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>
    <div class="panel-body collapse in">
    

        <form action="<?php echo base_url();?>clients/edit" class="form-horizontal row-border" data-validate="parsley" id="validate-form" method="POST" >
            <input type="hidden" name="client_id" id="client_id"/>
            <div class="form-group">
                <label class="col-sm-3 control-label ">Client Name</label>
                <div class="col-sm-6">
                    <input type="text" required="required" class="form-control parsley-validated" id="client_name" name="client_name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Invoice Adress</label>
                <div class="col-sm-6">
                    <input type="text" required="required" class="form-control parsley-validated" id="invoice_address" name="invoice_address">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Client Number</label>
                <div class="col-sm-6">
                    <input type="text" required="required" class="form-control parsley-validated" placeholder="" id="client_number" name="client_number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Site</label>
                <div class="col-sm-6">
                    <input type="text" required="required" class="form-control parsley-validated"  id="site" name="site">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Contact Person</label>
                <div class="col-sm-6">
                    <input type="text" required="required" class="form-control parsley-validated" name="contact_person" value="" id="contact_person">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text"  required="required" class="form-control parsley-validated"  id="phone_number" name="phone_number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" data-type="email"  placeholder="Email address"  required="required"  class="form-control parsley-validated"  id="email" name="email">
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
            
<script>
function viewData(id){
        var url = "<?php echo base_url(); ?>clients/get_client_id?id=" + id;
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
                  $('#invoice_adress').val(client['invoice_address']);
                  $('#client_number').val(client['client_number']);
                  $('#email').val(client['email']);
                  $('#phone_number').val(client['phone_number']);
                  $('#site').val(client['site']);
                  $('#invoice_address').val(client['invoice_address']);
                  $('#contact_person').val(client['contact_person']);
              }

    });
    }
$(document).ready(function(){   
    
});
</script>
   