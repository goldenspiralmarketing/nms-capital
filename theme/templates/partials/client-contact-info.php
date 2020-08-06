<div class="client-contact-info" itemscope itemtype="http://schema.org/Organization">
	<?php if ( get_field( 'client_contact_name', 'option' ) ) : ?>
		<div><span itemprop="name"><?php the_field( 'client_contact_name', 'option' ); ?></span></div>
	<?php endif; ?>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<?php if ( get_field( 'client_contact_address_1', 'option' ) ) : ?>
			<div><span itemprop="streetAddress"><?php the_field( 'client_contact_address_1', 'option' ); ?></span></div>
		<?php endif; ?>
		<?php if ( get_field( 'client_contact_address_2', 'option' ) ) : ?>
			<div><?php the_field( 'client_contact_address_2', 'option' ); ?></div>
		<?php endif; ?>
		<div>
			<?php if ( get_field( 'client_contact_city', 'option' ) ) : ?>
				<span itemprop="addressLocality"><?php the_field( 'client_contact_city', 'option' ); ?></span>,&nbsp;
			<?php endif; ?>
			<?php if ( get_field( 'client_contact_state', 'option' ) ) : ?>
				<span itemprop="addressRegion"><?php the_field( 'client_contact_state', 'option' ); ?></span>&nbsp;&nbsp;
			<?php endif; ?>
			</span>
			<?php if ( get_field( 'client_contact_zip_code', 'option' ) ) : ?>
				<span itemprop="postalCode"><?php the_field( 'client_contact_zip_code', 'option' ); ?></span>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( get_field( 'client_contact_email', 'option' ) ) : ?>
		<div><a href="mailto:<?php the_field( 'client_contact_email', 'option' ); ?>" itemprop="email"><?php the_field( 'client_contact_email', 'option' ); ?></a></div>
	<?php endif; ?>
	<?php if ( get_field( 'client_contact_phone', 'option' ) ) : ?>
		<div>p:&nbsp;<a href="tel:<?php the_field( 'client_contact_phone', 'option' ); ?>" itemprop="telephone"><?php the_field( 'client_contact_phone', 'option' ); ?></a></div>
	<?php endif; ?>
	<?php if ( get_field( 'client_contact_fax', 'option' ) ) : ?>
		<div>f:&nbsp;<span itemprop="faxNumber"><?php the_field( 'client_contact_fax', 'option' ); ?></span></div>
	<?php endif; ?>
</div>
