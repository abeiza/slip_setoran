			  <!-- Event card -->
				<script src="<?php echo base_url();?>assets/js/highchart.js"></script>
				<script src="<?php echo base_url();?>assets/js/exporting.js"></script>	
				<style>
				.demo-card-event.mdl-card {
				  width: 24%;
				  height: 150px;
				  background: #46B6AC;
				  float:left;
				  margin:0.5%;
				}
				.demo-card-event > .mdl-card__actions {
				  border-color: rgba(255, 255, 255, 0.2);
				}
				.demo-card-event > .mdl-card__title {
				  align-items: flex-start;
				}
				.demo-card-event > .mdl-card__title > h4 {
				  margin-top: 0;
				}
				.demo-card-event > .mdl-card__actions {
				  display: flex;
				  box-sizing:border-box;
				  align-items: center;
				}
				.demo-card-event > .mdl-card__actions > .material-icons {
				  padding-right: 10px;
				}
				.demo-card-event > .mdl-card__title,
				.demo-card-event > .mdl-card__actions,
				.demo-card-event > .mdl-card__actions > .mdl-button {
				  color: #fff;
				}
				</style>
			  <script>
			  $(document).ready(function() {
					$('#example').DataTable( {
						columnDefs: [
							{
								targets: [ 0, 1, 2 ],
								className: 'mdl-data-table__cell--non-numeric'
							}
						]
					} );
				} );
			  </script>
			  <script>
				$(function () {
					$(document).ready(function () {
						// Build the chart
						$('#chart_io').highcharts({
									chart: {
										type: 'area'
									},
									title: {
										text: '(Grafik) Frekuensi pemakaian slip setoran bank'
									},
									subtitle: {
										text: 'Source: <a href="www.goc.co.id">' +
											'Gloria Origita Cosmetics</a>'
									},
									xAxis: {
										allowDecimals: false,
										labels: {
											formatter: function () {
												return this.value; // clean, unformatted number for year
											}
										}
									},
									yAxis: {
										title: {
											text: 'Frekuensi transaksi bulan ini'
										},
										labels: {
											formatter: function () {
												return this.value + ' Transaksi';
											}
										}
									},
									tooltip: {
										pointFormat: '{series.name} frekuensi : <b>{point.y:,.0f} Transaksi</b><br/>di bulan {point.x}'
									},
									plotOptions: {
										area: {
											pointStart: 1,
											marker: {
												enabled: false,
												symbol: 'circle',
												radius: 1,
												states: {
													hover: {
														enabled: true
													}
												}
											}
										}
									},
									series: [
									<?php 
										$get_bank = $this->db->query("select * from tbl_SlipSetor_Ms_Bank order by Bank_Name");
										foreach($get_bank->result() as $bank){
									?>
										{
											name: '<?php echo $bank->Bank_Name;?>',
											data: [
												<?php 
													
													for($i=1;$i<=12;$i++){
													$get_tr = $this->db->query("select distinct Trans_No from tbl_SlipSetor_Transaction as trans inner join tbl_SlipSetor_SetupSlip_Var 
																			as var on trans.SLip_Var_ID = var.ObjectID inner join tbl_SlipSetor_Ms_Slip as slip on slip.ObjectID = var.Slip_ID 
																			inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID where bank.ObjectID = '".$bank->ObjectID."' and Month(trans.Trans_Dt) = '".$i."' and Year(trans.Trans_Dt) = '".date('Y')."'");
													echo $get_tr->num_rows().',';
													}
												?>
												]
										},
									<?php 
										}
									?>
									]
								});
					});
				});
			  </script>
			  <div class="mdl-layout__content">
				<div class="page-content" style="background-color:#fff;">
					<div>
						<div class="mdl-grid">
						  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet">
							<div class="demo-card-event mdl-card mdl-shadow--2dp">
							  <div class="mdl-card__title mdl-card--expand">
								<i class="material-icons" style="font-size:85px;">face</i>
								<h4 style="text-align:right;width:65%;">
								 Hallo, <br>
								 <?php echo $this->session->userdata('name');?> <br/>
								
								</h4>
							  </div>
							  <div class="mdl-card__actions mdl-card--border">
								<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
								  Tampilkan Profile
								</a>
								<div class="mdl-layout-spacer"></div>
								<i class="material-icons">visibility</i>
							  </div>
							</div>
							
							<div class="demo-card-event mdl-card mdl-shadow--2dp">
							  <div class="mdl-card__title mdl-card--expand">
								<h4>
								  Total Transaksi bulan ini:<br>
								  <div style="text-align:right;"><?php echo $cek_trans;?> Transaksi</div>
								</h4>
							  </div>
							  <div class="mdl-card__actions mdl-card--border">
								<a href="<?php echo base_url();?>index.php/form_slip/transaction_list/" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
								  Tampilkan Detail
								</a>
								<div class="mdl-layout-spacer"></div>
								<i class="material-icons">visibility</i>
							  </div>
							</div>
							
							<div class="demo-card-event mdl-card mdl-shadow--2dp">
							  <div class="mdl-card__title mdl-card--expand">
								<h4>
								  Slip Setoran yang telah ada:<br>
								  <div style="text-align:right;"><?php echo $cek_form;?> Formulir</div>
								</h4>
							  </div>
							  <div class="mdl-card__actions mdl-card--border">
								<a href="<?php echo base_url();?>index.php/dashboard/master_slip_list/" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
								  Tampilkan Detail
								</a>
								<div class="mdl-layout-spacer"></div>
								<i class="material-icons">visibility</i>
							  </div>
							</div>
							
							<div class="demo-card-event mdl-card mdl-shadow--2dp">
							  <div class="mdl-card__title mdl-card--expand">
								<h4>
								  Daftar Penerima yang tersedia:<br>
								 <div style="text-align:right;"><?php echo $cek_penerima;?> Record</div>
								</h4>
							  </div>
							  <div class="mdl-card__actions mdl-card--border">
								<a href="<?php echo base_url();?>index.php/dashboard/master_receiver_list/" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
								  Tampilkan Detail
								</a>
								<div class="mdl-layout-spacer"></div>
								<i class="material-icons">visibility</i>
							  </div>
							</div>
						
							<div class="chart_io" id="chart_io" style="min-width: 310px; height: 400px; margin: 0 auto;width:100%;float:left;margin:10px 0px;"></div>
							
							<span class="mdl-layout-title" style="float:left;width:100%;margin-bottom:10px;">Rekapitulasi Transaksi di Tahun <?php echo date('Y');?></span>
							<table id="example" class="mdl-data-table" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Nama Bank</th>
										<th>Nama Slip Setoran</th>
										<th>Jumlah Transaksi</th>
										<th>Total Nominal Transaksi</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Nama Bank</th>
										<th>Nama Slip Setoran</th>
										<th>Jumlah Transaksi</th>
										<th>Total Nominal Transaksi</th>
									</tr>
								</tfoot>
								<tbody>
									<?php 
										foreach($table_trans->result() as $tr){
									?>
									<tr>
										<td><?php echo $tr->Bank_Name;?></td>
										<td><?php echo $tr->Slip_Name;?></td>
										<td><?php echo number_format($tr->Count_Trans);?></td>
										<td><?php echo number_format($tr->Sum_Trans);?></td>
									</tr>
									<?php 
										}
									?>
								</tbody>
							</table>
						  </div>
						</div>
					</div>
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
</script>