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
			  </header>