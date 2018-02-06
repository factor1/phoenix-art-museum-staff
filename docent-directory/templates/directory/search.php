<div class="s-row">
	<div class="s-col-5 col--flex-column">
		<h6 class="staff-directory-options">Search the Directory:</h6>
		<form action="" class="search-field-wrap">
			<?php foreach(array_except($query, array('search')) as $key => $value): ?>
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
			<?php endforeach; ?>
			<input type="text" class="search-field" name="search">
			<input type="submit" class="search-submit" value="Search">
		</form>
	</div>
    <div class="s-col-5 col--flex-column">
	    <h6 class="staff-directory-options">Sort/Filter by:</h6>
	    <form action="" class="search-field-wrap search-field-wrap--select">
		    <?php foreach(array_except($query, array('docent-designation')) as $key => $value): ?>
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
			<?php endforeach; ?>
		    <select name="docent-designation" class="search-field__select">
			    <option value=""
			    	<?php if(empty($query['docent-designation'])): ?>selected="selected"<?php endif; ?>>All</option>
			    <?php foreach($designations as $designation => $abbreviation): ?>
			    	<option value="<?php echo $abbreviation; ?>"
			    		<?php if($abbreviation == $query['docent-designation']): ?>selected="selected"<?php endif; ?>>
			    			<?php echo $designation; ?>
			    		</option>
				<?php endforeach; ?>
			</select>
			<input type="submit" class="search-submit select-submit" value="Sort">
		</form>
	</div>
	<div class="s-col-2 col--flex-column s-sm-hide">
		<h6 class="staff-directory-options">View as:</h6>
		<div class="s-row">
			<div class="s-col-12 col--justify-content-space-around">
				<a href="<?php echo $links['grid']; ?>">
					<img class="grid-img" src="<?php echo Factor1_ASSET_URL; ?>/img/grid1.svg" alt="Photo Grid" />
				</a>
				<a href="<?php echo $links['list']; ?>">
					<img class="grid-img" src="<?php echo Factor1_ASSET_URL; ?>/img/grid2.svg" alt="Basic List" />
				</a>
			</div>
		</div>
	</div>
</div>

<div class="s-row staff-sort">
	<?php if($show_alphabet_index): ?>
	    <div class="s-col-12 col--justify-content-center col--align-items-center s-sm-hide">
		    <span class="staff-sort__text">Jump to:</span>
		    <?php
			    $this->insert('directory/alphabet-index', array(
			    	'separate_alphabet_pages' => $separate_alphabet_pages,
			    	'jump_link' => $links['jump'],
			    	'query' => $query,
			    ));
			?>
	    </div>
	<?php endif; ?>

	<?php if($show_alphabet_index): ?>
	    <div class="s-col-6 col--flex-column s-sm-only grid-view select--jump">
		    <h6 class="staff-directory-options">Jump to:</h6>
		    <?php
			    $this->insert('directory/alphabet-index', array(
			    	'separate_alphabet_pages' => $separate_alphabet_pages,
			    	'jump_link' => $links['jump'],
			    	'query' => $query,
			    ));
			?>
	    </div>
	<?php endif; ?>
</div>
