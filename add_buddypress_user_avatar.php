function add_buddypress_user_avatar($new_user_id,$avatar_url){

            $new_file_name= md5($avatar_url);
            //cheks dirs
            $upload_dir   = wp_upload_dir();
            $avatar_dir = $upload_dir['basedir'].'/avatars/';
            $avatar_user_dir=$avatar_dir.''.$new_user_id;
            $avatar_user_path_file=$avatar_user_dir.'/'.$new_file_name.'-original.jpg';
            if (!file_exists($avatar_user_dir)) { //check if directory exist if not create
                @mkdir($avatar_user_dir, 0770, true);
            }
            //copy original file to avatar user dir
            @copy($avatar_url, $avatar_user_path_file); //importe from the url image

            $image = wp_get_image_editor( $avatar_user_path_file );
              if ( ! is_wp_error( $image ) ) {
                  $image->resize( 150, 150, true ); //size of bpfull
                  $new_image_bpfull=str_replace('-original','-bpfull',$avatar_user_path_file);
                  $image->save($new_image_bpfull);
                  $image->resize( 50, 50, true );   //size of bpthumb
                  $new_image_bpthumb=str_replace('-original','-bpthumb',$avatar_user_path_file);
                  $image->save($new_image_bpthumb);
                  @unlink($avatar_user_path_file);   //remove the original one 
              } 
}
