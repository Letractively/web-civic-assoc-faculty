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
			<?= anchor('auth', 'DOMOV'); ?>
			<?= anchor('test', 'GRID'); ?>
		</div>
		<div id="secondary_navigation"> <!-- //secondary navigation -->
			<?= anchor('http://devilpage.cz', 'Web page Man Utd'); ?>
			<?= anchor('http://sme.sk', 'SME'); ?>
			<?= anchor('http://topky.sk', 'TOPKY'); ?>	
		</div>
	</div>
</div>