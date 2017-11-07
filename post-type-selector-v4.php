<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class AcfFieldPostTypeSelector extends acf_field {
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options


	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/

	function __construct() {
		// vars
		$this->name     = 'post-type-selector';
		$this->label    = __( 'Selecteur de type de contenus' );
		$this->category = __( 'Basic', 'acf' ); // Basic, Content, Choice, etc
		$this->defaults = array( // add default here to merge into your field.
			// This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
			//'preview_size' => 'thumbnail'
		);


		// do not delete!
		parent::__construct();


		// settings
		$this->settings = array(
			'path'    => apply_filters( 'acf/helpers/get_path', __FILE__ ),
			 'dir'     => apply_filters( 'acf/helpers/get_dir', __FILE__ ),
			'version' => '1.0.0',
		);

	}


	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/

	function create_options( $field ) {

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

	function create_field( $field ) {
		// create Field HTML
		?>
		<ul class="acf-checkbox-list checkbox horizontal <?php echo esc_attr( $field['class'] ); ?>">
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
new AcfFieldPostTypeSelector();
