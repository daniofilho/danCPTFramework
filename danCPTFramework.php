<?php

/**
 * Simples class functions to optimize the Custom Post Fields build process.
 *
 * ! MUST be called inside Wordpress !
 *
 * @since      1.0.0
 * @package    danCPTFw
 * @author     Dânio Filho
 */
class danCPTFw {

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Geral
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

      /**
   	 * Begin
   	 *
   	 * @since    1.0.0
   	 */
      public function __construct() {

   	}


      /**
   	*	Handles a string before echo to avoid special caracters problems.
   	*
   	* @since 1.0.0
   	*
   	*/
   	public function trata_string( $string ) {

   		$string = str_replace( '\"' , '"', $string );
   		$string = str_replace( "\'" , "'", $string );

   		return $string;
   	}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Campos
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

   /**
    * Checkbox ( input[type=text] )
    *
    * @since    1.0.0
    */
    public function getInput_text($name, $value, $style=""){ ?>
      <input type="text" name="<?= $name; ?>" value="<?= $value; ?>" style="<?= $style; ?>" />
    <?php
    }

   /**
    * Checkbox ( input[type=checkbox] )
    *
    * @since    1.0.0
    */
    public function getInput_checkbox($name, $value){ ?>
      <input type="checkbox" name="<?= $name; ?>" value="checked" <?= $value; ?> />
    <?php
    }

   /**
    * Textarea
    *
    * @since    1.0.0
    */
    public function getInput_textarea($name, $value, $style){ ?>
      <textarea name="<?= $name; ?>" style="<?= $style; ?>"><?= $this->trata_string( $value ); ?></textarea>
    <?php
    }




/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Wordpress Core
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


    /**
    *  Returns the default Wordpress Text Editor.
    *
    * @since    1.0.0
    */
    public function getWPCore_wp_editor($name, $value, $args="") {

      //$args Args for the function:  wp_editor #https://codex.wordpress.org/Function_Reference/wp_editor
      if( $args == "" )
         $args = array( 'textarea_rows' => 10 );

      wp_editor( $this->trata_string( $value ), $name, $args );
    }

    /**
     * Returnas a FILE field using the default Wordpress Media Uploader
     *
     * @since    1.0.0
     */
     public function getWPCore_file($name, $value, $btn_label="Choose file") {  ?>
         <div>
           <img src="<?= $value ?>" width="128" id="img_<?= $name; ?>"><br/>
           <input type="text" name="<?= $name; ?>" id="<?= $name; ?>" value="<?= $value; ?>" />
           <input type="button" id="btn_<?= $name; ?>" class="button-secondary" value="<?= $btn_label; ?>">
         </div>

        <script type="text/javascript">
           jQuery(document).ready(function($){
              $('#btn_<?= $name; ?>').click(function(e) {
                   e.preventDefault();
                   var image = wp.media({
                       title: '<?= $btn_label; ?>',
                       multiple: false
                   }).open()
                   .on('select', function(e){
                       var uploaded_image = image.state().get('selection').first();
                       var image_url = uploaded_image.toJSON().url;
                       $('#<?= $name; ?>').val(image_url);
                       $('#img_<?= $name; ?>').attr('src',image_url);
                   });
              });
           });
        </script>

      <?php
        /*
         In case of errors, try to include this code to force Wordpress to load the necessary files for upload.
         function load_wp_media_files() {
             wp_enqueue_media();
         }
         add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
        */

     }//getWPCore_wp_editor()


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Front End
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

   /**
   *  Return the text with the default text filters of Wordpress.
   *
   * @since    1.0.0
   */
   public function getFE_content($content) {
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
   }//getFE_content

}//danCPTFw
