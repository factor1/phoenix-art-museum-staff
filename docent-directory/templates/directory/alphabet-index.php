<form action="" method="get">
	<select name="docent-letter"
		class="staff-sort__options"
		data-mode="<?php echo ($separate_alphabet_pages) ? 'separate' : 'single'; ?>"
		data-filter="<?php echo ($filter_alphabet_index) ? 'true' : 'false'; ?>"
		data-uri="<?php echo $jump_link; ?>"
	>
		<option value=""
			<?php if(empty($query['docent-letter'])): ?>selected="selected"<?php endif; ?>>All</option>
		<?php foreach(range('A', 'Z') as $letter): ?>
			<option value="<?php echo $letter; ?>"
				<?php if(!empty($query['docent-letter']) && ($letter == $query['docent-letter'])): ?>
					selected="selected"
				<?php endif; ?>
				<?php if($filter_alphabet_index && !array_key_exists($letter, $docents)): ?>
					disabled="disabled"
				<?php endif; ?>
			><?php echo $letter; ?></option>
		<?php endforeach; ?>
	</select>
	<noscript>
		<button type="submit">Go</button>
	</noscript>
</form>