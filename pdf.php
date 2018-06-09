<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<script>
	 window.print();
	</script>
	<style type="text/css">
		.table td{
			border: 1px solid black;
		}
		.table th{
			border: 1px solid black;
		}
		.table{
			margin: 10px;
		}
		.footerpad
		{
			padding: 4px;
		}
		.footerpad{
			padding: 5px;
		}
		.minheight{
		    min-height: 1000px;
		}
		.fontS{
			font-size: 11px;
		}
		.fontH{
			font-size: 12px;
		}
	</style>
</head>
<body><div class="printableArea">
	<table width="100%" border="1" cellspacing="0" style="border: 0px solid black; border-collapse: collapse;" class="table" cellpadding="2">
		<tr>
			<td colspan="6" style="border: 0px;text-align: right;">
				<?php if(isset($invoice[0]->invs_header)){echo $invoice[0]->invs_header;}?>
			</td>
			<td colspan="8" style="border: 0px;text-align: right;">
				<?php if(isset($invoice[0]->invs_heading)){echo $invoice[0]->invs_heading;}?>
			</td>
		</tr>
		<tr>
			<td rowspan="2" colspan="6">
				<table>
					<tr>
						<td style="border: 0px;font-size:13px;">    							
							<img src="<?php echo base_url('assets/uploads/');?><?php echo $invoice[0]->invs_logo;?>" width="120" height="90">	    							
						</td>    						
					</tr>
				</table>
			</td>
		
			<td valign="top" style="width: 25%;font-size: 13px;" colspan="4">
				Invoice Number<br>
				<p style="font-size: 13px;font-weight:bold"><?php if(isset($sales[0]->sell_invoice_no)){echo $sales[0]->sell_invoice_no;}?></p>
			</td>
			<td valign="top" style="width: 25%;font-size: 13px;" colspan="4" rowspan="2">
			<?php 
			if ($invoice[0]->invs_location==1) { ?> 	
				<?php if(isset($invoice[0]->invs_label)){echo $invoice[0]->invs_label;}?><br>
				<?php if(isset($invoice[0]->invs_zipcode)){echo $invoice[0]->invs_zipcode;}?><br>
				<?php if(isset($invoice[0]->invs_mobile)){echo $invoice[0]->invs_mobile;}?><br>
				<?php if(isset($invoice[0]->invs_alt_mobile)){echo $invoice[0]->invs_alt_mobile;}?><br>
				<?php if(isset($invoice[0]->invs_email)){echo $invoice[0]->invs_email;}?><br>
			<?php } ?>	
			</td>
		</tr>
		<tr style="font-size: 13px;">
			<td valign="top" colspan="4" style="font-size: 13px;">
				Date<br>
					<p style="font-size: 13px;font-weight:bold"><?php if(isset($sales[0]->sell_create_date)){echo date('d/m/Y',strtotime($sales[0]->sell_create_date));}?></p>
			</td>				
		</tr>
		<tr>
			<th style="text-align: center;font-size: 12px;">SR</th>
			<th style="text-align: center;font-size: 12px;" colspan="5">Product Name</th>			
			<th style="text-align: center;font-size: 12px;">Unit</th>
			<th style="text-align: center;font-size: 12px;" colspan="1">Qty</th>
			<th style="text-align: center;font-size: 12px;" colspan="3">Price</th>						
			<th style="text-align: center;font-size: 12px;" colspan="3">Total</th>
		</tr>
		<?php 
			$i = 1; 
			foreach ($pro as $value) { 
		?>
		<tr>
			<td style="text-align: center;font-size: 12px;" ><?php echo $i; ?></td>
			<td style="text-align: center;font-size: 12px;"  colspan="5"><?php echo $value->product_name; ?></td>			
			<td style="text-align: center;font-size: 12px;" ><?php echo $value->unit_name; ?></td>
			<td style="text-align: center;font-size: 12px;"  colspan="1"><?php echo $value->sell_pro_qty;?></td>
			<td style="text-align: center;font-size: 12px;"  colspan="3"><?php echo $value->sell_pro_price;?></td>						
			<td style="text-align: center;font-size: 12px;"  colspan="3"><?php echo $value->sell_pro_total;?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="14" style="padding: 10px;"></td>
		</tr>
		<tr>
			<td colspan="10" align="right" class="footerpad fontH"><b>SGST</td>
			<td colspan="2" align="right" class="fontH">(<?php echo $sales[0]->sell_sgst; ?>%)</td>
			<td align="right" colspan="2" class="fontH">RS(<?php echo $sales[0]->sell_total_sgst; ?>)</td>
		</tr>
		<tr>
			<td colspan="10" align="right" class="footerpad fontH"><b>CGST</td>
			<td colspan="2" align="right" class="fontH">(<?php echo $sales[0]->sell_cgst; ?>%)</td>
			<td align="right" colspan="2" class="fontH">RS(<?php echo $sales[0]->sell_total_cgst; ?>)</td>
		</tr>
		<tr>
			<td colspan="10" align="right" class="footerpad fontH"><b>IGST</td>
			<td colspan="2" align="right" class="fontH">(<?php echo $sales[0]->sell_igst; ?>%)</td>
			<td align="right" colspan="2" class="fontH">RS(<?php echo $sales[0]->sell_total_igst; ?>)</td>
		</tr>
		<tr>
			<td colspan="10" align="right" class="footerpad fontH"><b>Inclusive ?</td>
			<td colspan="4" align="right" class="fontH">(<?php echo $sales[0]->sell_inclusive; ?>)</td>
		</tr>
		<tr>
            <td colspan="10" align="right" class="footerpad fontH"><b>Total Tax</td>
            <td colspan="2" align="right" class="fontH">(<?php echo $sales[0]->sell_total_tax; ?>%)</td>
            <td align="right" colspan="2" class="fontH">RS (<?php echo $sales[0]->sell_total_tax_val; ?>)</td>                
        </tr>
        <tr>
            <td colspan="10" align="right" class="footerpad fontH"><b>Total</td>
            <td align="right" colspan="4" class="fontH">RS (<?php echo $sales[0]->sell_total; ?>)</td>                
        </tr>
        <tr>
            <td colspan="10" align="right" class="footerpad fontH"><b>Sub Total</td>
            <td align="right" colspan="4" class="fontH">RS (<?php echo $sales[0]->sell_sub_total; ?>)</td>                
        </tr>
        <tr>
        	<td colspan="14" style="padding: 10px;"></td>
        </tr>
        <?php 
		if ($invoice[0]->invs_payment_info==1) {
        if ($sales[0]->sell_pay==0) 
        { ?> 
        <tr>
            <td colspan="10" align="right" class="footerpad fontH"><h3>Paid Amount Pending</h3></td>
            <td align="right" colspan="4" class="fontH"><h3>RS (<?php echo $sales[0]->sell_sub_total; ?>)</h3></td>                
        </tr>
		<?php } else{ ?>
		<tr>	
			<td colspan="10" align="right" class="footerpad fontH"><b>Paid Amount Complited</td>
            <td align="right" colspan="4" class="fontH">RS (<?php echo $sales[0]->sell_sub_total; ?>)</td> 
        </tr>                
		<?php
        }
    	}
        ?>
        <tr>
        	<td colspan="14" valign="top" style="height: 60px;border-bottom: 0px;font-size: 13px;">
        		Paid Amount (in Words)<br>
        		<!-- <b><?php echo $this->numbertowords->convert_number($sales[0]->sell_sub_total); ?>Only</b> -->
        		<b><?php echo getIndianCurrency($sales[0]->sell_sub_total); ?> Only</b>
        	</td>
        </tr>
        <tr>
        	<!-- <td colspan="5" style="height: 60px;border-bottom: 0px;font-size: 13px;">
        		<b>Head Office :</b>
        			<span><br>
					Name:		<?php if(isset($shop[0]->shop_name)){echo $shop[0]->shop_name;}?>,<br>
	    			Landmark:	<?php if(isset($shop[0]->shop_landmark)){echo $shop[0]->shop_landmark;}?>,<br>
					Zipcode:	<?php if(isset($shop[0]->shop_zip_code)){echo $shop[0]->shop_zip_code;}?>,<br>
					City:		<?php if(isset($shop[0]->city_name)){echo $shop[0]->city_name;} ?>,<br>
					State:		<?php if(isset($shop[0]->state_name)){echo $shop[0]->state_name;} ?>,<br>
					Country:	<?php if(isset($shop[0]->country_name)){echo $shop[0]->country_name;}?>,<br>
        			</span>        		
        	</td> -->
        	<td colspan="7" style="height: 60px;border-bottom: 0px;font-size: 13px;">
        		<?php 
		        if ($invoice[0]->invs_bussines==1) 
		        { ?> 
        		<b>Business :</b>
        			<span><br>
					Name:		<?php if(isset($business[0]->business_name)){echo $business[0]->business_name;}?>,<br>
	    			Business Start Date:	<?php if(isset($business[0]->business_start_date)){echo date('d/m/Y',strtotime($business[0]->business_start_date));}?>,<br>
					Product SKU:	<?php if(isset($business[0]->business_product_prefix)){echo $business[0]->business_product_prefix;}?>,<br>					
        			</span>
        		<?PHP } ?>	        		
        	</td>
        	<td colspan="7" style="height: 60px;border-bottom: 0px;font-size: 13px;">
        		<?php 
		        if ($invoice[0]->invs_customer_info==1) 
		        { ?> 
        		<b>Customer :</b>
        			<span><br>
					Name:		<?php if(isset($customer[0]->customer_name)){echo $customer[0]->customer_name;}?>,<br>
	    			Landmark:	<?php if(isset($customer[0]->customer_mobile)){echo $customer[0]->customer_mobile;}?>,<br>					
					City:		<?php if(isset($customer[0]->city_name)){echo $customer[0]->city_name;} ?>,<br>
					State:		<?php if(isset($customer[0]->state_name)){echo $customer[0]->state_name;} ?>,<br>
					Country:	<?php if(isset($customer[0]->country_name)){echo $customer[0]->country_name;}?>,<br>
        			</span> 
        		<?PHP } ?>	       		
        	</td>
        </tr>        
        <tr>
        	<td colspan="7" style="height: 80px;font-size: 13px;" valign="top">
        		Customer Signature
        		<br>
        		<br>
        	</td>
        	<td colspan="7" valign="top" style="text-align: right;font-size: 13px;">
        		<b>For <?php if(isset($business[0]->business_name)){echo $business[0]->business_name;}?></b>
        		<br>
        		Authorised Signature
        	</td>
        </tr>    
	</table>
	<table>
		<tr>
        	<td colspan="14" style="border:0px;text-align: center;font-size: 13px;">
        		<b><?php if(isset($invoice[0]->invs_footer)){echo $invoice[0]->invs_footer;}?></b>
        	</td>
        </tr>
	</table>
	</div>
</body>
</html>

<?php 
function getIndianCurrency(float $number)
    {
      $decimal = round($number - ($no = floor($number)), 2) * 100;
      $hundred = null;
      $digits_length = strlen($no);
      $i = 0;
      $str = array();
      $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
      $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');

      while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100 ;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
          $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
          $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
          $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
      }

      $rupees = implode('', array_reverse($str));
      $paise = '';

      if ($decimal) {
        $paise = 'And ';
        $decimal_length = strlen($decimal);

        if ($decimal_length == 2) {
          if ($decimal >= 20) {
            $dc = $decimal % 10;
            $td = $decimal - $dc;
            $ps = ($dc == 0) ? '' : ' ' . $words[$dc];

            $paise .= $words[$td] . $ps;
          } else {
            $paise .= $words[$decimal];
          }
        } else {
          $paise .= $words[$decimal % 10];
        }

        $paise .= ' Paise';
      }
      return ($rupees ? $rupees . 'Rupees ' : '') . $paise ;
    }
?>