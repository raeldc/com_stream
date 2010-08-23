<? /** $Id: default_items.php 22 2010-07-25 17:29:36Z copesc $ */ ?>
<? defined('KOOWA') or die('Restricted access'); ?>

<? $i = 0; $m = 0; ?>
<? foreach (@$targets as $target) : ?>
<tr class="<?php echo 'row'.$m; ?>">
	<td align="center">
		<?= $i + 1; ?>
	</td>
	<td align="center">
		<?= @helper('grid.checkbox', array('row'=>$target))?>
	</td>
	<td>
		<span class="editlinktip hasTip" title="<?= @text('Edit target') ?>::<?= @escape($target->message); ?>">
		<? if($target->locked) : ?>
			<span>
				<?= @escape($target->title); ?>
			</span>
		<? else : ?>
			<a href="<?= @route('view=target&id='.$target->id); ?>">
				<?= @escape($target->title); ?>
			</a>
		<? endif; ?>
		</span>
	</td>
</tr>
<? $i = $i + 1; $m = (1 - $m); ?>
<? endforeach; ?>