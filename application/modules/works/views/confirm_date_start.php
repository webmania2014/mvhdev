<div class="container">
    <div class="row">
        
            <div class="col-md-12 col-form col-st">                        
                <div class="panel panel-sky">
                    <div class="panel-heading">
                        <h4>Confirm date will start</h4>
                        <div class="options">   
                            <a href="javascript:;"><i class="fa fa-cog"></i></a>
                            <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                            <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                        </div>
                    </div>
                    <div class="panel-body collapse in">
                        <form action="<?php echo base_url();?>works/confirm_date_will_start" class="form-horizontal row-border" data-validate="parsley" id="validate-form" method="POST">
                        <input type="hidden" name="work_id" value="<?php echo $work_id; ?>"/>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="date_will_start">Date will start</label>
                            <div class="col-md-6">
                                <div id="date_will_start_date_picker">
                                    <div class="input-group date" id="datepicker">
                                        <input type="text" required="required" class="form-control parsley-validated" id="date_will_start" name="date_will_start"/>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
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