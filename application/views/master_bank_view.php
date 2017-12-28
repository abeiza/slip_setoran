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
							url:'<?php echo base_url();?>index.php/dashboard/edit_master_bank/'+id+'/',
							cache:false,
							type: "POST",
							dataType: 'json',
							success:function(result){
								$.each(result, function(i, data){
									$('#e_kode_bank').val(data.Bank_ID);
									$('#e_nama_bank').val(data.Bank_Name);
									$('#e_keterangan_bank').val(data.Bank_Desc);
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
							<span class="mdl-layout-title" style="margin-bottom:10px;">Master Bank</span>
							<button id="btnAdd" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
							  Tambah
							</button>
							
							<div>
								<?php 
									$attribute = array('id'=>'frmadd','class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:20px 0;padding:2%');
									echo form_open('dashboard/add_master_bank/',$attribute);?>
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Input Data</span>
							
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="kode_bank" name="kode_bank">
									<label class="mdl-textfield__label" for="sample3">Kode Bank</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="nama_bank" name="nama_bank">
									<label class="mdl-textfield__label" for="sample3">Nama Bank</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" type="text" rows= "3" id="keterangan_bank" name="keterangan_bank" ></textarea>
									<label class="mdl-textfield__label" for="sample5">Keterangan Bank</label>
								  </div>
								  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
									  Simpan
								  </button>
								  <a id="btnbtlAdd" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
									  Batal
								  </a>
								</form>
							</div>
							<div  class="frmedit">
								<?php 
									$attribute1 = array('class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:auto;padding:2%;background:#fff;position:fixed;');
									echo form_open('dashboard/update_master_bank/',$attribute1);?>
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Ubah Data</span>
								  <input style="display:none;" type="text" id="objectid" name="objectid">
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_kode_bank" name="e_kode_bank">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Kode Bank</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_nama_bank" name="e_nama_bank">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Nama Bank</label>
								  </div>
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" type="text" rows= "3" id="e_keterangan_bank" name="e_keterangan_bank" ></textarea>
									<label  style="font-size:12px;color:#46B6AC" for="sample5">Keterangan Bank</label>
								  </div>
								  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
									  Ubah
								  </button>
								  <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="btnbtledit">
									  Batal
								  </a>
								</form>
							</div>
							<table id="example" class="mdl-data-table" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Bank Code</th>
										<th>Bank Name</th>
										<th>Descriptions</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Bank Code</th>
										<th>Bank Name</th>
										<th>Descriptions</th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php 
										foreach($query_list_bank->result() as $bank){	
									?>
									<tr>
										<td><?php echo $bank->Bank_ID;?></td>
										<td><a style="cursor:pointer" onclick='edit_data(<?php echo $bank->ObjectID;?>)'><?php echo $bank->Bank_Name;?></a></td>
										<td><?php echo $bank->Bank_Desc;?></td>
										<td>
											<button onclick='delete_id(<?php echo $bank->ObjectID;?>)' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
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
				content: 'Anda yakin ingin menghapus record ini?',
				confirm: function(){
					window.location.href='<?php echo base_url();?>index.php/dashboard/del_master_bank/'+id+'/';
				},
				cancel: function(){
					$.alert('Canceled!');
				}
			});
		}
	</script>