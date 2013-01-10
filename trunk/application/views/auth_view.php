<div id="content_wrapper1">
	<?php

	//    array_debug($this->selecter->get_posts());
	//    array_debug($this->selecter->get_events(0));
		
		$this->load->helper('text');
		
		
		
		
		$counter = 0;
		echo '<div class="auth_view_column">';
			echo '<span class="auth_view_title"> Udalosti </span>';
			foreach ($this->selecter->get_events(0) as $event) 
			{
				if($counter < 3)
				{
					echo '<div class="post" id='.$event->event_id.'>'; 
						echo '<span class="auth_view_link">'; echo anchor('events/detail/'.$event->event_id, $event->event_name); echo '</span>';
						echo '<br />';
						$string = $event->event_about;
						$string = word_limiter($string, 15);
						echo perex_from_content($string);
						echo '<br />';
						echo '<p class="separation"> </p>';
					echo '</div>';				
					$counter++;
				}
				else
					break;
			}
		echo '</div>';
		
		$counter = 0;
		echo '<div class="auth_view_column">';
			echo '<span class="auth_view_title"> Články </span>';
			foreach ($this->selecter->get_posts() as $post) 
			{
				if($counter < 3)
				{
					echo '<div class="event" id='.$post->post_id.'>';
						echo '<span class="auth_view_link">'; echo anchor('posts/detail/'.$post->post_id, $post->post_title); echo '</span>';
						echo '<br />';
						$string = $post->post_content;
						$string = word_limiter($string, 15);
						echo perex_from_content($string);
						echo '<br />';
						echo '<p class="separation"> </p>';
					echo '</div>';
					$counter++;
				}	
				else
					break;
			}
		echo '</div>';
	   
	?>
</div>