<?php 
  $this->load->view('layout/header')
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                   
                <div class="body">                        
                    <ol class="breadcrumb breadcrumb-bg-orange">
                        <li><a href="<?php echo base_url();?>dashboard">Home</a></li>                            
                        <li class="active">User Management</li>
                    </ol>
                </div>              
            </div>
        </div>            
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-md-6">
                            <h2>User Management</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo base_url(); ?>user/userAdd">
                                <button type="button" class="btn btn-danger waves-effect pull-right     a-btn-slide-text">+ Add User</button>
                            </a>
                        </div>  
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody> 
                                  <?php  
                                    $i=1;

                                    foreach ($User_list as $fet)
                                    {                         
                                  ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $fet->admin_prefix." ".$fet->admin_first_name." ".$fet->admin_last_name; ?></td>
                                        <td><?php echo $fet->admin_email; ?></td>
                                        <td><?php echo $fet->admin_mobile; ?></td> 
                                        <td><?php echo $fet->admin_username; ?></td>              
                                        <td><?php echo $fet->role_name; ?></td> 
                                        <td>
                                            <?php if ($fet->admin_status==0) { ?>
                                                <div class="label label-success">Active</div>
                                            <?php } else{ ?>
                                                <div class="label label-danger">Deactive</div>
                                            <?php } ?>                                
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>user/edit/<?php echo $fet->admin_id; ?>" class="btn btn-info btn-xs"><i class="material-icons">edit</i></a>
                                            <a href="<?php echo base_url(); ?>user/delete/<?php echo $fet->admin_id; ?>" class="btn btn-danger btn-xs"><i class="material-icons">delete</i></a></td>
                                    </tr>
                                  <?php 
                                    }                     
                                  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
</section>
<?php 
  $this->load->view('layout/footer')
?>

