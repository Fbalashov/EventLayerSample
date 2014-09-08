<div class="events form">
<?php echo $this->Form->create('Event'); ?>
	<fieldset>
		<legend><?php echo __('Edit Event'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('title');
		echo $this->Form->input('start');
		echo $this->Form->input('end');
		echo $this->Form->input('description');
		echo $this->Form->input('picture', array('type' => 'hidden'));
		echo $this->Form->input('link');
		echo $this->Form->input('point_of_contact', array('type' => 'hidden'));
		echo $this->Form->input('location_details');
		echo $this->Form->input('lat', array('type' => 'hidden'));
		echo $this->Form->input('lon', array('type' => 'hidden'));
		echo $this->Form->input('event_type', array(
                    'options' => array('sport'=>'sport', 'academic'=>'academic', 'entertainment'=>'entertainment', 'other'=>'other'),
                    'empty' => '(choose one)'
                ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

