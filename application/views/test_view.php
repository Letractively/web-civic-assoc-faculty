<?php
	$this->load->library('grid');
	$this->load->model('selecter');
	
	/*$users = array(
		array('user_id' => 1, 'name' => 'jozo', 'age' => '22', 'food' => 'apple'),
		array('user_id' => 2, 'name' => 'miso', 'age' => '25', 'food' => 'cheeseburger'),
		array('user_id' => 3, 'name' => 'fero', 'age' => '30', 'food' => 'bread'),
		array('user_id' => 4, 'name' => 'duri', 'age' => '18', 'food' => 'apple')
	);
	
	$foods = array(
		array('food_id' => 1, 'food_name' => 'apple', 'food_healty' => 'best'),
		array('food_id' => 2, 'food_name' => 'cheeseburger', 'food_healty' => 'worst'),
		array('food_id' => 3, 'food_name' => 'sausage', 'food_healty' => 'bad'),
		array('food_id' => 4, 'food_name' => 'bread', 'food_healty' => 'good')
	);*/
	
	$grid = new Grid();

	if ( $grid->bind($this->db->query('select u.user_id, u.user_username, u.user_name, u.user_surname, d.degree_id, d.degree_name from users u join degrees d on (u.user_degree_id = d.degree_id)')->result(), 'user_id') )
	{
		$grid->header('user_id')->visible = false;
		$grid->header('degree_id')->visible = false;
		$grid->header('user_username')->set_anchor("users/detail", "user_id");
		$grid->header('degree_name')->set_anchor("{$this->router->class}/detail", "degree_id");
		$grid->header('degree_name')->component->type = "combobox";
		$grid->header('degree_name')->component->bind($this->db->query('select * from degrees')->result(), 'degree_id', 'degree_name');
		$grid->add_url = "{$this->router->class}/add";
		$grid->edit_url = "{$this->router->class}/edit";
		$grid->remove_url = "{$this->router->class}/delete";
		
		$grid->display();
	}
?>
