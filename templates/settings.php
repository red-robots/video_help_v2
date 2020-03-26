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
    $menu_label     = trim($_POST['video_menu_label']);
    $title_label    = trim($_POST['video_title_label']);

    if( $edit_video && $view_video){
        update_option('edit_video_role', $edit_video);
        update_option('view_video_role', $view_video);
        update_option('video_help_menu_label', $menu_label);
        update_option('video_help_title_label', $title_label);
        $message = 'Roles have been saved!';
    }

}

$edit_video = get_option('edit_video_role');
$view_video = get_option('view_video_role');
$menu_label = get_option('video_help_menu_label');
$title_label = get_option('video_help_title_label');

?>

<div class="wrap">
    <?php if( $message ): ?>
        <div class="updated_settings_error notice is-dismissable"><strong><?php echo $message; ?></strong></div>
    <?php endif; ?>

    <h2>Settings</h2>

    <h1 style="font-size: 30px">Roles</h1>

    <p>Use these options to specify roles.</p>
    <form action="" method="post">
        <table class="form-table">
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
                            <input type="text" name="video_title_label" id="video_title_label" autocomplete="off" value="<?php echo esc_attr( $title_label ); ?>">
                        </div>

                        <div class="input-text-wrap" id="description-wrap">
                            <div>
                                <label for="video_menu_label">Menu Label</label>
                            </div>                            
                            <input type="text" name="video_menu_label" id="video_menu_label" autocomplete="off" value="<?php echo esc_attr( $menu_label ); ?>">
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="column-right ">
                <h2>Agency</h2>
                <div class="">                        
                        <div class="input-text-wrap video_agency_input">
                            <input type="checkbox" name="video_activate_agency_link" id="video_activate_agency_link"> Activate Agency Link
                        </div>

                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Title</label>
                            </div>                            
                            <input type="text" name="video_agency_title" id="video_agency_title" autocomplete="off">
                        </div>

                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Branding</label>
                            </div>                            
                            <input type="file" name="video_agency_branding" id="video_agency_branding" autocomplete="off">
                        </div>

                        <div class="input-text-wrap video_agency_input" >
                            <div>
                                <label for="video_menu_label">Button Link</label>
                            </div>                            
                            <input type="text" name="video_agency_button_link" id="video_agency_button_link" autocomplete="off">
                            <div><small>Ex: https://mywebsite.com/contact-us</small></div>
                        </div>
                    
                </div>
            </div>
        </div>
        
        <div class="clearfix" style="clear: both;"></div>

        <button type="submit" class="button button-primary" name="custom_video_submit_values">Save Changes</button>
    </form>
</div>