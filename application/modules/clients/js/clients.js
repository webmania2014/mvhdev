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
