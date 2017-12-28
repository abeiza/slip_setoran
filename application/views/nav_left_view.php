<div class="demo-drawer mdl-layout__drawer" style="background:#46B6AC;">
				<header class="demo-drawer-header">
				  <img src="images/user.jpg" class="demo-avatar">
				  <div class="demo-avatar-dropdown">
					<div style="padding:30px;">
						<div style="text-align:right;">
							<span style="color:#fff;">Aplikasi</span>
							<h4 style="font-family:'pacifico';color:#fff;">Slip Setoran Bank</h4>
						</div>
						<div style="float:left;color:#fff;"><?php echo $this->session->userdata('name');?></div>
						<div class="mdl-layout-spacer"></div>
						<button id="accbtn" style="float:right;margin-top:-8px;color:#fff;" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
						  <i class="material-icons" role="presentation">arrow_drop_down</i>
						  <span class="visuallyhidden">Accounts</span>
						</button>
					</div>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
					  <li class="mdl-menu__item" id="demo-show-toast">Pengaturan Akun</li>
					  <li class="mdl-menu__item" id="demo-show-toast2">Ganti Password</li>
					  <li class="mdl-menu__item" id="logout">Logout</li>
					</ul>
				  </div>
				</header>
				<nav class="demo-navigation mdl-navigation" style="background-color:#424242">
				  <a class="mdl-navigation__link" style="color:#fff;" href="<?php echo base_url();?>">Beranda</a>
				  <a class="mdl-navigation__link mdl-js-ripple-effect" style="color:#fff;" id="mtrbtn" href="#">Master Data  <i class="material-icons" role="presentation">arrow_drop_down</i></a>
				    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" style="background-color:#444;" for="mtrbtn">
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_curr_list/">Data Mata Uang</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_currate_list/">Data Rate Mata Uang</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_bank_list/">Data Bank</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_rec_list/">Data Rekening Bank</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_receiver_list/">Data Penerima</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_depositor_list/">Data Penyetor</a></li>
				    </ul>
				  <a href="<?php echo base_url();?>index.php/form_slip/transaction_list/" class="mdl-navigation__link" style="color:#fff;" href="">Daftar Transaksi</a>
				  <?php 
					$get_type = $this->db->query("select distinct type.ObjectID, type.Slip_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on slip.TypeSlip_ID = type.ObjectID where slip.Slip_Status = '1' order by Slip_Name");
					if($get_type->num_rows() > 0){
						foreach($get_type->result() as $ty){
				  ?>
				  
				  <a class="mdl-navigation__link" style="color:#fff;" id="<?php echo $ty->Slip_Name.'btn';?>" href="#"><?php echo $ty->Slip_Name;?> <i class="material-icons" role="presentation">arrow_drop_down</i></a>
				  
				  <?php
							$get_ty_bk = $this->db->query("select slip.*, bank.Bank_Name, type.Slip_Name from tbl_SlipSetor_Ms_Slip as slip inner join tbl_SlipSetor_Ms_Type_Slip as type on slip.TypeSlip_ID = type.ObjectID inner join tbl_SlipSetor_Ms_Bank as bank on bank.ObjectID = slip.Bank_ID and type.ObjectID = '".$ty->ObjectID."' and slip.slip_status = '1'");
							if($get_ty_bk->num_rows() > 0){
				  ?>
						<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" style="background-color:#444;" for="<?php echo $ty->Slip_Name.'btn';?>">
				  <?php 
								foreach($get_ty_bk->result() as $bk){
				  ?>
							<li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/form_slip/form/<?php echo $bk->ObjectID;?>"><?php echo $bk->Bank_Name;?></a></li>
				  <?php
								}
				  ?> 
						</ul>
				  <?php 
							}
						}
					}
				  ?>
				  <a class="mdl-navigation__link" style="color:#fff;" id="setupbtn" href="#">Pengaturan <i class="material-icons" role="presentation">arrow_drop_down</i></a>
				  <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" style="background-color:#444;" for="setupbtn">
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_user_list/">Pengaturan Akun</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_slip_list/">Daftar Slip Setoran</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="<?php echo base_url();?>index.php/dashboard/master_type_list/">Tipe Slip Setoran</a></li>
					  <li class="mdl-menu__item" style="color:#fff;background-color:#444 !important;"><a style="color:#fff;text-decoration:none;" href="#">Pengaturan Slip Setoran</a></li>
				  </ul>
				  
				  <div class="mdl-layout-spacer"></div>
				  <a class="mdl-navigation__link mdl-color-text--blue-grey-400" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span> Information</a>
				</nav>
			  </div>
			<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
			  <div class="mdl-snackbar__text"></div>
			  <button class="mdl-snackbar__action" type="button"></button>
			</div>
			<script>
			(function() {
			  'use strict';
			  var snackbarContainer = document.querySelector('#demo-toast-example');
			  var showToastButton = document.querySelector('#demo-show-toast');
			  showToastButton.addEventListener('click', function() {
				'use strict';
				var data = {message: 'Maaf, Layanan ini belum tersedia'};
				snackbarContainer.MaterialSnackbar.showSnackbar(data);
			  });
			}());
			</script>
			
			<div id="demo-toast-example2" class="mdl-js-snackbar mdl-snackbar">
			  <div class="mdl-snackbar__text"></div>
			  <button class="mdl-snackbar__action" type="button"></button>
			</div>
			<script>
			(function() {
			  'use strict';
			  var snackbarContainer = document.querySelector('#demo-toast-example2');
			  var showToastButton = document.querySelector('#demo-show-toast2');
			  showToastButton.addEventListener('click', function() {
				'use strict';
				var data = {message: 'Silahkan hubungi divisi IT'};
				snackbarContainer.MaterialSnackbar.showSnackbar(data);
			  });
			}());
			</script>
