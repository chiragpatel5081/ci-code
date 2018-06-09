<?php 
$this->load->view('layout/header')
?>
<style type="text/css">
.input_small
{
    width: 80px;
}
.input_mid
{
    width: 140px;
}
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                   
            <div class="body">                        
                <ol class="breadcrumb breadcrumb-bg-orange">
                    <li><a href="<?php echo base_url();?>dashboard">Home</a></li>
                    <li><a href="<?php echo base_url();?>sales">Sales</a></li>
                    <li class="active">Add New Sales</li>
                </ol>
            </div>              
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header row">
                    <div class="col-md-6">
                        <h2>Add New Sales</h2>                            
                    </div>
                    <div class="col-md-6">
                        <h2 class="pull-right"></h2>                            
                    </div>                         
                </div>
                <div class="body">
                    <form id="form_advanced_validation" method="post" enctype="multipart/form-data" action="<?php echo base_url('sales/Add_data'); ?>">
                        <div class="row clearfix">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line focused error">

                                        <?php
                                        if($cafe_sell_list==null){
                                            $no = sprintf('%06d',intval(1));
                                        }
                                        else{
                                          foreach ($cafe_sell_list as $value) {
                                            $no = sprintf('%06d',intval($value->sell_invoice_no)+1); 
                                        }
                                    }                    
                                    ?>
                                    <input type="text" class="form-control" readonly  value="<?php echo "Invoice No :".$no; ?>">
                                    <input type="hidden" class="form-control" name="sell_invoice_no" value="<?php echo $no; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line focused error">
                                    <input type="text" class="form-control" readonly name="date_val" value="<?php echo date('d/m/y'); ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row clearfix">

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">                                            
                                    <select class="form-control show-tick" data-live-search="true" name="customer_id" id="customer_id" required tabindex="1">
                                        <option value="">Select Customer Mobile No</option>
                                        <?php 
                                        foreach ($customer as $value) 
                                          { ?>
                                            <option value="<?php echo $value->customer_id; ?>"><?php echo $value->customer_mobile; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <span style="color: red;"><?php echo form_error("customer_id"); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">                                    
                            <a href="<?php echo base_url(); ?>Customer/AddForm">
                                <button type="button" tabindex="2" class="btn btn-danger">+ Add Customer</button>
                            </a>                                       
                        </div>                                
                    </div>                              
                    <div class="row clearfix">

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-line focused success">
                                    <select class="form-control show-tick" data-live-search="true" name="input_product_name" id="input_product_name" tabindex="3">
                                        <option value="0">Select Product Name</option>
                                        <?php 
                                        foreach ($products as $value) 
                                          { ?>
                                            <option value="<?php echo $value->product_id; ?>"><?php echo $value->product_name; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>   
                            <span style="color: red;"><?php echo form_error("sub_total"); ?></span>
                            <span id="error_pro" style="color: red;"></span>  
                        </div> 
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="body table-responsive">
                                <table class="table table-striped " id="sales" >
                                    <thead>
                                        <tr>
                                            <th><i class="material-icons">delete</i></th>
                                            <th>Product Name</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Price (&#8377)</th>
                                            <th>Total (&#8377)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_table">
                                    </tbody>
                                </table>
                            </div>                               
                        </div>                                
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="body table-responsive">
                                <table class="table table-striped">
                                    <thead>                                                
                                    </thead>
                                    <tbody id="sub_total_table">


                                        <tr>                                                    
                                            <th>SGST %</th>
                                            <th><input type="number" class="form-control input_small" id="sgst" name="sgst" maxlength="3"  value="" placeholder="%"></th>
                                            <th><input type="number" class="form-control input_mid" id="total_sgst" name="total_sgst" placeholder="00.00"  value="" readonly=""></th>
                                        </tr>
                                        <tr>                                                    
                                            <th>CGST %</th>
                                            <th><input type="number" class="form-control input_small" id="cgst" name="cgst" maxlength="3"  value="" placeholder="%"></th>
                                            <th><input type="number" class="form-control input_mid" id="total_cgst" name="total_cgst" placeholder="00.00"  value="" readonly=""></th>
                                        </tr>
                                        <tr>
                                            <th>IGST %</th>
                                            <th><input type="number" class="form-control input_small" id="igst" name="igst"  maxlength="3" value=""  width="50px" placeholder="%" ></th>
                                            <th><input type="number" class="form-control input_mid" id="total_igst" name="total_igst"  placeholder="00.00" value="" readonly=""></th>
                                        </tr>                                                    

                                        <tr>
                                            <th>Inclusive ?</th>
                                            <th></th>                                                      
                                            <th>
                                                <input name="radio_2" type="radio" id="radio_2" checked value="NO" />
                                                <label for="radio_2">NO</label>
                                                <input name="radio_2" type="radio" id="radio_1"  value="YES" />
                                                <label for="radio_1">YES</label>
                                            </th>                                                  
                                        </tr>
                                        <tr>
                                            <th>Total Tax %</th>
                                            <th><input type="number" class="form-control input_small" id="total_tax" name="total_tax" value=""  width="50px"  readonly="" placeholder="%"></th>
                                            <th><input type="number" class="form-control input_mid" id="total_tax_val" placeholder="00.00" name="total_tax_val"   value="" readonly=""></th>
                                        </tr>
                                        <tr>                                                    
                                            <th>Total (&#8377)</th>
                                            <th></th>
                                            <th><input type="number" class="form-control input_mid" id="main_total" name="main_total" value=""  readonly="" placeholder="00.00"></th>
                                        </tr> 
                                        <tr>                                                    
                                            <th>Sub Total (&#8377)</th>
                                            <th></th>
                                            <th>
                                                <input type="number"  class="form-control input_mid" value="" id="sub_total" required=""  placeholder="00.00" name="sub_total" readonly="">                                                
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                               
                        </div>                                
                    </div>
                    <input type="submit" value="Submit" id="submit" class="btn btn-success" tabindex="7">
                    <a href="<?php echo base_url('sales'); ?>" class="btn btn-danger" tabindex="8">Cancel</a>
                    <a href="<?php echo base_url('sales/add'); ?>" class="btn btn-dark" tabindex="9">Reset</a>                                                                
                </div>                                      
            </form>    
        </div>
    </div>
</div>            
</div>
</section>
<?php 
$this->load->view('layout/footer')
?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#input_product_name').select2();
        $('#customer_id').select2();
        
        $('#exp_date').datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
        });
        //$("#sub_total_table").hide();
        $("#sales").hide();
        
        $('#input_product_name').on('change', function() {        

            var pro_id = $('#input_product_name').val(); 
           // $("#sub_total_table").show();
            $("#sales").show();

            var flag = 0;
            $("#product_table").find('input[name^="pro_id_my"]').each(function () {
                if(pro_id  == +$(this).val()){
                    flag = 1;
                }               
            });
            if(flag==1)
            {
                $("#error_pro").text("Product Already Added !");

            } else {
                $("#error_pro").text("");
                add_row(pro_id);
            } 
            $('#input_product_name').val('0');  
        });

    });
    $("#product_table,#sub_total_table").on("keyup change click", 'input[name^="price"], input[name^="qty"],input[name^="qty"],input[name^="igst"],input[name^="sgst"], input[name^="cgst"],input[name^="radio_2"]', function (event) {          
        calculateRow($(this).closest("tr"));
        Total();
        calculateGrandTotal();

    });
    function removeMe(that) 
    {
        var row = $(that).closest('tr').remove();
        Total();
        calculateGrandTotal();           
    }
    function add_row(pro_id){
        var counter = 0;
        var newRow = $("<tr>");
        var cols = "";
        $.ajax({
            url: "<?php echo base_url(); ?>sales/product_id",
            type: "POST",
            data: {pro_id: pro_id},
            dataType: "json",
            success: function (data) {

                cols += '<td><a value="'+ data['product_id']+'" onclick="removeMe(this)";><img src="<?php  echo base_url(); ?>assets/images/bin3.png"/></a></td>';

                cols += '<td>'+ data['product_name']+'<input type="hidden" value="'+ data['product_id']+'" name="pro_id_'+ data['product_id'] + ' id="pro_id"/><input type="hidden" value="'+ data['product_id']+'" name="pro_id_my[]"  id="pro_id_my"/></td>';
                cols += '<td>'+ data['unit_name']+'</td>';
                cols += '<td><input type="number" class="form-control input_mid"  placeholder="qty" id="qty" value="1" name="qty_' + data['product_id'] + '"/></td>';
                cols += '<td><input type="number" class="form-control input_mid" placeholder="00.00" required id="price" value="" class="price_' + data['product_id'] + '" name="price_' + data['product_id'] + '"/></td>';
                cols += '<td><input type="number" class="form-control input_mid" placeholder="00.00" id="total" value="" name="total_' + data['product_id'] + '" readonly/></td>';

                newRow.append(cols);
                $('#product_table').append(newRow);
                counter++;

            },            
        });
    }
    function calculateRow(row) {
        var price = +row.find('input[name^="price"]').val();
        var qty = +row.find('input[name^="qty"]').val();
        row.find('input[name^="total"]').val((price * qty).toFixed(2)); 
    }
    function Total() {
        var total = 0;
        $("#product_table").find('input[name^="total"]').each(function () {
            total += +$(this).val();
        });
        $("#main_total").val(total.toFixed(2));
    }
    function calculateGrandTotal(){
        var main_total = $('#main_total').val(); 

        var igst = $('#igst').val(); 
        var cgst = $('#cgst').val(); 
        var sgst = $('#sgst').val(); 

        var tax_total = (+igst + +cgst + +sgst);
        $('#total_tax').val(tax_total.toFixed(2));

        var igst_tax = main_total*igst/100;
        var cgst_tax = main_total*cgst/100;
        var sgst_tax = main_total*sgst/100;
        var tax = (+igst_tax + +cgst_tax + +sgst_tax).toFixed(2);

        var sub_sub_total = (+main_total + +tax).toFixed(2);

        $("#total_tax_val").val(tax);


        $("#total_igst").val(igst_tax.toFixed(2));
        $("#total_cgst").val(cgst_tax.toFixed(2));
        $("#total_sgst").val(sgst_tax.toFixed(2));

        var inclusive = $("input[name='radio_2']:checked").val();
        if (inclusive=='YES') {

            $("#sub_total").val(main_total);

        }
        else{

            $("#sub_total").val(sub_sub_total);
        }            
    };       
</script>
<!-- <script type="text/javascript">
$("#form_advanced_validation").validate();
</script>
<style type="text/css">
    .error{
        color: red;
    }
</style> -->