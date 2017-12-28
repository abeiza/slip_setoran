			  <script>
			  $(document).ready(function() {
					$('#example').DataTable( {
						columnDefs: [
							{
								targets: [ 0, 1, 2 ],
								className: 'mdl-data-table__cell--non-numeric'
							}
						],
						"order": [[ 0, "desc" ]]
					} );
					
					$('#list_customer').DataTable( {
						columnDefs: [
							{
								targets: [ 0, 1, 2 ],
								className: 'mdl-data-table__cell--non-numeric'
							}
						],
						"order": [[ 0, "asc" ]]
					} );
					
					$('#list_depositor').DataTable( {
						columnDefs: [
							{
								targets: [ 0, 1, 2 ],
								className: 'mdl-data-table__cell--non-numeric'
							}
						],
						"order": [[ 0, "asc" ]]
					} );
		
					$('#notif').click(function(){
						$('#notif').slideUp('slow');
					});
					
					$('#close_cust').click(function(){
						$('#container_customer').fadeOut('slow');
					});
					
					$('#close_depo').click(function(){
						$('#container_depositor').fadeOut('slow');
					});
					
					/*$('#search_cust').click(function(){
						$('#container_customer').fadeIn('slow');
					});*/
					
					$('#search_depo').click(function(){
						$('#container_depositor').fadeIn('slow');
					});
				} );
			  </script>
			  <script>
				function show_list_cust(id){
					//$('.cust id_lst').remove();
					
					//$('.cust').append("<input type='hidden' id='id_lst' value/>");
					$('#id_lst').val(id);
					$('#container_customer').fadeIn('slow');
				}
			  </script>
			  <script>
				function choose_cust_id(id){
					var id2 = $('#id_lst').val();
					$(function(){
						$.ajax({
							url:'<?php echo base_url();?>index.php/form_slip/get_cust/'+id+'/',
							cache:false,
							type: "POST",
							dataType: 'json',
							success:function(result){
								$.each(result, function(i, data){
									$('#no_rek_customer_'+id2).val(data.Receiver_Rec);
									$('#nama_customer_'+id2).val(data.Receiver_Name);
								});
							}
						});
					});
					$('#container_customer').fadeOut('slow');
				}
			</script>
			  <style>
				#container_customer{
					position: fixed;
					z-index: 99;
					background: rgba(0,0,0,0.4);
					height: 100%;
					width:100%;
				}
				
				.cust{
				    background: #fff;
					width: 50%;
					margin: auto;
					padding: 50px 20px;
					height: 100%;
				}
				
				#container_depositor{
					position: fixed;
					z-index: 99;
					background: rgba(0,0,0,0.4);
					height: 100%;
					width:100%;
				}
				
				.depo{
				    background: #fff;
					width: 50%;
					margin: auto;
					padding: 50px 20px;
					height: 100%;
				}
				
				#container_customer{
					display:none;
				}
				
				#container_depositor{
					display:none;
				}
			  </style>
			  <script type="text/javascript" src="<?php echo base_url();?>assets/js/terbilang.js"></script>
			  <div id="container_customer">
				<div class="cust">
				<input type="hidden" id="id_lst"/>
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px;position:absolute;margin:auto;top:20px;" id="close_cust">clear</i>
					<table id="list_customer" class="mdl-data-table" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#Pilih</th>
								<th>Nama Penerima</th>
								<th>Rekening Penerima</th>
								<th>Alamat Penerima</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#Pilih</th>
								<th>Nama Penerima</th>
								<th>Rekening Penerima</th>
								<th>Alamat Penerima</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
								foreach($master_receiver_list->result() as $rece){	
							?>
							<tr>
								<td id="btnCst">
									<button onclick='choose_cust_id(<?php echo $rece->ObjectID;?>)' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
									  Pilih
									</button>
								</td>
								<td><?php echo $rece->Receiver_Name;?></td>
								<td><?php echo $rece->Receiver_Rec;?></td>
								<td><?php echo $rece->Receiver_Address;?></td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			  </div>
			  
			  
			  <div id="container_depositor">
				<div class="depo">
				<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px;position:absolute;margin:auto;top:20px;" id="close_depo">clear</i>
					
					<table id="list_depositor" class="mdl-data-table" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#Pilih</th>
								<th>Nama Penyetor</th>
								<th>Rekening Penyetor</th>
								<th>Alamat Penyetor</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>#Pilih</th>
								<th>Nama Penyetor</th>
								<th>Rekening Penyetor</th>
								<th>Alamat Penyetor</th>
							</tr>
						</tfoot>
						<tbody>
							<?php 
								foreach($master_depositor_list->result() as $dep){	
							?>
							<tr>
								<td>
									<button onclick='choose_depo_id(<?php echo $dep->ObjectID;?>)' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
									  Pilih
									</button>
								</td>
								<td><?php echo $dep->Depositor_Name;?></td>
								<td><?php echo $dep->Depositor_Rec;?></td>
								<td><?php echo $dep->Depositor_Address;?></td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			  </div>
			  
			  <div class="mdl-layout__content">
				<div class="page-content" style="background-color:#fff;">
					<div>
						<div class="mdl-grid">
						  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet">
							<span class="mdl-layout-title" style="padding-bottom:10px;">Formulir <?php echo $title_1;?> (<?php echo $title_2;?>)</span>
								<div>
									<?php 
										$attribute = array('id'=>'frmadd','class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:20px 0;padding:2%');
										echo form_open('form_slip/update_transaction/'.$this->uri->segment(3).'/'.$this->uri->segment(4),$attribute);?>
									  <div style="float:left;width:100%">
									  <?php 
									  if($qry_frm->result() == 0){
										  
									  }else{
											foreach($qry_frm->result() as $fm){
											$val = '';
												$qry_value = $this->db->query("select Trans_No, Slip_Var_ID, Slip_Var_Value from tbl_SlipSetor_Transaction where Slip_Var_ID = '".$fm->ObjectID."' and Trans_No = '".$this->uri->segment(4)."'");
												foreach($qry_value->result() as $h){
													$val = $h->Slip_Var_Value;
												}
												if($fm->Slip_Var_Type == 'Boolean'){
												
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<input type="checkbox" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>" <?php echo $val == 'on'?'checked':'';?>>
											<label for="sample3" style="font-size:11px;"><?php echo $fm->Slip_Var_Name;?></label>
										</div>
									<?php
												}else if($fm->Slip_Var_Type == 'numeric'){
													if($fm->Slip_Var_Group == 'tanggal_digit'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" class="mdl-textfield__input tanggal_digit" maxlength="1" style="margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php					
													}else if($fm->Slip_Var_Group == 'nominal'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" onchange="numberFormat(<?php echo $fm->Slip_Field;?>);" class="mdl-textfield__input nominal" style="float:left;width:350px;margin-left:0px;margin-top:1px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
													}else if($fm->Slip_Var_Group == 'total'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" onchange="numberFormat(<?php echo $fm->Slip_Field;?>);" class="mdl-textfield__input total" style="float:left;width:350px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
													}else if($fm->Slip_Var_Group == 'nominal_reg'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" onchange="numberFormat(<?php echo $fm->Slip_Field;?>);" class="mdl-textfield__input nominal" style="margin-left:0px;margin-top:1px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
													}else if($fm->Slip_Var_Group == 'total_reg'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" onchange="numberFormat(<?php echo $fm->Slip_Field;?>);" class="mdl-textfield__input total" style="margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
													}else if($fm->Slip_Var_Group == 'inline_short'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" onchange="numberFormat(<?php echo $fm->Slip_Field;?>);" class="mdl-textfield__input" style="float:left;width:150px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
													}else if($fm->Slip_Var_Group == 'inline_long'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" onchange="numberFormat(<?php echo $fm->Slip_Field;?>);" class="mdl-textfield__input" style="float:left;width:350px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
													}else{
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input value="<?php echo $val;?>" onchange="numberFormat(<?php echo $fm->Slip_Field;?>);" class="mdl-textfield__input" style="margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
													}
												}else{
													if(substr($fm->Slip_Var_Function,0,9) == 'terbilang'){
									?>
									<script>
									$(document).ready(function() {
										setInterval(function(){//memanggil fungsi terbilang() dari file terbilang.js
											 var isi = document.getElementById('<?php echo substr($fm->Slip_Var_Function,10,100);?>').value;
											 var regex = new RegExp(',', 'g');
											 var hasil = terbilang(parseInt(isi.replace(regex,'')));
											 var hasil_div= document.getElementById('<?php echo $fm->Slip_Field;?>');
											 //masukkan hasil konversi ke dalam hasil_div
											 hasil_div.value = '';
											 if(hasil == ''){
												hasil_div.value = hasil;
											 }else{
												hasil_div.value = "# "+hasil+" Rupiah";
											 }
											 //alert(1);
										},500);
									} );
									</script>
									<?php
														if($fm->Slip_Var_Group == 'inline_short'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="margin-left:5px;float:left;width:150px;margin-right:5px;font-size:15px;background:#f6f6f6;color:#000;padding:10px;border:none;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else if($fm->Slip_Var_Group == 'inline_long'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="margin-left:5px;float:left;width:350px;margin-right:5px;font-size:15px;background:#f6f6f6;color:#000;padding:10px;border:none;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else{
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="font-size:15px;background:#f6f6f6;color:#000;padding:10px;border:none;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}	
													}else if($fm->Slip_Var_Function == 'tanggal'){
									?>
									  <link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css">
									  <script src="<?php echo base_url();?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
									  <script>
									  $( function() {
										$( "#<?php echo $fm->Slip_Field;?>" ).datepicker({
										  changeMonth: true,
										  changeYear: true
										});
									  } );
									  </script>
									<?php 
														if($fm->Slip_Var_Group == 'inline_short'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:150px;margin-left:5px;" type="text" disable id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else if($fm->Slip_Var_Group == 'inline_long'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:350px;margin-left:5px;" type="text" disable id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else{
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" type="text" disable id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}
													}else if($fm->Slip_Var_Function == 'customer'){
									?>
	
									<?php 
														if($fm->Slip_Var_Group == 'inline_short'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px;float:left;" id="search_cust" onclick="show_list_cust(<?php echo substr($fm->Slip_Field,16,2);?>)">search</i>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:150px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else if($fm->Slip_Var_Group == 'inline_long'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px;float:left;" id="search_cust" onclick="show_list_cust(<?php echo substr($fm->Slip_Field,16,2);?>)">search</i>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:350px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php 
														}else{
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px" id="search_cust" onclick="show_list_cust(<?php echo substr($fm->Slip_Field,16,2);?>)">search</i>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}
													}else if($fm->Slip_Var_Function == 'penyetor'){
									?>
										<script>
											function choose_depo_id(id){
												$(function(){
													$.ajax({
														url:'<?php echo base_url();?>index.php/form_slip/get_depo/'+id+'/',
														cache:false,
														type: "POST",
														dataType: 'json',
														success:function(result){
															$.each(result, function(i, data){
																$('#nama_penyetor').val(data.Depositor_Name);
																$('#alamat_penyetor').val(data.Depositor_Address);
																$('#telp_penyetor').val(data.Depositor_Telp);
																$('#no_rek_penyetor').val(data.Depositor_Rec);
																
															});
														}
													});
												});
												$('#container_depositor').fadeOut('slow');
											}
										</script>
									<?php 
														if($fm->Slip_Var_Group == 'inline_short'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px;float:left;" id="search_depo">search</i>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:150px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else if($fm->Slip_Var_Group == 'inline_long'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px;float:left;" id="search_depo">search</i>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:350px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php 
														}else{
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation" style="font-size:18px" id="search_depo">search</i>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}
													}else{
														if($fm->Slip_Var_Group == 'inline_short'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:150px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else if($fm->Slip_Var_Group == 'inline_long'){
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC;float:left;" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" value="<?php echo $val;?>" style="float:left;width:350px;margin-left:5px;" type="text" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php
														}else{
									?>
										<div style="<?php echo $fm->Slip_Var_Css;?>">
											<label style="font-size:12px;color:#46B6AC" for="sample3"><?php echo $fm->Slip_Var_Name;?></label>
											<input class="mdl-textfield__input" type="text" value="<?php echo $val;?>" id="<?php echo $fm->Slip_Field;?>" name="<?php echo $fm->Slip_Field;?>">
										</div>
									<?php				}	
													}
												}
											}
									  }
									  ?>
									  
										  <div style="float:left; margin-top:20px;">
											  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
												  Ubah
											  </button>
											  <a id="btnHapus" onclick="delete_slip_id('<?php echo $this->uri->segment(4);?>')" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
												  Hapus
											  </a>
											  <a id="btnKembali" href="<?php echo base_url().'index.php/form_slip/transaction_list/';?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
												  Kembali
											  </a>
										  </div>
									  </div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php echo $this->session->flashdata('change_result')?>
					<footer class="mdl-mega-footer">
					  <div class="mdl-mega-footer--middle-section">
						
					  </div>
					  <div class="mdl-mega-footer--bottom-section">
						<div class="mdl-logo">
						  More Information
						</div>
						<ul class="mdl-mega-footer--link-list">
						  <li><a href="https://www.goc.co.id/">Call IT Division | Programmer</a></li>
						</ul>
					  </div>
					</footer>
				</div>
			  </div>
			</div>
		</div>
	</body>
	<script src="<?php echo base_url();?>assets/confirm/jquery-confirm.min.js"></script>
	<script>
		$('#logout').confirm({
			title: '<span style="color:#FF6B6B;"><i class="fa fa-sign-out" style="margin-right:5px;"></i>Confirmation</span>',
			content: 'Anda yakin akan keluar dari aplikasi ini?',
			confirm: function(){
				window.location.replace("<?php echo base_url();?>index.php/app/logout_act/");
			},
			cancel: function(){
				$.alert('Canceled!');
			}
		});
		
		$('.tanggal_digit').keyup(function(e){
			if (e.which == 8){
				//backspace
				$(this).prevAll('input:first').focus();
			}
			else if(e.which > 47 && e.which < 58){
				$(this).closest('div').next().find(':input').first().focus();
			}
			else{
				$(this).val('');
				return false;
			}
		});
		
		function delete_id(id)
		{
			$.confirm({
				title: '<span style="color:#FF6B6B;"><i class="fa fa-exclamation" style="margin-right:5px;"></i>Confirmation</span>',
				content: 'Anda yakin mau menghapus data ini?',
				confirm: function(){
					window.location.href='<?php echo base_url();?>index.php/dashboard/del_master_type/'+id+'/';
				}
			});
		}
		
		function delete_slip_id(id)
		{
			$.confirm({
				title: '<span style="color:#FF6B6B;"><i class="fa fa-exclamation" style="margin-right:5px;"></i>Confirmation</span>',
				content: 'Anda yakin mau menghapus catatan transaksi ini?',
				confirm: function(){
					window.location.href='<?php echo base_url();?>index.php/index.php/form_slip/delete_transaction/'+id;
				}
			});
		}
		
		$(".nominal").change(function(){
			var sum = 0;
			// or $( 'input[name^="ingredient"]' )
			$( '.nominal' ).each( function( i , e ) {
				//var v = parseInt( $( e ).val() );
				var regex = new RegExp(',', 'g');
				var ii = $( e ).val();
				var v = parseInt( ii.replace(regex,'') );
				if ( !isNaN( v ) )
					sum += v;
			} );
			
			$(".total").val(numberFormatf (sum));
		});
		function set_total(){
			var sum = 0;
			// or $( 'input[name^="ingredient"]' )
			$( '.nominal' ).each( function( i , e ) {
				var regex = new RegExp(',', 'g');
				var ii = $( e ).val();
				var v = parseInt( ii.replace(regex,'') );
				if ( !isNaN( v ) )
					sum += v;
			} );
			
			$(".total").val(numberFormatf (sum));
		}
		
		$(".nominal_reg").change(function(){
			var sum = 0;
			// or $( 'input[name^="ingredient"]' )
			$( '.nominal_reg' ).each( function( i , e ) {
				var regex = new RegExp(',', 'g');
				var ii = $( e ).val();
				var v = parseInt( ii.replace(regex,'') );
				//var v = parseInt( $( e ).val() );
				if ( !isNaN( v ) )
					sum += v;
			} );
			
			$(".total").val(numberFormatf (sum));
		});
		function set_total_reg(){
			var sum = 0;
			// or $( 'input[name^="ingredient"]' )
			$( '.nominal_reg' ).each( function( i , e ) {
				var regex = new RegExp(',', 'g');
				var ii = $( e ).val();
				var v = parseInt( ii.replace(regex,'') );
				//var v = parseInt( $( e ).val() );
				if ( !isNaN( v ) )
					sum += v;
			} );
			
			$(".total_reg").val(numberFormatf (sum));
		}
		function currencyFormat (num) {
			var c = parseFloat(num);
			var a = String(c);
			return "IDR " + a.toString(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
		}
		
		function numberFormatf (num) {
			var c = parseFloat(num);
			var a = String(c);
			return a.toString(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
		}
		
		function numberFormat (num) {
			var c = parseFloat(num.value);
			var a = String(c);
			num.value=a.toString(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
			//$('#'+num).val();
		}
	</script>