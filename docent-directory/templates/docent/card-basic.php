<div class="s-row single-staff">
	<div class="s-col-12 col--flex-column">
		<div class="s-row">
			<div class="s-col-12 col--flex-column staff-info staff-info--3-col">
				<p class="staff-name">
					<span class="staff-name__last"><?php echo $docent->last_name; ?></span>,
					<?php echo $docent->first_name; ?>
				</p>
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
					<?php echo $docent->user_email; ?>
				</p>
			</div>
		</div>
	</div>
</div>
