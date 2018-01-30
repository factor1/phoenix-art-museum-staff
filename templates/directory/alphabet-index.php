<form action="">
	<select class="staff-sort__options">
		<?php foreach(range('A', 'Z') as $letter): ?>
			<option value="<?php echo $letter; ?>"><?php echo $letter; ?></option>
		<?php endforeach; ?>
	</select>
</form>