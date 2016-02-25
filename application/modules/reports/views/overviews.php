<div class="container">
    
    <div class="row">
        <ul class="nav nav-tabs" style="font-size:16px">
          <li id="follow-up-btn" onclick="changeTab('follow-up',event)" role="presentation" class="active"><a href="#">Follow up reports</a></li>
          <li id="scaffold-btn" onclick="changeTab('scaffold',event)" role="presentation"><a href="#">Scaffold report</a></li>
          <li id="saved-btn" onclick="changeTab('saved',event)" role="presentation"><a href="#">Saved reports</a></li>
        </ul>
        <div id="follow-up-search" style="padding:20px;border-left-style: solid; border-width: 1px;border-color: #DDDDDD;">
            
            <form class="form-inline col-xs-3" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select id="client-id-select" class="form-control" style="width:80%">
                            <option value="null">Client</option>

                            <?php  if(isset($all_client)):  ?>
                                <?php foreach($all_client as $client ): ?>
                                    <option value="<?php echo $client->id; ?>">
                                        <?php echo $client->client_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </select>
                </div>
            </form>


            <form class="form-inline col-xs-9">
                <div class="form-group" style="width:100%">
                    
                        <label class="control-label">From:</label>

                        <input class="form-control" type="text" style="width:20%;display:inline"> 
                         
                        <label class="control-label">To:</label>

                        <input class="form-control" type="text" style="width:20%;display:inline">

                </div>
            </form>
            <form class="form-inline col-xs-3" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select class="form-control" style="width:80%">
                            <option>Project Number</option>

                            <?php  if(isset($all_project)):  ?>
                                <?php foreach($all_project as $project ): ?>
                                    <option>
                                        <?php echo $project->project_number; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </select>
                </div>
            </form>
            <form class="form-inline col-xs-9">
                <div class="form-group" style="width:100%">
                    
                    <select class="form-control" style="width:50%">

                        <option>or choose a period</option>
                        <option>Yesterday</option>
                        <option>Last week</option>
                        <option>Current week</option>
                        <option>Last month</option>
                        <option>Current month</option>
                        <option>Current year</option>
                    </select>

                </div>
            </form>
            
            <div class="col-xs-12">
            <button type="submit" onclick="get_scaffold()" class="btn btn-success">Search</button>
            <button type="submit" onclick="get_scaffold()" class="btn btn-success">Save report</button>
            <button type="submit" onclick="get_scaffold()" class="btn btn-success">Save as follow up</button>
            </div>
        </div>


        <div id="scaffold-search"  style="display:none;padding:20px;border-left-style: solid; border-width: 1px;border-color: #DDDDDD;">
            
            <form class="form-inline col-xs-4" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select id="client-id-select-2" class="form-control" style="width:80%">
                            <option value="null">Client</option>

                            <?php  if(isset($all_client)):  ?>
                                <?php foreach($all_client as $client ): ?>
                                    <option value="<?php echo $client->id; ?>">
                                        <?php echo $client->client_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </select>
                </div>
            </form>

            <form class="form-inline col-xs-4" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select id="client-id-select" class="form-control" style="width:80%">
                            <option value="null">Scarfold Number</option>

                            <?php  if(isset($all_scaffold_id)):  ?>
                                <?php foreach($all_scaffold_id as $scaffold_id ): ?>
                                    <option value="<?php echo $scaffold_id->id; ?>">
                                        <?php echo $scaffold_id->id; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </select>
                </div>
            </form>
            <form class="form-inline col-xs-4" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select id="client-id-select" class="form-control" style="width:80%">
                            <option value="null">Scarfold Type</option>

                            <?php  if(isset($all_scaffold_type)):  ?>
                                <?php foreach($all_scaffold_type as $scaffold_type ): ?>
                                    <option value="<?php echo $scaffold_type->name; ?>">
                                        <?php echo $scaffold_type->name; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </select>
                </div>
            </form>

            <form class="form-inline col-xs-4" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select id="client-id-select" class="form-control" style="width:80%">
                            <option value="null">Scarfold status</option>
                            <option value="null">Up and running</option>
                            <option value="null">Stopped</option>
                            
                        </select>
                </div>
            </form>

            <form class="form-inline col-xs-4" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select id="client-id-select" class="form-control" style="width:80%">
                            <option value="null">House</option>

                            <?php  if(isset($all_house)):  ?>
                                <?php foreach($all_house as $house ): ?>
                                    <option value="<?php echo $house->house; ?>">
                                        <?php echo $house->house; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </select>
                </div>
            </form>

            <form class="form-inline col-xs-4" >
                <div class="form-group" style="width:100%">
                    
                    <!-- <label class="control-label">Client:</label> -->
                        <select id="client-id-select" class="form-control" style="width:80%">
                            <option value="null">Room</option>

                            <?php  if(isset($all_room)):  ?>
                                <?php foreach($all_room as $room ): ?>
                                    <option value="<?php echo $room->room; ?>">
                                        <?php echo $room->room; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </select>
                </div>
            </form>

            <div class="col-xs-12">
            <button type="submit" onclick="get_scaffold_report()" class="btn btn-success">Search</button>
            <button type="submit" onclick="get_scaffold_report()" class="btn btn-success">Save report</button>
            </div>
        </div>

        <div id="saved-search" style="display:none"></div>


        <div id="follow-up-result" class="col-xs-12" >
            <div class="panel panel-sky" style="margin-top:20px">
                <div class="panel-heading">
                    <h4>Results</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered " >
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Scaffold type</th>
                                <th>House</th>
                                <th>Room</th>
                                <th>Size</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody id="scaffold-list">
                                
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Works Queue -->
            
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Summary</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                  <div class="col-xs-2">Transport Cost:</div>
                  <div class="col-xs-10" id="transportCost"></div>
                </div>
            </div>
            
            <!-- End Works Queue -->
            
        </div>

        <div id="scaffold-result" style="display:none" class="col-xs-12">
            <div class="panel panel-sky" style="margin-top:20px">
                <div class="panel-heading">
                    <h4>Results</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered " id="example">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Scaffold type</th>
                                <th>Client</th>
                                <th>Project</th>
                                <th>Size</th>
                                <th>House</th>
                                <th>Room</th>
                                <th>Start date</th>
                                <th>End date</th>
                            </tr>
                        </thead>
                        <tbody id="scaffold-list-2">
                             
                            <!-- <tr>
                                <td></td>
                            </tr> -->
                                
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Works Queue -->
            
            
            
        </div>

        <div id="saved-result" style="display:none"></div>
        
    </div> 
</div> 
<!-- container -->

<script>

    function showDetail(id){
      $('#detail-'+id).show();
    }
    function showDetail2(id){
      $('#detail-2-'+id).show();
    }
    

    function get_scaffold(){
        var text = $('#client-id-select').val();
        // text = encodeURIComponent(text);
        // var text = '1'
        console.log('text');
        console.log(text);
        var url = "<?php echo base_url(); ?>reports/search_report?client_id="+text;
        $.ajax({
          type: "GET",
          url: url, 
          dataType: "text",  
          cache:false,
          success: 

            function(data){
              console.log('success');
              var data = jQuery.parseJSON(data);
              console.log('data');
              console.log(data);
              var offers = data.offers;
              var works = data.works;
              var all_scaffold_type = data.all_scaffold_type;
              var html = "";
              var transportCost = 0;
              offers.forEach(function(offer) {
                if(offer.scaffold_transport_cost){
                  transportCost = transportCost + Number(offer.scaffold_transport_cost);
                }
                if(offer.tent_transport_cost){
                  transportCost = transportCost + Number(offer.tent_transport_cost);
                }
                html = html + "<tr><td onclick='showDetail("+offer.id+")'>" +
                  + offer.id + "</td><td>"
                  + all_scaffold_type[(Number(offer.type_scaffold_id) || 1)-1].name + "</td><td>"
                  + offer.house + "</td><td>"
                  + offer.room + "</td><td>"
                  + offer.size + "</td><td>"
                  + offer.start_date + "</td><td>"
                  + offer.end_date + "</td><td>"
                  + "offer.price" + "</td></tr>"
                  + "<tr id='detail-"+offer.id+"' style='display:none'><td></td><td colspan='7'>"
                  
                  + "Work:<br>"
                  + "<table cellpadding='0' cellspacing='0' border='0' class='table table-bordered'>"
                  + "<thead>"
                  +          "<tr>"
                  +             "<th>Date</th>"
                  +             "<th>Work number</th>"
                  +             "<th>Worker</th>"
                  +             "<th>Type of work</th>"
                  +             "<th>Hours</th>"
                  +         "</tr>"
                  + "</thead>"
                  + "<tbody id='detail-work"+offer.id+"'>"
                  + "</tbody>"
                  + "</table>"                  

                  + "Materials:<br>"
                  + "<table cellpadding='0' cellspacing='0' border='0' class='table table-bordered'>"
                  + "<thead>"
                  +          "<tr>"
                  +             "<th>Date</th>"
                  +             "<th>Work number</th>"
                  +             "<th>Type of material</th>"
                  +             "<th>Amount</th>"
                  +         "</tr>"
                  + "</thead>"
                  + "<tbody >"
                  + "<tr>"
                  +   "<td>"+ offer.scaffold_date +"</td>"
                  +   "<td>"+ offer.scaffold_work_id +"</td>"
                  +   "<td>"+ "Scaffold material" +"</td>"
                  +   "<td>"+ offer.scaffold_work_amount +"</td>"
                  + "</tr>"  
                  + "<tr>"
                  +   "<td>"+ offer.tent_date +"</td>"
                  +   "<td>"+ offer.tent_work_id +"</td>"
                  +   "<td>"+ "Tent material" +"</td>"
                  +   "<td>"+ offer.tent_work_amount +"</td>"
                  + "</tr>"    
                  + "</tbody>"
                  + "</table>"

                  + "Transport:<br>"
                  + "<table cellpadding='0' cellspacing='0' border='0' class='table table-bordered'>"
                  + "<thead>"
                  +          "<tr>"
                  +             "<th>Date</th>"
                  +             "<th>Work number</th>"
                  +             "<th>Type of work</th>"
                  +             "<th>House</th>"
                  +         "</tr>"
                  + "</thead>"
                  + "<tbody >"
                  + "<tr>"
                  +   "<td>"+ offer.scaffold_date +"</td>"
                  +   "<td>"+ offer.scaffold_work_id +"</td>"
                  +   "<td>"+ "Transport scaffold" +"</td>"
                  +   "<td>"+ offer.scaffold_work_house +"</td>"
                  + "</tr>"  
                  + "<tr>"
                  +   "<td>"+ offer.tent_date +"</td>"
                  +   "<td>"+ offer.tent_work_id +"</td>"
                  +   "<td>"+ "Tranfsport tent" +"</td>"
                  +   "<td>"+ offer.tent_work_house +"</td>"
                  + "</tr>"    
                  + "</tbody>"
                  + "</table>"
                  + "</td></tr>";
              });
              $('#scaffold-list').html(html);
              works.forEach(function(work) {
                var htmlWork = "";
                htmlWork = "<tr>"
                +"<td>"+work.date_start+"</td>"
                +"<td>"+work.id+"</td>"
                +"<td>"+work.worker_id+"</td>"
                +"<td>"+work.work_type_id+"</td>"
                +"<td>"+work.work_hour+"</td>"
                +"</tr>";
                $('#detail-work'+work.offer_id).append(htmlWork);
              })
              // console.log('transportCost');
              // console.log(transportCost);
              $('#transportCost').html(transportCost+' €');
            }

        });
    };

    function get_scaffold_report(){
        var text = $('#client-id-select-2').val();
        // text = encodeURIComponent(text);
        // var text = '1'
        console.log('text');
        console.log(text);
        var url = "<?php echo base_url(); ?>reports/search_report?client_id="+text;
        $.ajax({
          type: "GET",
          url: url, 
          dataType: "text",  
          cache:false,
          success: 

            function(data){
              console.log('success');
              var data = jQuery.parseJSON(data);
              console.log('data');
              console.log(data);
              var offers = data.offers;
              var works = data.works;
              var html = "";
              var transportCost = 0;
              offers.forEach(function(offer) {
                if(offer.scaffold_transport_cost){
                  transportCost = transportCost + Number(offer.scaffold_transport_cost);
                }
                if(offer.tent_transport_cost){
                  transportCost = transportCost + Number(offer.tent_transport_cost);
                }
                html = html + "<tr><td onclick='showDetail2("+offer.id+")'>" +
                  + offer.id + "</td><td>"
                  + offer.scaffold_type + "</td><td>"
                  + offer.client_id + "</td><td>"
                  + offer.project_id + "</td><td>"
                  + offer.size + "</td><td>"
                  + offer.house + "</td><td>"
                  + offer.room + "</td><td>"
                  + offer.starting_date + "</td><td>"
                  + offer.end_date + "</td></tr>"

                  + "<tr id='detail-2-"+offer.id+"' style='display:none'><td></td><td colspan='8'>"
                  
                  + "Work:<br>"
                  + "<table cellpadding='0' cellspacing='0' border='0' class='table table-bordered'>"
                  + "<thead>"
                  +          "<tr>"
                  +             "<th>Date</th>"
                  +             "<th>Work number</th>"
                  +             "<th>Worker</th>"
                  +             "<th>Type of work</th>"
                  +             "<th>Hours</th>"
                  +         "</tr>"
                  + "</thead>"
                  + "<tbody id='detail-work-2-"+offer.id+"'>"
                  + "</tbody>"
                  + "</table>"                  

                  + "Materials:<br>"
                  + "<table cellpadding='0' cellspacing='0' border='0' class='table table-bordered'>"
                  + "<thead>"
                  +          "<tr>"
                  +             "<th>Date</th>"
                  +             "<th>Work number</th>"
                  +             "<th>Type of material</th>"
                  +             "<th>Amount</th>"
                  +         "</tr>"
                  + "</thead>"
                  + "<tbody >"
                  + "<tr>"
                  +   "<td>"+ offer.scaffold_date +"</td>"
                  +   "<td>"+ offer.scaffold_work_id +"</td>"
                  +   "<td>"+ "Scaffold material" +"</td>"
                  +   "<td>"+ offer.scaffold_work_amount +"</td>"
                  + "</tr>"  
                  + "<tr>"
                  +   "<td>"+ offer.tent_date +"</td>"
                  +   "<td>"+ offer.tent_work_id +"</td>"
                  +   "<td>"+ "Tent material" +"</td>"
                  +   "<td>"+ offer.tent_work_amount +"</td>"
                  + "</tr>"    
                  + "</tbody>"
                  + "</table>"

                  + "Transport:<br>"
                  + "<table cellpadding='0' cellspacing='0' border='0' class='table table-bordered'>"
                  + "<thead>"
                  +          "<tr>"
                  +             "<th>Date</th>"
                  +             "<th>Work number</th>"
                  +             "<th>Type of work</th>"
                  +             "<th>House</th>"
                  +         "</tr>"
                  + "</thead>"
                  + "<tbody >"
                  + "<tr>"
                  +   "<td>"+ offer.scaffold_date +"</td>"
                  +   "<td>"+ offer.scaffold_work_id +"</td>"
                  +   "<td>"+ "Transport scaffold" +"</td>"
                  +   "<td>"+ offer.scaffold_work_house +"</td>"
                  + "</tr>"  
                  + "<tr>"
                  +   "<td>"+ offer.tent_date +"</td>"
                  +   "<td>"+ offer.tent_work_id +"</td>"
                  +   "<td>"+ "Tranfsport tent" +"</td>"
                  +   "<td>"+ offer.tent_work_house +"</td>"
                  + "</tr>"    
                  + "</tbody>"
                  + "</table>"
                  + "</td></tr>";
              });
              $('#scaffold-list-2').html(html);
              works.forEach(function(work) {
                var htmlWork = "";
                htmlWork = "<tr>"
                +"<td>"+work.date_start+"</td>"
                +"<td>"+work.id+"</td>"
                +"<td>"+work.worker_id+"</td>"
                +"<td>"+work.work_type_id+"</td>"
                +"<td>"+work.work_hour+"</td>"
                +"</tr>";
                $('#detail-work-2-'+work.offer_id).append(htmlWork);
              })
              // console.log('transportCost');
              // console.log(transportCost);
              // $('#transportCost').html(transportCost+' €');
            }

        });
    };

    function changeTab(type){
      event.preventDefault();
      if(type=='scaffold'){
        $('#scaffold-btn').addClass("active");
        $('#follow-up-btn').removeClass("active");
        $('#saved-btn').removeClass("active");

        $('#scaffold-search').show();
        $('#follow-up-search').hide();
        $('#saved-search').hide();

        $('#scaffold-result').show();
        $('#follow-up-result').hide();
        $('#saved-result').hide();
      } else if(type=='follow-up'){
        $('#scaffold-btn').removeClass("active");
        $('#follow-up-btn').addClass("active");
        $('#saved-btn').removeClass("active");

        $('#scaffold-search').hide();
        $('#follow-up-search').show();
        $('#saved-search').hide();
        $('#scaffold-result').hide();
        $('#follow-up-result').show();
        $('#saved-result').hide();
      } else if(type=='saved'){
        $('#scaffold-btn').removeClass("active");
        $('#follow-up-btn').removeClass("active");
        $('#saved-btn').addClass("active");

        $('#scaffold-search').hide();
        $('#follow-up-search').hide();
        $('#saved-search').show();
         $('#scaffold-result').hide();
        $('#follow-up-result').hide();
        $('#saved-result').show();
      }
    } 


    $( document ).ready(function() {
        $('.scaffold_number').hide();
        $('.rental_number').show();
    });

</script>
   