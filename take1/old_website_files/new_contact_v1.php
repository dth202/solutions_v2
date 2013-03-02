<style type="text/css">
.separator {
	background-color:#036;
	height:1px; 
	margin:auto; 
	width:100%;
	margin-bottom:5px;
	margin-top:10px;
}
</style>
<table style="padding-left:15px;" width="80%" border="0" cellspacing="0" cellpadding="2">
<tr>
  <td colspan="4"><h1>New Client</h1></td>
</tr>
<tr>
  <td>First</td>
  <td><input type="text" class="text_input" name="First" /></td>
  <td>Last</td>
  <td><input type="text" class="text_input" name="Last" /></td>
</tr>
<tr>
  <td>Company</td>
  <td><select id="companies" name="companies">
    <option value="shannon_cpas_and_associates">Shannon CPAs &amp; Associates</option>
    <option value="all_star_garage_doors">All Star Garage Doors</option>
    <option value="payson_diesel">Payson Diesel</option>
    <option value="mountain_loan_centers_provo">Mountain Loan Centers (Provo)</option>
  </select></td>
  <td>Support Plan</td>
  <td><select id="Support_Plan" name="Support_Plan">
    <option value="full">Fully Managed</option>
    <option value="call">On Call</option>
    <option value="part">Partially Managed</option>
  </select></td>
</tr>
<tr>
  <td>Street Address</td>
  <td><input type="text" class="text_input" name="Street_Address" /></td>
  <td>City</td>
  <td><input type="text" class="text_input" name="City" /></td>
</tr>
<tr>
  <td>Zip</td>
  <td><input type="text" class="text_input" name="Zip" /></td>
  <td>Phone</td>
  <td><input type="text" class="text_input" name="Phone" /></td>
</tr>
</table>
<script type="text/javascript">
 $("#companies").ufd({submitFreeText:true});
 $("#Support_Plan").ufd({submitFreeText:true});
</script>