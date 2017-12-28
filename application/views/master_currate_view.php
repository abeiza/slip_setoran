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
							url:'<?php echo base_url();?>index.php/dashboard/edit_master_currate/'+id+'/',
							cache:false,
							type: "POST",
							dataType: 'json',
							success:function(result){
								$.each(result, function(i, data){
									$('#e_bank_id').val(data.Bank_ID);
									$('#e_year').val(data.Year);
									$('#e_month').val(data.Month);
									$('#e_curr_id').val(data.Curr_ID);
									$('#e_rate').val(data.Rate);
									$('#objectid').val(data.ObjectID);
								});
							}
						});
					});
					$('.frmedit').show('slow').css('display', 'flex');
				}
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
							<span class="mdl-layout-title" style="margin-bottom:10px;">Currency Rate</span>
							<button id="btnAdd" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
							  Tambah
							</button>
							<div>
								<?php 
									$attribute = array('id'=>'frmadd','class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:20px 0;padding:2%');
									echo form_open('dashboard/add_master_currate/',$attribute);?>
								  <div style="width:50%;float:left;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Input Data</span>
							
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="year" name="year">
									<label class="mdl-textfield__label" for="sample3">Tahun</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="month" name="month">
									<label class="mdl-textfield__label" for="sample3">Bulan</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="bank_id" name="bank_id">
										<option value="" selected disabled>Pilih Data Bank</option>
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
									<select class="mdl-textfield__input" type="text" id="curr_id" name="curr_id">
										<option value="" selected disabled>Pilih Data Mata Uang</option>
										<?php 
											if($query_list_curr->num_rows() == 0){
										?>
											<option disabled>Data Mata Uang Kosong</option>
										<?php
											}else{
												foreach($query_list_curr->result() as $curr){
													echo "<option value=".$curr->ObjectID.">".$curr->Curr_Name." (".$curr->Curr_ShotID.")</option>";
												}
											}
										?>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Mata Uang</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="rate" name="rate">
									<label class="mdl-textfield__label" for="sample3">Rate</label>
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
									echo form_open('dashboard/update_master_currate/',$attribute1);?>
								<div style="width:50%;float:right;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Ubah Data</span>
								  <input style="display:none;" type="text" id="objectid" name="objectid">
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="e_year" name="e_year">
									<label style="font-size:12px;color:#46B6AC" for="sample3">Tahun</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="e_month" name="e_month">
									<label style="font-size:12px;color:#46B6AC" for="sample3">Bulan</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="e_bank_id" name="e_bank_id">
										<option value="" selected disabled>Pilih Data Bank</option>
										<?php 
											if($query_list_bank_e->num_rows() == 0){
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
									<select class="mdl-textfield__input" type="text" id="e_curr_id" name="e_curr_id">
										<option value="" selected disabled>Pilih Data Mata Uang</option>
										<?php 
											if($query_list_curr_e->num_rows() == 0){
										?>
											<option disabled>Data Mata Uang Kosong</option>
										<?php
											}else{
												foreach($query_list_curr->result() as $curr){
													echo "<option value=".$curr->ObjectID.">".$curr->Curr_Name." (".$curr->Curr_ShotID.")</option>";
												}
											}
										?>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Mata Uang</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="e_rate" name="e_rate">
									<label style="font-size:12px;color:#46B6AC" for="sample3">Rate</label>
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
										<th>#ID Rate</th>
										<th>Bank</th>
										<th>Tahun</th>
										<th>Bulan</th>
										<th>Mata Uang</th>
										<th>Rate</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#ID Rate</th>
										<th>Bank</th>
										<th>Tahun</th>
										<th>Bulan</th>
										<th>Mata Uang</th>
										<th>Rate</th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php 
										foreach($query_list_currate->result() as $curt){	
									?>
									<tr>
										<td><?php echo $curt->ObjectID;?></td>
										<td><a style="cursor:pointer" onclick='edit_data(<?php echo $curt->ObjectID;?>)'><?php echo $curt->Bank_Name;?></a></td>
										<td><?php echo $curt->Year;?></td>
										<td><?php echo date('F', mktime(0, 0, 0, $curt->Month, 10));?></td>
										<td><?php echo $curt->Curr_Name;?></td>
										<td><?php echo number_format($curt->Rate,2);?></td>
										<td>
											<button onclick='delete_id(<?php echo $curt->ObjectID;?>)' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
											  Hapus
											</button>
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
				content: 'Anda yakin mau manghapus record ini?',
				confirm: function(){
					window.location.href='<?php echo base_url();?>index.php/dashboard/del_master_currate/'+id+'/';
				},
				cancel: function(){
					$.alert('Canceled!');
				}
			});
		}
	</script>