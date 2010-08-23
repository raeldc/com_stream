<? /** $Id: default.php 22 2010-07-25 17:29:36Z copesc $ */ ?>
<? defined('KOOWA') or die('Restricted access'); ?>

<?= @helper('behavior.tooltip'); ?>
<style src="media://com_default/css/form.css" />
<style src="media://com_default/css/admin.css" />

<script>
	function checksubmit(form) {
		var submitOK=true;
		var checkaction=form.action.value;
		// do field validation
		if (checkaction=='cancel') {
			return true;
		}
		if (form.title.value == ""){
			alert( "<?= @text('Target must have a target', true); ?>" );
			submitOK=false;
			// remove the action field to allow another submit
			form.action.remove();
		}
		return submitOK;
	}
</script>

<form action="<?= @route('&id='.$target->id)?>" method="post" name="adminForm">
	<div style="width:100%; float: left" id="mainform">
		<fieldset>
			<legend><?= @text('Details'); ?></legend>
			<label for="target_type" class="mainlabel"><?= @text('Title'); ?></label>
			<input id="title" type="text" name="title" value="<?= $target->title; ?>" style="width:50%" />
		</fieldset>
	</div>
</form>