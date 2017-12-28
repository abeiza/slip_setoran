	<body>
		<div class="container">
			<div class="demo-layout-waterfall mdl-layout mdl-js-layout">
			  <header class="mdl-layout__header mdl-layout__header--waterfall">
				<!-- Top row, always visible -->
				<div class="mdl-layout__header-row">
				  <!-- Title -->
				  <span class="mdl-layout-title" style="font-family:pacifico">Aplikasi Slip Setoran Bank</span>
				  
				  <div class="mdl-layout-spacer"></div>
				  <div class="material-icons mdl-badge mdl-badge--overlap" data-badge="1">notifications</div>
				  <div style="margin:20px !important;">
					<?php echo $this->session->userdata('name');?>
				  </div>
				  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
							  mdl-textfield--floating-label mdl-textfield--align-right">
					<label class="mdl-button mdl-js-button mdl-button--icon"
						   for="waterfall-exp">
					  <i class="material-icons">search</i>
					</label>
					<div class="mdl-textfield__expandable-holder">
					  <input class="mdl-textfield__input" type="text" name="sample"
							 id="waterfall-exp">
					</div>
				  </div>
				</div>
				<!-- Bottom row, not visible on scroll -->
				<div class="mdl-layout__header-row">
				  <div class="mdl-layout-spacer"></div>
				  <!-- Navigation -->
				  <nav class="mdl-navigation">
					<a class="mdl-navigation__link" href="<?php echo base_url().'index.php/dashboard/master_curr_list/'?>">Daftar Mata Uang</a>
					<a class="mdl-navigation__link" href="<?php echo base_url().'index.php/dashboard/master_currate_list/'?>">Daftar Rate</a>
					<a class="mdl-navigation__link" href="<?php echo base_url().'index.php/dashboard/master_bank_list/'?>">Daftar Bank</a>
					<a class="mdl-navigation__link" href="<?php echo base_url().'index.php/dashboard/master_rec_list/'?>">Daftar Rekening</a>
					<a class="mdl-navigation__link" href="<?php echo base_url().'index.php/dashboard/master_receiver_list/'?>">Daftar Penerima</a>
					<a class="mdl-navigation__link" href="<?php echo base_url().'index.php/dashboard/master_depositor_list/'?>">Daftar Penyetor</a>
				  </nav>
				</div>
			  </header>