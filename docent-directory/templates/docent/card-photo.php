<div class="s-row single-staff">
	<div class="s-col-2 col--flex-column">
		<?php if(!empty($docent->photo) && !empty(wp_get_attachment_image($docent->photo, $photo_size))): ?>
			<?php echo wp_get_attachment_image($docent->photo, $photo_size); ?>
		<?php else: ?>
			<img src="<?php echo get_avatar_url($docent, array('default' => Factor1_ASSET_URL . '/img/staff.png')); ?>"
				alt="staff-title"
				class="staff-img" />
		<?php endif; ?>
	</div>
	<div class="s-col-10 col--flex-column">
		<h3 class="staff-name">
			<span class="staff-name__last"><?php echo $docent->last_name; ?></span>,
			<?php echo $docent->first_name; ?>
			<?php if(!empty($docent->spouse_partner)): ?>
				<span class="staff-spouse_partner">
					<?php echo $docent->spouse_partner; ?>
				</span>
			<?php endif; ?>
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
						<br>
						<?php echo $docent->address['city']; ?><?php if(!empty($docent->address['state'])) : ?>,<?php endif; ?>
						<?php echo $docent->address['state']; ?>
						<?php echo $docent->address['zip']; ?>
					</p>
				<?php endif; ?>
				<p class="staff-phone">
					<?php if(!empty($docent->primary_phone_group_primary_phone)): ?>
						<span>
							<strong><?php echo substr($docent->primary_phone_group_primary_phone_type, 0, 1); ?></strong>
						</span>
						<?php echo $docent->primary_phone_group_primary_phone; ?>
						<br>
					<?php endif; ?>
					<?php if(!empty($docent->alternate1_phone_group_alternate1_phone)): ?>
						<span>
							<strong><?php echo substr($docent->alternate1_phone_group_alternate1_phone_type, 0, 1); ?></strong>
						</span>
						<?php echo $docent->alternate1_phone_group_alternate1_phone; ?>
						<br>
					<?php endif; ?>
					<?php if(!empty($docent->alternate2_phone_group_alternate2_phone)): ?>
						<span>
							<strong><?php echo substr($docent->alternate2_phone_group_alternate2_phone_type, 0, 1); ?></strong>
						</span>
						<?php echo $docent->alternate2_phone_group_alternate2_phone; ?>
					<?php endif; ?>
				</p>
				<p class="staff-email">
					<a href="mailto:<?php echo $docent->user_email; ?>"><?php echo $docent->user_email; ?></a>
				</p>
			</div>
			<div class="s-col-6 col--flex-column staff-info">
				<p class="w3-tooltip">
					<span class="staff-designation">
						<strong>
							<?php echo $docent->docent_designation_abbreviation; ?>
						</strong>
					</span>
					<span class="w3-text">
						<span class="arrow bottom right"></span>
						<?php echo $docent->docent_designation; ?>
					</span>
				</p>
				<?php if(!$docent->is_staff && $docent->docent_designation != 'Honorary'): ?>
					<p class="w3-tooltip">
						<?php echo $docent->class_year; ?>
						<span class="w3-text">
							<span class="arrow bottom right"></span>
							Class Year
						</span>
					</p>
				<?php endif; ?>
				<?php if(!empty($docent->past_president)): ?>
					<p class="w3-tooltip">
						<span class="staff-president">&#9733;</span>
						<span class="w3-text"><span class="arrow bottom right"></span>Past President</span>
					</p>
					<p class="w3-tooltip">
						<?php echo $docent->years_of_office_years_of_office_start; ?>
						<?php if(!empty($docent->years_of_office_years_of_office_end)): ?>
							-
							<?php echo $docent->years_of_office_years_of_office_end; ?>
						<?php endif; ?>
						<span class="w3-text"><span class="arrow bottom right"></span>Years of Service</span>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
