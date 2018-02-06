<form action="" method="get">
	<select name="docent-letter"
		class="staff-sort__options"
		data-mode="<?php echo ($separate_alphabet_pages) ? 'separate' : 'single'; ?>"
		data-uri="<?php echo $jump_link; ?>"
	>
		<option value=""
			<?php if(empty($query['docent-letter'])): ?>selected="selected"<?php endif; ?>>All</option>
		<?php foreach(range('A', 'Z') as $letter): ?>
			<option value="<?php echo $letter; ?>"
				<?php if(!empty($query['docent-letter']) && ($letter == $query['docent-letter'])): ?>
					selected="selected"
				<?php endif; ?>
				<?php if(!array_key_exists($letter, $docents)): ?>
					disabled="disabled"
				<?php endif; ?>
			><?php echo $letter; ?></option>
		<?php endforeach; ?>
	</select>
	<noscript>
		<button type="submit">Go</button>
	</noscript>
</form>