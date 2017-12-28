			  <script>
			  $(document).ready(function() {
					$('#example').DataTable( {
						columnDefs: [
							{
								targets: [ 0, 1, 2 ,3,4,5,6,7],
								className: 'mdl-data-table__cell--non-numeric', 
								class:"wrapok"
							}
						],
						"order": [[ 0, "desc" ]]
					} );
					
					$('#btnbtledit').click(function(){
						$('.frmedit').hide('slow');
					});
					
					$('#btnAdd').click(function(){
						$('#frmadd').slideDown('slow');
					});
					
					$('#btnbtlAdd').click(function(){
						$('#frmadd').slideUp('slow');
					});
					
					$('#notif').click(function(){
						$('#notif').slideUp('slow');
					});
				} );
			  </script>
			  <script>
				function edit_data(id){
					$(function(){
						$.ajax({
							url:'<?php echo base_url();?>index.php/dashboard/edit_master_slip/'+id+'/',
							cache:false,
							type: "POST",
							dataType: 'json',
							success:function(result){
								$.each(result, function(i, data){
									$('#e_slip_name').val(data.Slip_Name_e);
									$('#e_typeslip_id').val(data.TypeSlip_ID);
									$('#e_bank_id').val(data.Bank_ID);
									$('#e_slip_status').val(data.Slip_Status);
									$('#e_slip_memo').val(data.Slip_Memo);
									$('#objectid').val(data.ObjectID);
								});
							}
						});
					});
					$('.frmedit').show('slow').css('display', 'flex');
				}
			  </script>
			  <script type="text/javascript">
				jQuery(function () {
					// remove the below comment in case you need chnage on document ready
					// location.href=jQuery("#selectbox").val(); 
					jQuery("#select_bank").change(function () {
						location.href = jQuery(this).val();
					})
					
					jQuery("#select_slip").change(function () {
						location.href = jQuery(this).val();
					})
					
					jQuery("#from").change(function () {
						var regex = '\/';
						var from1 = jQuery("#from").val().replace(regex,'');
						var from2 = from1.replace(regex,'');
						//alert(from2);
						if(from2 == ''){
							location.href = '<?php echo base_url();?>index.php/form_slip/transaction_bank/<?php echo $this->uri->segment(3)== ''?'all':$this->uri->segment(3);?>/<?php echo $this->uri->segment(4)== ''?'all':$this->uri->segment(4);?>/all/<?php echo $this->uri->segment(6)== ''?'all':$this->uri->segment(6);?>/';
						}else{
							location.href = '<?php echo base_url();?>index.php/form_slip/transaction_bank/<?php echo $this->uri->segment(3)== ''?'all':$this->uri->segment(3);?>/<?php echo $this->uri->segment(4)== ''?'all':$this->uri->segment(4);?>/'+from2+'/<?php echo $this->uri->segment(6)== ''?'all':$this->uri->segment(6);?>/';
						}
					})
					
					jQuery("#to").change(function () {
						var regex = '\/';
						var to1 = jQuery("#to").val().replace(regex,'');
						var to2 = to1.replace(regex,'');
						if(to2 == ''){
							location.href = '<?php echo base_url();?>index.php/form_slip/transaction_bank/<?php echo $this->uri->segment(3)== ''?'all':$this->uri->segment(3);?>/<?php echo $this->uri->segment(4)== ''?'all':$this->uri->segment(4);?>/<?php echo $this->uri->segment(5)== ''?'all':$this->uri->segment(5);?>/all/';
						}else{
							location.href = '<?php echo base_url();?>index.php/form_slip/transaction_bank/<?php echo $this->uri->segment(3)== ''?'all':$this->uri->segment(3);?>/<?php echo $this->uri->segment(4)== ''?'all':$this->uri->segment(4);?>/<?php echo $this->uri->segment(5)== ''?'all':$this->uri->segment(5);?>/'+to2+'/';
						}
					})
				})     
			  </script>
			  <style>
				.frmedit{
					display:none;
					position: fixed;
					width: 100%;
					height: 100%;
					left: 0;
					z-index: 999;
					top: 0;
					background: rgba(0,0,0,0.5);
					float: left;
					//display: flex;
					align-items: center;
				}
				
				#frmadd{
					display:none;
				}
				
				td {
					white-space: nowrap;
				}
				 
				td.wrapok {
					white-space:normal
				}
			  </style>
			  <link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css">
			  <script src="<?php echo base_url();?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
			  <script>
			  $( function() {
				$( "#from" ).datepicker({
				  changeMonth: true,
				  changeYear: true
				});
				
				$( "#to" ).datepicker({
				  changeMonth: true,
				  changeYear: true
				});
			  } );
			  </script>
			  
			  <div class="mdl-layout__content">
				<div class="page-content" style="background-color:#fff;">
					<div>
						<div class="mdl-grid">
						  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet">
							<span class="mdl-layout-title" style="padding-bottom:10px;">Daftar Transaksi</span>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display:block;padding-top:20px;float:left;">
								<select class="mdl-textfield__input" type="text" id="select_bank" name="bank_id">
									<option value="" selected disabled>Pilih Bank</option>
									<?php
										$query_list_bank = $this->db->query("select distinct Bank_ID, Bank_Name from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on  
										trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID 
										order by Bank_Name");
										if($query_list_bank->num_rows() == 0){
									?>
										<option disabled>Data Bank Kosong</option>
									<?php
										}else{
									?>
										<option value="<?php echo base_url();?>index.php/form_slip/transaction_bank/all/<?php echo $this->uri->segment(4);?>/all/all/" selected>Semua Bank</option>
									<?php
											foreach($query_list_bank->result() as $bank){
									?>
												<option value="<?php echo base_url();?>index.php/form_slip/transaction_bank/<?php echo $bank->Bank_ID;?>/<?php echo $this->uri->segment(4) == ''?'all':$this->uri->segment(4);?>/<?php echo $this->uri->segment(5)== ''?'all':$this->uri->segment(5);?>/<?php echo $this->uri->segment(6)== ''?'all':$this->uri->segment(6);?>" 
												<?php echo $bank->Bank_ID == $this->uri->segment(3)?'selected':'';?>><?php echo $bank->Bank_Name;?></option>
									<?php
											}
										}
									?>
								</select>
								<label style="font-size:12px;color:#46B6AC" for="sample3">Pilih Bank</label>
							</div>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display:block;padding-top:20px;float:left;margin-left:10px;">
								<select class="mdl-textfield__input" type="text" id="select_slip" name="bank_id">
									<option value="" selected disabled>Pilih Slip Setoran</option>
									<?php
										$query_list_slip = $this->db->query("select distinct slip.ObjectID, Slip_Name_e from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var as var on  
										trans.Slip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on var.Slip_ID = slip.ObjectID 
										order by Slip_Name_e");
										if($query_list_slip->num_rows() == 0){
									?>
										<option disabled>Data Slip Setoran Kosong</option>
									<?php
										}else{
									?>
										<option value="<?php echo base_url();?>index.php/form_slip/transaction_bank/<?php echo $this->uri->segment(3);?>/all/all/all/" selected>Semua Slip Setor</option>
									<?php
											foreach($query_list_slip->result() as $slp){
									?>
												<option value="<?php echo base_url();?>index.php/form_slip/transaction_bank/<?php echo $this->uri->segment(3)==''?'all':$this->uri->segment(3);?>/<?php echo $slp->ObjectID;?>/<?php echo $this->uri->segment(5)==''?'all':$this->uri->segment(5);?>/<?php echo $this->uri->segment(6)==''?'all':$this->uri->segment(6);;?>" 
												<?php echo $slp->ObjectID == $this->uri->segment(4)?'selected':'';?>><?php echo $slp->Slip_Name_e;?></option>
									<?php
											}
										}
									?>
								</select>
								<label style="font-size:12px;color:#46B6AC" for="sample3">Pilih Slip Setoran</label>
							</div>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display:block;padding-top:20px;float:left;margin-left:10px;">
								<input class="mdl-textfield__input" type="text" disable id="from" name="from" value="<?php if($this->uri->segment(5)== '' or $this->uri->segment(5)== 'all'){echo '';}else{echo substr($this->uri->segment(5),0,2).'/'.substr($this->uri->segment(5),2,2).'/'.substr($this->uri->segment(5),4,4);}?>">
								<label style="font-size:12px;color:#46B6AC" for="sample3">Dari Tanggal</label>
							</div>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display:block;padding-top:20px;float:left;margin-left:10px;">
								<input class="mdl-textfield__input" type="text" disable id="to" name="to" value="<?php if($this->uri->segment(6)== '' or $this->uri->segment(6)== 'all'){echo '';}else{echo substr($this->uri->segment(6),0,2).'/'.substr($this->uri->segment(6),2,2).'/'.substr($this->uri->segment(6),4,4);}?>">
								<label style="font-size:12px;color:#46B6AC" for="sample3">Sampai Tanggal</label>
							</div>
							
							<div style="float:left;width:100%;">&nbsp;</div>
							<table id="example" class="mdl-data-table" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#No. Transaksi</th>
										<th>Nama Bank</th>
										<th>Nama Slip Setoran</th>
										<th>Dikirim kepada</th>
										<th>No. Rekening</th>
										<th>Tanggal Setor</th>
										<th>Nominal Setor</th>
										<th>Keterangan</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#No. Transaksi</th>
										<th>Nama Bank</th>
										<th>Nama Slip Setoran</th>
										<th>Dikirim kepada</th>
										<th>No. Rekening</th>
										<th>Tanggal Setor</th>
										<th>Nominal Setor</th>
										<th>Keterangan</th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php 
										foreach($qry_frm->result() as $tr){	
									?>
									<tr>
										<td><?php echo $tr->Trans_No;?></td>
										<td><?php echo $tr->Bank_Name;?></a></td>
										<td><?php echo $tr->Slip_Name;?></td>
										<td><?php echo $tr->Receiver_Name;?></td>
										<td><?php echo $tr->Receiver_Rek;?></td>
										<td><?php echo $tr->Trans_Dt;?></td>
										<td><?php echo number_format ($tr->Trans_Amount);?></td>
										<td><?php echo $tr->Trans_Desc;?></td>
										<td>
											<button onclick="window.open('<?php echo base_url();?>index.php/form_slip/get_print/<?php echo $tr->Trans_No?>','mywindow', 'width=900,height=555,left=160,top=170')" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
											  Cetak
											</button>
											
											<a href="<?php echo base_url().'index.php/form_slip/form_detail/'.$tr->Slip_ID.'/'.$tr->Trans_No.'/';?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
											  Tampilkan Detail
											</a>
										</td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
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
		
		function delete_id(id)
		{
			$.confirm({
				title: '<span style="color:#FF6B6B;"><i class="fa fa-exclamation" style="margin-right:5px;"></i>Confirmation</span>',
				content: 'Anda yakin mau menghapus record ini?',
				confirm: function(){
					window.location.href='<?php echo base_url();?>index.php/dashboard/del_master_slip/'+id+'/';
				},
				cancel: function(){
					$.alert('Canceled!');
				}
			});
		}
	</script>