<div class="inmuebles form">
<?php echo $this->Form->create('Inmueble'); ?>
	<fieldset>
		<legend><?php echo __('Edit Inmueble'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('ubicacion');
		echo $this->Form->input('numero');
		echo $this->Form->input('sector');
		echo $this->Form->input('area_terr');
		echo $this->Form->input('area_cons');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Inmueble.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Inmueble.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Inmuebles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
	</ul>
</div>
