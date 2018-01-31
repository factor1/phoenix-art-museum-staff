<div class="s-row single-staff">
	<div class="s-col-12 col--flex-column">
		<div class="s-row">
			<div class="s-col-12 col--flex-column staff-info staff-info--3-col">
				<p class="staff-name">
					<span class="staff-name__last"><?php echo $docent->last_name; ?></span>, <?php echo $docent->first_name; ?>
				</p>
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
		</div>
	</div>
</div>
