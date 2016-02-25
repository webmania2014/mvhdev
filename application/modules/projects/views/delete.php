<?php

?>

 <form action="<?php echo base_url(); ?>clients/delete/<?php echo $client->id; ?>" method="POST">
    <div class="md-xs-8">Are you sure?</div>
    <div class="md-xs-8"><button class="btn btn-success">Yes </button>
        <button class="btn btn-success">Cancel </button>
    </div>
 </form>