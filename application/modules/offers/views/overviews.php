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
                                        <td><?php echo $offer->email; ?></td>
                                        <td>10$</td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
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
                        <form action="<?php echo base_url();?>offers/edit" class="form-horizontal row-border" data-validate="parsley" id="validate-form" method="POST">
                            <input type="hidden" name="offer_id" id="offer_id"/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Offer Number</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="offer_number" name="offer_number">
                                </div>
                                <label class="col-sm-2 control-label">House</label>
                                <div class="col-sm-3">
                                    <?php get_house_dropdown(); ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">Starting date</label>
                                <div class="col-sm-3" id="green_date_picker">
                                    <div class="input-group date" id="datepicker" data-date-format="mm/dd/yyyy">
                                        <input type="text"  class="form-control" name="date_starting" id="date_starting"/>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label">Room</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="room" id="room">
                                        <option>Please choose house</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Client Name</label>
                                <div class="col-sm-3">
                                    <?php get_clients_dropdown(); ?>
                                    
                                </div>
                                <label class="col-sm-2 control-label">Clients work Number</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="client_number" name="client_number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Project Number</label>
                                <div class="col-sm-3">
                                    <?php get_project_drop_down(); ?>
                                </div>
                                
                                <label class="col-sm-2 control-label">Contact Person</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="contact_person" name="contact_person">
                                </div>
                          
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Invoice Address</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="invoice_address" name="invoice_address">
                                </div>
                                <label class="col-sm-2 control-label parsley-validated ">Seller</label>
                                <div class="col-sm-3">
                                    <?php get_users_dropdown(); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Order Number</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="order_number" name="order_number">
                                </div>
                                <label class="col-sm-2 control-label">Responsible SV</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated"  id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Days</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="day" name="day">
                                </div>
                                <label class="col-sm-2 control-label">Cost center</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="cost_center" name="cost_center">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Probability %</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="probability" name="probability">
                                </div>
                                <label class="col-sm-2 control-label">Foreman</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="foreman" name="foreman">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Assembling group</label>
                                <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control parsley-validated" id="assembling_group" name="assembling_group">
                                </div>
                               
                            </div>
                            <!-- table rental scaffolds -->
                           <div class="form-group table_rental_scaffolds">
                           <div class="table-responsive">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered rental_scaffold" id="example">
                                    <thead>
                                        <tr>
                                            <th colspan="16">Rental</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Scaffolds</th>
                                            <th colspan="2">Costs</th>
                                            <th>Cover</th>
                                            <th colspan="7"></th>
                                            <th colspan="3">Square Calculator</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Scaffold type</th>
                                            <th>€/m2</th>
                                            <th>YHT €</th>
                                            <th>%</th>
                                            <th>m2</th>
                                            <th>€/m2</th>
                                            <th>vrk</th>
                                            <th>YHT €</th>
                                            <th>(€/vrk)</th>
                                            <th>€/kk</th>
                                            <th>Stand dimensions and rack type (contur, layher, etc.).</th>
                                            <th>m</th>
                                            <th>x m</th>
                                            <th>m2</th>
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
                           <!-- table rental tents -->
                           <div class="form-group table_rental_tents table-responsive">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered rental_tent" id="example">
                                    <thead>
                                        <tr>
                                            <th colspan="16">Rental</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Tents</th>
                                            <th colspan="2">Costs</th>
                                            <th>Cover</th>
                                            <th colspan="9"></th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Scaffold type</th>
                                            <th>€/m2</th>
                                            <th>YHT €</th>
                                            <th>%</th>
                                            <th>m2</th>
                                            <th>€/m2</th>
                                            <th>vrk</th>
                                            <th>YHT €</th>
                                            <th>(€/vrk)</th>
                                            <th>€/kk</th>
                                            <th>Protection dimensions</th>
                                            <th>Keep an advantage</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                    <tfoot>
                                        
                                    </tfoot>
                                    
                                </table>
                                <a class="btn btn-primary" id="add_rental_tents">Add</a>
                           </div>
                           <!-- end table rental tents -->
                           <!-- table work scaffolds -->
                                <div class="form-group work_scaffold_talbe table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered work_scaffold" id="example">
                                        <thead>
                                            <tr>
                                                <th colspan="2" >Work</th>
                                                <th colspan="6">Installation and dismantling</th>
                                                <th colspan="3" rowspan="2">Transport</th>
                                                <th colspan="3" rowspan="2">Kraana</th>
                                                <th colspan="4" rowspan="2">Materials</th>
                                                <th colspan="4" rowspan="2">Other</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Scaffolds</th>
                                                <th colspan="3">Costs</th>
                                                <th>Cover</th>
                                                <th colspan="2">Bargain price</th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Scaffold type</th>
                                                <th>m2</th>
                                                <th>€/m2</th>
                                                <th>YHT €</th>
                                                <th>%</th>
                                                <th>€/m2</th>
                                                <th>YHT €</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Mitä</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Mitä</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tfoot>
                                        
                                            </tfoot>
                                        </tbody>
                                    </table>
                                </div>
                           <!-- end table work scaffolds -->
                           <!-- table work tents -->
                                <div class="form-group work_tent_table table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered work_scaffold" id="example">
                                        <thead>
                                            <tr>
                                                <th colspan="2" >Work</th>
                                                <th colspan="6">Installation and dismantling</th>
                                                <th colspan="3" rowspan="2">Transport</th>
                                                <th colspan="3" rowspan="2">Kraana</th>
                                                <th colspan="4" rowspan="2">Materials</th>
                                                <th colspan="4" rowspan="2">Other</th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Scaffolds</th>
                                                <th colspan="3">Costs</th>
                                                <th>Cover</th>
                                                <th colspan="2">Bargain price</th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Scaffold type</th>
                                                <th>m2</th>
                                                <th>€/m2</th>
                                                <th>YHT €</th>
                                                <th>%</th>
                                                <th>€/m2</th>
                                                <th>YHT €</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Mitä</th>
                                                <th>Kust. €</th>
                                                <th>Kate %</th>
                                                <th>Tarjous €</th>
                                                <th>Mitä</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                            <tfoot>
                                                
                                            </tfoot>
                                    </table>
                                    
                                </div>
                           <!-- end table work tents -->
                           <div class="form-group closed_cost">
                                <h3>Closed Costs</h3>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table_close_cost">
                                    <thead>
                                        <th>Name</th>
                                        <th>Kululaji</th>
                                        <th>Määrä</th>
                                        <th>Yksikkö</th>
                                        <th>€/yks</th>
                                        <th>Total€</th>
                                        <th>Profit %</th>
                                        <th>Offer €</th>
                                        <th>Selite</th>
                                    </thead>
                                    <tbody>
                                        <tr id="row_cost_close_1">
                                            <td class="name"><input type="text" name="name_cost[]" class="name_cost" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit"><input type="text" class="unit" name="unit[]" /></td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"></td>
                                            <td class="bid"></td>
                                            <td class="selite"></td>
                                        </tr>
                                        <tr id="row_cost_close_2">
                                            <td class="name"><input type="text" name="name_cost[]" class="name_cost" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit"><input type="text" class="unit" name="unit[]" /></td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"></td>
                                            <td class="bid"></td>
                                            <td class="selite"></td>
                                        </tr>
                                        <tr id="row_cost_close_3">
                                            <td class="name"><input type="text" name="name_cost[]" class="name_cost" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit"><input type="text" class="unit" name="unit[]" /></td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"></td>
                                            <td class="bid"></td>
                                            <td class="selite"></td>
                                        </tr>
                                        <tr id="row_cost_close_4">
                                            <td class="name"><input type="text" name="name_cost[]" class="name_cost" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit"><input type="text" class="unit" name="unit[]" /></td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"></td>
                                            <td class="bid"></td>
                                            <td class="selite"></td>
                                        </tr>
                                        <tr id="row_cost_close_5">
                                            <td class="name"><input type="text" name="name_cost[]" class="name_cost" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit"><input type="text" class="unit" name="unit[]" /></td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"></td>
                                            <td class="bid"></td>
                                            <td class="selite"></td>
                                        </tr>
                                        <tr id="row_cost_close_6">
                                            <td class="name"><input type="text" name="name_cost[]" class="name_cost" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit"><input type="text" class="unit" name="unit[]" /></td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"></td>
                                            <td class="bid"></td>
                                            <td class="selite"></td>
                                        </tr>
                                        <tr id="row_cost_close_7">
                                            <td class="name"><input type="text" name="name_cost[]" class="name_cost" /></td>
                                            <td class="name_kind"><?php get_kind_dropdown(); ?></td>
                                            <td class="quantity"><input type="text" class='quantity' name="quantity[]"/></td>
                                            <td class="unit"><input type="text" class="unit" name="unit[]" /></td>
                                            <td class="price_per_unit"><input type="text" class="price_per_unit" name="price_per_unit[]" /></td>
                                            <td class="total"></td>
                                            <td class="cover"></td>
                                            <td class="bid"></td>
                                            <td class="selite"></td>
                                        </tr>
                                    </tbody>
                                    
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
<!-- container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
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
                  $('#email').val(offer['email']);
                  $('#phone_number').val(offer['phone_number']);
                  $('#site').val(offer['site']);
                  $('#order_number').val(offer['order_number']);
                  $('#contact_person').val(offer['contact_person']);
                  $('#user_id').val(offer['seller']);
                  $('#day').val(offer['day']);
                  $('#probability').val(offer['probability']);
                  $('#assembling_group').val(offer['assembling_group']);
                  $('#house').val(offer['house_id']);
                  var parent_id = $('#house').val();
                  var url_close_cost = "<?php echo base_url() ?>offers/get_close_cost?offer_id=" + offer['id'];
                  var main_body = $('.table_close_cost').find('tbody').html("");
                  $('.table_close_cost').find('tbody').empty();
                  $.ajax({
                    type: "GET",
                    url: url_close_cost, 
                    dataType: "text",  
                    cache:true,
                    success: 
                        function(data){
                            var data_cost = jQuery.parseJSON(data); 
                            var count = 0;                     
                            $.each(data_cost, function (key,value) {
                                count += 1;
                                var row_cost_id = "#row_cost_close_"+count;
                                var row_cost = "<tr id='row_cost_close_"+count+"'><td class='name'><input type='text' name='name_cost[]' class='name_cost' value='"+value['name']+"' /></td><td class='name_kind'><?php get_kind_dropdown(); ?></td><td class='quantity'><input type='text' value='"+value['quantity']+"' class='quantity' name='quantity[]'/></td><td class='unit'><input type='text' value='"+value['unit']+"' class='unit' name='unit[]' /></td><td class='price_per_unit'><input type='text' value='"+value['price_per_unit']+"' class='price_per_unit' name='price_per_unit[]' /></td><td class='total'></td><td class='cover'></td><td class='bid'></td><td class='selite'></td></tr>";         
                                main_body.append(row_cost);
                                main_body.find(row_cost_id).find('.kind_cost').val(value['kind_id']);
                            });
                        }
                  });
                  
                  var url = "<?php echo base_url() ?>offers/get_room_of_house?house_id="+parent_id;
                  $('#room').empty();
                  $.ajax({
                    type: "GET",
                    url: url, 
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
                  $('#cost_center').val(offer['cost_center']);
                  $('#foreman').val(offer['foreman']);
                  $('#date_starting').val(offer['starting_date']);
                  var url = "<?php echo base_url(); ?>offers/get_rental_scaffold_by_offer_id?offer_id=" + id+"&day="+offer['day']+"&start_date="+offer['starting_date']+"&type=1";
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
                                            var total_row = "<tr><td colspan='3'>YHTEENSÄ</td><td class='rental_scaffold_total_1'></td><td class='total_cover'></td><td class='rental_scaffold_total_2'></td><td></td><td></td><td class='rental_scaffold_total_3'></td><td class='rental_scaffold_total_4'></td><td class='rental_scaffold_total_5'></td><td colspan='6'></td></tr>";
                                            var count = a + 1;
                                            var row_id = "#rentalscaffoldrow_"+count;
                                            var row = "<tr id='rentalscaffoldrow_"+count+"'><td>"+count+"</td><td><?php  get_rental_scaffold_type_dropdown(); ?></td><td class='price_m2_data'>"+value['price_generate']+"</td><td class='total1'>"+value['total1']+"</td><td><input type='text' name='rental_scaffold_cover[]' onclick='change_cover();' class='rental_scaffold_cover' value='"+value['cover']+"' /></td><td><input type='text' onclick='change_m2();' name='rental_scaffold_m2[]' value='"+value['m2']+"' class='rental_scaffold_m2' /></td><td class='price_m2'>"+value['price_m2']+"</td><td class='day'>"+offer['day']+"</td><td class='total2'>"+value['total2']+"</td><td class='price_day'>"+value['per_day']+"</td><td class='price_month'>"+value['per_month']+"</td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            $('.table_rental_scaffolds').find('table').find('tbody:first').append(row);
                                            $(".table_rental_scaffolds").find(row_id).find('.rental_scaffold_type').val(value["type_scaffold_id"]);
                                            if(afoot == 0){
                                                $('.table_rental_scaffolds').find('table').find('tfoot').append(total_row);
                                            }
                                       });
                                       
                                       $('.rental_scaffold_total_1').html(rental_scaffold1.toFixed(2));
                                       $('.rental_scaffold_total_2').html(rental_scaffold2.toFixed(2));
                                       $('.rental_scaffold_total_3').html(rental_scaffold3.toFixed(2));
                                       $('.rental_scaffold_total_4').html(rental_scaffold4.toFixed(2));
                                       $('.rental_scaffold_total_5').html(rental_scaffold5.toFixed(2));
                                      
                                  }
                        
                        });
                        var url1 = "<?php echo base_url(); ?>offers/get_rental_tent_by_offer_id?offer_id=" + id+"&day="+offer['day']+"&start_date="+offer['starting_date']+"&type=2";
                        $.ajax({
                             type: "GET",
                             url: url1, 
                             dataType: "text",  
                             cache:false,
                             success: 
                                  function(data){
                                      $('.table_rental_tents').find('table').find('tbody').empty();
                                      var data_rental_scaffold = jQuery.parseJSON(data);
                                      var rental_tent1 = 0;
                                      var rental_tent2 = 0;
                                      var rental_tent3 = 0;
                                      var rental_tent4 = 0;
                                      var rental_tent5 = 0;
                                      $.each(data_rental_scaffold, function (key,value) {
                                            rental_tent1 += parseFloat(value['total1']);//total 1
                                            rental_tent2 += parseFloat(value['m2']);//m2
                                            rental_tent3 += parseFloat(value['total2']);//total 2
                                            rental_tent4 += parseFloat(value['per_day']);//price per day
                                            rental_tent5 += parseFloat(value['per_month']);//price per month
                                            var total_row = "<tr><td colspan='3'>YHTEENSÄ</td><td class='rental_tent_total_1'></td><td class='total_cover'></td><td class='rental_tent_total_2'></td><td></td><td></td><td class='rental_tent_total_3'></td><td class='rental_tent_total_4'></td><td class='rental_tent_total_5'></td><td colspan='6'></td></tr>";
                                            var a = $('.table_rental_tents').find('tbody tr').length;
                                            var afoot = $('.table_rental_tents').find('tfoot tr').length;
                                            var count = a + 1;
                                            var row_total_scaffold = "<tr><td colspan='3'>VUOKRAT YHTEENSÄ</td><td class='total_all_scaffold1'></td><td></td><td class='total_all_scaffold_m2'></td><td colspan='2'></td><td class='total_all_scaffold2'></td><td class='total_all_per_day'></td><td class='total_all_per_month'></td><td colspan='3'></td></tr>"
                                            var row_id = "#rentaltentrow_"+count;
                                            var row = "<tr id='rentaltentrow_"+count+"'><td>"+count+"</td><td><?php  get_work_scaffold_type_dropdown(); ?></td><td class='price_m2_data'>"+value['price_generate']+"</td><td class='total1'>"+value['total1']+"</td><td><input type='text' name='rental_tent_cover[]' onclick='change_cover();' class=' rental_scaffold_cover' value='"+value['cover']+"' /></td><td><input type='text' onclick='change_m2();' name='rental_tent_m2[]' value='"+value['m2']+"' class=' rental_scaffold_m2' /></td><td class='price_m2'>"+value['price_m2']+"</td><td class='day'>"+offer['day']+"</td><td class='total2'>"+value['total2']+"</td><td class='price_day'>"+value['per_day']+"</td><td class='price_month'>"+value['per_month']+"</td><td></td><td></td><td></td></tr>";
                                            $('.table_rental_tents').find('table').find('tbody:first').append(row);
                                            $(".table_rental_tents").find(row_id).find('.rental_tent_type').val(value["type_scaffold_id"]);
                                            if(afoot == 0){
                                                $('.table_rental_tents').find('table').find('tfoot').append(total_row);
                                                $('.table_rental_tents').find('table').find('tfoot').append(row_total_scaffold);
                                            }
                                       });
                                       
                                       $('.rental_tent_total_1').html(rental_tent1.toFixed(2));
                                       $('.rental_tent_total_2').html(rental_tent2.toFixed(2));
                                       $('.rental_tent_total_3').html(rental_tent3.toFixed(2));
                                       $('.rental_tent_total_4').html(rental_tent4.toFixed(2));
                                       $('.rental_tent_total_5').html(rental_tent5.toFixed(2));
                                  }
                        
                        });
                        var url3 = "<?php echo base_url(); ?>offers/get_work_scaffold_by_offer_id?offer_id=" + id+"&type=1";
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
                                        var total_row = "<tr><td colspan='2'>YHTEENSÄ</td><td class='work_scaffold_total_1'></td><td class='total_cover'></td><td class='work_scaffold_total_2'></td><td></td><td></td><td class='work_scaffold_total_3'></td><td class='work_scaffold_total_4'></td><td></td><td class='work_scaffold_total_5'></td><td class='work_scaffold_total_6'></td><td></td><td class='work_scaffold_total_7'></td><td class='work_scaffold_total_8'></td><td></td><td class='work_scaffold_total_9'></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            var a = $('.work_scaffold_talbe').find('tbody tr').length;
                                            var afoot = $('.work_scaffold_talbe').find('tfoot tr').length;
                                            var count = a + 1;
                                            var row_work = "<tr id='workscaffoldrow_"+count+"'><td>"+count+"</td><td class='scaffold_type'></td><td class='work_m2'>"+value['m2']+"</td><td><input type='text' onclick='change_work_m2();' name='work_scaffold_m2[]' class=' work_scaffold_m2' value='"+value['price_m2']+"' /></td><td class='price_work_total1'>"+value['total1']+"<td><input type='text' name='work_scaffold_cover[]' onclick='change_cover_work();' value='"+value['cover']+"' class=' work_scaffold_cover' /></td><td class='price_work_m2'>"+value['price_m2_cal']+"</td><td class='price_work_total2'>"+value['total2']+"</td><td><input type='text' name='kust_transport[]' value='"+value['transport_cost']+"' onclick='change_kust_transport()' class=' transport_kust'/></td><td><input type='text' value='"+value['transport_profit']+"' name='cover_transport[]' onclick='change_cover_transport()' class=' transport_cover'/></td><td class=' transport_offer'>"+value['transport_offer']+"</td><td><input type='text' onclick='change_kust_kraana()' value='"+value['kraana_cost']+"' name='kust_kraana[]' class=' kraana_kust'/></td><td><input type='text' onclick='change_cover_kraana()' value='"+value['kraana_profit']+"' name='cover_kraana[]' class=' kraana_cover'/></td><td class='kraana_offer'>"+value['kraana_offer']+"</td><td><input type='text' name='kust_material[]' onclick='change_kust_material()' value='"+value['material_cost']+"' class='material_kust'/></td><td><input type='text' name='cover_material[]' value='"+value['material_profit']+"' onclick='change_cover_material()' class='material_cover'/></td><td class='material_offer'>"+value['material_offer']+"</td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            $('.work_scaffold_talbe').find('table').find('tbody').append(row_work);
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
                                  }
                        });
                        var url4 = "<?php echo base_url(); ?>offers/get_work_tent_by_offer_id?offer_id=" + id+"&type=2"
                        $.ajax({
                             type: "GET",
                             url: url4, 
                             dataType: "text",  
                             cache:false,
                             success: 
                                  function(data){
                                      $('.work_tent_table').find('table').find('tbody').empty();
                                      var sum1 = 0;
                                      var sum2 = 0;
                                      var sum3 = 0;
                                      var sum4 = 0;
                                      var sum5 = 0;
                                      var sum6 = 0;
                                      var sum7 = 0;
                                      var sum8 = 0;
                                      var sum9 = 0;
                                      var data_rental_scaffold = jQuery.parseJSON(data);
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
                                            var total_row = "<tr><td colspan='2'>YHTEENSÄ</td><td class='work_tent_total_1'></td><td class='total_cover'></td><td class='work_tent_total_2'></td><td></td><td></td><td class='work_tent_total_3'></td><td class='work_tent_total_4'></td><td></td><td class='work_tent_total_5'></td><td class='work_tent_total_6'></td><td></td><td class='work_tent_total_7'></td><td class='work_tent_total_8'></td><td></td><td class='work_tent_total_9'></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            var a = $('.work_tent_table').find('tbody tr').length;
                                            var afoot = $('.work_tent_table').find('tfoot tr').length;
                                            var count = a + 1;
                                            var row_total_work = "<tr id='row_total_work'><td colspan='2'>TYÖT YHTEENSÄ</td><td></td><td></td> <td class='total_all_work1'></td><td></td><td class='total_all_work_price_m2'></td><td class='total_all_work2'></td><td class='total_all_work_transport_cost'></td><td></td><td class='total_all_work_transport_offer'></td><td class='total_all_work_kraana_cost'></td><td></td><td class='total_all_work_kraana_offer'></td><td class='total_all_work_material_cost'></td><td></td><td class='total_all_work_material_offer'></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            
                                            var row_work = "<tr id='worktentrow_"+count+"'><td>"+count+"</td><td class='scaffold_type'></td><td class='work_m2'>"+value['m2']+"</td><td><input type='text' onclick='change_work_m2();' name='work_tent_m2[]' class=' work_scaffold_m2' value='"+value['price_m2']+"' /></td><td class='price_work_total1'>"+value['total1']+"<td><input type='text' name='work_tent_cover[]' onclick='change_cover_work();' value='"+value['cover']+"' class=' work_scaffold_cover' /></td><td class='price_work_m2'>"+value['price_m2_cal']+"</td><td class='price_work_total2'>"+value['total2']+"</td><td><input type='text' name='kust_transport_tent[]' value='"+value['transport_cost']+"' onclick='change_kust_transport()' class=' transport_kust'/></td><td><input type='text' value='"+value['transport_profit']+"' name='cover_transport_tent[]' onclick='change_cover_transport()' class=' transport_cover'/></td><td class=' transport_offer'>"+value['transport_offer']+"</td><td><input type='text' onclick='change_kust_kraana()' value='"+value['kraana_cost']+"' name='kust_kraana_tent[]' class=' kraana_kust'/></td><td><input type='text' onclick='change_cover_kraana()' value='"+value['kraana_profit']+"' name='cover_kraana_tent[]' class=' kraana_cover'/></td><td class='kraana_offer'>"+value['kraana_offer']+"</td><td><input type='text' name='kust_material_tent[]' onclick='change_kust_material()' value='"+value['material_cost']+"' class='material_kust'/></td><td><input type='text' name='cover_material_tent[]' value='"+value['material_profit']+"' onclick='change_cover_material()' class='material_cover'/></td><td class='material_offer'>"+value['material_offer']+"</td><td></td><td></td><td></td><td></td><td></td></tr>";
                                            $('.work_tent_table').find('table').find('tbody').append(row_work);
                                            if(afoot == 0){
                                                $('.work_tent_table').find('table').find('tfoot').append(total_row);
                                                $('.work_tent_table').find('table').find('tfoot').append(row_total_work);
                                            }
                                       });
                                       $('.work_tent_total_1').html(sum1.toFixed(2));
                                       $('.work_tent_total_2').html(sum2.toFixed(2));
                                       $('.work_tent_total_3').html(sum3.toFixed(2));
                                       $('.work_tent_total_4').html(sum4.toFixed(2));
                                       $('.work_tent_total_5').html(sum5.toFixed(2));
                                       $('.work_tent_total_6').html(sum6.toFixed(2));
                                       $('.work_tent_total_7').html(sum7.toFixed(2));
                                       $('.work_tent_total_8').html(sum8.toFixed(2));
                                       $('.work_tent_total_9').html(sum9.toFixed(2));
                                       // total of scaffold
                                        var total1 = parseFloat($('.rental_scaffold_total_1').html());
                                        var total2 = parseFloat($('.rental_tent_total_1').html());
                                        $('.total_all_scaffold1').html((total1+total2).toFixed(2));
                                        var total3 = parseFloat($('.rental_scaffold_total_2').html());
                                        var total4 = parseFloat($('.rental_tent_total_2').html());
                                        $('.total_all_scaffold_m2').html((total3+total4).toFixed(2));
                                        
                                        var total5 = parseFloat($('.rental_scaffold_total_3').html());
                                        var total6 = parseFloat($('.rental_tent_total_3').html());
                                        $('.total_all_scaffold2').html((total5+total6).toFixed(2));
                                        
                                        var total7 = parseFloat($('.rental_scaffold_total_4').html());
                                        var total8 = parseFloat($('.rental_tent_total_4').html());
                                        $('.total_all_per_day').html((total7+total8).toFixed(2));
                                        
                                        var total9 = parseFloat($('.rental_scaffold_total_5').html());
                                        var total10 = parseFloat($('.rental_tent_total_5').html());
                                        $('.total_all_per_month').html((total9+total10).toFixed(2));
                                    // end total scaffold
                                    
                                    // total of work
                                        
                                        
                                        var work_total3 = parseFloat($('.work_scaffold_total_2').html());
                                        var work_total4 = parseFloat($('.work_tent_total_2').html());
                                        $('.total_all_work1').html((work_total3+work_total4).toFixed(2));
                                        
                                        var work_total5 = parseFloat($('.work_scaffold_total_3').html());
                                        var work_total6 = parseFloat($('.work_tent_total_3').html());
                                        $('.total_all_work2').html((work_total5+work_total6).toFixed(2));
                                        
                                        var work_total7 = parseFloat($('.work_scaffold_total_4').html());
                                        var work_total8 = parseFloat($('.work_tent_total_4').html());
                                        $('.total_all_work_transport_cost').html((work_total7+work_total8).toFixed(2));
                                        
                                        var work_total9 = parseFloat($('.work_scaffold_total_5').html());
                                        var work_total10 = parseFloat($('.work_tent_total_5').html());
                                        $('.total_all_work_transport_offer').html((work_total9+work_total10).toFixed(2));
                                        
                                        var work_total11 = parseFloat($('.work_scaffold_total_6').html());
                                        var work_total12 = parseFloat($('.work_tent_total_6').html());
                                        $('.total_all_work_kraana_cost').html((work_total11+work_total12).toFixed(2));
                                        
                                        var work_total13 = parseFloat($('.work_scaffold_total_7').html());
                                        var work_total14 = parseFloat($('.work_tent_total_7').html());
                                        $('.total_all_work_kraana_offer').html((work_total13+work_total14).toFixed(2));
                                        
                                        var work_total15 = parseFloat($('.work_scaffold_total_8').html());
                                        var work_total16 = parseFloat($('.work_tent_total_8').html());
                                        $('.total_all_work_material_cost').html((work_total15+work_total16).toFixed(2));            
                                        var work_total17 = parseFloat($('.work_scaffold_total_9').html());
                                        var work_total18 = parseFloat($('.work_tent_total_9').html());
                                        $('.total_all_work_material_offer').html((work_total17+work_total18).toFixed(2));            
                                    // end total work
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
    var a = $(this).closest('div').find('table tr').length;
    var row = "<tr id='rentalscaffoldrow_"+count+"'><td>"+count+"</td><td><?php  get_rental_scaffold_type_dropdown(); ?></td><td class='price_m2_data'></td><td class='total1'></td><td><input type='text' name='rental_scaffold_cover[]' onclick='change_cover();' class='rental_scaffold_cover' /></td><td><input type='text' onclick='change_m2();' name='rental_scaffold_m2[]' class='rental_scaffold_m2' /></td><td class='price_m2'></td><td class='day'></td><td class='total2'></td><td class='price_day'></td><td class='price_month'></td><td></td><td></td><td></td><td></td><td></td></tr>";
    
    var row_work = "<tr id='workscaffoldrow_"+count+"'><td>"+count+"</td><td class='scaffold_type'></td><td class='work_m2'></td><td><input type='text' onclick='change_work_m2();' name='work_scaffold_m2[]' class='work_scaffold_m2' /></td><td class='price_work_total1'><td><input type='text' name='work_scaffold_cover[]' onclick='change_cover_work();' class='work_scaffold_cover' /></td><td class='price_work_m2'></td><td class='price_work_total2'></td><td><input type='text' name='kust_transport[]' onclick='change_kust_transport()' class='transport_kust'/></td><td><input type='text' name='cover_transport[]' onclick='change_cover_transport()' class='transport_cover'/></td><td class='transport_offer'></td><td><input type='text' onclick='change_kust_kraana()' name='kust_kraana[]' class='kraana_kust'/></td><td><input type='text' onclick='change_cover_kraana()' name='cover_kraana[]' class='kraana_cover'/></td><td class='kraana_offer'></td><td><input type='text' name='kust_material[]' onclick='change_kust_material()' class='material_kust'/></td><td><input type='text' name='cover_material[]' onclick='change_cover_material()' class='material_cover'/></td><td class='material_offer'></td><td></td><td></td><td></td><td></td><td></td></tr>";
    
    $(this).closest('div').find('table').find('tbody:first').append(row); 
    $(".work_scaffold_talbe").find('table').find('tbody:first').append(row_work); 
});

$('#add_rental_tents').click(function(){
    var a = $(this).closest('div').find('table tr').length;
    var count = a - 2;
    var a = $(this).closest('div').find('table tr').length;
    var row = "<tr id='rentaltentrow_"+count+"'><td>"+count+"</td><td><?php  get_work_scaffold_type_dropdown(); ?></td><td class='price_m2_data'></td><td class='total1'></td><td><input type='text' name='rental_tent_cover[]' onclick='change_cover();' class='rental_scaffold_cover' /></td><td><input type='text' onclick='change_m2();' name='rental_tent_m2[]' class='rental_scaffold_m2' /></td><td class='price_m2'></td><td class='day'></td><td class='total2'></td><td class='price_day'></td><td class='price_month'></td><td></td><td></td><td></td></tr>";
    
    var row_work = "<tr id='worktentrow_"+count+"'><td>"+count+"</td><td class='scaffold_type'></td><td class='work_m2'></td><td><input type='text' onclick='change_work_m2();' name='work_tent_m2[]' class='work_scaffold_m2' /></td><td class='price_work_total1'><td><input type='text' name='work_tent_cover[]' onclick='change_cover_work();' class='work_scaffold_cover' /></td><td class='price_work_m2'></td><td class='price_work_total2'></td><td><input type='text' onclick='change_kust_transport()' name='transport_kust_tent' class='transport_kust'/></td><td><input type='text' onclick='change_cover_transport()' name='transport_cover_tent' class='transport_cover'/></td><td class='transport_offer'></td><td><input type='text' name='kraana_kust_tent' onclick='change_kust_kraana()' class='kraana_kust'/></td><td><input type='text' name='kraana_cover_tent' onclick='change_cover_kraana()' class='kraana_cover'/></td><td class='kraana_offer'></td><td><input type='text' name='material_kust_tent' onclick='change_kust_material()' class='material_kust'/></td><td><input type='text' name='material_cover_tent' onclick='change_cover_material()' class='material_cover'/></td><td class='material_offer'></td><td></td><td></td><td></td><td></td><td></td></tr>";
  
    $(this).closest('div').find('table').find('tbody:first').append(row); 
    
    $(".work_tent_table").find('table').find('tbody:first').append(row_work); 
});


function change_rental_scaffold_type(){
    $('.rental_scaffold_type').change(function(){
        var main_row = $(this).closest('tr');
        var start_date = $('#date_starting').val();
        var type = $(this).closest('tr').find('.rental_scaffold_type').val();
        
        var trid = $(this).closest('tr').attr('id');
        var index_rows = trid.split('_');
        var index_row = index_rows[1];
        var type_name = main_row.find('.rental_scaffold_type option:selected').text();
        
        row_id = '#workscaffoldrow_'+index_row;
        $(".work_scaffold_talbe").find("table").find(row_id).find(".scaffold_type").html(type_name);
        
        var url = "<?php echo base_url(); ?>offers/get_price_for_rental_scaffold?type=" + type + "&date=" + start_date;
        var row = $(this).closest('tr').find('td.price_m2_data');
        var date = $(this).closest('tr').find('td.day');
        
        $.ajax({
             type: "GET",
             url: url, 
             dataType: "text",  
             cache:true,
             success: 
                  function(data){
                      var client = jQuery.parseJSON(data);
                      if(parseInt(day)/30 > 3){
                            row.html(client['price_m2_over_3_month']);
                      }else{
                            row.html(client['price_m2_fewer_3_month']);
                      }
                      
                      var day = $('#day').val();
                      date.html(day);
                      var col_select_cover = parseFloat(main_row.find('.rental_scaffold_cover').val());
                        var col_select_total1 = main_row.find('.total1');
                        var col_price_m2_data = parseFloat(main_row.find('td.price_m2_data').html());
                        var col_select_m2 = parseFloat(main_row.find('.rental_scaffold_m2').val());
                        var day = parseFloat($('#day').val());
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
function change_rental_tent_type(){
    $('.rental_tent_type').change(function(){
        var start_date = $('#date_starting').val();
        var type = $(this).closest('tr').find('.rental_tent_type').val();
        var main_row = $(this).closest('tr');
        var url = "<?php echo base_url(); ?>offers/get_price_for_rental_scaffold?type=" + type + "&date=" + start_date;
        var row = $(this).closest('tr').find('td.price_m2_data');
        var date = $(this).closest('tr').find('td.day');
        
        var trid = $(this).closest('tr').attr('id');
        var index_rows = trid.split('_');
        var index_row = index_rows[1];
        var type_name = main_row.find('.rental_tent_type option:selected').text();
        
        row_id = '#worktentrow_'+index_row;
        $(".work_tent_table").find("table").find(row_id).find('.scaffold_type').html(type_name);
        
        var main_row = $(this).closest('tr');
        $.ajax({
             type: "GET",
             url: url, 
             dataType: "text",  
             cache:true,
             success: 
                  function(data){
                      var client = jQuery.parseJSON(data);
                      if(parseInt(day)/30 > 3){
                            row.html(client['price_m2_over_3_month']);
                      }else{
                            row.html(client['price_m2_fewer_3_month']);
                      }
                      var day = $('#day').val();
                      date.html(day);
                      var col_select_cover = parseFloat(main_row.find('.rental_scaffold_cover').val());
                        var col_select_total1 = main_row.find('.total1');
                        var col_price_m2_data = parseFloat(main_row.find('td.price_m2_data').html());
                        var col_select_m2 = parseFloat(main_row.find('.rental_scaffold_m2').val());
                        var day = parseFloat($('#day').val());
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
        var day = parseFloat($('#day').val());
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

function change_m2(){
    $('.rental_scaffold_m2').change(function(){
        var col_select_cover = parseFloat($(this).closest('tr').find('.rental_scaffold_cover').val());
        var col_select_total1 = $(this).closest('tr').find('.total1');
        var col_price_m2_data = parseFloat($(this).closest('tr').find('.price_m2_data').html());
        var col_select_m2 = parseFloat($(this).closest('tr').find('.rental_scaffold_m2').val());
        var day = parseFloat($('#day').val());
    
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
        
        var trid = $(this).closest('tr').attr('id');
        var index_rows = trid.split('_');
        var index_row = index_rows[1];
        row_id = '#workscaffoldrow_'+index_row;
        var row = $('.work_scaffold_talbe').find(row_id).find('.work_m2');
        
        row.html(col_select_m2);
        
        row_id2 = '#worktentrow_'+index_row;
        var row2 = $('.work_tent_table').find(row_id2).find('.work_m2');
        
        row2.html(col_select_m2);
        
    });
}
function change_work_m2(){
    $('.work_scaffold_m2').change(function(){
        //work scaffolds table
        var row_work_scaffold = $(this).closest('tr');
        var rental_scaffold_cover = parseFloat(row_work_scaffold.find('.work_scaffold_cover').val());
        var m2 = parseFloat(row_work_scaffold.find('.work_m2').html());
        
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
        var m2 = parseFloat(row_work_scaffold.find('.work_m2').html());
        var work_scaffold_m2 = parseFloat(row_work_scaffold.find('.work_scaffold_m2').val());
     
        row_work_scaffold.find('.price_work_total1').html((m2*work_scaffold_m2).toFixed(3));
        row_work_scaffold.find('.price_work_m2').html((work_scaffold_m2/((100-rental_scaffold_cover)/100).toFixed(1)));
        row_work_scaffold.find('.price_work_total2').html((m2*work_scaffold_m2/((100-rental_scaffold_cover)/100).toFixed(1)));
        //end
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
                $('#room').empty();
                var data_room = jQuery.parseJSON(data);                        
                $.each(data_room, function (key,value) {
                    $('#room').append("<option value="+value['id']+">"+value['name']+"</option>");
                });
            }
    });
});

$(document).ready(function(){   
    
});
</script>
   