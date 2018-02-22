<section class="staff-container">

	<?php
		$this->insert('directory/search',
			array(
				'show_alphabet_index' => $show_alphabet_index,
				'filter_alphabet_index' => $filter_alphabet_index,
				'separate_alphabet_pages' => $separate_alphabet_pages,
				'query' => $query,
				'links' => $links,
				'designations' => $designations,
				'docents' => $docents,
 			)
		);
	?>

	<?php if($show_letter_headers): ?>
		<?php foreach($docents as $letter => $list): ?>
			<div class="s-row">
				<div class="s-col-12">
					<h2 class="results-break">
						<?php echo $letter; ?>
					</h2>
				</div>
			</div>
			<?php foreach($list as $docent): ?>
				<?php if($show_photo_card): ?>
					<?php $this->insert('docent/card-photo', array('docent' => $docent, 'photo_size' => $photo_size)); ?>
				<?php else: ?>
					<?php $this->insert('docent/card-basic', array('docent' => $docent)); ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php else: ?>
		<?php foreach($docents as $docent): ?>
			<?php if($show_photo_card): ?>
				<?php $this->insert('docent/card-photo', array('docent' => $docent, 'photo_size' => $photo_size)); ?>
			<?php else: ?>
				<?php $this->insert('docent/card-basic', array('docent' => $docent)); ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if($is_admin): ?>
		<div class="s-row single-staff">
			<div class="s-col-12 col--flex-column">
				<div>
					<a href="<?php echo $links['export']; ?>" class="staff-export">Export Results As CSV</a>
				</div>
			</div>
		</div>
	<?php endif; ?>

</section>
