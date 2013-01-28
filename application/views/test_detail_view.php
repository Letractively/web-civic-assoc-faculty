<?php
echo 'detail';
	$this->load->model('selecter');
	
	$degrees = $this->selecter->get_degrees();
	$deg;
	foreach ($degrees as $degree)
		if ($degree->degree_id == $id) $deg = $degree;
?>
<p><b>id:</b> <?=$deg->degree_id?></p>
<p><b>name:</b> <?=$deg->degree_name?></p>
<p><b>grade:</b> <?=$deg->degree_grade?></p>