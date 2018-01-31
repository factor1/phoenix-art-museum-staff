<?php // Docent Designation Letters
switch ($docent->docent_designation) {
	case 'Docent':
		$letter = 'D';
		break;
	case 'Senior Docent':
		$letter = 'SD';
		break;
	case 'Master Docent':
		$letter = 'M';
		break;
	case 'Master Emeritus':
		$letter = 'ME';
		break;
	case 'Apprentice':
		$letter = 'A';
		break;
	case 'Sustaining':
		$letter = 'S';
		break;
	case 'Honorary':
		$letter = 'H';
		break;
	case 'Inactive':
		$letter = 'I';
		break;
	case 'Staff':
		$letter = 'ST';
		break;
	default:
		$letter = '';
} ?>

<div class="s-row single-staff">
	<div class="s-col-2 col--flex-column">
		<?php if(!empty($docent->photo)): ?>
			<?php echo wp_get_attachment_image($docent->photo); ?>
		<?php elseif(false): ?>
			<img src="<?php echo get_avatar_url($docent); ?>" alt="staff-title" class="staff-img" />
		<?php else: ?>
			<img src="<?php echo Factor1_ASSET_URL; ?>/img/staff.png" alt="staff-title" class="staff-img" />
		<?php endif; ?>
	</div>
	<div class="s-col-10 col--flex-column">
		<h3 class="staff-name">
			<span class="staff-name__last"><?php echo $docent->last_name; ?></span>, <?php echo $docent->first_name; ?>
		</h3>
		<div class="s-row">
			<div class="s-col-6 col--flex-column staff-info">
				<?php if(!empty($docent->address)): ?>
					<p>
						<?php echo $docent->address['street1']; ?>
						<?php if(!empty($docent->address['street2'])): ?>
							<br>
							<?php echo $docent->address['street2']; ?>
						<?php endif; ?>
					</p>
					<p>
						<?php echo $docent->address['city']; ?>,
						<?php echo $docent->address['state']; ?>
						<?php echo $docent->address['zip']; ?>
					</p>
				<?php endif; ?>
				<?php if(!empty($docent->phone_home)): ?>
					<?php $phone_home = unserialize($docent->phone_home); ?>
					<p>
						<span><strong>H</strong></span>
						(<?php echo $phone_home['area_code']; ?>)
						<?php echo $phone_home['phone_number']; ?>-<?php echo $phone_home['direct_dialing']; ?>
					</p>
				<?php endif; ?>
				<?php if(!empty($docent->phone_mobile)): ?>
					<?php $phone_mobile = unserialize($docent->phone_mobile); ?>
					<p>
						<span><strong>C</strong></span>
						(<?php echo $phone_mobile['area_code']; ?>)
						<?php echo $phone_mobile['phone_number']; ?>-<?php echo $phone_mobile['direct_dialing']; ?>
					</p>
				<?php endif; ?>
				<?php if(!empty($docent->phone_work)): ?>
					<?php $phone_work = unserialize($docent->phone_work); ?>
					<p>
						<span><strong>W</strong></span>
						(<?php echo $phone_work['area_code']; ?>)
						<?php echo $phone_work['phone_number']; ?>-<?php echo $phone_work['direct_dialing']; ?>
					</p>
				<?php endif; ?>
				<p>
					<?php echo $docent->user_email; ?>
				</p>
			</div>
			<div class="s-col-6 col--flex-column staff-info">
				<p class="w3-tooltip">
					<span><strong><?php echo $letter; ?></strong></span> <?php echo $docent->class_year; ?>
					<span class="w3-text"><span class="arrow bottom right"></span><?php echo $docent->docent_designation; ?></span>
				</p>
				<?php if(!empty($docent->past_president)): ?>
					<p>
						President Elect
					</p>
					<p class="w3-tooltip">
						<span>&#9733;</span>
						<?php echo $docent->years_of_office_years_of_office_start; ?>
						<?php if(!empty($docent->years_of_office_years_of_office_end)): ?>
							-
							<?php echo $docent->years_of_office_years_of_office_end; ?>
						<?php endif; ?>
						<span class="w3-text"><span class="arrow bottom right"></span>Past President</span>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
