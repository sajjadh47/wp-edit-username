<?php
/**
 * File containing the definition of the Sajjad_Dev_Settings_API class.
 *
 * This file defines the Sajjad_Dev_Settings_API class, a wrapper for the WordPress Settings API.
 *
 * @package    Sajjad_Dev_Settings_API
 * @author     Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

if ( ! class_exists( 'Sajjad_Dev_Settings_API' ) ) :
	/**
	 * Wrapper class for the WordPress Options API.
	 *
	 * This class provides an interface for interacting with the WordPress Options API.
	 *
	 * @since    1.0.0
	 */
	class Sajjad_Dev_Settings_API {
		/**
		 * Settings sections array
		 *
		 * @since     1.0.0
		 * @access    protected
		 * @var       array
		 */
		protected $settings_sections = array();

		/**
		 * Settings fields array.
		 *
		 * @since     1.0.0
		 * @access    protected
		 * @var       array
		 */
		protected $settings_fields = array();

		/**
		 * Allowed html tags array.
		 *
		 * @since     1.0.0
		 * @static
		 * @access    public
		 * @var       array
		 */
		public static $allowed_html_tags = array(
			'a'        => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'href'   => true,
				'target' => true,
				'data-*' => true,
			),
			'b'        => array(),
			'br'       => array(),
			'button'   => array(
				'id'       => true,
				'class'    => true,
				'style'    => true,
				'data-*'   => true,
				'disabled' => true,
				'name'     => true,
				'type'     => true,
				'value'    => true,
			),
			'code'     => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'div'      => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'em'       => array(),
			'fieldset' => array(
				'id'       => true,
				'class'    => true,
				'style'    => true,
				'disabled' => true,
				'data-*'   => true,
			),
			'h1'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'h2'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'h3'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'h4'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'h5'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'h6'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'hr'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'i'        => array(),
			'input'    => array(
				'id'          => true,
				'class'       => true,
				'style'       => true,
				'type'        => true,
				'name'        => true,
				'value'       => true,
				'checked'     => true,
				'placeholder' => true,
				'readonly'    => true,
				'required'    => true,
				'disabled'    => true,
				'min'         => true,
				'max'         => true,
				'step'        => true,
				'data-*'      => true,
			),
			'img'      => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
				'alt'    => true,
				'height' => true,
				'src'    => true,
				'width'  => true,
			),
			'label'    => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'for'    => true,
				'data-*' => true,
			),
			'li'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'ol'       => array(
				'id'       => true,
				'class'    => true,
				'style'    => true,
				'data-*'   => true,
				'start'    => true,
				'type'     => true,
				'reversed' => true,
			),
			'option'   => array(
				'value'    => true,
				'selected' => true,
				'disabled' => true,
				'data-*'   => true,
			),
			'p'        => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'pre'      => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'span'     => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
			),
			'strong'   => array(),
			'select'   => array(
				'id'       => true,
				'class'    => true,
				'style'    => true,
				'multiple' => true,
				'name'     => true,
				'required' => true,
				'disabled' => true,
				'data-*'   => true,
			),
			'svg'      => array(
				'id'      => true,
				'class'   => true,
				'style'   => true,
				'title'   => true,
				'height'  => true,
				'viewbox' => true,
				'version' => true,
				'width'   => true,
				'data-*'  => true,
			),
			'path'     => array(
				'd'      => true,
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'title'  => true,
				'data-*' => true,
			),
			'table'    => array(
				'id'          => true,
				'class'       => true,
				'style'       => true,
				'data-*'      => true,
				'align'       => true,
				'bgcolor'     => true,
				'border'      => true,
				'cellpadding' => true,
				'cellspacing' => true,
			),
			'tbody'    => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
				'align'  => true,
			),
			'td'       => array(
				'id'      => true,
				'class'   => true,
				'style'   => true,
				'data-*'  => true,
				'align'   => true,
				'bgcolor' => true,
				'colspan' => true,
				'rowspan' => true,
				'scope'   => true,
			),
			'textarea' => array(
				'id'          => true,
				'class'       => true,
				'style'       => true,
				'name'        => true,
				'rows'        => true,
				'cols'        => true,
				'placeholder' => true,
				'readonly'    => true,
				'required'    => true,
				'disabled'    => true,
				'data-*'      => true,
			),
			'tfoot'    => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
				'align'  => true,
			),
			'th'       => array(
				'id'      => true,
				'class'   => true,
				'style'   => true,
				'data-*'  => true,
				'align'   => true,
				'bgcolor' => true,
				'colspan' => true,
				'rowspan' => true,
				'scope'   => true,
			),
			'thead'    => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
				'align'  => true,
			),
			'tr'       => array(
				'id'      => true,
				'class'   => true,
				'style'   => true,
				'data-*'  => true,
				'align'   => true,
				'bgcolor' => true,
			),
			'ul'       => array(
				'id'     => true,
				'class'  => true,
				'style'  => true,
				'data-*' => true,
				'type'   => true,
			),
		);

		/**
		 * Enqueue scripts and styles for the settings page.
		 *
		 * @since     1.0.0
		 * @access    public
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		/**
		 * Enqueue scripts and styles
		 *
		 * @since     1.0.0
		 * @access    public
		 */
		public function admin_enqueue_scripts() {
			wp_register_style( 'sajjaddev-settings-api', TIP_THE_HELPER_PLUGIN_URL . 'admin/css/settings-api.css', array( 'wp-color-picker' ), '1.0.0', 'all' );

			wp_register_script( 'sajjaddev-settings-api', TIP_THE_HELPER_PLUGIN_URL . 'admin/js/settings-api.js', array( 'jquery', 'wp-color-picker' ), '1.0.0', true );
		}

		/**
		 * Set settings sections
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $sections Setting sections array.
		 */
		public function set_sections( $sections ) {
			$this->settings_sections = $sections;

			return $this;
		}

		/**
		 * Add a single section
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $section Single section.
		 */
		public function add_section( $section ) {
			$this->settings_sections[] = $section;

			return $this;
		}

		/**
		 * Set settings fields
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $fields Settings fields array.
		 */
		public function set_fields( $fields ) {
			$this->settings_fields = $fields;

			return $this;
		}

		/**
		 * Add a field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $section Single section.
		 * @param     array $field   Field data.
		 */
		public function add_field( $section, $field ) {
			$defaults = array(
				'name'  => '',
				'label' => '',
				'desc'  => '',
				'class' => '',
				'id'    => '',
				'type'  => 'text', // default type is text.
			);

			$arg = wp_parse_args( $field, $defaults );

			$this->settings_fields[ $section ][] = $arg;

			return $this;
		}

		/**
		 * Initialize and registers the settings sections and fields to WordPress
		 *
		 * Usually this should be called at `admin_init` hook.
		 *
		 * This function gets the initiated settings sections and fields. Then
		 * registers them to WordPress and ready for use.
		 *
		 * @since     1.0.0
		 * @access    public
		 */
		public function admin_init() {
			// Register settings sections.
			foreach ( $this->settings_sections as $section ) {
				if ( false === get_option( $section['id'] ) ) {
					add_option( $section['id'] );
				}

				if ( isset( $section['desc'] ) && ! empty( $section['desc'] ) ) {
					$section['desc'] = '<div class="inside">' . $section['desc'] . '</div>';
					$callback        = function () use ( $section ) {
						echo wp_kses( $section['desc'], self::$allowed_html_tags );
					};
				} elseif ( isset( $section['callback'] ) ) {
					$callback = $section['callback'];
				} else {
					$callback = null;
				}

				add_settings_section( $section['id'], $section['title'], $callback, $section['id'] );
			}

			// Register settings fields.
			foreach ( $this->settings_fields as $section => $field ) {
				foreach ( $field as $option ) {
					$name     = $option['name'];
					$type     = isset( $option['type'] ) ? $option['type'] : 'text';
					$label    = isset( $option['label'] ) ? $option['label'] : '';
					$callback = isset( $option['callback'] ) ? $option['callback'] : array( $this, 'callback_' . $type );
					$args     = array(
						'id'                => $name,
						'class'             => isset( $option['class'] ) ? $option['class'] : $name,
						'label_for'         => "{$section}[{$name}]",
						'desc'              => isset( $option['desc'] ) ? $option['desc'] : '',
						'name'              => $label,
						'section'           => $section,
						'size'              => isset( $option['size'] ) ? $option['size'] : null,
						'readonly'          => isset( $option['readonly'] ) ? $option['readonly'] : null,
						'options'           => isset( $option['options'] ) ? $option['options'] : '',
						'std'               => isset( $option['default'] ) ? $option['default'] : '',
						'sanitize_callback' => isset( $option['sanitize_callback'] ) ? $option['sanitize_callback'] : '',
						'type'              => $type,
						'placeholder'       => isset( $option['placeholder'] ) ? $option['placeholder'] : '',
						'min'               => isset( $option['min'] ) ? $option['min'] : '',
						'max'               => isset( $option['max'] ) ? $option['max'] : '',
						'step'              => isset( $option['step'] ) ? $option['step'] : '',
					);

					add_settings_field( "{$section}[{$name}]", $label, $callback, $section, $section, $args );
				}
			}

			// Creates our settings in the options table.
			foreach ( $this->settings_sections as $section ) {
				register_setting( $section['id'], $section['id'], array( $this, 'sanitize_options' ) );
			}
		}

		/**
		 * Get field description for display
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function get_field_description( $args ) {
			return ! empty( $args['desc'] ) ? sprintf( '<p class="description sajjaddev-description">%s</p>', $args['desc'] ) : '';
		}

		/**
		 * Displays a text field for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_text( $args ) {
			$value       = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$size        = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$type        = isset( $args['type'] ) ? $args['type'] : 'text';
			$placeholder = empty( $args['placeholder'] ) ? '' : ' placeholder="' . $args['placeholder'] . '"';
			$html        = sprintf( '<input data-default-color="#ffffff" type="%1$s" class="sajjaddev-text %2$s-text" id="%3$s[%4$s]" name="%3$s[%4$s]" value="%5$s"%6$s/>', $type, $size, $args['section'], $args['id'], $value, $placeholder );
			$html       .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a url field for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_url( $args ) {
			$this->callback_text( $args );
		}

		/**
		 * Displays a number field for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_number( $args ) {
			$value       = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$size        = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$type        = isset( $args['type'] ) ? $args['type'] : 'number';
			$placeholder = empty( $args['placeholder'] ) ? '' : ' placeholder="' . $args['placeholder'] . '"';
			$min         = ( '' === $args['min'] ) ? '' : ' min="' . $args['min'] . '"';
			$max         = ( '' === $args['max'] ) ? '' : ' max="' . $args['max'] . '"';
			$step        = ( '' === $args['step'] ) ? '' : ' step="' . $args['step'] . '"';
			$html        = sprintf( '<input type="%1$s" class="sajjaddev-number %2$s-number" id="%3$s[%4$s]" name="%3$s[%4$s]" value="%5$s"%6$s%7$s%8$s%9$s/>', $type, $size, $args['section'], $args['id'], $value, $placeholder, $min, $max, $step );
			$html       .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a checkbox for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_checkbox( $args ) {
			$value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$html  = '<fieldset>';
			$html .= sprintf( '<label for="%2$s">', $args['section'], $args['id'] );
			$html .= sprintf( '<input type="hidden" name="%1$s[%2$s]" value="off" />', $args['section'], $args['id'] );
			$html .= sprintf( '<input type="checkbox" class="sajjaddev-checkbox checkbox" id="%2$s" name="%1$s[%2$s]" value="on" %3$s />', $args['section'], $args['id'], checked( $value, 'on', false ) );
			$html .= sprintf( '%1$s</label>', $args['desc'] );
			$html .= '</fieldset>';

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a multicheckbox for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_multicheck( $args ) {
			$value = $this->get_option( $args['id'], $args['section'], $args['std'] );
			$html  = '<fieldset>';
			$html .= sprintf( '<input type="hidden" name="%1$s[%2$s]" value="" />', $args['section'], $args['id'] );

			foreach ( $args['options'] as $key => $label ) {
				$checked = isset( $value[ $key ] ) ? $value[ $key ] : '0';
				$html   .= sprintf( '<label for="sajjaddev-%1$s[%2$s][%3$s]">', $args['section'], $args['id'], $key );
				$html   .= sprintf( '<input type="checkbox" class="sajjaddev-multicheckbox checkbox" id="sajjaddev-%1$s[%2$s][%3$s]" name="%1$s[%2$s][%3$s]" value="%3$s" %4$s />', $args['section'], $args['id'], $key, checked( $checked, $key, false ) );
				$html   .= sprintf( '%1$s</label><br>', $label );
			}

			$html .= $this->get_field_description( $args );
			$html .= '</fieldset>';

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a radio button for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_radio( $args ) {
			$value = $this->get_option( $args['id'], $args['section'], $args['std'] );
			$html  = '<fieldset>';

			foreach ( $args['options'] as $key => $label ) {
				$html .= sprintf( '<label for="sajjaddev-%1$s[%2$s][%3$s]">', $args['section'], $args['id'], $key );
				$html .= sprintf( '<input type="radio" class="sajjaddev-radio radio" id="sajjaddev-%1$s[%2$s][%3$s]" name="%1$s[%2$s]" value="%3$s" %4$s />', $args['section'], $args['id'], $key, checked( $value, $key, false ) );
				$html .= sprintf( '%1$s</label><br>', $label );
			}

			$html .= $this->get_field_description( $args );
			$html .= '</fieldset>';

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a radio button with images for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_radio_image( $args ) {
			$value = $this->get_option( $args['id'], $args['section'], $args['std'] );
			$html  = '<div id="sajjaddev-radio-button-wrapper">';
			foreach ( $args['options'] as $key => $label ) {
				$html .= '<div class="sajjaddev-radio-item">';
				$html .= sprintf( '<label for="wpuf-%1$s[%2$s][%3$s]">', $args['section'], $args['id'], $key );
				$html .= sprintf( '<input type="radio" class="radio" id="wpuf-%1$s[%2$s][%3$s]" name="%1$s[%2$s]" value="%3$s" %4$s />', $args['section'], $args['id'], $key, checked( $value, $key, false ) );
				$html .= sprintf( '<img src="%1$s"></label>', esc_url( $label ) );
				$html .= '</div>';
			}

			$html .= $this->get_field_description( $args );
			$html .= '</div>';

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a selectbox for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_select( $args ) {
			$value = $this->get_option( $args['id'], $args['section'], $args['std'] );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$html  = sprintf( '<select class="sajjaddev-select %1$s" name="%2$s[%3$s]" id="%3$s">', $size, $args['section'], $args['id'] );

			foreach ( $args['options'] as $key => $label ) {
				$html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( $value, $key, false ), $label );
			}

			$html .= sprintf( '</select>' );
			$html .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a multi selectbox for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_multiselect( $args ) {
			$value = $this->get_option( $args['id'], $args['section'], array() );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$html  = sprintf( '<select class="sajjaddev-multiselect %1$s" name="%2$s[%3$s][]" id="%2$s[%3$s]" multiple="multiple">', $size, $args['section'], $args['id'] );

			foreach ( $args['options'] as $key => $label ) {
				$html .= sprintf( '<option value="%s"%s>%s</option>', $key, selected( true, in_array( $key, $value, true ), false ), $label );
			}

			$html .= sprintf( '</select>' );
			$html .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a textarea for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_textarea( $args ) {
			$value       = esc_textarea( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$readonly    = isset( $args['readonly'] ) && ! is_null( $args['readonly'] ) ? $args['readonly'] : '';
			$placeholder = empty( $args['placeholder'] ) ? '' : ' placeholder="' . $args['placeholder'] . '"';
			$html        = sprintf( '<textarea class="sajjaddev-textarea" %1$s id="%3$s" name="%2$s[%3$s]"%4$s>%5$s</textarea>', $readonly, $args['section'], $args['id'], $placeholder, $value );
			$html       .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays the html for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_html( $args ) {
			echo wp_kses( $this->get_field_description( $args ), self::$allowed_html_tags );
		}

		/**
		 * Displays a rich text textarea for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_wysiwyg( $args ) {
			$value = $this->get_option( $args['id'], $args['section'], $args['std'] );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : '500px';

			echo '<div style="max-width: ' . esc_attr( $size ) . ';">';

			$editor_settings = array(
				'teeny'         => true,
				'textarea_name' => $args['section'] . '[' . $args['id'] . ']',
				'textarea_rows' => 10,
			);

			if ( isset( $args['options'] ) && is_array( $args['options'] ) ) {
				$editor_settings = array_merge( $editor_settings, $args['options'] );
			}

			wp_editor( $value, $args['section'] . '-' . $args['id'], $editor_settings );

			echo '</div>';

			echo wp_kses( $this->get_field_description( $args ), self::$allowed_html_tags );
		}

		/**
		 * Displays a file upload field for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_file( $args ) {
			$value = esc_url( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$id    = $args['section'] . '[' . $args['id'] . ']';
			$label = isset( $args['options']['button_label'] ) ? $args['options']['button_label'] : '';
			$html  = sprintf( '<input type="text" class="%1$s-text sajjaddev-url" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
			$html .= '<input type="button" class="button sajjaddev-browse" value="' . $label . '" />';
			$html .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a password field for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_password( $args ) {
			$value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$html  = sprintf( '<input type="password" class="sajjaddev-password %1$s-text" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s"/>', $size, $args['section'], $args['id'], $value );
			$html .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a color picker field for a settings field
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_color( $args ) {
			$value = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
			$html  = sprintf( '<input type="text" class="sajjaddev-color-picker %1$s-text wp-color-picker-field" id="%2$s[%3$s]" name="%2$s[%3$s]" value="%4$s" data-default-color="%5$s" />', $size, $args['section'], $args['id'], $value, $args['std'] );
			$html .= $this->get_field_description( $args );

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Displays a select box for creating the pages select box
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_pages( $args ) {
			$value         = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$dropdown_args = array(
				'selected' => $value,
				'class'    => 'sajjaddev-select',
				'name'     => $args['section'] . '[' . $args['id'] . ']',
				'id'       => $args['section'] . '[' . $args['id'] . ']',
				'echo'     => 0,
			);

			echo wp_kses( wp_dropdown_pages( $dropdown_args ), self::$allowed_html_tags );
		}

		/**
		 * Displays a select box for creating the categories select box
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_categories( $args ) {
			$value         = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$dropdown_args = array(
				'selected'   => $value,
				'class'      => 'sajjaddev-select',
				'name'       => $args['section'] . '[' . $args['id'] . ']',
				'id'         => $args['section'] . '[' . $args['id'] . ']',
				'echo'       => 0,
				'hide_empty' => 0,
			);

			echo wp_kses( wp_dropdown_categories( $dropdown_args ), self::$allowed_html_tags );
		}

		/**
		 * Displays a select box for creating the categories select box
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $args Settings field args.
		 */
		public function callback_users( $args ) {
			$value         = esc_attr( $this->get_option( $args['id'], $args['section'], $args['std'] ) );
			$dropdown_args = array(
				'selected'     => $value,
				'class'        => 'sajjaddev-select',
				'name'         => $args['section'] . '[' . $args['id'] . ']',
				'id'           => $args['section'] . '[' . $args['id'] . ']',
				'echo'         => 0,
				'role'         => isset( $args['role'] ) ? $args['role'] : '',
				'role__in'     => isset( $args['role__in'] ) ? $args['role__in'] : array(),
				'role__not_in' => isset( $args['role__not_in'] ) ? $args['role__not_in'] : array(),
			);

			echo wp_kses( wp_dropdown_users( $dropdown_args ), self::$allowed_html_tags );
		}

		/**
		 * Sanitize callback for Settings API
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     array $options Options to sanitize.
		 * @return    mixed
		 */
		public function sanitize_options( $options ) {
			if ( ! $options ) {
				return $options;
			}

			foreach ( $options as $option_slug => $option_value ) {
				$sanitize_callback = $this->get_sanitize_callback( $option_slug );

				// If callback is set, call it.
				if ( $sanitize_callback ) {
					$options[ $option_slug ] = call_user_func( $sanitize_callback, $option_value );

					continue;
				}
			}

			return $options;
		}

		/**
		 * Get sanitization callback for given option slug
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     string $slug Option slug.
		 * @return    mixed        String or Bool false
		 */
		public function get_sanitize_callback( $slug = '' ) {
			if ( empty( $slug ) ) {
				return false;
			}

			// Iterate over registered fields and see if we can find proper callback.
			foreach ( $this->settings_fields as $section => $options ) {
				foreach ( $options as $option ) {
					if ( $option['name'] !== $slug ) {
						continue;
					}

					// Return the callback name.
					return isset( $option['sanitize_callback'] ) && is_callable( $option['sanitize_callback'] ) ? $option['sanitize_callback'] : false;
				}
			}

			return false;
		}

		/**
		 * Retrieves the value of a specific settings field.
		 *
		 * This method fetches the value of a settings field from the WordPress options database.
		 * It retrieves the entire option group for the given section and then extracts the
		 * value for the specified field.
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     string $option        The name of the settings field.
		 * @param     string $section       The name of the section this field belongs to. This corresponds
		 *                                  to the option name used in `register_setting()`.
		 * @param     string $default_value Optional. The default value to return if the field's value
		 *                                  is not found in the database. Default is an empty string.
		 * @return    string|mixed          The value of the settings field, or the default value if not found.
		 */
		public function get_option( $option, $section, $default_value = '' ) {
			$options = get_option( $section ); // Get all options for the section.

			// Check if the option exists within the section's options array.
			if ( isset( $options[ $option ] ) ) {
				return $options[ $option ]; // Return the option value.
			}

			return $default_value; // Return the default value if the option is not found.
		}

		/**
		 * Show navigations as tab
		 *
		 * Shows all the settings section labels as tab
		 *
		 * @since     1.0.0
		 * @access    public
		 */
		public function show_navigation() {
			$html  = '<h1 class="nav-tab-wrapper">';
			$count = count( $this->settings_sections );

			// don't show the navigation if only one section exists.
			if ( 1 === $count ) {
				return;
			}

			foreach ( $this->settings_sections as $tab ) {
				$html .= sprintf( '<a href="#%1$s" class="nav-tab" id="%1$s-tab">%2$s</a>', $tab['id'], $tab['title'] );
			}

			$html .= '</h1>';

			echo wp_kses( $html, self::$allowed_html_tags );
		}

		/**
		 * Show the section settings forms
		 *
		 * This function displays every sections in a different form
		 *
		 * @since     1.0.0
		 * @access    public
		 * @param     string $button_text Save button text.
		 */
		public function show_forms( $button_text = '' ) {
			/**
			 * Enqueue setting scripts
			 *
			 * This file uses localstorage for displaying active tabs
			 *
			 * @since     1.0.0
			 * @access    public
			 */
			wp_enqueue_media();
			wp_enqueue_style( 'sajjaddev-settings-api' );
			wp_enqueue_script( 'sajjaddev-settings-api' );

			?>
			<div class="wrap sajjaddev-wrap">
				<?php $this->show_navigation(); ?>
				<div class="metabox-holder">
					<?php foreach ( $this->settings_sections as $form ) { ?>
						<div id="<?php echo esc_attr( $form['id'] ); ?>" class="group">
							<form method="post" action="options.php">
								<?php
									settings_fields( $form['id'] );
									do_settings_sections( $form['id'] );
								?>
								<div><?php submit_button( $button_text ); ?></div>
							</form>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
endif;
