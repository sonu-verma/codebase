<?php

	if(!function_exists('check_value_in_associated_array')){
		function check_value_in_associated_array($asArray,$value){
			// dd(json_encode(json_decode($asArray,true)));
			if(isset($asArray)){
				foreach($asArray as $array){
					if($array->id === $value){
						return true;
					}
				}
				return false;
			}else{
				return false;
			}
		}
	}


	if(!function_exists('get_user_roles')){
		function get_login_user_roles(){
			$roles = auth()->user()->roles;
			$totalRole = count($roles);
			$output = '';	
			foreach($roles as $key=>$role){
				$output .= $role->display_name;
				$output .= ($totalRole != $key+1)? ' ,':'';
			}
			return $output;
		}
	}

	if(!function_exists('convert_title_to_slug')){
		function convert_title_to_slug($title){
			$slug = '';
			if($title != ''){
				$slug = strtolower(preg_replace('/[\s$@_*]+/', '-', $title));
			}

			return $slug;
		}
	}