<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CAFE | Sign in</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/admin_image/logo.png">
  </head>
  <body>
    <!-- ************* Message *************** -->
    <?php if ($error = $this->session->flashdata('error')) { ?> 
        <div id="myModal" class="modal modal-danger fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <p><span class="fa fa-thumbs-up"> </span> <?php echo $error; ?>
                            <button type="button" class="fa fa-times close" data-dismiss="modal" aria-hidden="true"></button></p>               
                    </div>
                </div>
            </div>
        </div>
    <?php } ?> 
    <!-- *********** End Message ************ -->
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span></span><strong class="text-primary">CAFE</strong></div>
             <form id="login-form" method="post" action="<?php echo base_url();?>login/check">
              <div class="form-group-material">
                <input id="email" type="text" name="loginUsername" required class="input-material">
                <label for="login-username" class="label-material">Email</label>
                <span id="error_email" class="text-danger"></span>
                <span style="color: red;"><?php echo form_error('email'); ?></span>
              </div>
              <div class="form-group-material">
                <input id="password" type="password" name="loginPassword" required class="input-material">
                <label for="login-password" class="label-material">Password</label>
                <span id="error_password" class="text-danger"></span>
                <span style="color: red;"><?php echo form_error('password'); ?></span>
              </div><button class="btn btn-primary" id="login">Sign in</button>
              <!-- This should be submit button but I replaced it with <a> for demo purposes-->
            </form>
          </div>
          <div class="copyrights text-center">
            <p>Design by <a href="http://densetek.com/" class="external">Densetek Infotech</a></p>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script>
    $(document).ready(function(){

        $("#password").focusout(function () {
            if ($(this).val() == '')
            {
                $(this).css("border-color", "#FF0000");
                $("#error_password").text("* You have to enter your first name!");
            } else
            {
                $(this).css("border-color", "#2eb82e");
                $("#error_password").text("");
            }
        });

        function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
            };
            $("#email").focusout(function(){
                if($(this).val()==''){
                        $(this).css("border-color", "#FF0000");
                            // $('#submit').attr('disabled',true);
                            $("#error_email").text("* You have to enter your Email!");
                }
                else if(!ValidateEmail($("#email").val())) {
                    $(this).css("border-color", "#FF0000");
                    // $('#submit').attr('disabled',true);
                    $("#error_email").text("* You have to enter Valid Email!");
                }
                else
                    {
                        $(this).css("border-color", "#2eb82e");
                        // $('#submit').attr('disabled',false);
                        $("#error_email").text("");
                    }
            });
    });
    </script>
    <script type="text/javascript">
        $('#myModal').modal('show');

        setTimeout(function () {
            $('#myModal').modal('hide');
        }, 2000);
    </script>
  </body>
</html>