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
		  <td width="25%"></td>
		  <td width="25%">&nbsp;</td>
		  <td width="25%">&nbsp;</td>
		  <td width="25%">&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="4"><form id="form1" name="form1" method="post" action="php_scripts/submit_new_ticket.php">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
			<td>&nbsp;</td>
			<td>Ticket Name</td>
			<td colspan="2"><input name="ticket_name" class="text_input" type="text" /></td>
			<td><span style="vertical-align:top;">Service Type </span></td>
			<td><span style="vertical-align:top;">
			  <select id="service_type" name="service_type">
			    <option value="desktop">Desktop</option>
			    <option value="hardware">Hardware</option>
			    <option value="network">Network</option>
			</select>
			</span></td>
			<td colspan="2" style="text-align:center;">Ticket No.
			  <input name="ticket_id" type="text" class="text_input" id="ticket_id" style="width:45px; text-align:center;" value="1235" /></td>
		</tr>
		      <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Client </td>
			<td colspan="2"><select id="companies" name="companies">
			  <option value="shannon_cpas_and_associates">Shannon CPAs &amp; Associates</option>
			  <option value="all_star_garage_doors">All Star Garage Doors</option>
			  <option value="payson_diesel">Payson Diesel</option>
			  <option value="mountain_loan_centers_provo">Mountain Loan Centers (Provo)</option>
			  </select></td>
			<td style="vertical-align:top;">Contact </td>
			<td style="vertical-align:top;"><select id="contacts" name="contacts">
			  <option value="robyn">Robyn</option>
			  <option value="shaunae">Shaunae</option>
			  </select></td>
			<td colspan="2" style="text-align:center;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8"><div class="separator"></div></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="3"><table border="0" cellpadding="0" cellspacing="0">
		<tr>
			    <td><h3> Hours</h3></td>
		</tr>
	</table>
	<div style="width:60%; padding-left:20px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td>Hours</td>
			  <td><input style="width:40px;" name="hours" class="text_input" type="text" /></td>
			  <td>Minutes</td>
			  <td><select name="minutes" id="minutes">
			    <option value="00">00</option>
			    <option value="15">15</option>
			    <option value="30">30</option>
			    <option value="45">45</option>
			  </select></td>
			</tr>
			<tr>
			  <td>Mileage</td>
			  <td><input style="width:40px;" name="miles2" class="text_input" type="text" /></td>
			  <td>Vehicel MPG</td>
			  <td><input style="width:40px;" name="mpg2" class="text_input" type="text" /></td>
			</tr>
		</table>
	</div>
</td>
<td colspan="4"><div>
		  <div style="width:50%; float:left;">
		    <table border="0" cellpadding="0" cellspacing="0">
		      <tr>
			<td colspan="2"><h3>Times</h3></td>
			</tr>
		      <tr>
			<td colspan="2"><select name="date" id="date" disabled="disabled">
			  <option value="10-6-2010">October 6 2010</option>
			  <option value="10-7-2010">October 7 2010</option>
			  </select></td>
			</tr>
		      <tr>
			<td>Start</td>
			<td style="text-align:left;"><select name="start_time" id="start_time" disabled="disabled">
			  <option value="12:00 AM">12:00 AM</option>
			  <option value="12:15 AM">12:15 AM</option>
			  <option value="12:30 AM">12:30 AM</option>
			  <option value="12:45 AM">12:45 AM</option>
			  <option value="1:00 AM">1:00 AM</option>
			  </select></td>
			</tr>
		      <tr>
			<td>Stop</td>
			<td style="text-align:left;"><select name="start_time2" id="start_time2" disabled="disabled">
			  <option value="12:00 AM">12:00 AM</option>
			  <option value="12:15 AM">12:15 AM</option>
			  <option value="12:30 AM">12:30 AM</option>
			  <option value="12:45 AM">12:45 AM</option>
			  <option value="1:00 AM">1:00 AM</option>
			  </select></td>
			</tr>
		      </table>
		    </div>
		  <div style="width:50%; float:left;">
		    <table border="0" cellpadding="0" cellspacing="0">
		      <tr>
			<td colspan="2" style="height:21px;">&nbsp;</td>
			</tr>
		      <tr>
			<td colspan="2"><select name="date2" id="date2" disabled="disabled">
			  <option value="10-6-2010">October 6 2010</option>
			  <option value="10-7-2010">October 7 2010</option>
			  </select></td>
			</tr>
		      <tr>
			<td>Start</td>
			<td style="text-align:left;"><select name="start_time3" id="start_time3" disabled="disabled">
			  <option value="12:00 AM">12:00 AM</option>
			  <option value="12:15 AM">12:15 AM</option>
			  <option value="12:30 AM">12:30 AM</option>
			  <option value="12:45 AM">12:45 AM</option>
			  <option value="1:00 AM">1:00 AM</option>
			  </select></td>
			</tr>
		      <tr>
			<td>Stop</td>
			<td style="text-align:left;"><select name="start_time4" id="start_time4" disabled="disabled">
			  <option value="12:00 AM">12:00 AM</option>
			  <option value="12:15 AM">12:15 AM</option>
			  <option value="12:30 AM">12:30 AM</option>
			  <option value="12:45 AM">12:45 AM</option>
			  <option value="1:00 AM">1:00 AM</option>
			  </select></td>
			</tr>
              </table>
            </div>
        </div></td>
        </tr>
      <tr>
        <td colspan="8"><div class="separator"></div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><h3>Description</h3></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>Failed  Equiptment</td>
            <td><select name="failed_equiptment" id="failed_equiptment">
              <option value="router">Router</option>
              <option value="shaunae-pc">Shaunae-PC</option>
              <option value="becky-pc">Becky-PC</option>
              <option value="becky-printer">Becky-Printer</option>
              </select></td>
            <td>Model</td>
            <td><select name="model_number" id="model_number">
              <option value="23c">23c</option>
              <option value="676c">676c</option>
              </select></td>
            <td>Serial/Asset #</td>
            <td><select name="serial_number" id="serial_number">
              <option value="becky-pc">2938KCIEN2</option>
              <option value="shaunae-pc">ENZ239382VDAO2</option>
              </select></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Problem(s)</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" style="text-align:center;">
        	<textarea name="problem" id="problem" style="height:90px; width:95%;"></textarea>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Work Preformed</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8" style="text-align:center;">
          <textarea name="work_preformed" id="work_preformed" style="height:90px; width:95%;"></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="8"><div class="separator"></div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><h3>Parts</h3></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;"><img src="./images/add.png" alt="" width="15px" /></td>
        <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="vertical-align:middle;">Qty. </td>
            <td style="vertical-align:middle;"><select name="quantity" id="quantity">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select></td>
            <td style="vertical-align:middle;">Vender </td>
            <td style="vertical-align:middle;"><select name="vendor" id="vendor">
              <option value="dell">Dell</option>
              <option value="hp">HP</option>
              <option value="linksys">Linksys</option>
            </select></td>
            <td>Part #
              <input type="text" class="text_input" style="width:120px;" id="part_no" name="part_no" /></td>
            <td>Desc.
              <input type="text" class="text_input" style="width:140px;" id="description_part" name="description_part" /></td>
            <td>Serial
              <input type="text" class="text_input" style="width:120px;" id="serial" name="serial" /></td>
            <td>Price $
              <input type="text" class="text_input" style="width:60px;" id="price" name="price" /></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="8"><div class="separator"></div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span style="vertical-align:top;">Technician ID </span></td>
        <td><span style="vertical-align:top;">
          <input name="tech_id" type="text" class="text_input" id="tech_id" style="width:80px; text-align:center;" value="KH05" />
        </span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input style="width:100px;" type="submit" name="submit" id="submit" value="Submit Ticket" /></td>
      </tr>
    </table>
  </form></td>
</tr>
</table>
<script type="text/javascript">
	$("#companies").ufd({submitFreeText:true});
	$("#service_type").ufd({submitFreeText:true});
	$("#contacts").ufd({submitFreeText:true});
	$("#start_time").ufd({submitFreeText:true});
	$("#start_time2").ufd({submitFreeText:true});
	$("#start_time3").ufd({submitFreeText:true});
	$("#start_time4").ufd({submitFreeText:true});
	$("#date").ufd({submitFreeText:true, manualWidth:147});
	$("#date2").ufd({submitFreeText:true, manualWidth:147});
	$("#minutes").ufd({submitFreeText:false});
	$("#failed_equiptment").ufd({submitFreeText:true});
	$("#serial_number").ufd({submitFreeText:true});
	$("#model_number").ufd({submitFreeText:true});
	$("#quantity").ufd({submitFreeText:true});
	$("#vendor").ufd({submitFreeText:true});
</script>