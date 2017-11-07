<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class AcfFieldPostTypeSelectorV5 extends acf_field {

	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	function __construct() {
		// vars
		$this->name     = 'post-type-selector';
		$this->label    = __( 'Selecteur de type de contenus' );
		$this->category = __( 'Basic', 'acf' ); // Basic, Content, Choice, etc

		// do not delete!
		parent::__construct();
	}


	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function render_field( $field ) {
		// create Field HTML
		?>
		<ul class="acf-checkbox-list acf-hl <?php echo esc_attr( $field['class'] ); ?>">
			<?php $ignore_post_types = array( 'attachment', 'mega-menu' ); ?>
			<?php foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) : ?>
				<?php if ( in_array( $post_type->name, $ignore_post_types, true ) ) { continue; } ?>
				<li>
					<input <?php checked( in_array( $post_type->name, (array) $field['value'], true ) ) ?> name="<?php echo esc_attr( $field['name'] ); ?>[]" id="<?php echo esc_attr( $field['key'].'-'.$post_type->name ); ?>" type="checkbox" value="<?php echo esc_attr( $post_type->name ); ?>" />
					<label for="<?php echo esc_attr( $field['key'].'-'.$post_type->name ); ?>"> <?php echo esc_html( $post_type->label ); ?> </label>
				</li>
			<?php endforeach; ?>
		</ul>
		<input name="<?php echo esc_attr( $field['name'] ); ?>[]" type="hidden" value="" />
	<?php
	}
}


// create field
new AcfFieldPostTypeSelectorV5();
