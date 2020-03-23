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

    $edit_video = $_POST['edit_video_role'];
    $view_video = $_POST['view_video_role'];

    if( $edit_video && $view_video){
        update_option('edit_video_role', $edit_video);
        update_option('view_video_role', $view_video);
        $message = 'Roles have been saved!';
    }

}

$edit_video = get_option('edit_video_role');
$view_video = get_option('view_video_role');

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
        <button type="submit" class="button button-primary" name="custom_video_submit_values">Save Changes</button>
    </form>
</div>