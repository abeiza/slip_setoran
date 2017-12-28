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
			  </style>
			  
			  <div class="mdl-layout__content">
				<div class="page-content" style="background-color:#fff;">
					<div>
						<div class="mdl-grid">
						  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet">
							<span class="mdl-layout-title" style="padding-bottom:10px;">Master Slip Setoran</span>
							<button id="btnAdd" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
							  Tambah
							</button>
							<div style="float:left;width:100%;">&nbsp;</div>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display:block;padding-top:20px;float:left;">
								<select class="mdl-textfield__input" type="text" id="select_bank" name="bank_id">
									<option value="" selected disabled>Pilih Bank</option>
									<?php
										$query_list_bank = $this->db->query("select distinct ObjectID, Bank_Name from tbl_SlipSetor_Ms_Bank order by Bank_Name");
										if($query_list_bank->num_rows() == 0){
									?>
										<option disabled>Data Bank Kosong</option>
									<?php
										}else{
									?>
										<option value="<?php echo base_url();?>index.php/form_slip/master_slip/all/<?php echo $this->uri->segment(4);?>" selected>Semua Bank</option>
									<?php
											foreach($query_list_bank->result() as $bank){
									?>
												<option value="<?php echo base_url();?>index.php/form_slip/master_slip/<?php echo $bank->ObjectID;?>/<?php echo $this->uri->segment(4) == ''?'all':$this->uri->segment(4);?>" 
												<?php echo $bank->ObjectID == $this->uri->segment(3)?'selected':'';?>><?php echo $bank->Bank_Name;?></option>
									<?php
											}
										}
									?>
								</select>
								<label style="font-size:12px;color:#46B6AC" for="sample3">Pilih Bank</label>
							</div>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display:block;padding-top:20px;float:left;margin-left:10px;">
								<select class="mdl-textfield__input" type="text" id="select_slip" name="bank_id">
									<option value="" selected disabled>Pilih Tipe Setoran</option>
									<?php
										$query_list_slip = $this->db->query("select distinct ObjectID, Slip_Name from tbl_SlipSetor_Ms_Type_Slip order by Slip_Name");
										if($query_list_slip->num_rows() == 0){
									?>
										<option disabled>Data Tipe Setoran Kosong</option>
									<?php
										}else{
									?>
										<option value="<?php echo base_url();?>index.php/form_slip/master_slip/<?php echo $this->uri->segment(3);?>/all" selected>Semua Slip Setor</option>
									<?php
											foreach($query_list_slip->result() as $slp){
									?>
												<option value="<?php echo base_url();?>index.php/form_slip/master_slip/<?php echo $this->uri->segment(3);?>/<?php echo $slp->ObjectID;?>" 
												<?php echo $slp->ObjectID == $this->uri->segment(4)?'selected':'';?>><?php echo $slp->Slip_Name;?></option>
									<?php
											}
										}
									?>
								</select>
								<label style="font-size:12px;color:#46B6AC" for="sample3">Pilih Tipe Setoran</label>
							</div>
							<div style="float:left;width:100%;">&nbsp;</div>
							
							<div>
								<?php 
									$attribute = array('id'=>'frmadd','class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:20px 0;padding:2%');
									echo form_open('dashboard/add_master_slip/',$attribute);?>
								  <div style="width:50%;float:left;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Input Data</span>
							
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="slip_name" name="slip_name">
									<label class="mdl-textfield__label" for="sample3">Nama Slip</label>
								  </div>
							
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="typeslip_id" name="typeslip_id">
										<option value="" selected disabled>Pilih Tipe Slip</option>
										<?php 
											if($query_list_type->num_rows() == 0){
										?>
											<option disabled>Tipe Slip Kosong</option>
										<?php
											}else{
												foreach($query_list_type->result() as $ty){
													echo "<option value=".$ty->ObjectID.">".$ty->Slip_Name."</option>";
												}
											}
										?>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Tipe Slip</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="bank_id" name="bank_id">
										<option value="" selected disabled>Pilih Bank</option>
										<?php 
											if($query_list_bank->num_rows() == 0){
										?>
											<option disabled>Data Bank Kosong</option>
										<?php
											}else{
												foreach($query_list_bank->result() as $bnk){
													echo "<option value=".$bnk->ObjectID.">".$bnk->Bank_Name." (".$bnk->Bank_ID.")</option>";
												}
											}
										?>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Bank</label>
								  </div>
								   
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="slip_status" name="slip_status">
										<option value="" selected disabled>Status</option>
										<option value="1">Aktif</option>
										<option value='0'>Tidak Aktif</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Status Penerima</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" type="text" rows= "3" id="slip_memo" name="slip_memo" ></textarea>
									<label style="font-size:12px;color:#46B6AC" for="sample5">Catatan</label>
								  </div>
								  
								  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
									  Simpan
								  </button>
								  <a id="btnbtlAdd" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
									  Batal
								  </a>
								  </div>
								</form>
							</div>
							
							
							<div class="frmedit">
								<?php 
									$attribute1 = array('class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:auto;padding:2%;background:#fff;position:fixed;');
									echo form_open('dashboard/update_master_slip/',$attribute1);?>
								<div style="width:50%;float:right;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Ubah Data</span>
								  <input style="display:none;" type="text" id="objectid" name="objectid">
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_slip_name" name="e_slip_name">
									<label style="font-size:12px;color:#46B6AC" for="sample3">Nama Slip</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="e_typeslip_id" name="e_typeslip_id">
										<option value="" selected disabled>Pilih Tipe Slip</option>
										<?php 
											if($e_query_list_type->num_rows() == 0){
										?>
											<option disabled>Tipe Slip Kosong</option>
										<?php
											}else{
												foreach($e_query_list_type->result() as $typ){
													echo "<option value=".$typ->ObjectID.">".$typ->Slip_Name."</option>";
												}
											}
										?>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Tipe Slip</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="e_bank_id" name="e_bank_id">
										<option value="" selected disabled>Pilih Bank</option>
										<?php 
											if($e_query_list_bank->num_rows() == 0){
										?>
											<option disabled>Data Bank Kosong</option>
										<?php
											}else{
												foreach($e_query_list_bank->result() as $bnk){
													echo "<option value=".$bnk->ObjectID.">".$bnk->Bank_Name." (".$bnk->Bank_ID.")</option>";
												}
											}
										?>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Bank</label>
								  </div>
								   
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="e_slip_status" name="e_slip_status">
										<option value="" selected disabled>Status</option>
										<option value="1">Aktif</option>
										<option value='0'>Tidak Aktif</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Status Penerima</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" type="text" rows= "3" id="e_slip_memo" name="e_slip_memo" ></textarea>
									<label style="font-size:12px;color:#46B6AC" for="sample5">Catatan</label>
								  </div>
								  
								  
								  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
									  Ubah
								  </button>
								  <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="btnbtledit">
									  Batal
								  </a>
								</div>
								</form>
							</div>
							
							<table id="example" class="mdl-data-table" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#ID</th>
										<th>Nama Slip</th>
										<th>Tipe Slip</th>
										<th>Bank</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#ID</th>
										<th>Nama Slip</th>
										<th>Tipe Slip</th>
										<th>Bank</th>
										<th>Status</th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php 
										foreach($master_sliptt_list->result() as $sl){	
									?>
									<tr>
										<td><?php echo $sl->ObjectID;?></td>
										<td><a style="cursor:pointer" onclick='edit_data(<?php echo $sl->ObjectID;?>)'><?php echo $sl->Slip_Name_e;?></a></td>
										<td><?php echo $sl->Slip_Name;?></td>
										<td><?php echo $sl->Bank_Name;?></td>
										<td><?php echo $sl->Slip_Status == '1'?'Aktif':'Tidak Aktif';?></td>
										<td>
											<button onclick='delete_id(<?php echo $sl->ObjectID;?>)' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
											  Hapus
											</button>
											
											<a href="<?php echo base_url().'index.php/dashboard/master_var_list/'.$sl->ObjectID;?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
											  Isi Variabel
											</a>
											
											<a id="tinjau" onclick="window.open('<?php echo base_url();?>index.php/form_slip/form_review/<?php echo $sl->ObjectID?>','mywindow', 'left=0,top=170')" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
											  Tinjau
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