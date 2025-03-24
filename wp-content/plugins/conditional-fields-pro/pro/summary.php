<?php

class WPCF7CF_Summary {

    public static function register() {
        // Register shortcodes
        add_action('wpcf7_init', array(__CLASS__, 'add_shortcode'));

        // Tag generator
	    add_action('admin_init', array(__CLASS__, 'tag_generator'), 570);

        // generate summary html
        add_action( 'wpcf7_contact_form', [ __CLASS__, 'generate_summary_html'] );
    }

    public static function saveSummaryTemplate($summary_template, $post_id) {
        return update_post_meta($post_id,'wpcf7cf_summary',$summary_template);
    }

    public static function getSummaryTemplate($post_id) {
        return get_post_meta($post_id, 'wpcf7cf_summary', true);
    }

    public static function shortcode_handler($tag) {
        // Will not get called because [summary] is not a valid CF7 tag and CF7 5.7.3 added extra validation so it will ignore this tag.
        // That's why we use the generate_summary_html hook to replace the [summary] tag with the actual summary html.
        // We are using the same approach for steps, groups and repeaters.
    }

    /**
     * replace [summary] tag with summary html
     *
     * @param WPCF7_ContactForm $contact_form
     * @return void
     */
    public static function generate_summary_html($contact_form) {
		if (!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) { // TODO: kind of hacky. maybe find a better solution. Needed because otherwise the summary tags will be replaced in the editor as well.
            $form = $contact_form->prop( 'form' );
            $contact_form->set_properties( array(
                'form'   => str_replace('[summary]', '<div class="wpcf7cf-summary">Summary</div>', $form),
            ));
        }
    }

    public static function tag_generator() {
        // if (! class_exists( 'WPCF7_TagGenerator' ))
        //     return;

        // $tag_generator = WPCF7_TagGenerator::get_instance();
        // $tag_generator->add( 'summary', __( 'CF Summary', 'cf7-conditional-fields' ),
        //     array(__CLASS__, 'tg_pane') );
    }

    public static function tg_pane($contact_form, $args = '') {
        $args = wp_parse_args( $args, array() );
        $type = 'summary';
        $description = __('Create a Summary. This will generate a real time overview of all field values within the form.', 'wpcf7cf');


	    require_once dirname(__FILE__) . '/tg_pane_summary.php';
    }

    public static function add_shortcode() {
        if (function_exists('wpcf7_add_form_tag')) {
            wpcf7_add_form_tag(array('summary'), array(__CLASS__, 'shortcode_handler'), true);
        }
    }

    public static function wpcf7cf_get_summary_arr($posted_data) {

        $arr = [];
    
        if (isset($posted_data['_wpcf7'])) {
            $id = (int) $posted_data['_wpcf7'];
    
            $template =  WPCF7CF_Summary::getSummaryTemplate($id);
    
            if ($contact_form = wpcf7_contact_form($id)) {
    
                if ($template == "") {
                    $arr['summaryHtml'] = self::wpcf7cf_get_summary_table_html($posted_data);
                    return $arr;
                }
    
                $html = self::wpcf7cf_generate_summary($contact_form, $template, $posted_data);
                $arr['summaryHtml'] = $html;
            }
        }
    
        return $arr;
    
    }
    
    public static function wpcf7cf_get_summary_table_html($posted_data) {
        ob_start();
        echo "<table>";
        foreach($posted_data as $key => $value) {
            if (strpos($key,'_wpcf7') !== false) continue;
            $v = is_array($value) ? implode(', ',$value) : $value;
            echo "<tr><td><strong>$key</strong></td><td>$v</td></tr>";
        }
        echo "</table>";
        return ob_get_clean();
    }
    
    public static function wpcf7cf_generate_summary($contact_form, $email_template, $posted_data) {
    
        $hidden_groups = json_decode(stripslashes($posted_data['_wpcf7cf_hidden_groups']));
        $visible_groups = json_decode(stripslashes($posted_data['_wpcf7cf_visible_groups']));
        $repeaters = json_decode(stripslashes($posted_data['_wpcf7cf_repeaters']));
        $steps = json_decode(stripslashes($posted_data['_wpcf7cf_steps']));

        // add support for checkbox free_text option
        foreach($posted_data as $key => $value) {
            if(str_starts_with($key, '_wpcf7_free_text_')) {
                $checkbox_field_name = str_replace('_wpcf7_free_text_', '', $key);
                if (isset($posted_data[$checkbox_field_name]) && is_array($posted_data[$checkbox_field_name])) {
                    // append value to last element of array
                    $posted_data[$checkbox_field_name][count($posted_data[$checkbox_field_name])-1] .= ' ' . $value;
                } 
            }
        }
        
    
        $parser = new Wpcf7cfMailParser($email_template, $visible_groups, $hidden_groups, $repeaters, $posted_data);
    
        return self::wpcf7cf_summary_replace_tags( $parser->getParsedMail(), $posted_data );
    }
    
    public static function wpcf7cf_summary_replace_tags($parsed_template, $posted_data = null) {
    
        $regex = '/(\[?)\[[\t ]*'
            . '([a-zA-Z_][0-9a-zA-Z:._-]*)' // [2] = name
            . '((?:[\t ]+"[^"]*"|[\t ]+\'[^\']*\')*)' // [3] = values
            . '[\t ]*\](\]?)/';
    
        return preg_replace_callback( $regex, function($matches) use ($posted_data) {
            return self::wpcf7cf_replace_tags_callback( $matches, false, $posted_data );
        }, $parsed_template );
    
    }
    
    
    /**
     * Based on WPCF7_MailTaggedText->replace_tags_callback, but without depending on actual form submission.
     *
     * @param [type] $matches
     * @param boolean $html
     * @return void
     */
    public static function wpcf7cf_replace_tags_callback( $matches, $html = false, $posted_data = null ) {
        // allow [[foo]] syntax for escaping a tag
        if ( $matches[1] == '['
        and $matches[4] == ']' ) {
            return substr( $matches[0], 1, -1 );
        }

        $posted_data = $posted_data ?? $_POST;
    
        $tag = $matches[0];
        $tagname = $matches[2];
        $values = $matches[3];
    
        $mail_tag = new WPCF7_MailTag( $tag, $tagname, $values );
    
        $submitted = isset($posted_data[$tagname]) ? $posted_data[$tagname] : '';

        if ($submitted === '') {
            $submitted = isset($_FILES[$tagname]) ? $_FILES[$tagname]['name'] : '';
        }
    
        $replaced = $submitted;
    
        // if ( $format = $mail_tag->get_option( 'format' ) ) {
        //     $replaced = $this->format( $replaced, $format );
        // }
    
        $replaced = wpcf7_flat_join( $replaced );
    
        if ( $html ) {
            $replaced = esc_html( $replaced );
            $replaced = wptexturize( $replaced );
        }
    
        if ( $form_tag = $mail_tag->corresponding_form_tag() ) {
            $type = $form_tag->type;
    
            $replaced = apply_filters(
                "wpcf7_mail_tag_replaced_{$type}", $replaced,
                $submitted, $html, $mail_tag );
        }
    
        $replaced = apply_filters( 'wpcf7_mail_tag_replaced', $replaced,
            $submitted, $html, $mail_tag );
    
        $replaced = wp_unslash( trim( $replaced ) );
    
        // $this->replaced_tags[$tag] = $replaced;
        return $replaced;
        
    }
}

WPCF7CF_Summary::register();

add_filter('wpcf7_editor_panels', 'add_summary_panel');

function add_summary_panel($panels) {
	if ( current_user_can( 'wpcf7_edit_contact_forms' ) ) {
		$panels['wpcf7cf-summary-panel'] = array(
			'title'    => __( 'Summary', 'wpcf7cf' ),
			'callback' => 'wpcf7cf_editor_panel_summary'
		);
	}
	return $panels;
}

function wpcf7cf_editor_panel_summary($form) {

    $post = null;
    $summary = '';
    // $suggested_mail_tags = '<span class="mailtag code used">[your-name]</span><span class="mailtag code used">[your-email]</span><span class="mailtag code used">[your-subject]</span><span class="mailtag code used">[your-message]</span>';

    $is_new_form = isset( $_GET['post'] );
    if ($is_new_form) {
        // EXISTING FORM
        $form_id = $_GET['post'];
        $post = WPCF7_ContactForm::get_instance($form_id);
        $summary = WPCF7CF_Summary::getSummaryTemplate($form_id);
    } else {
        // NEW FORM
        $post = WPCF7_ContactForm::get_template();
        $summary = WPCF7_ContactFormTemplate::mail()['body'];
    }

	$desc_link = wpcf7_link(
		__( 'https://contactform7.com/setting-up-mail/', 'wpcf7cf' ),
		__( 'Setting Up Mail', 'wpcf7cf' ) );
	$description = __( "You can edit the summary template here. This will be used to replace the [summary] tag. The summary template follows the same rules as the Mail template. For details, see %s.", 'wpcf7cf' );
	$description = sprintf( esc_html( $description ), $desc_link );

	?>
    <div class="wpcf7cf-inner-container">
        <h2><?php echo esc_html( __( 'Summary', 'wpcf7cf' ) ); ?></h2>
		
		<?php
			echo $description;
			echo '<br><br>';
		
			echo esc_html( __( "In the summary field, you can use these tags:",
				'wpcf7cf' ) );
			echo '<br />';
			$post->suggest_mail_tags( 'mail' );
		?>

		<table class="form-table">
			<tr>
				<th scope="row"><label for="wpcf7cf-summary-template">Summary template</label></th>
				<td><textarea class="large-text code" cols="100" rows="18" id="wpcf7cf-summary-template" name="wpcf7cf-summary-template"><?php echo $summary ?></textarea></td>
			</tr>
		</table>
		
    </div>
<?php
}