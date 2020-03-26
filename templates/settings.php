<?php
$message = '';

$roles = array(
        'subscriber'    => 'Subscriber',
        'contributor'   => 'Contributor',
        'author'        => 'Author',
        'editor'        => 'Editor',
        'administrator' => 'Administrator',
);

if( array_key_exists( 'custom_video_submit_values', $_POST) ){   

    $edit_video     = trim($_POST['edit_video_role']);
    $view_video     = trim($_POST['view_video_role']);
    $menu_label     = isset( $_POST['video_menu_label'] ) ? trim($_POST['video_menu_label']) : 'Video Help';
    $title_label    = isset( $_POST['video_title_label'] ) ? trim($_POST['video_title_label']) : 'Table of Contents';


    $video_activate_agency_link     = isset($_POST['video_activate_agency_link']) ? trim($_POST['video_activate_agency_link']) : '';
    $video_agency_title             = isset($_POST['video_agency_title']) ? trim($_POST['video_agency_title']) : '';    
    $video_agency_button_link       = isset($_POST['video_agency_button_link']) ? trim($_POST['video_agency_button_link']) : '';
    $video_agency_button_color      = isset($_POST['video_agency_button_color']) ? trim($_POST['video_agency_button_color']) : '';
    $video_agency_button_text_color = isset($_POST['video_agency_button_text_color']) ? trim($_POST['video_agency_button_text_color']) : '';
    $video_agency_background_color  = isset($_POST['video_agency_background_color']) ? trim($_POST['video_agency_background_color']) : '';
    $video_agency_description       = isset($_POST['video_agency_description']) ? trim($_POST['video_agency_description']) : '';

    $video_agency_branding          = $_FILES['video_agency_branding'];

    if( $_FILES['video_agency_branding']['name'] != '' ){
        $uploadedfile = $_FILES['video_agency_branding'];
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        $imageurl = "";
        if ( $movefile && ! isset( $movefile['error'] ) ) {
           $imageurl = $movefile['url'];
           update_option('video_agency_branding', esc_url( $imageurl ) );          
        } 
    }
 
    

    if( $edit_video && $view_video){
        update_option('edit_video_role', sanitize_text_field( $edit_video )  );
        update_option('view_video_role', sanitize_text_field( $view_video ) );
        update_option('video_help_menu_label', sanitize_text_field( $menu_label ) );
        update_option('video_help_title_label', sanitize_text_field( $title_label ) );

        update_option('video_activate_agency_link', sanitize_text_field( $video_activate_agency_link ) );
        update_option('video_agency_title', sanitize_text_field( $video_agency_title ) );
        update_option('video_agency_button_link', esc_url( $video_agency_button_link ) );
        update_option('video_agency_button_color', sanitize_text_field( $video_agency_button_color ) );
        update_option('video_agency_button_text_color', sanitize_text_field( $video_agency_button_text_color ) );
        update_option('video_agency_background_color', sanitize_text_field( $video_agency_background_color ) );
        update_option('video_agency_description', sanitize_text_field( $video_agency_description ) );

        $message = 'Settings have been saved!';
    }

}

$edit_video = esc_attr( get_option('edit_video_role') );
$view_video = esc_attr( get_option('view_video_role') );
$menu_label = esc_attr( get_option('video_help_menu_label') );
$title_label = esc_attr( get_option('video_help_title_label') );

$video_activate_agency_link = esc_attr( get_option('video_activate_agency_link') );
$video_agency_title = esc_attr( get_option('video_agency_title') );
$video_agency_button_link = esc_attr( get_option('video_agency_button_link') );
$video_agency_button_color = esc_attr( get_option('video_agency_button_color') );
$video_agency_button_text_color = esc_attr( get_option('video_agency_button_text_color') );
$video_agency_background_color = esc_attr( get_option('video_agency_background_color') );
$video_agency_description = esc_attr( get_option('video_agency_description') );

$video_agency_branding = esc_attr( get_option('video_agency_branding') );

?>

<div class="wrap">
    <?php if( $message ): ?>
        <div class="updated_settings_error notice is-dismissable"><strong><?php echo $message; ?></strong></div>
    <?php endif; ?>

    <h2>Settings</h2>

    <h1 style="font-size: 30px">Roles</h1>

    <p>Use these options to specify roles.</p>
    <form action="" method="post" enctype='multipart/form-data'>
        <table class="form-table" >
            <tbody>
                <tr>
                    <th scope="row" >
                        <label for="edit_videos">Edit Videos</label>
                    </th>
                    <td>
                        <select name="edit_video_role" id="edit_video_role">
                            <?php foreach( $roles as $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php echo ($edit_video == $key) ? "selected":""; ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>                            
                        </select>
                        <p class="description">Select the role which can edit Easy Support Videos. Please note: Roles inherit capabilities by default Wordpress. If the "Contributor" role is selected, every role that inherits Contributor will be able to edit Easy Support Videos.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row" >
                        <label for="edit_videos">View Videos</label>
                    </th>
                    <td>
                        <select name="view_video_role" id="view_video_role">
                            <?php foreach( $roles as $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php echo ($view_video == $key) ? " selected ":""; ?> ><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="description">Select the role which can edit Easy Support Videos. Please note: Roles inherit capabilities by default Wordpress. If the "Contributor" role is selected, every role that inherits Contributor will be able to edit Easy Support Videos.</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="column_holder ">
            <div class="column-left ">
                <div >
                    <h2 >White Label</h2>
                    <div class="">                        
                        <div class="input-text-wrap" id="title-wrap">       
                            <div><label for="video_title_label">
                                    Title Label          </label>
                            </div>                     
                            <input type="text" name="video_title_label" id="video_title_label" autocomplete="off" value="<?php echo  $title_label ; ?>">
                        </div>

                        <div class="input-text-wrap" id="description-wrap">
                            <div>
                                <label for="video_menu_label">Menu Label</label>
                            </div>                            
                            <input type="text" name="video_menu_label" id="video_menu_label" autocomplete="off" value="<?php echo  $menu_label ; ?>">
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="column-right ">
                <h2>Agency</h2>
                <div class="">                        
                        <div class="input-text-wrap video_agency_input">
                            <label for="video_activate_agency_link">
                            <input type="checkbox" name="video_activate_agency_link" id="video_activate_agency_link" value="1" <?php echo ( $video_activate_agency_link ) ? ' checked ':''; ?>> Activate Agency Link
                            </label>
                        </div>

                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Title</label>
                            </div>                            
                            <input type="text" name="video_agency_title" id="video_agency_title" autocomplete="off" value="<?php echo $video_agency_title;  ?>">
                        </div>

                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Branding</label>
                            </div>                            
                            <input type="file" name="video_agency_branding" id="video_agency_branding">
                            <?php if( $video_agency_branding ): ?>
                                <img src="<?php echo $video_agency_branding ?>" alt="" style="max-height:20px; width: auto; ">
                            <?php endif; ?>
                        </div>

                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Button Link</label>
                            </div>                            
                            <input type="text" name="video_agency_button_link" id="video_agency_button_link" autocomplete="off" value="<?php echo $video_agency_button_link ?>">
                            <div><small>Ex: https://mywebsite.com/contact-us</small></div>
                        </div>


                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Button Color</label>
                            </div>                            
                            <input type="text" name="video_agency_button_color" id="video_agency_button_color" autocomplete="off" class="cpa-color-picker" value="<?php echo $video_agency_button_color; ?>">                            
                        </div>

                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Button Text Color</label>
                            </div>                            
                            <input type="text" name="video_agency_button_text_color" id="video_agency_button_text_color" autocomplete="off" class="cpa-color-picker" value="<?php echo $video_agency_button_text_color; ?>">                            
                        </div>


                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Background Color</label>
                            </div>                            
                            <input type="text" name="video_agency_background_color" id="video_agency_background_color" autocomplete="off" class="cpa-color-picker" value="<?php echo $video_agency_background_color; ?>">                            
                        </div>


                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Description</label>
                            </div>                            
                            <?php
                                $content = get_option('video_agency_description');
                                wp_editor( $content, 'video_agency_description', $settings = array('textarea_rows'=> '10') );

                            ?>                            
                        </div>
                    
                </div>
            </div>
        </div>
        
        <div class="clearfix" style="clear: both;"></div>

        <button type="submit" class="button button-primary" name="custom_video_submit_values">Save Changes</button>
    </form>
</div>