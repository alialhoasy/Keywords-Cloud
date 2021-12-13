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
            'keywords-cloud',  // Base ID
            'Keywords Cloud'   // Name
        );
		
		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_script( 'jqcloudjs', $dir = '/wp-content/plugins/keywords-cloud/js/jqcloud.min.js' , array('jquery'), false, true );
			wp_enqueue_script( 'keywordscloudjs', $dir = '/wp-content/plugins/keywords-cloud/js/keywords-cloud.js' , array('jquery', 'jqcloudjs'), false, true );
		});

		add_action( 'wp_enqueue_scripts', function () {
    		wp_enqueue_style('keywordscloudcss', $dir = '/wp-content/plugins/keywords-cloud/css/jqcloud.min.css', array());
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
		// Count Words
        echo '<div class="get-keywords-cloud" style="display:none">';
        echo esc_html__( wp_tag_cloud(array('number' => $instance['countwords'])), 'text_domain' );
        echo '</div>';
		
        echo '<div class="keywords-cloud" style="height: 300px;"></div>';
        echo $args['after_widget'];
 
    }
    public function form( $instance ) {
        $title 					= ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
        $countwords 			= ! empty( $instance['countwords'] ) ? $instance['countwords'] : esc_html__( 50, 'text_domain' );
        $keywordscloudcolor1 	= ! empty( $instance['keywordscloudcolor1'] ) ? $instance['keywordscloudcolor1'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor2 	= ! empty( $instance['keywordscloudcolor2'] ) ? $instance['keywordscloudcolor2'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor3 	= ! empty( $instance['keywordscloudcolor3'] ) ? $instance['keywordscloudcolor3'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor4 	= ! empty( $instance['keywordscloudcolor4'] ) ? $instance['keywordscloudcolor4'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor5 	= ! empty( $instance['keywordscloudcolor5'] ) ? $instance['keywordscloudcolor5'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor6 	= ! empty( $instance['keywordscloudcolor6'] ) ? $instance['keywordscloudcolor6'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor7 	= ! empty( $instance['keywordscloudcolor7'] ) ? $instance['keywordscloudcolor7'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor8 	= ! empty( $instance['keywordscloudcolor8'] ) ? $instance['keywordscloudcolor8'] : esc_html__( '', 'text_domain' );
        $keywordscloudcolor9 	= ! empty( $instance['keywordscloudcolor9'] ) ? $instance['keywordscloudcolor9'] : esc_html__( '', 'text_domain' );

        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'countwords' ) ); ?>"><?php echo esc_html__( 'Count Words:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'countwords' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'countwords' ) ); ?>" type="number" value="<?php echo esc_attr( $countwords ); ?>">
        </p>

        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor1') ); ?>"><?php echo esc_html__( 'Color 1:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor1' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor1 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor2') ); ?>"><?php echo esc_html__( 'Color 2:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor2' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor2 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor3') ); ?>"><?php echo esc_html__( 'Color 3:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor3' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor3 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor4') ); ?>"><?php echo esc_html__( 'Color 4:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor4' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor4 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor5') ); ?>"><?php echo esc_html__( 'Color 5:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor5' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor5 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor6') ); ?>"><?php echo esc_html__( 'Color 6:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor6' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor6' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor6 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor7') ); ?>"><?php echo esc_html__( 'Color 7:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor7' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor7' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor7 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor8') ); ?>"><?php echo esc_html__( 'Color 8:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor8' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor8' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor8 ); ?>">
        </p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor9') ); ?>"><?php echo esc_html__( 'Color 9:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'keywordscloudcolor9' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'keywordscloudcolor9' ) ); ?>" type="text" value="<?php echo esc_attr( $keywordscloudcolor9 ); ?>">
        </p>
		<?php 
    }
	public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] 		= ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['countwords'] = ( !empty( $new_instance['countwords'] ) ) ? strip_tags( $new_instance['countwords'] ) : '';
		for ($i=1; $i <= 9 ; $i++) {
        	$instance['keywordscloudcolor' . $i] = ( !empty( $new_instance['keywordscloudcolor' . $i] ) ) ? strip_tags( $new_instance['keywordscloudcolor' . $i] ) : '';
		}
        return $instance;
    }
}

$keywords_cloud = new Keywords_Cloud();
?>