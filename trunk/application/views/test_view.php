<?php
	$this->load->library('grid');
	$this->load->model('selecter');
	
	$users = array(
		array('user_id' => 1, 'name' => 'jozo', 'age' => '22', 'food' => 'apple'),
		array('user_id' => 2, 'name' => 'miso', 'age' => '25', 'food' => 'cheeseburger'),
		array('user_id' => 3, 'name' => 'fero', 'age' => '30', 'food' => 'space meat'),
		array('user_id' => 4, 'name' => 'duri', 'age' => '18', 'food' => 'apple')
	);
	
	$foods = array(
		array('food_id' => 1, 'food_name' => 'apple', 'food_healty' => 'best', 'food_price' => '0.259', 'food_date' => '2012-12-20 00-00'),
		array('food_id' => 2, 'food_name' => 'cheeseburger', 'food_healty' => 'worst', 'food_price' => '1.2', 'food_date' => '2012-12-28 00-00'),
		array('food_id' => 3, 'food_name' => 'sausage', 'food_healty' => 'bad', 'food_price' => '0.64389', 'food_date' => '2012-12-30 00-00'),
		array('food_id' => 4, 'food_name' => 'bread', 'food_healty' => 'good', 'food_price' => '2.058', 'food_date' => '2012-12-16 00-00'),
		array('food_id' => 6, 'food_name' => 'space meat', 'food_healty' => 'best', 'food_price' => '15204', 'food_date' => '2012-12-10 00-00')
	);
	
	$grid = new Grid();

	if ( $grid->bind($users, 'user_id') )
	{
		$grid->header('user_id')->visible = false;
		$grid->header('name')->set_anchor("users/detail", "user_id");
		$grid->header('food')->component->type = "combobox";
		$grid->header('food')->component->bind($foods, 'food_id', 'food_name');
		
		$grid->add_url = "{$this->router->class}/add";
		$grid->edit_url = "{$this->router->class}/edit";
		$grid->remove_url = "{$this->router->class}/delete";
		
		$grid->display();
	}
	
	/*$grid2 = new Grid();

	if ( $grid2->bind($foods, 'food_id') )
	{
		$grid2->header('food_id')->visible = false;
		$grid2->header('food_price')->set_numformat('Cena: {2:,: } EUR');
		$grid2->header('food_date')->set_datetime('Y-m-d H-i', 'd.m.Y');
		
		$grid2->display();
	}*/
?>
