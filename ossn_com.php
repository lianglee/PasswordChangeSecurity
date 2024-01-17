<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright 2021 OPEN TEKNIK
 * @license   OPEN SOURCE SOCIAL NETWORK LICENSE 4.0
 * @link      http://www.opensource-socialnetwork.org/licence
 */
define('__PasswordChangeSecurity__', ossn_route()->com . 'PasswordChangeSecurity/');
function password_change_security_init() {
		ossn_extend_view('forms/OssnProfile/edit', 'password_change_security/repassword');
		ossn_register_callback('action', 'load', 'password_change_security_old_password_check');
}
function password_change_security_old_password_check($callback, $type, $params) {
		if($params['action'] == 'profile/edit') {
				$oldpassword = input('oldpassword');

				if(!empty($oldpassword)) {
						$user = ossn_loggedin_user();
						//get user again because session didn't contain the actual user password hash
						$user = ossn_user_by_guid($user->guid);
						$user->setPassAlgo($user->password_algorithm);
						if(!$user->verifyPassword($oldpassword, $user->salt, $user->password)) {
								ossn_trigger_message(ossn_print('password:security:old:invalid'), 'error');
								redirect(REF);
						}
				}
		}
}
ossn_register_callback('ossn', 'init', 'password_change_security_init');
