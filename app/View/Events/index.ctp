<div class="events <?php if (!$ajax) echo 'index'; ?>">
	<h2>Events</h2>
	<div class="pagination">
        <ul>
        <?php
	        $this->Paginator->options(array(
	            'update' => '.span12',
	            'evalScripts' => true,
	            'before' => '$(".progress").show()',
	            'complete' => '$(".progress").hide()',
	        ));
            echo $this->Paginator->prev('&laquo; ' . __('previous'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'prev disabled', 'escape' => false, 'disabledTag' => 'span'));
            echo $this->Paginator->numbers(array('modulus' => 20, 'separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'span'));
            echo $this->Paginator->next(__('next') . ' &raquo;', array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'next disabled', 'escape' => false, 'disabledTag' => 'span'));
        ?>
        </ul>
    </div>
	<?php
		$tab = "Center";
		if (!isset($simple)) $simple = false;
		$filtered = false;
		if (!$simple && count($passedArgsArray) > 0) {
			$tab = "Left";
			$filtered = true;
		}
		if (!$ajax && !$simple):
	?>
	<div class="tabMenuFixedContainer" style="display:inline-block;">
		<span class="tabMenuFixed tabMenuFixed<?php echo $tab; ?> tabMenuSides">
			<span id="create-button" title="Modify filters" class="icon-search useCursorPointer" onClick="getPopup('<?php echo h($urlparams);?>', 'events', 'filterEventIndex');"></span>
		</span>
		<?php 
			if ($filtered):
				foreach ($passedArgsArray as $k => $v):?>
					<span class="tabMenuFixed tabMenuFixedElement">
						<?php echo h(ucfirst($k)) . " : " . h($v); ?>
					</span>
				<?php endforeach; ?>
			<span class="tabMenuFixed tabMenuFixedRight tabMenuSides">
				<?php echo $this->Html->link('', array('controller' => 'events', 'action' => 'index'), array('class' => 'icon-remove', 'title' => 'Remove filters'));?>
			</span>
			<?php endif;?>
			<span id="quickFilterButton" class="tabMenuFilterFieldButton useCursorPointer" onClick='quickFilter(<?php echo h($passedArgs);?>, "/events/index");'>Filter</span>
			<input class="tabMenuFilterField" type="text" id="quickFilterField"></input>
			<?php
				$tempArgs = json_decode($passedArgs, true);
				$tabBackground = "";
				if (isset($tempArgs['searchemail']) && $tempArgs['searchemail'] === $me['email']) {
					unset($tempArgs['searchemail']);
					$tabBackground = 'background-lightblue';
				} else {
					$tempArgs['searchemail'] = $me['email'];
				}
				$tempArgs = json_encode($tempArgs);
			?>
			<span class="tabMenuFixed tabMenuFixedLeft tabMenuSides useCursorPointer <?php echo $tabBackground; ?>" style="margin-left:50px;">
				<span id="myOrgButton" title="Modify filters" onClick="executeFilter(<?php echo h($tempArgs);?>, '<?php echo $baseurl;?>/events/index');">My Events</span>
			</span>
			<?php
				$tempArgs = json_decode($passedArgs, true);
				$tabBackground = "";
				if (isset($tempArgs['searchorg']) && $tempArgs['searchorg'] === $me['Organisation']['id']) {
					unset($tempArgs['searchorg']);
					$tabBackground = 'background-lightblue';
				} else {
					$tempArgs['searchorg'] = $me['Organisation']['id'];
				}
				$tempArgs = json_encode($tempArgs);
			?>
			<span class="tabMenuFixed tabMenuFixedRight tabMenuSides useCursorPointer <?php echo $tabBackground; ?>">
				<span id="myOrgButton" title="Modify filters" onClick="executeFilter(<?php echo h($tempArgs);?>, '<?php echo $baseurl;?>/events/index');">Org Events</span>
			</span>
		</div>
	<?php 
		endif; 
		echo $this->element('Events/eventIndexTable');
	?>
	<p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?>
    </p>
    <div class="pagination">
        <ul>
        <?php
            echo $this->Paginator->prev('&laquo; ' . __('previous'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'prev disabled', 'escape' => false, 'disabledTag' => 'span'));
            echo $this->Paginator->numbers(array('modulus' => 20, 'separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'span'));
            echo $this->Paginator->next(__('next') . ' &raquo;', array('tag' => 'li', 'escape' => false), null, array('tag' => 'li', 'class' => 'next disabled', 'escape' => false, 'disabledTag' => 'span'));
        ?>
        </ul>
    </div>
</div>
<?php
	if (!$ajax) echo $this->element('side_menu', array('menuList' => 'event-collection', 'menuItem' => 'index'));
?>
