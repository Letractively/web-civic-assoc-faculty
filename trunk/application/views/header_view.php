<div id="header">
	<div id="logo">
		<div id="logo_position"> </div>
	</div>
	<div id="loginBar">
		<?php if( !$this->userdata->is_logged() ): ?>
			<table id="login_table">    
				<?= form_open('auth/login', array('class' => 'form-horizontal')); ?>
					<tr> <td colspan="3" id="login"> Prihlasovanie </td> </tr>
					<tr> 
						<td class="login_table_label"> 
							<label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_login') ?> </label> 
						</td>
						<td colspan="2"> <?= form_input(array('type' => 'text','id' => 'username', 'name' => 'username', 'class' => 'input'.$error['username']), set_value('username')); ?> </td>
					</tr>
					<tr>
						<td class="login_table_label"> 
							<label for="password" class="<?= $error['password'] ?>"><?= $this->lang->line('label_password') ?> </label> 
						</td>
						<td> <?= form_password(array('type' => 'password', 'id' => 'password', 'name' => 'password', 'class' => 'input'.$error['password']), set_value('password')); ?> </td>
						<td> <?= form_submit(array('name' => 'submit', 'class' => 'loginBtn'), $this->lang->line("button_login")); ?> </td>
					</tr>
					<tr> <td colspan="3" id="registration"> <?= anchor('auth/registration', 'REGISTRÁCIA'); ?> </td> </tr>
				<?= form_close(); ?>
			</table>
		<?php else: ?>
            <table id="logout_table">  
				<tr> <td id="logout_table_sign"> <?= $this->lang->line('logged_in'); ?>: </td> </tr>
					<?php $uid = $this->session->userdata('user'); ?>
				<tr> <td id="logout_table_name"> <?php echo anchor('users/detail/'.$uid, $this->userdata->full_name($uid)); ?> </td> </tr>
				<tr> <td id="logout_table_button"> <?php echo anchor('auth/logout', $this->lang->line('button_logout') ); ?> </td> </tr>
			</table>
		<?php endif; ?>
	</div>
	<div id="panel">
		<div id="left"> </div>
		<div id="center">
			<div id="headline">
				<p class="headline1"> Alumni FMFI </p>
				<p class="headline2"> združenie absolventov a priateľov Fakulty matematiky, fyziky a informatiky Univerzity Komenského v Bratislave </p>
			</div>
		</div>
		<div id="right"> </div>
	</div>
	<div id="navigation">
		<div id="main_navigation"> <!-- //main navigation -->
		<?php $sender = $this->router->class; ?>
			<?= anchor('auth', 'DOMOV', ($sender == 'auth' || $sender == 'pages') ? array('class' => 'selected') : null); ?>
			<?= anchor('projects', 'PROJEKTY', in_array($sender, array('projects', 'project_categories')) ? array('class' => 'selected') : null); ?>
			<?= anchor('events', 'UDALOSTI', $sender == 'events' ? array('class' => 'selected') : null); ?>
			<?= anchor('posts', 'ČLÁNKY', $sender == 'posts' ? array('class' => 'selected') : null); ?>
			<?= anchor('users', 'ČLENOVIA', $sender == 'users' ? array('class' => 'selected') : null); ?>
			<?= anchor('administration', 'SPRÁVA', $sender == 'administration' ? array('class' => 'selected') : null); ?>
			<?= anchor('test', 'TEST', $sender == 'test' ? array('class' => 'selected') : null); ?>
		</div>
		<?php if ( ($sender == 'auth') || ($sender == 'pages') ) { ?>
		<div id="secondary_navigation"> <!-- //secondary navigation -->
			<?= anchor('pages/index/rules', 'Stanovy', $view == 'pages_rules_view' ? array('class' => 'selected') : null); ?>
			<?= anchor('pages/index/about', 'O nás', $view == 'pages_about_view' ? array('class' => 'selected') : null); ?>
			<?= anchor('pages/index/contact', 'Kontakt', $view == 'pages_contact_view' ? array('class' => 'selected') : null); ?>	
		</div>
		<?php } else if (in_array($sender, array('administration', 'degrees', 'studies', 'email_types', 'payments', 'io', 'correspondence'))) { ?>
		<div id="secondary_navigation"> <!-- //secondary navigation -->
			<?= anchor('degrees', 'Tituly', $sender == 'degrees' ? array('class' => 'selected') : null); ?>
			<?= anchor('studies', 'Študijné programy', $sender == 'studies' ? array('class' => 'selected') : null); ?>
			<?= anchor('email_types', 'E-mail typy', $sender == 'email_types' ? array('class' => 'selected') : null); ?>
			<?= anchor('payments', 'Platby', $sender == 'payments' ? array('class' => 'selected') : null); ?>
			<?= anchor('io/export', 'Export', $sender == 'io' ? array('class' => 'selected') : null); ?>
			<?= anchor('correspondence', 'Korešpondencia', $sender == 'correspondence' ? array('class' => 'selected') : null); ?>
		</div>
		<?php } ?>
	</div>
</div>