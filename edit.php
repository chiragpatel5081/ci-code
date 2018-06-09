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
                        <li><a href="<?php echo base_url();?>user">User Management</a></li>
                        <li class="active">Edit User</li>
                    </ol>
                </div>              
            </div>
        </div>            
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-md-6">
                            <h2>Edit User</h2>
                        </div>                         
                    </div>
                    <div class="body">
                        <form id="form_advanced_validation" method="post" enctype="multipart/form-data" action="<?php echo base_url('user/update'); ?>">

                                <div class="form-group form-float">
                                    <div class="demo-radio-button">
                                        <input name="admin_prefix" type="radio" id="radio_1"  checked value="Mr" <?php if($data[0]->admin_prefix=='Mr'){?> checked <?php } ?>/>
                                        <label for="radio_1">Mr</label>
                                        <input name="admin_prefix" type="radio" id="radio_2" value="Mrs" <?php if($data[0]->admin_prefix=='Mrs'){?> checked <?php } ?>/>
                                        <label for="radio_2">Mrs</label>
                                        <input name="admin_prefix" type="radio" id="radio_3" value="Miss" <?php if($data[0]->admin_prefix=='Miss'){?> checked <?php } ?>/>
                                        <label for="radio_3">Miss</label>
                                    </div>                                                                        
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="hidden" name="admin_id"  value="<?php echo $data[0]->admin_id; ?>" id="admin_id">
                                        <input type="text" class="form-control" name="first_name" maxlength="10" minlength="3" required value="<?php echo $data[0]->admin_first_name; ?>">
                                        <label class="form-label">First Name</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 10 characters</div>
                                    <span style="color: red;"><?php echo form_error('first_name'); ?></span>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="last_name" maxlength="10" minlength="3" required value="<?php echo $data[0]->admin_last_name; ?>">
                                        <label class="form-label">Last Name</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 10 characters</div>
                                    <span style="color: red;"><?php echo form_error('last_name'); ?></span>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required value="<?php echo $data[0]->admin_email; ?>">
                                        <label class="form-label">Email</label>
                                    </div>
                                    <span style="color: red;"><?php echo form_error('email'); ?></span>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="phone" maxlength="10" minlength="10" required value="<?php echo $data[0]->admin_mobile; ?>">
                                        <label class="form-label">Phone</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 10 alphabetical</div>
                                    <span style="color: red;"><?php echo form_error('phone'); ?></span>
                                </div>
                                <div class="form-group ">
                                    <div class="">
                                    <select class="form-control show-tick" data-live-search="true" required name="user_type" id="user_type">
                                    <option >Select User Type</option>
                                        <?php 
                                          foreach ($cafe_role as $value) 
                                          { ?>
                                            <option value="<?php echo $value->role_no; ?>"
                                            <?php if($value->role_no==$data[0]->admin_role){?> selected="selected"<?php }?> ><?php echo $value->role_name; ?></option>
                                          <?php }
                                          ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="hidden" name="admin_id"  value="<?php echo $data[0]->admin_id; ?>">
                                        <input type="text" class="form-control" name="username" maxlength="10" minlength="3" required value="<?php echo $data[0]->admin_username; ?>" >
                                        <label class="form-label">Username</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 10 characters</div>
                                    <span style="color: red;"><?php echo form_error('username'); ?></span>
                                </div>                                                                 
                                <div class="form-group form-float">
                                    <a href="<?php echo base_url();?>user/change_password/<?php echo $data[0]->admin_id; ?>" tabindex="10">
                                        <button type="button" class="btn btn-info">change password</button> 
                                    </a>                                        
                                </div>
                                <input type="submit" value="Submit" class="btn btn-success">
                                <a href="<?php echo base_url('user'); ?>" class="btn btn-danger">Cancel</a>
                                <input type="reset" value="Reset" class="btn btn-dark">
                        </form>
                    </div>
                </div>
            </div>
        </div>            
    </div>
</section>
<?php 
  $this->load->view('layout/footer')
?>
<script type="text/javascript">
    $('#user_type').select2();
</script>