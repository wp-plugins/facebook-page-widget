<?php
/**
 * @package facebook-Page-Widget.php
*/
/*
Plugin Name: Facebook Page Widget 
Plugin URI: http://www.joomexperts.com
Description: Thanks for installing Facebook Widget 
Version: 1.0
Author: Priam Talukder
Author URI: http://www.joomexperts.com
*/

class FacebookPageWidget extends WP_Widget{
    
    public function __construct() {
        $params = array(
            'description' => 'Thanks for installing Facebook Page Widget',
            'name' => 'Facebook Page Widget '
        );
        parent::__construct('FacebookPageWidget','',$params);
    }
    
    public function form($instance) {
        extract($instance);
        
        ?>
<!-- here will put all widget configuration -->
<p>
    <label for="<?php echo $this->get_field_id('title');?>">Title : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('title');?>"
	name="<?php echo $this->get_field_name('title');?>"
        value="<?php echo !empty($title) ? $title : "Facebook Widget Plus"; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('fb_url');?>">Facebook Page URL : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('fb_url');?>"
	name="<?php echo $this->get_field_name('fb_url');?>"
        value="<?php echo !empty($fb_url) ? $fb_url : "https://www.facebook.com/FacebookDevelopers"; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('width');?>">Width : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('width');?>"
	name="<?php echo $this->get_field_name('width');?>"
        value="<?php echo !empty($width) ? $width : "300"; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('height');?>">Height : </label>
    <input
	class="widefat"
	id="<?php echo $this->get_field_id('height');?>"
	name="<?php echo $this->get_field_name('height');?>"
        value="<?php echo !empty($height) ? $height : "550"; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id( 'cover_photo' ); ?>">Hide Cover Photo:</label> 
    <select id="<?php echo $this->get_field_id( 'cover_photo' ); ?>"
        name="<?php echo $this->get_field_name( 'cover_photo' ); ?>"
        class="widefat" style="width:100%;">
            <option value="0" <?php if ($cover_photo == '0') echo 'selected="0"'; ?> >Yes</option>
            <option value="1" <?php if ($cover_photo == '1') echo 'selected="1"'; ?> >No</option>	
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'face' ); ?>">Show Friends Faces:</label> 
    <select id="<?php echo $this->get_field_id( 'face' ); ?>"
        name="<?php echo $this->get_field_name( 'face' ); ?>"
        class="widefat" style="width:100%;">
            <option value="true" <?php if ($face == 'true') echo 'selected="true"'; ?> >Yes</option>
            <option value="false" <?php if ($face == 'false') echo 'selected="false"'; ?> >No</option>	
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'post' ); ?>">Show Post:</label> 
    <select id="<?php echo $this->get_field_id( 'post' ); ?>"
        name="<?php echo $this->get_field_name( 'post' ); ?>"
        class="widefat" style="width:100%;">
            <option value="true" <?php if ($post == 'true') echo 'selected="true"'; ?> >Yes</option>
            <option value="false" <?php if ($post == 'false') echo 'selected="false"'; ?> >No</option>	
    </select>
</p>
<?php
    }
    
    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        $title = apply_filters('widget_title', $title);
        $description = apply_filters('widget_description', $description);
	   if(empty($title)) $title = "Facebook Page Widget ";
        if(empty($fb_url)) $fb_url = "http://www.facebook.com/FacebookDevelopers";
        if(empty($width)) $width = "300";
        if(empty($height)) $height = "550";
        if(empty($cover_photo)) $cover_photo = "0";
        if(empty($face)) $face = "true";
        if(empty($post)) $post = "true";
        echo $before_widget;
            echo $before_title . $title . $after_title;
            
            ?>

  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=262562957268319&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        
         <div class="facebook_page_widget">
      	     <div class="fb-page"
                data-href="<?php echo $fb_url;?>" 
                data-width="<?php echo $width;?>" 
                data-height="<?php echo $height;?>"
                 <?php if($cover_photo=='0') {?>
                data-hide-cover="true" 
                 <?php } else { ?>
                data-hide-cover="false"
                 <?php } ?>
                 <?php if($face=='true') {?>
                data-show-facepile="true" 
                 <?php } else { ?>
                 data-show-facepile="false"
                 <?php } ?> 
                 <?php if($post=='true') {?>
                data-show-posts="true"
                 <?php } else { ?>
                data-show-posts="false">
                 <?php } ?>
             </div>
       </div>
<?php
        echo $after_widget;
    }
}

add_action('widgets_init','register_FacebookPageWidget');
function register_FacebookPageWidget(){
    register_widget('FacebookPageWidget');
}