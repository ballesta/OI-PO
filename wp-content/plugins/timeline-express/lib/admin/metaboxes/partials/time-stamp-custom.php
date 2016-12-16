<?php

// get date picker depencies
CMB2_JS::add_dependencies( array( 'jquery-ui-core', 'jquery-ui-datepicker' ) );
?>

<style>
	#ui-datepicker-div { z-index: 99999 !important; }
	#wpbody-content { overflow: hidden !important; }
	.cmb_id_announcement_image td .cmb_upload_button { height: 32px !important; }
</style>

<?php
if ( $meta && isset( $meta ) ) {
	$value = ( '' !== $meta ) ? apply_filters( 'timeline_express_admin_render_date_format', date( 'm/d/Y', $meta ), $meta ) : $field->args['default'];
	echo '<input class="cmb2-text-small cmb2-datepicker" type="text" name="' . esc_attr__( $field->args['id'] ) . '" id="' . esc_attr__( $field->args['id'] ) . '" value="' . esc_attr__( $value ) . '" />';
} else {
	echo '<input class="cmb2-text-small cmb2-datepicker" type="text" name="' . esc_attr__( $field->args['id'] ) . '" id="' .  esc_attr__( $field->args['id'] ) . '" value="' . esc_attr__( apply_filters( 'timeline_express_admin_render_date_format', date( 'm/d/Y' ), false ) ) .'" />';
}
echo '<p class="cmb2-metabox-description">' . esc_attr__( $field->args['desc'] ) . '</p>';
