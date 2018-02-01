<section class="staff-container">

	<?php
		$this->insert('directory/search',
			array(
				'show_alphabet_index' => $show_alphabet_index,
				'separate_alphabet_pages' => $separate_alphabet_pages,
				'links' => $links,
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
					<?php $this->insert('docent/card-photo', array('docent' => $docent)); ?>
				<?php else: ?>
					<?php $this->insert('docent/card-basic', array('docent' => $docent)); ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	<?php else: ?>
		<?php foreach($docents as $docent): ?>
			<?php if($show_photo_card): ?>
				<?php $this->insert('docent/card-photo', array('docent' => $docent)); ?>
			<?php else: ?>
				<?php $this->insert('docent/card-basic', array('docent' => $docent)); ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

</section>