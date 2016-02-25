<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Offers</h4>
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
                                    <th>Offer Number</th>
                                    <th>Client</th>
                                    <th>Site</th>
                                    <th>Responsible person</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Email</th>
                                    <th>$$</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php  if(isset($offers)):  ?>
                                <?php foreach($offers as $offer ): ?>
                                    <tr onclick="viewData(<?php echo $offer->id;  ?>);">
                                        <td><?php echo $offer->offer_number; ?></td>
                                        <td><?php echo $offer->client_name; ?></td>
                                        <td><?php echo $offer->site; ?></td>
                                        <td><?php echo $offer->contact_person; ?></td>
                                        <td><?php echo $offer->phone_number; ?></td>
                                        <td>
                                            <?php
                                                if($offer->status == 1){
                                                    echo 'Draft';
                                                }elseif($offer->status == 2){
                                                    echo 'Sent';
                                                }elseif($offer->status == 3){
                                                    echo 'Active';
                                                }elseif($offer->status == 4){
                                                    echo 'Arhived';
                                                }elseif($offer->status == 5){
                                                    echo 'Declined';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $offer->contact_email; ?></td>
                                        <td>10$</td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div><form action="<?php echo base_url();?>offers/edit" class="form-horizontal row-border" data-validate="parsley" id="validate-form" method="POST">
            <div class="col-md-12 col-form col-st">                        
                <div class="panel panel-sky">
                    <div class="panel-heading">
                        <h4>Create/Edit Offers</h4>
                        <div class="options">   
                            <a href="javascript:;"><i class="fa fa-cog"></i></a>
                            <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                            <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                        </div>
                    </div>
                    <div class="panel-body collapse in">
                        
                            <input type="hidden" name="offer_id" id="offer_id"/>
                            <div class="col-sm-3 form-group">
                                <label class="col-sm-3 control-label">Offer Number</label>
                                <div class="col-sm-8">
                                    <input type="text" required="required" class="form-control parsley-validated" id="offer_number" name="offer_number" value="<?php echo generate_offer_number();?>" disabled="true"/>
                                    <input type="hidden" required="required" class="form-control parsley-validated" id="offer_number" name="offer_number" value="<?php echo generate_offer_number();?>"/>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Starting date</label>
                                <div class="col-sm-8" id="green_date_picker">
                                    <div class="input-group date" id="datepicker" data-date-format="mm/dd/yyyy">
                                        <input type="text"  class="form-control" name="date_starting" id="date_starting" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Project duration</label>
                              
                                    <label class="col-sm-8 control-label for_offer" id="project_duration">over or fewer 3 month</label>
                               
                            </div>
                             <div class="col-sm-3 form-group">
                                <label class="col-sm-3 control-label">Building</label>
                                <div class="col-sm-8">
                                    <?php get_house_dropdown(); ?>
                                </div>
                                <div class="clearfix"></div>
                                </br>
                                <label class="col-sm-3 control-label">Room</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="room" id="room">
                                        <option>Please choose house</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Week</label>
                                
                                    <label class="col-sm-8 control-label for_offer" id="week_of_offer"></label>
                                
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Days</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="day_duration"  id="day_duration"/>
                                </div>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label class="col-sm-3 control-label">Client Name</label>
                                <div class="col-sm-8">
                                    <?php get_clients_dropdown(); ?>
                                    
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Project Number</label>
                                <div class="col-sm-8">
                                    <select name="project_number" class="form-control" id="project_number">
                                        <option value="0">Please choose client</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Cost center</label>
                                <div class="col-sm-8">
                                    <input type="text" required="required" class="form-control parsley-validated" id="cost_center" name="cost_center">
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Invoice Address</label>
                                <div class="col-sm-8">
                                    <input type="text" required="required" class="form-control parsley-validated" id="invoice_address" disabled="true" name="invoice_address">
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Order Number</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="order_number" name="order_number">
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Probability %</label>
                                <div class="col-sm-8">
                                    <input type="text" required="required" class="form-control parsley-validated" id="probability" name="probability">
                                </div>
                            </div>
                            <div class="col-sm-4 form-group">
                                
                                <label class="col-sm-3 control-label">Clients work Number</label>
                                <div class="col-sm-8">
                                    <input type="text" required="required" class="form-control parsley-validated" id="client_number" name="client_number"/>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Contact Person</label>
                                <div class="col-sm-8">
                                    <?php get_contact_person_dropdown(); ?>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Contact Email</label>
                                <div class="col-sm-8">
                                    <input type="text" required="required" class="form-control parsley-validated" id="contact_email" name="contact_email" disabled="true"/>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Seller</label>
                                <div class="col-sm-8">
                                    <?php get_seller_dropdown(); ?>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Responsible SV</label>
                                <div class="col-sm-8">
                                    <?php get_all_responsive_sv_dropdown(); ?>
                                </div>
                                <div class="clearfix"></div>
                                <label class="col-sm-3 control-label">Foreman</label>
                                <div class="col-sm-8">
                                    <?php get_all_foreman_dropdown(); ?>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                            <div class="col-sm-4">
                                
                                        <label>Infomation about rental object</label>
                                        <ul class="infomaiton" id="infomarion">
                                            
                                        </ul>
                                        <input type="text" name="information_text[]" class="form-control" id="text-information" />
                                        <a class="btn btn-primary add-informaion" onclick="add_information();">Add</a>
                                
                            </div>
                            
                            <div class="col-sm-4">
                               
                                        <label>Services we offer:</label>
                                        <br/>
                                        <div id='services_offer'>
                                            <input type='checkbox' name='status_service[]' checked /><label>Scaffold assembling and dismantling</label><input type='hidden' name='name_service[]' value='Scaffold assembling and dismantling'/><br />
                                            <input type='checkbox' name='status_service[]' checked /><label>Weather protection assembling and dismantling</label><input type='hidden' name='name_service[]' value='Weather protection assembling and dismantling'/><br />
                                            <input type='checkbox' name='status_service[]' checked /><label>Transport</label><input type='hidden' name='name_service[]' value='Transport'/><br />
                                            <input type='checkbox' name='status_service[]' checked /><label>Project managment</label><input type='hidden' name='name_service[]' value='Project managment'/><br />
                                        </div>
                                        <input type="text" class="form-control" id="name_services_text" />
                                        <a class="btn btn-primary" id="add_services">Add</a>
                            </div>
                            
                            <div class="col-sm-4 ">
                                
                                        <label class="col-sm-3">Startus:</label>
                                        <select class="col-sm-8" name="startus_offer" id="startus_offer">
                                            <option value="1">Draft</option>
                                            <option value="2">Sent</option>
                                            <option value="3">Active</option>
                                            <option value="4">Arhived</option>
                                            <option value="5">Declined</option>
                                        </select>
                               
                            </div>
                            </div>
                               
                            </div>
                            <!-- table rental scaffolds -->
                           <div class="form-group table_rental_scaffolds">
                           <div class="table-responsive">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered rental_scaffold" id="example">
                                    <thead>
                                        <tr>
                                            <th colspan="18">Rental</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Scaffolds and Tents</th>
                                            <th colspan="2">Costs</th>
                                            <th>Profit</th>
                                            <th colspan="7"></th>
                                            <th colspan="4">Square/Cubic calculator</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Rent type</th>
                                            <th>Work Step</th>
                                            <th>€/m2</th>
                                            <th>TOT€</th>
                                            <th>%</th>
                                            <th>m2</th>
                                            <th>€/m2</th>
                                            <th>day</th>
                                            <th>TOT€</th>
                                            <th>(€/day)</th>
                                            <th>€/kk</th>
                                            <th>Stand dimensions and rack type (contur, layher, etc.).</th>
                                            <th>Length</th>
                                            <th>Width</th>
                                            <th>High</th>
                                            <th>m2 or m3</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <div class="rental_total_scaffold"></div>
                                    </tbody>
                                    <tfoot>
                                        
                                    </tfoot>
                                </table>
                                <a class="btn btn-primary" id="add_rental_scaffold">Add</a>
                                </div>
                           </div>
                           <!-- end table rental scaffolds -->
                           
                           <!-- table work scaffolds -->
                                <div class="form-group work_scaffold_talbe table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered work_scaffold" id="example">
                                        <thead>
                                            <tr>
                                                <th colspan="3" >Work</th>
                                                <th colspan="6">Installation and dismantling</th>
                                                <th colspan="3" rowspan="2">Transport</th>
                                                <th colspan="3" rowspan="2">Crane</th>
                                                <th colspan="4" rowspan="2">Materials</th>
                                                <th colspan="4" rowspan="2">Other</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3">Scaffolds and Tents</th>
                                                <th colspan="3">Costs</th>
                                                <th>Profit</th>
                                                <th colspan="2">Bargain price</th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Scaffold type</th>
                                                <th>Work Step</th>
                                                <th>m2</th>
                                                <th>€/m2</th>
                                                <th>TOT €</th>
                                                <th>%</th>
                                                <th>€/m2</th>
                                                <th>TOT €</th>
                                                <th>Cost. €</th>
                                                <th>Profit  %</th>
                                                <th>Offer €</th>
                                                <th>Cost. €</th>
                                                <th>Profit  %</th>
                                                <th>Offer €</th>
                                                <th>Cost. €</th>
                                                <th>Profit  %</th>
                                                <th>Offer €</th>
                                                <th>Note</th>
                                                <th>Cost. €</th>
                                                <th>Profit  %</th>
                                                <th>Offer €</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tfoot>
                                        
                                            </tfoot>
                                        </tbody>
                                    </table>
                                    <a class="btn btn-primary" id="add_work_offer">Add</a>
                                </div>
                           <!-- end table work scaffolds -->
                           
                           <div class="form-group closed_cost">
                                <h3>Closed Costs</h3>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table_close_cost">
                                    <thead>
                                        <th>Supervisor</th>
                                        <th>Cost type</th>
                                        <th>Amount</th>
                                        <th>Unit</th>
                                        <th>€/unit</th>
                                        <th>Total€</th>
                                        <th>Profit %</th>
                                        <th>Offer €</th>
                                        <th>Note</th>
                                    </thead>
                                    <tbody>
                                        <tr id="row_cost_close_1">
                                            <td class="name">Työnjohtaja<input type="hidden" name="name_cost[]" class="name_cost" value="Työnjohtaja" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit">
                                                <select class="unit" name="unit[]" >
                                                    <option value="0">Select Unit</option>
                                                    <option value="1">vrk</option>
                                                    <option value="2">h</option>
                                                    <option value="3">kk</option>
                                                </select>
                                            </td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"><input type="text" name="profit_cover[]" class="profit_cover" /></td>
                                            <td class="bid"></td>
                                            <td class="selite"><input type="text" name="note_close_cost[]" class="note_close_cost" /></td>
                                        </tr>
                                        <tr id="row_cost_close_2">
                                            <td class="name">Suunnittelu<input type="hidden" name="name_cost[]" class="name_cost" value="Suunnittelu" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit">
                                                <select class="unit" name="unit[]" >
                                                    <option value="0">Select Unit</option>
                                                    <option value="1">vrk</option>
                                                    <option value="2">h</option>
                                                    <option value="3">kk</option>
                                                </select>
                                            </td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"><input type="text" name="profit_cover[]" class="profit_cover" /></td>
                                            <td class="bid"></td>
                                            <td class="selite"><input type="text" name="note_close_cost[]" class="note_close_cost" /></td>
                                        </tr>
                                        <tr id="row_cost_close_3">
                                            <td class="name">Työmaatoimisto<input type="hidden" name="name_cost[]" class="name_cost" value="Työmaatoimisto" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit">
                                                <select class="unit" name="unit[]" >
                                                    <option value="0">Select Unit</option>
                                                    <option value="1">vrk</option>
                                                    <option value="2">h</option>
                                                    <option value="3">kk</option>
                                                </select>
                                            </td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"><input type="text" name="profit_cover[]" class="profit_cover" /></td>
                                            <td class="bid"></td>
                                            <td class="selite"><input type="text" name="note_close_cost[]" class="note_close_cost" /></td>
                                        </tr>
                                        <tr id="row_cost_close_4">
                                            <td class="name">Varastokoppi<input type="hidden" name="name_cost[]" class="name_cost" value="Varastokoppi"/></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit">
                                                <select class="unit" name="unit[]" >
                                                    <option value="0">Select Unit</option>
                                                    <option value="1">vrk</option>
                                                    <option value="2">h</option>
                                                    <option value="3">kk</option>
                                                </select>
                                            </td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"><input type="text" name="profit_cover[]" class="profit_cover" /></td>
                                            <td class="bid"></td>
                                            <td class="selite"><input type="text" name="note_close_cost[]" class="note_close_cost" /></td>
                                        </tr>
                                        <tr id="row_cost_close_5">
                                            <td class="name">Trukki/kurottaja<input type="hidden" name="name_cost[]" class="name_cost" value="Trukki/kurottaja" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit">
                                                <select class="unit" name="unit[]" >
                                                    <option value="0">Select Unit</option>
                                                    <option value="1">vrk</option>
                                                    <option value="2">h</option>
                                                    <option value="3">kk</option>
                                                </select>
                                            </td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"><input type="text" name="profit_cover[]" class="profit_cover" /></td>
                                            <td class="bid"></td>
                                            <td class="selite"><input type="text" name="note_close_cost[]" class="note_close_cost" /></td>
                                        </tr>
                                        <tr id="row_cost_close_6">
                                            <td class="name">Lava-auto/kuorma-auto<input type="hidden" name="name_cost[]" class="name_cost" value="Lava-auto/kuorma-auto" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit">
                                                <select class="unit" name="unit[]" >
                                                    <option value="0">Select Unit</option>
                                                    <option value="1">vrk</option>
                                                    <option value="2">h</option>
                                                    <option value="3">kk</option>
                                                </select>
                                            </td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"><input type="text" name="profit_cover[]" class="profit_cover" /></td>
                                            <td class="bid"></td>
                                            <td class="selite"><input type="text" name="note_close_cost[]" class="note_close_cost" /></td>
                                        </tr>
                                        <tr id="row_cost_close_7">
                                            <td class="name">Varastokulu<input type="hidden" name="name_cost[]" class="name_cost" value="Varastokulu" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit">
                                                <select class="unit" name="unit[]" >
                                                    <option value="0">Select Unit</option>
                                                    <option value="1">vrk</option>
                                                    <option value="2">h</option>
                                                    <option value="3">kk</option>
                                                </select>
                                            </td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"><input type="text" name="profit_cover[]" class="profit_cover" /></td>
                                            <td class="bid"></td>
                                            <td class="selite"><input type="text" name="note_close_cost[]" class="note_close_cost" /></td>
                                            
                                        </tr>
                                    </tbody>
                                    
                                </table>
                           </div>
                                
                           <div class="form-group rental_fees">
                                <h3>Rental fees</h3>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table_rental_fee">
                                    <thead>
                                        <th>Rent type</th>
                                        <th>€ / unit / day</th>
                                        <th>Min € / day</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php get_rental_scaffold_type_dropdown_fee(); ?></td>
                                            <td><input type="text" name="fee_unit_day[]" class="fee_unit_day"/></td>
                                            <td><input type="text" name="fee_min_day[]" class="fee_min_day"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-primary" class="add_rental_fee" id="add_rental_fee">Add</a>
                           </div>
                           
                           <div class="form-group table_overhour_rates">
                           <h3>Overhour Rates</h3>
                                <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table_overhour_rate">
                                <thead>
                                    <th>Name</th>
                                    <th>Base</th>
                                    <th>50%</th>
                                    <th>100%</th>
                                    <th>150%</th>
                                    <th>200%</th>
                                    <th>300%</th>
                                    <th>Estimated h</th>
                                    <th>Estimated Total</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Work hour<input type="hidden" name="name_overhour[]" value="Work hour" /></td>
                                        <td><input type="text" class='base_over_hour' value="40.00" name="base[]" id='work_base' /></td>
                                        <td><input type="text" value="1.40" name="f5_percen[]" id='work_f5_percen' /></td>
                                        <td><input type="text" value="1.80" name="h1_percen[]" id='work_h1_percen' /></td>
                                        <td><input type="text" value="2.30" name="h15_percen[]" id='work_h15_percen' /></td>
                                        <td><input type="text" value="2.65" name="h2_percen[]" id='work_h2_percen' /></td>
                                        <td><input type="text" value="3.10" name="h3_percen[]" id='work_h3_percen' /></td>
                                        <td><input type="text" onclick='change_estimation();'  class="total_estimation" value="" name="estimated[]" id='work_estimated' /></td>
                                        <td class="estimation_total"></td>
                                    </tr>
                                    <tr>
                                        <td>Foreman<input type="hidden" name="name_overhour[]" value="Foreman" /></td>
                                        <td><input type="text" class='base_over_hour' value="48.00" name="base[]" id='foreman_base' /></td>
                                        <td><input type="text" value="1.40" name="f5_percen[]" id='foreman_f5_percen' /></td>
                                        <td><input type="text" value="1.80" name="h1_percen[]" id='foreman_h1_percen' /></td>
                                        <td><input type="text" value="2.30" name="h15_percen[]" id='foreman_h15_percen' /></td>
                                        <td><input type="text" value="2.65" name="h2_percen[]" id='foreman_h2_percen' /></td>
                                        <td><input type="text" value="3.10" name="h3_percen[]" id='foreman_h3_percen' /></td>
                                        <td><input type="text" onclick='change_estimation();' class="total_estimation" value="" name="estimated[]" id='foreman_estimated' /></td>
                                        <td class="estimation_total"></td>
                                    </tr>
                                    <tr>
                                        <td>Supervisor<input type="hidden" name="name_overhour[]" value="Supervisor" /></td>
                                        <td><input type="text" class='base_over_hour' value="50.00" name="base[]" id='supervisor_base' /></td>
                                        <td><input type="text" value="1.40" name="f5_percen[]" id='supervisor_f5_percen' /></td>
                                        <td><input type="text" value="1.80" name="h1_percen[]" id='supervisor_h1_percen' /></td>
                                        <td><input type="text" value="2.30" name="h15_percen[]" id='supervisor_h15_percen' /></td>
                                        <td><input type="text" value="2.65" name="h2_percen[]" id='supervisor_h2_percen' /></td>
                                        <td><input type="text" value="3.10" name="h3_percen[]" id='supervisor_h3_percen' /></td>
                                        <td><input type="text" onclick='change_estimation();' class="total_estimation" value="" name="estimated[]" id='supervisor_estimated' /></td>
                                        <td class="estimation_total"></td>
                                    </tr>
                                    <tr>
                                        <td>Transport<input type="hidden" name="name_overhour[]" value="Transport" /></td>
                                        <td><input type="text" class='base_over_hour' value="90.00"  name="base[]" id='transport_base' /></td>
                                        <td><input type="text" value="1.40" name="f5_percen[]" id='transport_f5_percen' /></td>
                                        <td><input type="text" value="1.80" name="h1_percen[]" id='transport_h1_percen' /></td>
                                        <td><input type="text" value="2.30" name="h15_percen[]" id='transport_h15_percen' /></td>
                                        <td><input type="text" value="2.65" name="h2_percen[]" id='transport_h2_percen' /></td>
                                        <td><input type="text" value="3.10" name="h3_percen[]" id='transport_h3_percen' /></td>
                                        <td><input type="text" onclick='change_estimation();' class="total_estimation" value="" name="estimated[]" id='transport_estimated' /></td>
                                        <td class="estimation_total"></td>
                                    </tr>
                                </tbody>
                                
                                </table>
                               
                           </div>
                           
                           <div class="form-group table_material_price">
                           <h3>Material Prices</h3>
                                <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table_material">
                                <thead>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>€/Unit</th>
                                    <th>Total €</th>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                
                                </table>
                                <a class="btn btn-primary" class="add_material_price" id="add_material_price">Add</a>
                           </div>
                           <div class="form-group table_total_all">
                           <h3>Price Calculation</h3>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table_total">
                                    <thead>
                                        <th>Name</th>
                                        <th>Offer prices</th>
                                        <th>Costs</th>
                                        <th>Profit</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rental total</td>
                                            <td class="rental_total"></td>
                                            <td class="cost_rental"></td>
                                            <td class="profit_rental"></td>
                                        </tr>
                                        <tr>
                                            <td>Work total</td>
                                            <td class="work_total"></td>
                                            <td class="cost_work"></td>
                                            <td class="profit_work"></td>
                                        </tr>
                                        <tr>
                                            <td>Transport total</td>
                                            <td class="transport_total"></td>
                                            <td class="cost_transport"></td>
                                            <td class="profit_transport"></td>
                                        </tr>
                                        <tr>
                                            <td>Crane total</td>
                                            <td class="kraana_total"></td>
                                            <td class="cost_kraana"></td>
                                            <td class="profit_kraana"></td>
                                        </tr>
                                        <tr>
                                            <td>Other total</td>
                                            <td class="other_total"></td>
                                            <td class="cost_other"></td>
                                            <td class="profit_other"></td>
                                        </tr>
                                        <tr>
                                            <td>Closed cost total</td>
                                            <td class="close_cost_total"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td class="total_final1"></td>
                                            <td class="total_final2"></td>
                                            <td class="total_final3"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                           </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
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
<!-- container date_starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
Date.prototype.getWeek = function() {
      var onejan = new Date(this.getFullYear(),0,1);
      var today = new Date(this.getFullYear(),this.getMonth(),this.getDate());
      var dayOfYear = ((today - onejan +1)/86400000);
      return Math.ceil(dayOfYear/7)
};
$('#date_starting').on('change',function(){
    var date = $('#date_starting').val();
    var weekNumber = (new Date(date)).getWeek();
    $('#week_of_offer').text(weekNumber);
});

$('#client_id').change(function(){
    var client_id = $('#client_id').val();
    var url_project_number = "<?php echo base_url() ?>offers/get_project_number_by_client_id?client_id="+client_id;
    $.ajax({
        type: "GET",
        url: url_project_number, 
        dataType: "text",  
        cache:true,
        success: 
            function(data){
                $('#project_number').empty();
                var project_number = jQuery.parseJSON(data);                        
                $.each(project_number, function (key,value) {
                    $('#project_number').append("<option value="+value['id']+">"+value['project_number']+"</option>");
                });
            }
    });
});
$('#add_services').click(function(){
    var name_services = $('#name_services_text').val();
    if(name_services != ''){
        var html = "<input type='checkbox' name='status_service[]' checked /><label>"+name_services+"</label><input type='hidden' name='name_service[]' value='"+name_services+"'/><br />";
        $('#services_offer').append(html);
    }
    $('#name_services_text').val("");
});
$('#add_material_price').click(function(){
    var html = "<tr><td><?php get_material_dropdown(); ?></td><td><input type='text' name='amount_material[]' /></td><td><input type='text' name='unit_material[]' /><?php step_dropdown_unit_matrial(); ?></td><td></td></tr>";
    $('.table_material_price').find('table').find('tbody').append(html);
});
$('#contact_person_id').change(function(){
    var worker_id = $('#contact_person_id').val();
    var url_contact = "<?php echo  base_url() ?>offers/get_contact_email?worker_id="+worker_id; 
    $.ajax({
         type: "GET",
         url: url_contact, 
         dataType: "text",  
         cache:false,
         success: 
            function(data){
                var contact = jQuery.parseJSON(data);
                $('#contact_email').val(contact['email']);
            }
    });
});
$('#add_rental_fee').click(function(){
    var html = "<tr><td><?php get_rental_scaffold_type_dropdown_fee(); ?></td><td><input type='text' name='fee_unit_day[]' class='fee_unit_day'/></td><td><input type='text' name='fee_min_day[]' class='fee_min_day'/></td></tr>";
    $('.table_rental_fee').find('tbody').append(html);   
});
function add_information(){
    var text = $('#text-information').val();
    if(text != ''){
        var html = "<li><label>"+text+"</label><a href='#' class='del'> Del</a><br /><input type='hidden' value='"+text+"' name='information[]'></li>";
        $('#infomarion').append(html); 
        $('#text-information').val('');
    }
}
$('#infomarion').on('click', '.del', function() {
    $(this).closest('li').remove();
    return false;
});
function change_width(){
    $('.width').change(function(){
        var length = $(this).closest('tr').find('.length').val();
        var width = $(this).closest('tr').find('.width').val();
        var high = $(this).closest('tr').find('.high').val();
        
        if(length == ''){
            length = 0;
        }else{
            length = parseFloat(length);
        }
        if(high == ''){
            high = 0;
        }else{
            high = parseFloat(high);
        }
        if(width == '' || width == 0){
             $(this).closest('tr').find('.m2_or_m3').html(length*high);
        }else{
            width = parseFloat(width);
            $(this).closest('tr').find('.m2_or_m3').html(length*high*width);
        }
    });
}
function change_length(){
    $('.length').change(function(){
        var length = $(this).closest('tr').find('.length').val();
        var width = $(this).closest('tr').find('.width').val();
        var high = $(this).closest('tr').find('.high').val();
        
        if(length == ''){
            length = 0;
        }else{
            length = parseFloat(length);
        }
        if(high == ''){
            high = 0;
        }else{
            high = parseFloat(high);
        }
        if(width == '' || width == 0){
             $(this).closest('tr').find('.m2_or_m3').html(length*high);
        }else{
            width = parseFloat(width);
            $(this).closest('tr').find('.m2_or_m3').html(length*high*width);
        }
    });
}
function change_high(){
    $('.high').change(function(){
        var length = $(this).closest('tr').find('.length').val();
        var width = $(this).closest('tr').find('.width').val();
        var high = $(this).closest('tr').find('.high').val();
        
        if(length == ''){
            length = 0;
        }else{
            length = parseFloat(length);
        }
        if(high == ''){
            high = 0;
        }else{
            high = parseFloat(high);
        }
        if(width == '' || width == 0){
             $(this).closest('tr').find('.m2_or_m3').html(length*high);
        }else{
            width = parseFloat(width);
            $(this).closest('tr').find('.m2_or_m3').html(length*high*width);
        }
    });
}


function viewData(id){
        var url = "<?php echo base_url(); ?>offers/get_offer_id?id=" + id;
        $.ajax({
         type: "GET",
         url: url, 
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                  var offer = jQuery.parseJSON(data);
                  $('#offer_id').val(offer['id']);
                  $('#offer_number').val(offer['offer_number']);
                  $('#client_id').val(offer['client_id']);
                  $('#invoice_address').val(offer['invoice_address']);
                  $('#client_number').val(offer['client_number']);
                  
                  $('#cost_center').val(offer['cost_center']);
                  $('#order_number').val(offer['order_number']);
                  $('#contact_person_id').val(offer['contact_person_id']);
                  $('#seller_id').val(offer['seller_id']);
                  $('#probability').val(offer['probability']);
                  $('#responsible_sv_id').val(offer['responsible_sv_id']);
                  $('#foreman_id').val(offer['foreman_id']);
                  $('#house').val(offer['house_id']);
                  $('#day_duration').val(offer['day']);
                  $('#startus_offer').val(offer['status']);
                 
                  var parent_id = $('#house').val();
                  var url_project_number = "<?php echo base_url() ?>offers/get_project_number_by_client_id?client_id="+offer['client_id'];
                    $.ajax({
                        type: "GET",
                        url: url_project_number, 
                        dataType: "text",  
                        cache:true,
                        success: 
                            function(data){
                                $('#project_number').empty();
                                var project_number = jQuery.parseJSON(data);                        
                                $.each(project_number, function (key,value) {
                                    $('#project_number').append("<option value="+value['id']+">"+value['project_number']+"</option>");
                                });
                            }
                    });
                    $('#project_number').val(offer['project_id']);
                   var url_services = "<?php echo  base_url() ?>offers/get_services?offer_id="+offer['id']; 
                    $.ajax({
                         type: "GET",
                         url: url_services, 
                         dataType: "text",  
                         cache:false,
                         success: 
                            function(data){
                                var service = jQuery.parseJSON(data);
                                $('#services_offer').empty();
                                $.each(service, function (key,value) {
                                    if(value['status'] == 1){
                                        var html = "<input type='checkbox' name='status_service[]' checked /><label>"+value['service']+"</label><input type='hidden' name='name_service[]' value='"+value['service']+"'/><br />";
                                    }else{
                                        var html = "<input type='checkbox' name='status_service[]' /><label>"+value['service']+"</label><input type='hidden' name='name_service[]' value='"+value['service']+"'/><br />";
                                    }
                                    
                                    $('#services_offer').append(html);
                                });
                            }
                    });
                  var url_material = "<?php echo  base_url() ?>offers/get_material?offer_id="+offer['id']; 
                    $.ajax({
                         type: "GET",
                         url: url_material, 
                         dataType: "text",  
                         cache:false,
                         success: 
                            function(data){
                                var data_cost = jQuery.parseJSON(data); 
                                var count = 0;
                                $('.table_material_price').find('tbody').empty();
                                $.each(data_cost, function (key,value) {
                                    count += 1;
                                    var row_id_m = '#row_material_'+count;
                                    var html = "<tr id='row_material_"+count+"'><td><?php get_material_dropdown(); ?></td><td><input type='text' name='amount_material[]' value='"+value['amount']+"' /></td><td><input type='text' name='unit_material[]' value='"+value['unit']+"' /><?php step_dropdown_unit_matrial(); ?></td><td>"+value['total']+"</td></tr>";
                                    $('.table_material_price').find('table').find('tbody').append(html);
                                    $('.table_material_price').find('table').find(row_id_m).find('.select_name_material').val(value['name_material']);
                                    $('.table_material_price').find('table').find(row_id_m).find('.per_unit_material').val(value['price_per_unit']);
                                    console.log();
                                });
                            }
                    });
                  var url_overhour = "<?php echo base_url()?>offers/get_over_hour?offer_id="+ offer['id'];
                  $.ajax({
                         type: "GET",
                         url: url_overhour, 
                         dataType: "text",  
                         cache:false,
                         success: 
                            function(data){
                                var overhour = jQuery.parseJSON(data);
                                if(overhour.length > 0){
                                    $('.table_overhour_rates').find('table').find('tbody').empty();
                                }
                                var count = 0;
                                $.each(overhour, function (key,value) {
                                    count +=1;
                                    var row_over_hour = '#over_hour_row_'+count;
                                    var html="<tr id='over_hour_row_"+count+"'><td>"+value['name']+"<input type='hidden' name='name_overhour[]' value='"+value['name']+"' /></td><td><input type='text' class='base_over_hour' name='base[]' value='"+value['base']+"' /></td><td><input type='text' name='f5_percen[]' value='"+value['50_percent']+"' /></td><td><input type='text' name='h1_percen[]' value='"+value['100_percent']+"' /></td><td><input type='text' name='h15_percen[]' value='"+value['150_percent']+"' /></td><td><input type='text' name='h2_percen[]' value='"+value['200_percent']+"' /></td><td><input type='text' name='h3_percen[]' value='"+value['300_percent']+"' /></td><td><input type='text' name='estimated[]' class='total_estimation' onclick='change_estimation();' value='"+value['estimate']+"'/></td><td class='estimation_total'></td></tr>";
                                    $('.table_overhour_rates').find('table').find('tbody').append(html);
                                    $('.table_overhour_rates').find('table').find(row_over_hour).find('.estimation_total').html(value['base']*value['estimate']);console.log(value['base']*value['estimate']);
                                });
                            }
                    });
                  var url_close_cost = "<?php echo base_url() ?>offers/get_close_cost?offer_id=" + offer['id'];
                  var main_body = $('.table_close_cost').find('tbody');
                  $.ajax({
                    type: "GET",
                    url: url_close_cost, 
                    dataType: "text",  
                    cache:true,
                    success: 
                        function(data){
                            var data_cost = jQuery.parseJSON(data); 
                            var count = 0; 
                            var total_close_cost = 0;
                            if(data_cost.length>=1){
                                $('.table_close_cost').find('tbody').empty();
                            }                  
                            $.each(data_cost, function (key,value) {
                                count += 1;
                                total_close_cost += parseFloat(value['total_cost']);
                                var row_cost_id = "#row_cost_close_"+count;
                                var row_cost = "<tr id='row_cost_close_"+count+"'><td class='name'>"+value['name']+"<input type='hidden' name='name_cost[]' class='name_cost' value='"+value['name']+"' /></td><td class='name_kind'><?php get_kind_dropdown(); ?></td><td class='quantity'><input type='text' value='"+value['quantity']+"' class='quantity' name='quantity[]'/></td><td class='unit'><select class='unit_select' name='unit[]' ><option value='0'>Select Unit</option><option value='1'>vrk</option><option value='2'>h</option><option value='3'>kk</option></select></td><td class='price_per_unit'><input type='text' value='"+value['price_per_unit']+"' class='price_per_unit' name='price_per_unit[]' /></td><td class='total'>"+value['total_cost']+"</td><td class='cover'><input type='text' name='profit_cover[]' value='"+value['profit_cover']+"'/></td><td class='bid'></td><td class='selite'><input type='text' name='note_close_cost[]' class='note_close_cost' value='"+value['selite']+"' /></td></tr>";         
                                main_body.append(row_cost);
                                main_body.find(row_cost_id).find('.kind_cost').val(value['kind_id']);
                                main_body.find(row_cost_id).find('.unit_select').val(value['unit']);
                                main_body.find(row_cost_id).find('.bid').html((value['total_cost']*((100+value['profit_cover'])/100)).toFixed(2));
                            });
                            $('#total_close_cost').val(total_close_cost);
                            localStorage.setItem('total_close_cost', total_close_cost);
                        }
                  });
                    var worker_id = $('#contact_person_id').val();
                    var url_contact = "<?php echo  base_url() ?>offers/get_contact_email?worker_id="+worker_id; 
                    $.ajax({
                         type: "GET",
                         url: url_contact, 
                         dataType: "text",  
                         cache:false,
                         success: 
                            function(data){
                                var contact = jQuery.parseJSON(data);
                                $('#contact_email').val(contact['email']);
                            }
                    });
                  var url_rental_fee = "<?php echo base_url()?>offers/get_rental_fee?offer_id="+offer['id'];
                  $.ajax({
                    type: "GET",
                    url: url_rental_fee, 
                    dataType: "text",  
                    cache:true,
                    success: 
                        function(data){
                            var count = 0;
                            $(".rental_fees").find('table').find('tbody').empty();
                            var data_room = jQuery.parseJSON(data);                      
                            $.each(data_room, function (key,value) {
                                count += 1;
                                var row_cost_id = "#row_rental_fee_"+count;
                                var html = "<tr id='row_rental_fee_"+count+"'><td><?php get_rental_scaffold_type_dropdown_fee(); ?></td><td><input type='text' name='fee_unit_day[]' value='"+value['fee_unit_day']+"' class='fee_unit_day'/></td><td><input type='text' name='fee_min_day[]' value='"+value['fee_min_day']+"' class='fee_min_day'/></td></tr>"; 
                                $(".rental_fees").find("table").find("tbody").append(html);
                                $(row_cost_id).find('.rental_fee').val(value['type_rental_id']);
                            });
                        }
                  });
                  var url_info = "<?php echo base_url()?>offers/get_all_info?offer_id="+offer['id'];
                  $.ajax({
                    type: "GET",
                    url: url_info, 
                    dataType: "text",  
                    cache:true,
                    success: 
                        function(data){
                            $("#infomarion").empty();
                            var data_room = jQuery.parseJSON(data);                       
                            $.each(data_room, function (key,value) {
                                $("#infomarion").append("<li><label>"+value['info']+"</label><a href='#' class='del'> Del</a><br /><input type='hidden' value='"+value['info']+"' name='information[]'/></li>");
                            });
                        }
                  });
                  var url_room = "<?php echo base_url() ?>offers/get_room_of_house?house_id="+parent_id;
                  $('#room').empty();
                  $.ajax({
                    type: "GET",
                    url: url_room, 
                    dataType: "text",  
                    cache:true,
                    success: 
                        function(data){
                            var data_room = jQuery.parseJSON(data);                        
                            $.each(data_room, function (key,value) {
                                $('#room').append("<option value="+value['id']+">"+value['name']+"</option>");
                            });
                        }
                  });
                  
                  $('#room').val(offer['room_id']);
                  $('#date_starting').val(offer['starting_date']);
                  var day = $('#day_duration').val();
                  var weekNumber = (new Date(offer['starting_date'])).getWeek();
                  $('#week_of_offer').text(weekNumber);
                  if(day < 90){
                        $('#project_duration').text('Fewer 3 month');
                  }else{
                        $('#project_duration').text('over 3 month');
                  }
                  var url = "<?php echo base_url(); ?>offers/get_rental_scaffold_by_offer_id?offer_id=" + id+"&day="+day+"&start_date="+offer['starting_date'];
                    $.ajax({
                         type: "GET",
                         url: url, 
                         dataType: "text",  
                         cache:false,
                         success: 
                              function(data){
                                  $('.table_rental_scaffolds').find('table').find('tbody').empty();
                                  var data_rental_scaffold = jQuery.parseJSON(data);
                                  var rental_scaffold1 = 0;
                                  var rental_scaffold2 = 0;
                                  var rental_scaffold3 = 0;
                                  var rental_scaffold4 = 0; 
                                  var rental_scaffold5 = 0;
                                  $.each(data_rental_scaffold, function (key,value) {
                                        rental_scaffold1 += parseFloat(value['total1']);//total 1
                                        rental_scaffold2 += parseFloat(value['m2']);//m2
                                        rental_scaffold3 += parseFloat(value['total2']);//total 2
                                        rental_scaffold4 += parseFloat(value['per_day']);//price per day
                                        rental_scaffold5 += parseFloat(value['per_month']);//price per month
                                        var a = $('.table_rental_scaffolds').find('tbody tr').length;
                                        var afoot = $('.table_rental_scaffolds').find('tfoot tr').length;
                                        var total_row = "<tr><td colspan='4'>YHTEENSÄ</td><td class='rental_scaffold_total_1'></td><td class='total_cover'></td><td class='rental_scaffold_total_2'></td><td></td><td></td><td class='rental_scaffold_total_3'></td><td class='rental_scaffold_total_4'></td><td class='rental_scaffold_total_5'></td><td colspan='6'></td></tr>";
                                        var count = a + 1;
                                        var row_id = "#rentalscaffoldrow_"+count;
                                        var row = "<tr id='rentalscaffoldrow_"+count+"'><td>"+count+"</td><td><?php  get_rental_scaffold_type_dropdown(); ?></td><td><?php step_dropdown(); ?><td class='price_m2_data'>"+value['price_generate']+"</td><td class='total1'>"+value['total1']+"</td><td><input type='text' name='rental_scaffold_cover[]' onclick='change_cover();' class='rental_scaffold_cover' value='"+value['cover']+"' /></td><td><input type='text' onclick='change_m2();' name='rental_scaffold_m2[]' value='"+value['m2']+"' class='rental_scaffold_m2' /></td><td class='price_m2'>"+value['price_m2']+"</td><td class='day'><input type='text' name='day[]' onclick='change_day();' class='day_offer' value='"+value['day']+"' /></td><td class='total2'>"+value['total2']+"</td><td class='price_day'>"+value['per_day']+"</td><td class='price_month'>"+value['per_month']+"</td><td><input type='text' name='scaffold_dimension[]' class='scaffold_dimension' value='"+value['dimension']+"' /></td><td><input type='text' name='length[]' class='length' value='"+value['length']+"' onclick='change_length();' /></td><td><input type='text' name='width[]' class='width' value='"+value['width']+"' onclick='change_width();' /></td><td><input type='text' name='high[]' class='high' onclick='change_high();' value='"+value['high']+"' /></td><td class='m2_or_m3'>"+value['m2_or_m3']+"</td><td><input type='text' name='note[]' class='note' value='"+value['note']+"' /></td></tr>";
                                        
                                        $('.table_rental_scaffolds').find('table').find('tbody:first').append(row);
                                        $(".table_rental_scaffolds").find(row_id).find('.rental_scaffold_type').val(value["type_scaffold_id"]);
                                        $(".table_rental_scaffolds").find(row_id).find('.step_offer').val(value['step']);
                                        if(afoot == 0){
                                            $('.table_rental_scaffolds').find('table').find('tfoot').append(total_row);
                                        }
                                   });
                                   
                                   $('.rental_scaffold_total_1').html(rental_scaffold1.toFixed(2));
                                   $('.rental_scaffold_total_2').html(rental_scaffold2.toFixed(2));
                                   $('.rental_scaffold_total_3').html(rental_scaffold3.toFixed(2));
                                   $('.rental_scaffold_total_4').html(rental_scaffold4.toFixed(2));
                                   $('.rental_scaffold_total_5').html(rental_scaffold5.toFixed(2));
                                   localStorage.setItem('rental_total', rental_scaffold3.toFixed(2));
                                   localStorage.setItem('cost_rental', rental_scaffold1.toFixed(2));
                                   localStorage.setItem('profit_rental', (rental_scaffold3-rental_scaffold1).toFixed(2));
                                   
                                   
                                   $('.table_total_all').find('table').find('.rental_total').html(rental_scaffold3.toFixed(2));
                                   $('.table_total_all').find('table').find('.cost_rental').html(rental_scaffold1.toFixed(2));
                                   $('.table_total_all').find('table').find('.profit_rental').html((rental_scaffold3-rental_scaffold1).toFixed(2));
                                  
                              }
                    
                        });
                    var url3 = "<?php echo base_url(); ?>offers/get_work_scaffold_by_offer_id?offer_id=" + id;
                        $.ajax({
                             type: "GET",
                             url: url3, 
                             dataType: "text",  
                             cache:false,
                             success: 
                                  function(data){
                                      $('.work_scaffold_talbe').find('table').find('tbody').empty();
                                      var data_rental_scaffold = jQuery.parseJSON(data);
                                      var sum1 = 0;
                                      var sum2 = 0;
                                      var sum3 = 0;
                                      var sum4 = 0;
                                      var sum5 = 0;
                                      var sum6 = 0;
                                      var sum7 = 0;
                                      var sum8 = 0;
                                      var sum9 = 0;
                                      var sum10 = 0;
                                      var sum11 = 0;
                                      $.each(data_rental_scaffold, function (key,value) {
                                        sum1 += parseFloat(value['m2']);
                                        sum2 += parseFloat(value['total1']);
                                        sum3 += parseFloat(value['total2']);
                                        sum4 += parseFloat(value['transport_cost']);
                                        sum5 += parseFloat(value['transport_offer']);
                                        sum6 += parseFloat(value['kraana_cost']);
                                        sum7 += parseFloat(value['kraana_offer']);
                                        sum8 += parseFloat(value['material_cost']);
                                        sum9 += parseFloat(value['material_offer']);
                                        sum10 += parseFloat(value['other_cost']);
                                        sum11 += parseFloat(value['other_offer']);
                                        var total_row = "<tr><td colspan='3'>YHTEENSÄ</td><td class='work_scaffold_total_1'></td><td class='total_cover'></td><td class='work_scaffold_total_2'></td><td></td><td></td><td class='work_scaffold_total_3'></td><td class='work_scaffold_total_4'></td><td></td><td class='work_scaffold_total_5'></td><td class='work_scaffold_total_6'></td><td></td><td class='work_scaffold_total_7'></td><td class='work_scaffold_total_8'></td><td></td><td class='work_scaffold_total_9'></td><td></td><td class='work_scaffold_total_10'></td><td></td><td class='work_scaffold_total_11'></td><td></td></tr>";
                                            var a = $('.work_scaffold_talbe').find('tbody tr').length;
                                            var afoot = $('.work_scaffold_talbe').find('tfoot tr').length;
                                            var count = a + 1;
                                            var row_id = '#workscaffoldrow_'+count;
                                            var row_work = "<tr id='workscaffoldrow_"+count+"'><td>"+count+"</td><td class='scaffold_type'><?php get_work_scaffold_type_dropdown();?></td><td><?php step_dropdown_work(); ?></td><td class='work_m2'><input type='text' name='work_m2[]' value='"+value['m2']+"' class='m2_of_work'/></td><td><input type='text' onclick='change_work_m2();' name='work_scaffold_m2[]' class=' work_scaffold_m2' value='"+value['price_m2']+"' /></td><td class='price_work_total1'>"+value['total1']+"<td><input type='text' name='work_scaffold_cover[]' onclick='change_cover_work();' value='"+value['cover']+"' class=' work_scaffold_cover' /></td><td class='price_work_m2'>"+value['price_m2_cal']+"</td><td class='price_work_total2'>"+value['total2']+"</td><td><input type='text' name='kust_transport[]' value='"+value['transport_cost']+"' onclick='change_kust_transport()' class=' transport_kust'/></td><td><input type='text' value='"+value['transport_profit']+"' name='cover_transport[]' onclick='change_cover_transport()' class=' transport_cover'/></td><td class=' transport_offer'>"+value['transport_offer']+"</td><td><input type='text' onclick='change_kust_kraana()' value='"+value['kraana_cost']+"' name='kust_kraana[]' class=' kraana_kust'/></td><td><input type='text' onclick='change_cover_kraana()' value='"+value['kraana_profit']+"' name='cover_kraana[]' class=' kraana_cover'/></td><td class='kraana_offer'>"+value['kraana_offer']+"</td><td><input type='text' name='kust_material[]' onclick='change_kust_material()' value='"+value['material_cost']+"' class='material_kust'/></td><td><input type='text' name='cover_material[]' value='"+value['material_profit']+"' onclick='change_cover_material()' class='material_cover'/></td><td class='material_offer'>"+value['material_offer']+"</td><td><input type='text' name='material_note[]' value='"+value['note_material']+"' class='material_note' /></td><td><input type='text' name='other_cost[]' value='"+value['other_cost']+"' class='other_cost' /></td><td><input type='text' name='other_cover[]' value='"+value['other_profit']+"' class='other_cover'/></td><td class='other_offer'>"+value['other_offer']+"</td><td><input type='text' name='other_note[]' value='"+value['note_other']+"' class='other_note'/></td></tr>";
                                            $('.work_scaffold_talbe').find('table').find('tbody').append(row_work);
                                            $('.work_scaffold_talbe').find(row_id).find('.work_scaffold_type').val(value['type_scaffold_id']);
                                            $('.work_scaffold_talbe').find(row_id).find('.step_offer').val(value['step']);
                                            if(afoot == 0){
                                                $('.work_scaffold_talbe').find('table').find('tfoot').append(total_row);
                                            }
                                       });
                                       
                                       $('.work_scaffold_total_1').html(sum1.toFixed(2));
                                       $('.work_scaffold_total_2').html(sum2.toFixed(2));
                                       $('.work_scaffold_total_3').html(sum3.toFixed(2));
                                       $('.work_scaffold_total_4').html(sum4.toFixed(2));
                                       $('.work_scaffold_total_5').html(sum5.toFixed(2));
                                       $('.work_scaffold_total_6').html(sum6.toFixed(2));
                                       $('.work_scaffold_total_7').html(sum7.toFixed(2));
                                       $('.work_scaffold_total_8').html(sum8.toFixed(2));
                                       $('.work_scaffold_total_9').html(sum9.toFixed(2));
                                       $('.work_scaffold_total_10').html(sum10.toFixed(2));
                                       $('.work_scaffold_total_11').html(sum11.toFixed(2));
                                                                           
                                       
                                       $('.table_total_all').find('table').find('.work_total').html(sum3.toFixed(2));                             
                                       $('.table_total_all').find('table').find('.cost_work').html(sum2.toFixed(2));
                                       $('.table_total_all').find('table').find('.profit_work').html((sum3-sum2).toFixed(2));
                                       $('.table_total_all').find('table').find('.transport_total').html(sum5.toFixed(2));
                                       $('.table_total_all').find('table').find('.cost_transport').html(sum4.toFixed(2));
                                       $('.table_total_all').find('table').find('.profit_transport').html((sum5-sum4).toFixed(2));
                                       $('.table_total_all').find('table').find('.kraana_total').html(sum7.toFixed(2));
                                       $('.table_total_all').find('table').find('.cost_kraana').html(sum6.toFixed(2));
                                       $('.table_total_all').find('table').find('.profit_kraana').html((sum7-sum6).toFixed(2));
                                       $('.table_total_all').find('table').find('.other_total').html(sum11.toFixed(2));
                                       $('.table_total_all').find('table').find('.cost_other').html(sum10.toFixed(2));
                                       $('.table_total_all').find('table').find('.profit_other').html((sum11-sum10).toFixed(2));           
                                       $('.table_total_all').find('table').find('.close_cost_total').html(localStorage.getItem('total_close_cost'));
                                       $('.table_total_all').find('table').find('.total_final1').html((parseFloat(localStorage.getItem('rental_total'))+ sum3 + sum5 + sum7 + sum11 + parseFloat(localStorage.getItem('total_close_cost'))).toFixed(2)); 
                                       $('.table_total_all').find('table').find('.total_final2').html(parseFloat(localStorage.getItem('cost_rental'))+ sum2 + sum4 + sum6 + sum10); 
                                       $('.table_total_all').find('table').find('.total_final3').html((parseFloat(localStorage.getItem('profit_rental'))+ (sum3-sum2) + (sum5-sum4) + (sum7-sum6) + (sum11-sum10)).toFixed(2)); 
                                  }
                        });                                                  
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

$('#add_rental_scaffold').click(function(){
    var a = $(this).closest('div').find('table tr').length;
    var count = a - 2;
    var row = "<tr id='rentalscaffoldrow_"+count+"'><td>"+count+"</td><td><?php  get_rental_scaffold_type_dropdown(); ?></td><td><?php step_dropdown(); ?></td><td class='price_m2_data'></td><td class='total1'></td><td><input type='text' name='rental_scaffold_cover[]' onclick='change_cover();' class='rental_scaffold_cover' /></td><td><input type='text' onclick='change_m2();' name='rental_scaffold_m2[]' class='rental_scaffold_m2' /></td><td class='price_m2'></td><td class='day'><input type='text' class='day_offer' name='day[]' onclick='change_day();' /></td><td class='total2'></td><td class='price_day'></td><td class='price_month'></td><td><input type='text' name='scaffold_dimension[]' class='scaffold_dimension' /></td><td><input type='text' name='length[]' class='length' onclick='change_length();' /></td><td><input type='text' name='width[]' class='width' onclick='change_width();' /></td><td><input type='text' name='high[]' class='high' onclick='change_high();' /></td><td class='m2_or_m3'></td><td><input type='text' name='note[]' class='note' /></td></tr>";
    $(this).closest('div').find('table').find('tbody:first').append(row); 
    
    var row_work = "<tr id='workscaffoldrow_"+count+"'><td>"+count+"</td><td class='scaffold_type'><?php get_work_scaffold_type_dropdown();?></td><td><?php step_dropdown_work(); ?></td><td class='work_m2'><input type='text' class='m2_of_work' name='work_m2[]'></td><td><input type='text' onclick='change_work_m2();' name='work_scaffold_m2[]' class='work_scaffold_m2' /></td><td class='price_work_total1'><td><input type='text' name='work_scaffold_cover[]' onclick='change_cover_work();' class='work_scaffold_cover' /></td><td class='price_work_m2'></td><td class='price_work_total2'></td><td><input type='text' name='kust_transport[]' onclick='change_kust_transport()' class='transport_kust'/></td><td><input type='text' name='cover_transport[]' onclick='change_cover_transport()' class='transport_cover'/></td><td class='transport_offer'></td><td><input type='text' onclick='change_kust_kraana()' name='kust_kraana[]' class='kraana_kust'/></td><td><input type='text' onclick='change_cover_kraana()' name='cover_kraana[]' class='kraana_cover'/></td><td class='kraana_offer'></td><td><input type='text' name='kust_material[]' onclick='change_kust_material()' class='material_kust'/></td><td><input type='text' name='cover_material[]' onclick='change_cover_material()' class='material_cover'/></td><td class='material_offer'></td><td><input type='text' class='note_material' name='note_material[]' /></td><td><input type='text' name='cost_other[]' class='cost_other' /></td><td><input type='text' name='cover_other[]' class='cover_other' /></td><td></td><td><input type='text' name='note_other[]' class='note_other' /></td></tr>";
    
    $(".work_scaffold_talbe").find('table').find('tbody:first').append(row_work);
});

$('#add_work_offer').click(function(){
    var a = $(this).closest('div').find('table tr').length;
    var count = a - 2;
    var row_work = "<tr id='workscaffoldrow_"+count+"'><td>"+count+"</td><td class='scaffold_type'><?php get_work_scaffold_type_dropdown();?></td><td><?php step_dropdown_work(); ?></td><td class='work_m2'><input type='text' class='m2_of_work' name='work_m2[]'></td><td><input type='text' onclick='change_work_m2();' name='work_scaffold_m2[]' class='work_scaffold_m2' /></td><td class='price_work_total1'><td><input type='text' name='work_scaffold_cover[]' onclick='change_cover_work();' class='work_scaffold_cover' /></td><td class='price_work_m2'></td><td class='price_work_total2'></td><td><input type='text' name='kust_transport[]' onclick='change_kust_transport()' class='transport_kust'/></td><td><input type='text' name='cover_transport[]' onclick='change_cover_transport()' class='transport_cover'/></td><td class='transport_offer'></td><td><input type='text' onclick='change_kust_kraana()' name='kust_kraana[]' class='kraana_kust'/></td><td><input type='text' onclick='change_cover_kraana()' name='cover_kraana[]' class='kraana_cover'/></td><td class='kraana_offer'></td><td><input type='text' name='kust_material[]' onclick='change_kust_material()' class='material_kust'/></td><td><input type='text' name='cover_material[]' onclick='change_cover_material()' class='material_cover'/></td><td class='material_offer'></td><td><input type='text' class='note_material' name='note_material[]' /></td><td><input type='text' name='cost_other[]' class='cost_other' /></td><td><input type='text' name='cover_other[]' class='cover_other' /></td><td></td><td><input type='text' name='note_other[]' class='note_other' /></td></tr>";
    
    $(".work_scaffold_talbe").find('table').find('tbody:first').append(row_work); 
});

$('#day_duration').change(function(){
    var day = $('#day_duration').val();
    if(parseFloat(day) > 90){
        $('#project_duration').text('Over 3 month');
    }else{
        $('#project_duration').text('fewer 3 month');
    }
});

function change_rental_scaffold_type(){
    $('.rental_scaffold_type').change(function(){
        var main_row = $(this).closest('tr');
        var start_date = $('#date_starting').val();
        var type = $(this).closest('tr').find('.rental_scaffold_type').val();
        
        var url = "<?php echo base_url(); ?>offers/get_price_for_rental_scaffold?type=" + type + "&date=" + start_date;
        var row = $(this).closest('tr').find('td.price_m2_data');
        $.ajax({
             type: "GET",
             url: url, 
             dataType: "text",  
             cache:true,
             success: 
                  function(data){
                      var day = $('#day_duration').val();;
                      var client = jQuery.parseJSON(data);
                      if(parseInt(day)/30 > 3){
                            row.html(client['price_m2_over_3_month']);
                      }else{
                            row.html(client['price_m2_fewer_3_month']);
                      }
                      
                       var col_select_cover = parseFloat(main_row.find('.rental_scaffold_cover').val());
                        var col_select_total1 = main_row.find('.total1');
                        var col_price_m2_data = parseFloat(main_row.find('td.price_m2_data').html());
                        var col_select_m2 = parseFloat(main_row.find('.rental_scaffold_m2').val());
                        var day = parseFloat(main_row.find('.day_offer').val());
                        console.log(day);
                        col_select_total1.html((col_price_m2_data*col_select_m2*day).toFixed(0));
                        var price_m2 = main_row.find('.price_m2');
                        var price_day = main_row.find('.price_day');
                        var col_price_m2 = parseFloat(main_row.find('.price_m2').html());
                        var col_select_total2 = main_row.find('.total2');
                        col_select_total2.html((col_price_m2*day*col_select_m2).toFixed(0));
                        
                        price_m2.html((col_price_m2_data/((100-col_select_cover)/100)).toFixed(3));
                        
                        var price_day = main_row.find('.price_day');
                        price_day.html((col_select_m2*col_price_m2).toFixed(0));
                        
                        var value_price_day = parseFloat(price_day.html());
                        var price_month = main_row.find('.price_month');
                        price_month.html(value_price_day*30);
                  }
        });
        
        
    }); 
}
function change_cover(){
    $('.rental_scaffold_cover').change(function(){
        var col_select_cover = parseFloat($(this).closest('tr').find('.rental_scaffold_cover').val());
        var col_price_m2_data = parseFloat($(this).closest('tr').find('.price_m2_data').html());
        var col_select_total1 = $(this).closest('tr').find('.total1');
        var col_select_m2 = parseFloat($(this).closest('tr').find('.rental_scaffold_m2').val());
        var day = parseFloat($(this).closest('tr').find('.day_offer').val());
        var price_m2 = $(this).closest('tr').find('.price_m2');
        var col_price_m2 = parseFloat($(this).closest('tr').find('.price_m2').html());
        price_m2.html((col_price_m2_data/((100-col_select_cover)/100)).toFixed(3));
        col_select_total1.html((col_price_m2_data*col_select_m2*day).toFixed(0));
        
        var price_day = $(this).closest('tr').find('.price_day');
        price_day.html((col_select_m2*col_price_m2).toFixed(0));
        
        var value_price_day = parseFloat(price_day.html());
        var price_month = $(this).closest('tr').find('.price_month');
        price_month.html(value_price_day*30);
    });
}

function change_day(){
    $('.day_offer').change(function(){
        
        var col_select_cover = parseFloat($(this).closest('tr').find('.rental_scaffold_cover').val());
        var col_select_total1 = $(this).closest('tr').find('.total1');
        var col_price_m2_data = parseFloat($(this).closest('tr').find('.price_m2_data').html());
        var col_select_m2 = parseFloat($(this).closest('tr').find('.rental_scaffold_m2').val());
        var day = parseFloat($(this).closest('tr').find('.day_offer').val());
        
        var col_price_m2 = parseFloat($(this).closest('tr').find('.price_m2').html());
        var col_select_total2 = $(this).closest('tr').find('.total2');
        col_select_total2.html((col_price_m2*day*col_select_m2).toFixed(0));
        var price_m2 = $(this).closest('tr').find('.price_m2');
        price_m2.html((col_price_m2_data/((100-col_select_cover)/100)).toFixed(3));
        col_select_total1.html((col_price_m2_data*col_select_m2*day).toFixed(0));
        console.log((col_price_m2_data*col_select_m2*day).toFixed(0));
        
        var price_day = $(this).closest('tr').find('.price_day');
        price_day.html((col_select_m2*col_price_m2).toFixed(0));
        
        var value_price_day = parseFloat(price_day.html());
        var price_month = $(this).closest('tr').find('.price_month');
        price_month.html(value_price_day*30);
    });
}
function change_m2(){
    $('.rental_scaffold_m2').change(function(){
        var col_select_cover = parseFloat($(this).closest('tr').find('.rental_scaffold_cover').val());
        var col_select_total1 = $(this).closest('tr').find('.total1');
        var col_price_m2_data = parseFloat($(this).closest('tr').find('.price_m2_data').html());
        var col_select_m2 = parseFloat($(this).closest('tr').find('.rental_scaffold_m2').val());
        var day = parseFloat($(this).find('.day_offer').val());
        
        var col_price_m2 = parseFloat($(this).closest('tr').find('.price_m2').html());
        var col_select_total2 = $(this).closest('tr').find('.total2');
        col_select_total2.html((col_price_m2*day*col_select_m2).toFixed(0));
        var price_m2 = $(this).closest('tr').find('.price_m2');
        price_m2.html((col_price_m2_data/((100-col_select_cover)/100)).toFixed(3));
        col_select_total1.html((col_price_m2_data*col_select_m2*day).toFixed(0));
        
        var price_day = $(this).closest('tr').find('.price_day');
        price_day.html((col_select_m2*col_price_m2).toFixed(0));
        
        var value_price_day = parseFloat(price_day.html());
        var price_month = $(this).closest('tr').find('.price_month');
        price_month.html(value_price_day*30);
        
    });
}
function change_estimation(){
    $('.total_estimation').change(function(){
        var hour = $(this).closest('tr').find('.total_estimation').val();
        var base = $(this).closest('tr').find('.base_over_hour').val();
        $(this).closest('tr').find('.estimation_total').html(parseFloat(hour)*parseFloat(base));
    });
}

function change_kust_transport(){
    $('.transport_kust').change(function(){
        var row = $(this).closest('tr');
        var kust = parseFloat(row.find('.transport_kust').val());
        var cover = parseFloat(row.find('.transport_cover').val());
        row.find('.transport_offer').html((kust/((100-cover)/100)).toFixed(0));
    });
}
function change_cover_transport(){
    $('.transport_cover').change(function(){
        var row = $(this).closest('tr');
        var kust = parseFloat(row.find('.transport_kust').val());
        var cover = parseFloat(row.find('.transport_cover').val());
        row.find('.transport_offer').html((kust/((100-cover)/100)).toFixed(0));
    });
}

function change_kust_kraana(){
    $('.kraana_kust').change(function(){
        var row = $(this).closest('tr');
        var kust = parseFloat(row.find('.kraana_kust').val());
        var cover = parseFloat(row.find('.kraana_cover').val());
        row.find('.kraana_offer').html((kust/((100-cover)/100)).toFixed(0));
    });
}
function change_cover_kraana(){
    $('.kraana_cover').change(function(){
        var row = $(this).closest('tr');
        var kust = parseFloat(row.find('.kraana_kust').val());
        var cover = parseFloat(row.find('.kraana_cover').val());
        row.find('.kraana_offer').html((kust/((100-cover)/100)).toFixed(0));
    });
}

function change_kust_material(){
    $('.material_kust').change(function(){
        var row = $(this).closest('tr');
        var kust = parseFloat(row.find('.material_kust').val());
        var cover = parseFloat(row.find('.material_cover').val());
        row.find('.material_offer').html((kust/((100-cover)/100)).toFixed(0));
    });
}
function change_cover_material(){
    $('.material_cover').change(function(){
        var row = $(this).closest('tr');
        var kust = parseFloat(row.find('.material_kust').val());
        var cover = parseFloat(row.find('.material_cover').val());
        row.find('.material_offer').html((kust/((100-cover)/100)).toFixed(0));
    });
}

$('#house').change(function(){
    var parent_id = $('#house').val();
    var url = "<?php echo base_url() ?>offers/get_room_of_house?house_id="+parent_id;
    $.ajax({
        type: "GET",
        url: url, 
        dataType: "text",  
        cache:true,
        success: 
            function(data){
                console.log('aaaa');
                $('#room').empty();
                var data_room = jQuery.parseJSON(data);                        
                $.each(data_room, function (key,value) {
                    $('#room').append("<option value="+value['id']+">"+value['name']+"</option>");
                });
            }
    });
});

function change_work_m2(){
    $('.work_scaffold_m2').change(function(){
        //work scaffolds table
        var row_work_scaffold = $(this).closest('tr');
        var rental_scaffold_cover = parseFloat(row_work_scaffold.find('.work_scaffold_cover').val());
        var m2 = parseFloat(row_work_scaffold.find('.m2_of_work').val());
        
        var work_scaffold_m2 = parseFloat(row_work_scaffold.find('.work_scaffold_m2').val());
       
        row_work_scaffold.find('.price_work_total1').html((m2*work_scaffold_m2).toFixed(1));
        row_work_scaffold.find('.price_work_m2').html((work_scaffold_m2/((100-rental_scaffold_cover)/100).toFixed(1)));
        row_work_scaffold.find('.price_work_total2').html((m2*work_scaffold_m2/((100-rental_scaffold_cover)/100).toFixed(1)));
        //end
    });
}
function change_cover_work(){
    $('.work_scaffold_cover').change(function(){
        //work scaffolds table
        var row_work_scaffold = $(this).closest('tr');
        var rental_scaffold_cover = parseFloat(row_work_scaffold.find('.work_scaffold_cover').val());
        var m2 = parseFloat(row_work_scaffold.find('.m2_of_work').val());
        var work_scaffold_m2 = parseFloat(row_work_scaffold.find('.work_scaffold_m2').val());
     
        row_work_scaffold.find('.price_work_total1').html((m2*work_scaffold_m2).toFixed(3));
        row_work_scaffold.find('.price_work_m2').html((work_scaffold_m2/((100-rental_scaffold_cover)/100).toFixed(1)));
        row_work_scaffold.find('.price_work_total2').html((m2*work_scaffold_m2/((100-rental_scaffold_cover)/100).toFixed(1)));
        //end
    });
}

$(document).ready(function(){   
    
});
</script>
   