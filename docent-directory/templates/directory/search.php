<div class="s-row">
	<div class="s-col-5 col--flex-column">
		<h6 class="staff-directory-options">Search the Directory:</h6>
		<form action="" class="search-field-wrap">
			<input type="text" class="search-field" name="search">
			<input type="submit" class="search-submit" value="Search">
		</form>
	</div>
    <div class="s-col-5 col--flex-column">
	    <h6 class="staff-directory-options">Sort/Filter by:</h6>
	    <form action="" class="search-field-wrap search-field-wrap--select">
		    <select class="search-field__select">
			    <option value="Option 1">Option 1</option>
			    <option value="Option 2">Option 2</option>
			    <option value="Option 3">Option 3</option>
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
			    ));
			?>
	    </div>
	<?php endif; ?>
</div>
