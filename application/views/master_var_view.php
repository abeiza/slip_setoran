			  <script>
			  $(document).ready(function() {
					$('#example').DataTable( {
						columnDefs: [
							{
								targets: [ 0, 1, 2 ],
								className: 'mdl-data-table__cell--non-numeric'
							}
						],
						"order": [[ 0, "asc" ]]
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
				function edit_data(idh, idd){
					$(function(){
						$.ajax({
							url:'<?php echo base_url();?>index.php/dashboard/edit_master_var/'+idh+'/'+idd+'/',
							cache:false,
							type: "POST",
							dataType: 'json',
							success:function(result){
								$.each(result, function(i, data){
									$('#e_field').val(data.Slip_Field);
									$('#e_label').val(data.Slip_Var_Name);
									$('#e_tipe_data').val(data.Slip_Var_Type);
									$('#e_margin_top').val(data.Slip_Var_Margin_Top);
									$('#e_margin_left').val(data.Slip_Var_Margin_Left);
									$('#e_align').val(data.Slip_Var_Align);
									$('#e_group').val(data.Slip_Var_Group);
									$('#e_border').val(data.Slip_Var_Border);
									$('#e_function').val(data.Slip_Var_Function);
									$('#e_css').val(data.Slip_Var_Css);
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
							<span class="mdl-layout-title" style="padding-bottom:10px;">Daftar Variabel</span>
							<button id="btnAdd" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
							  Tambah
							</button>
							<a href="<?php echo base_url().'index.php/form_slip/form/'.$this->uri->segment(3);?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Isi Formulir</a>
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="display:block;padding-top:20px;">
								<select class="mdl-textfield__input" type="text" id="select_slip" name="bank_id">
									<option value="" selected disabled>Pilih Slip Setoran</option>
									<?php 
										if($query_list_slip->num_rows() == 0){
									?>
										<option disabled>Data Slip Setoran Kosong</option>
									<?php
										}else{
											foreach($query_list_slip->result() as $slp){
									?>
												<option value="<?php echo $slp->ObjectID;?>" 
												<?php echo $slp->ObjectID == $this->uri->segment(3)?'selected':'';?>><?php echo  "(".$slp->Bank_Name.")  ".$slp->Slip_Name_e;?></option>
									<?php
											}
										}
									?>
								</select>
								<label style="font-size:12px;color:#46B6AC" for="sample3">Pilih Slip Setoran</label>
							</div>
							<div>
								<?php 
									$attribute = array('id'=>'frmadd','class'=>'mdl-shadow--2dp','style'=>'float:left;width:95%;margin:20px 0;padding:2%');
									echo form_open('dashboard/add_master_var/'.$this->uri->segment(3),$attribute);?>
								  <div style="width:50%;float:left;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Input Data</span>
							
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" rows= "3" id="field" name="field"/>
									<label class="mdl-textfield__label" for="sample5">Field</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="label" name="label">
									<label class="mdl-textfield__label" for="sample3">Label</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="tipe_data" name="tipe_data">
									<label class="mdl-textfield__label" for="sample3">Tipe Data</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="margin_top" name="margin_top">
									<label class="mdl-textfield__label" for="sample3">Margin Atas</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="margin_left" name="margin_left">
									<label class="mdl-textfield__label" for="sample3">Margin Kiri</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="align" name="align">
										<option value="" selected disabled>Pilih Rata Kanan / Kiri</option>
										<option value="0">Kanan</option>
										<option value='1'>Kiri</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Rata Kanan / Kiri</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="group" name="group">
									<label class="mdl-textfield__label" for="sample3">Grup</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="border" name="border">
										<option value="" selected disabled>Pilih Border</option>
										<option value="0">Tidak</option>
										<option value='1'>Ya</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Pilih Border</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="function" name="function">
									<label class="mdl-textfield__label" for="sample3">Function</label>
								  </div>
								  
								   <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" id="css" name="css"></textarea>
									<label style="font-size:12px;color:#46B6AC" for="sample3">CSS Script</label>
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
									echo form_open('dashboard/update_master_var/'.$this->uri->segment(3),$attribute1);?>
								<div style="width:50%;float:right;">
								  <span class="mdl-layout-title" style="margin-bottom:10px;">Ubah Data</span>
								  <input style="display:none;" type="text" id="objectid" name="objectid">
						
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" rows= "3" id="e_field" name="e_field"/>
									<label  style="font-size:12px;color:#46B6AC" for="sample5">Field</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_label" name="e_label">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Label</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_tipe_data" name="e_tipe_data">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Tipe Data</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_margin_top" name="e_margin_top">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Margin Atas</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_margin_left" name="e_margin_left">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Margin Kiri</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="e_align" name="e_align">
										<option value="" selected disabled>Pilih Rata Kanan / Kiri</option>
										<option value="0">Kanan</option>
										<option value='1'>Kiri</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Rata Kanan / Kiri</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_group" name="e_group">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Grup</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<select class="mdl-textfield__input" type="text" id="e_border" name="e_border">
										<option value="" selected disabled>Pilih Border</option>
										<option value="0">Tidak</option>
										<option value='1'>Ya</option>
									</select>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Pilih Border</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<input class="mdl-textfield__input" type="text" id="e_function" name="e_function">
									<label  style="font-size:12px;color:#46B6AC" for="sample3">Function</label>
								  </div>
								  
								  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="float:left;padding-right:10px;">
									<textarea class="mdl-textfield__input" id="e_css" name="e_css"></textarea>
									<label style="font-size:12px;color:#46B6AC" for="sample3">Css Script</label>
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
										<th>Slip</th>
										<th>Field</th>
										<th>Label</th>
										<th>Margin Atas</th>
										<th>Margin Left</th>
										<th></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#ID</th>
										<th>Slip</th>
										<th>Field</th>
										<th>Label</th>
										<th>Margin Atas</th>
										<th>Margin Left</th>
										<th></th>
									</tr>
								</tfoot>
								<tbody>
									<?php 
										foreach($master_var_list->result() as $var){	
									?>
									<tr>
										<td><?php echo $var->ObjectID;?></td>
										<td><?php echo $var->Slip_Name;?></td>
										<td><a style="cursor:pointer" onclick='edit_data(<?php echo $var->Slip_ID;?>,<?php echo $var->ObjectID;?>)'><?php echo $var->Slip_Field;?></a></td>
										<td><?php echo $var->Slip_Var_Name;?></td>
										<td><?php echo $var->Slip_Var_Margin_Top;?></td>
										<td><?php echo $var->Slip_Var_Margin_Left;?></td>
										<td>
											<button onclick='delete_id(<?php echo $var->Slip_ID;?>,<?php echo $var->ObjectID;?>)' class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
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
				content: 'Anda yakin untuk penghapusan record ini?',
				confirm: function(){
					window.location.href='<?php echo base_url();?>index.php/dashboard/del_master_var/'+id+'/';
				},
				cancel: function(){
					$.alert('Canceled!');
				}
			});
		}
	</script>