   <div class="col-xs-12 col-form col-st">                        
    <div class="panel panel-midnightblue">
    <div class="panel-heading">
        <h4>Create Client</h4>
        <div class="options">   
            <a href="javascript:;"><i class="fa fa-cog"></i></a>
            <a href="javascript:;"><i class="fa fa-wrench"></i></a>
            <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>
    
    <div class="panel-body collapse in">
       <?php $this->logtrino_ui->_message(); ?>

                        <?php
                        echo form_open( 'clients/create', 
                            array(
                                    'role'   => 'form',
                                    'name'   => 'new_admin_form',
                                    'id'     => 'new_admin_form',
                                    'class'  => 'form-horizontal row-border'
                                )
                            ); 
                        ?>
        
            <div class="form-group">
                <label class="col-sm-3 control-label">Client Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="client_name" name="client_name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Invoice Adress</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="invoice_adress" name="invoice_adress">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Client Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="" id="client_number" name="client_number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Site</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="http://" id="site" name="site">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Contact Person</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" readonly="readonly" value="" id="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Phone Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" value="number" id="phone_number" name="phone_number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" maxlength="20" placeholder="email" id="email" name="email">
                </div>
            </div>  
      <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="btn-toolbar">
                        <button class="btn-primary btn">Submit</button>
                        <button class="btn-default btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>
