<form action="" method="get">
	<select name="docent-letter"
		class="staff-sort__options"
		data-mode="<?php echo ($separate_alphabet_pages) ? 'separate' : 'single'; ?>"
		data-uri="<?php echo $jump_link; ?>"
	>
		<?php foreach(range('A', 'Z') as $letter): ?>
			<option value="<?php echo $letter; ?>"><?php echo $letter; ?></option>
		<?php endforeach; ?>
	</select>
	<noscript>
		<button type="submit">Go</button>
	</noscript>
</form>