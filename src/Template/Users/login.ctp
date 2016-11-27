<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->input('email') ?>
<?= $this->Form->input('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->button('Signup', array('type'=>'button', 'onclick'=>'location.href=\'/users/add/\';')) ?>
<?= $this->Form->end() ?>