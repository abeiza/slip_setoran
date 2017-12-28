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
							url:'<?php echo base_url();?>index.php/dashboard/edit_master_depositor/'+id+'/',
							cache:false,
							type: "POST",
							dataType: 'json',
							success:function(result){
								$.each(result, function(i, data){
									$('#e_depositor_name').val(data.Depositor_Name);
									$('#e_depositor_address').val(data.Depositor_Address);
									$('#e_depositor_phone').val(data.Depositor_Phone);
									$('#e_depositor_rec').val(data.Depositor_Rec);
									$('#e_depositor_status').val(data.Depositor_Status);
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
							<span class="mdl-layout-title" style="padding-bottom:10px;">Master Penyetor</span>
							<button id="btnAdd" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
							  Tambah
							</button>
							<div>
								<?php 
									$attribute = array('id'=>'frmadd','class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:20px 0;padding:2%');
									echo form_open('dashboard/add_master_depositor/',$attribute);?>
								  <div style="width:50%;float:left;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Input Data</span>
							
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="depositor_name" name="depositor_name">
									<label class="mdl-textfield__label" for="sample3">Nama Penyetor</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" type="text" rows= "3" id="depositor_address" name="depositor_address" ></textarea>
									<label class="mdl-textfield__label" for="sample5">Alamat</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="depositor_phone" name="depositor_phone">
									<label class="mdl-textfield__label" for="sample3">Telp</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="depositor_rec" name="depositor_rec">
									<label class="mdl-textfield__label" for="sample3">Rekening Penyetor</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="depositor_status" name="depositor_status">
										<option value="" selected disabled>Pilih Status Penyetor</option>
										<option value="1">Aktif</option>
										<option value='0'>Tidak Aktif</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Status Penyetor</label>
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
									echo form_open('dashboard/update_master_depositor/',$attribute1);?>
								<div style="width:50%;float:right;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Ubah Data</span>
								  <input style="display:none;" type="text" id="objectid" name="objectid">
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_depositor_name" name="e_depositor_name">
									<label style="font-size:12px;color:#46B6AC" for="sample3">Nama Penyetor</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" type="text" rows= "3" id="e_depositor_address" name="e_depositor_address" ></textarea>
									<label style="font-size:12px;color:#46B6AC" for="sample5">Alamat</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_depositor_phone" name="e_depositor_phone">
									<label style="font-size:12px;color:#46B6AC" for="sample3">Telp</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_depositor_rec" name="e_depositor_rec">
									<label style="font-size:12px;color:#46B6AC" for="sample3">Rekening Penyetor</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="e_depositor_status" name="e_depositor_status">
										<option value="" selected disabled>Pilih Status Penyetor</option>
										<option value="1">Aktif</option>
										<option value='0'>Tidak Aktif</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Status Penyetor</label>
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
										<th>Nama Penyetor</th>
										<th>Alamat Penyetor</th>
										<th>Telp Penyetor</th>
										<th>Rekening Penyetor</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#ID</th>
										<th>Nama Penyetor</th>
										<th>Alamat Penyetor</th>
										<th>Telp Penyetor</th>
										<th>Rekening Penyetor</th>
										<th>Status</th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php 
										foreach($master_depositor_list->result() as $dep){	
									?>
									<tr>
										<td><?php echo $dep->ObjectID;?></td>
										<td><a style="cursor:pointer" onclick='edit_data(<?php echo $dep->ObjectID;?>)'><?php echo $dep->Depositor_Name;?></a></td>
										<td><?php echo $dep->Depositor_Address;?></td>
										<td><?php echo $dep->Depositor_Phone;?></td>
										<td><?php echo $dep->Depositor_Rec;?></td>
										<td><?php echo $dep->Depositor_Status == '1'?'Aktif':'Tidak Aktif';?></td>
										<td>
											<button onclick='delete_id(<?php echo $dep->ObjectID;?>)' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
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
				content: 'Anda yakin mau menghapus record ini?',
				confirm: function(){
					window.location.href='<?php echo base_url();?>index.php/dashboard/del_master_depositor/'+id+'/';
				},
				cancel: function(){
					$.alert('Canceled!');
				}
			});
		}
	</script>