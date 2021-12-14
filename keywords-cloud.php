<?php
/**
 * Plugin Name:       Keywords Cloud
 * Plugin URI:        https://www.alhoasy.com/
 * Description:       This plugin colors and decorates the tags and makes them more aesthetic than the default word cloud.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ali Alhoasy
 * Author URI:        https://github.com/alialhoasy/Keywords-Cloud
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       keywords-cloud
 * Domain Path:       /languages
 */
class Keywords_Cloud extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'keywords-cloud-widget',  // Base ID
            'Keywords Cloud'   // Name
        );

		// Script Files
		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_script( 'jqcloudjs', plugins_url('js/jqcloud.min.js',  __FILE__ )  , array('jquery'), false, true );
			wp_enqueue_script( 'keywordscloudjs', plugins_url('js/keywords-cloud.js', __FILE__ )  , array('jquery', 'jqcloudjs'), false, true );
		});

        // Css Files
		add_action( 'wp_enqueue_scripts', function () {
    		wp_enqueue_style('keywordscloudcss', plugins_url('css/jqcloud.min.css', __FILE__ ) , array());
		}, 20);

        add_action( 'widgets_init', function() {
            register_widget( 'Keywords_Cloud' );
        });
		
    }
	public $args = array(
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div class="widget-wrap">',
		'after_widget'  => '</div></div>'
	);

    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

		// Color
        echo '<div class="get-keywords-cloud-color" style="display:none">';
		for ($i=1; $i <= 9 ; $i++) {
			echo '<span>' . esc_html__($instance['keywordscloudcolor' . $i], 'text_domain' ) . '</span>';
		}
        echo '</div>';

        // Get Option
        echo '<div style="display:none;position:absolute;">';
            echo '<span class="option-keywords-shape">' . $instance['keywordscloudshape'] . '</span>';
            echo '<span class="option-keywords-autoresize">' . $instance['keywordscloudautoResize'] . '</span>';
            echo '<span class="option-keywords-delay">' . $instance['keywordsclouddelay'] . '</span>';
            echo '<span class="option-keywords-fontSizefrom">' . $instance['keywordscloudfontSizefrom'] . '</span>';
            echo '<span class="option-keywords-fontSizeto">' . $instance['keywordscloudfontSizeto'] . '</span>';
        echo '</div>';
        
		// Count Words
        echo '<div class="get-keywords-cloud" style="display:none">';
        echo esc_html__( wp_tag_cloud(array('number' => $instance['keywordscloudcountwords'])), 'text_domain' );
        echo '</div>';
		
        echo '<div class="keywords-cloud" style="width: 100%;height: 300px; line-height: normal;overflow: hidden;"></div>';
        echo $args['after_widget'];
 
    }
    public function form( $instance ) {

        $title 					        = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $keywordscloudcountwords 	    = ! empty( $instance['keywordscloudcountwords'] ) ? $instance['keywordscloudcountwords'] : esc_html__( 50, 'text_domain' );
        $keywordscloudshape             = ! empty( $instance['keywordscloudshape'] ) ? $instance['keywordscloudshape'] : esc_html__( 'rectangular', 'text_domain' );
        $keywordscloudautoResize        = ! empty( $instance['keywordscloudautoResize'] ) ? $instance['keywordscloudautoResize'] : esc_html__( 'false', 'text_domain' );
        $keywordsclouddelay             = ! empty( $instance['keywordsclouddelay'] ) ? $instance['keywordsclouddelay'] : esc_html__( 10, 'text_domain' );
        $keywordscloudfontSizefrom      = ! empty( $instance['keywordscloudfontSizefrom'] ) ? $instance['keywordscloudfontSizefrom'] : esc_html__( 0.1, 'text_domain' );
        $keywordscloudfontSizeto        = ! empty( $instance['keywordscloudfontSizeto'] ) ? $instance['keywordscloudfontSizeto'] : esc_html__( 0.02, 'text_domain' );
        $keywordscloudcolor1 	        = ! empty( $instance['keywordscloudcolor1'] ) ? $instance['keywordscloudcolor1'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor2 	        = ! empty( $instance['keywordscloudcolor2'] ) ? $instance['keywordscloudcolor2'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor3 	        = ! empty( $instance['keywordscloudcolor3'] ) ? $instance['keywordscloudcolor3'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor4 	        = ! empty( $instance['keywordscloudcolor4'] ) ? $instance['keywordscloudcolor4'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor5 	        = ! empty( $instance['keywordscloudcolor5'] ) ? $instance['keywordscloudcolor5'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor6 	        = ! empty( $instance['keywordscloudcolor6'] ) ? $instance['keywordscloudcolor6'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor7 	        = ! empty( $instance['keywordscloudcolor7'] ) ? $instance['keywordscloudcolor7'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor8 	        = ! empty( $instance['keywordscloudcolor8'] ) ? $instance['keywordscloudcolor8'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor9 	        = ! empty( $instance['keywordscloudcolor9'] ) ? $instance['keywordscloudcolor9'] : esc_html__( '', 'text_domain' );


        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcountwords' ) ); ?>"><?php echo esc_html__( 'Count Words:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcountwords' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcountwords' ) ); ?>" type="number" value="<?php echo esc_attr( $keywordscloudcountwords ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudshape' ) ); ?>"><?php echo esc_html__( 'Shape:', 'text_domain' ); ?></label>
            <select class="widefat keywordscloudshape" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudshape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudshape' ) ); ?>">
                <option value="rectangular" <?php echo (esc_attr( $keywordscloudshape ) == 'rectangular' ? ' selected' : ''); ?>>rectangular</option>
                <option value="elliptic" <?php echo (esc_attr( $keywordscloudshape ) == 'elliptic' ? ' selected' : ''); ?>>elliptic</option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudautoResize' ) ); ?>"><?php echo esc_html__( 'Auto Resize:', 'text_domain' ); ?></label>
            <select class="widefat keywordscloudautoResize" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudautoResize' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudautoResize' ) ); ?>">
                <option value="true" <?php echo (esc_attr( $keywordscloudautoResize ) == 'true' ? ' selected' : ''); ?>>Yes</option>
                <option value="false" <?php echo (esc_attr( $keywordscloudautoResize ) == 'false' ? ' selected' : ''); ?>>No</option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordsclouddelay' ) ); ?>"><?php echo esc_html__( 'Delay:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordsclouddelay' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordsclouddelay' ) ); ?>" type="number" value="<?php echo esc_attr( $keywordsclouddelay ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudfontSizefrom' ) ); ?>"><?php echo esc_html__( 'Font Size (From):', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudfontSizefrom' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudfontSizefrom' ) ); ?>" type="number" value="<?php echo esc_attr( $keywordscloudfontSizefrom ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudfontSizeto' ) ); ?>"><?php echo esc_html__( 'Font Size (To):', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudfontSizeto' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudfontSizeto' ) ); ?>" type="number" value="<?php echo esc_attr( $keywordscloudfontSizeto ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor1') ); ?>"><?php echo esc_html__( 'Color 1:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor1' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor1 ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor2') ); ?>"><?php echo esc_html__( 'Color 2:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor2' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor2 ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor3') ); ?>"><?php echo esc_html__( 'Color 3:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor3' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor3 ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor4') ); ?>"><?php echo esc_html__( 'Color 4:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor4' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor4 ); ?>">
        </p>

        </p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor5') ); ?>"><?php echo esc_html__( 'Color 5:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor5' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor5 ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor6') ); ?>"><?php echo esc_html__( 'Color 6:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor6' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor6' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor6 ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor7') ); ?>"><?php echo esc_html__( 'Color 7:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor7' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor7' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor7 ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor8') ); ?>"><?php echo esc_html__( 'Color 8:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor8' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor8' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor8 ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor9') ); ?>"><?php echo esc_html__( 'Color 9:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor9' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor9' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor9 ); ?>">
        </p>
		<?php 
    }
	public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] 		                        = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['keywordscloudcountwords']            = ( !empty( $new_instance['keywordscloudcountwords'] ) ) ? strip_tags( $new_instance['keywordscloudcountwords'] ) : '';
        $instance['keywordscloudshape']                 = ( !empty( $new_instance['keywordscloudshape'] ) ) ? strip_tags( $new_instance['keywordscloudshape'] ) : '';
        $instance['keywordscloudautoResize']            = ( !empty( $new_instance['keywordscloudautoResize'] ) ) ? strip_tags( $new_instance['keywordscloudautoResize'] ) : '';
        $instance['keywordsclouddelay']                 = ( !empty( $new_instance['keywordsclouddelay'] ) ) ? strip_tags( $new_instance['keywordsclouddelay'] ) : '';
        $instance['keywordscloudfontSizefrom']          = ( !empty( $new_instance['keywordscloudfontSizefrom'] ) ) ? strip_tags( $new_instance['keywordscloudfontSizefrom'] ) : '';
        $instance['keywordscloudfontSizeto']            = ( !empty( $new_instance['keywordscloudfontSizeto'] ) ) ? strip_tags( $new_instance['keywordscloudfontSizeto'] ) : '';


		for ($i=1; $i <= 9 ; $i++) {
        	$instance['keywordscloudcolor' . $i] = ( !empty( $new_instance['keywordscloudcolor' . $i] ) ) ? strip_tags( $new_instance['keywordscloudcolor' . $i] ) : '';
		}
        return $instance;
    }
}

if( class_exists( 'Keywords_Cloud' ) ) {
	$keywords_cloud = new Keywords_Cloud();
}

?>
