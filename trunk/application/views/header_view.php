<div id="header">
	<div id="logo"> 
	</div>
        <div id="loginBar">
            <?php if( !$this->userdata->is_logged() ): ?>
                <?= form_open('auth/login', array('class' => 'form-horizontal')); ?>
                    <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
                    <?= form_input(array('type' => 'text','id' => 'username', 'name' => 'username', 'class' => ' '.$error['username']), set_value('username')); ?>
                    <label for="password" class="<?= $error['password'] ?>"><?= $this->lang->line('label_password') ?></label>
                    <?= form_password(array('type' => 'password', 'id' => 'password', 'name' => 'password', 'class' => ' '.$error['password']), set_value('password')); ?>
                    <?= form_submit(array('name' => 'submit', 'class' => 'loginBtn'), $this->lang->line("button_login")); ?>
                <?= form_close(); ?>
            <?php else: ?>
                    <strong><?= $this->lang->line('logged_in'); ?>: </strong>
                    <?php 
                        $uid = $this->session->userdata('user');
                        echo anchor('users/detail/'.$uid, $this->userdata->full_name($uid));
                        echo anchor('auth/logout', $this->lang->line('button_logout') ); 
                    ?>
            <?php endif; ?>
        </div>
	<div id="panel">
		<p class="left" > </p>
		<p class="center"> </p>
		<p class="right"> </p
        </div>
	<div id="navigation">
		<div id="main_navigation"> <!-- //main navigation -->
			<p>
				<?= anchor('', 'DOMOV'); ?>
				<?= anchor('test', 'GRID'); ?>
				<?= anchor('auth/registration', 'REGISTRACIA'); ?>
			</p>
		</div>
		<div id="secondary_navigation"> <!-- //secondary navigation -->
			<p>
				<?= anchor('http://devilpage.cz', 'Web page Man Utd'); ?>
				<?= anchor('http://sme.sk', 'SME'); ?>
				<?= anchor('http://topky.sk', 'TOPKY'); ?>	
			</p>
		</div>
	</div>
</div>
