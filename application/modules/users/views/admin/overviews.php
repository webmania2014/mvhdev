<div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="index.php">Dashboard</a></li>
                <li class="active">Calendar</li>
            </ol>
</div>
<div class="container">
    <table class="table table-striped table-bordered datatables" id="example">
        <th>Usename</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Action</th>
        <?php  if(isset($users)):  ?>
            <?php foreach($users as $user ): ?>
                <tr>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->first_name; ?></td>
                    <td><?php echo $user->last_name; ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?php echo base_url(); ?>users/edit/<?php echo $user->id ?>">Edit</a>
                        <a class="btn btn-danger" href="<?php echo base_url(); ?>users/delete/<?php echo $user->id ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif;?>
    </table>
</div>