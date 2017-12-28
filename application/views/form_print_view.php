<link rel='stylesheet' type='text/css' media='print' href='<?php echo base_url();?>assets/css/print.css' />
<style>
body{
	margin:8px;
}

a{
	background: 0 0;
    border: none;
    border-radius: 2px;
    color: #000;
    position: relative;
    height: 36px;
    margin: 0;
    min-width: 64px;
    padding: 0 16px;
    display: inline-block;
    font-family: "Roboto","Helvetica","Arial",sans-serif;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0;
    overflow: hidden;
    will-change: box-shadow;
    transition: box-shadow .2s cubic-bezier(.4,0,1,1),background-color .2s cubic-bezier(.4,0,.2,1),color .2s cubic-bezier(.4,0,.2,1);
    outline: none;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    line-height: 36px;
    vertical-align: middle;
	color: #fff;
    background-color: #ff4081;
	-webkit-tap-highlight-color: rgba(255,255,255,0);
    padding: 0 5px;
}
</style>
<?php 
foreach($cek_print->result() as $p){
	if($p->Slip_Var_Type == 'Boolean'){
		if($p->Slip_Var_Value != 'on'){
			echo "";
		}else{
			echo "<div style='position:absolute;font-size:12px;margin-top:".$p->Slip_Var_Margin_Top."cm;margin-left:".$p->Slip_Var_Margin_Left."cm'>&#10004;</div>";
		}
	}else if($p->Slip_Var_Type == 'numeric'){
		echo "<div style='position:absolute;font-size:12px;margin-top:".$p->Slip_Var_Margin_Top."cm;margin-left:".$p->Slip_Var_Margin_Left."cm'>";
		echo $p->Slip_Var_Value;
		echo "</div>";
	}else{
		echo "<div style='position:absolute;font-size:12px;margin-top:".$p->Slip_Var_Margin_Top."cm;margin-left:".$p->Slip_Var_Margin_Left."cm'>".$p->Slip_Var_Value."</div>";
	}
}
echo "<a style='margin-left:20px;margin-top:20px;' class='material-icons' id='printButtonClass' href='javascript:window.print();'>Print</a>";
?>
			   