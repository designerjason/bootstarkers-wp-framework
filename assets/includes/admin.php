<?php

	// Change the admin default welcome page
	function loginRedirect( $redirect_to, $request, $user ){
    	if( is_array( $user->roles ) ) { // check if user has a role
        	return home_url("/wp-admin/edit.php?post_type=ENTERHERE");

    	}
	}

	//add_filter("login_redirect", "loginRedirect", 10, 3);



	// Remove admin menu items
	function remove_menus () {
		get_currentuserinfo();
		global $current_user, $menu;

		if( ! in_array( 'administrator', $current_user->roles ) ){
			$restricted = array( __('Posts'), __('Links'), __('Tools'), __('Comments'), __('Feedbacks'), __('Settings'));
			end ($menu);

			while (prev($menu)){
				$value = explode(' ',$menu[key($menu)][0]);
				if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
			}
		}

	}

	add_action('admin_menu', 'remove_menus');

	// Remove Admin bar
	function remove_admin_bar(){
   		return false;
	}

	add_filter('show_admin_bar', 'remove_admin_bar'); 



?>