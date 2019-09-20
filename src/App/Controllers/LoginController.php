<?php

namespace Project\Controllers;

use \Psr\Container\ContainerInterface;
use Project\Models\UsersModel;
use Respect\Validation\Validator as V;

class LoginController
{
   protected $container;


   public function __construct( $container) 
   {
       $this->container = $container;
   }

   public function login($request, $response, $args)
   {


		$UsersModel = new UsersModel($this->container);
		
		var_dump($UsersModel->find());die;
		//$error = $this->container->flash->getMessages();
        return $this->container->renderer->render($response, 'login/index.php', ['error'=>$error]);
   }

   /**
	* Autenticação de usuarios
	*
	* @param [type] $request
	* @param [type] $response
	* @param [type] $args
	* @return redirect
	*/
   public function logar($request, $response, $args)
   {
	   $metadata = $request->getParsedBody();
		$validator  = $this->container->validator->validate($request, [
			'username' => V::length(6, 100)->alnum('@.:')->noWhitespace()->notBlank(),
			'password' => V::length(6, 25)->noWhitespace()->notBlank(),
        ]);
        
        
        
        $errors = $validator->getErrors();
        var_dump($errors);
        die;

		if ($validator->isValid()) {
    
			// $domain = $this->get_domain();
			// $loginModel = new LoginModel($this->container);
			// $auth = $loginModel->authentication($domain);
			// if($auth) {
			// 	//get the groups assigned to the user and then set the groups in $_SESSION["groups"]
			// 		$GroupUsersModel = new GroupUsersModel($this->container);
			// 		$resultGroupUser = $GroupUsersModel->get($auth);
			// 		$_SESSION["groups"] = $resultGroupUser;
			// 		if($resultGroupUser){
			// 			//get the permissions assigned to the groups that the user is a member of set the permissions in $_SESSION['permissions']
			// 				$GroupPermissionsModel = new GroupPermissionsModel($this->container);
			// 				$resultGroupPermissions = $GroupPermissionsModel->getDistinctLogin($resultGroupUser);
			// 				if ($resultGroupPermissions) {
			// 					foreach ($resultGroupPermissions as $row) {
			// 						$_SESSION['permissions'][$row["permission_name"]] = true;
			// 					}
			// 				}	
			// 		}
			// 	//get the user settings
			// 		$UserSettingsModel = new UserSettingsModel($this->container);
			// 		$resultUserSettings = $UserSettingsModel->get($auth);
			// 		if ($resultUserSettings) {
			// 			foreach ($resultUserSettings as $row) {
			// 				$name = $row['user_setting_name'];
			// 				$category = $row['user_setting_category'];
			// 				$subcategory = $row['user_setting_subcategory'];
			// 				if (strlen($row['user_setting_value']) > 0) {
			// 					if (strlen($subcategory) == 0) {
			// 						//$$category[$name] = $row['domain_setting_value'];
			// 						if ($name == "array") {
			// 							$_SESSION[$category][] = $row['user_setting_value'];
			// 						}
			// 						else {
			// 							$_SESSION[$category][$name] = $row['user_setting_value'];
			// 						}
			// 					} else {
			// 						//$$category[$subcategory][$name] = $row['domain_setting_value'];
			// 						if ($name == "array") {
			// 							$_SESSION[$category][$subcategory][] = $row['user_setting_value'];
			// 						}
			// 						else {
			// 							$_SESSION[$category][$subcategory][$name] = $row['user_setting_value'];
			// 						}
			// 					}
			// 				}
			// 			}
			// 		}
			// 	//get the extensions that are assigned to this user
			// 		$UsersModel = new UsersModel($this->container);
			// 		$resultUsersModel = $UsersModel->getExtensionUser($auth);
			// 		if($resultUsersModel){
			// 			$x = 0;
			// 			foreach($resultUsersModel as $row) {
			// 				//set the destination
			// 				$destination = $row['extension'];
			// 				if (strlen($row['number_alias']) > 0) {
			// 					$destination = $row['number_alias'];
			// 				}
							
			// 				//build the uers array
			// 				$_SESSION['user']['extension'][$x]['user'] = $row['extension'];
			// 				$_SESSION['user']['extension'][$x]['number_alias'] = $row['number_alias'];
			// 				$_SESSION['user']['extension'][$x]['destination'] = $destination;
			// 				$_SESSION['user']['extension'][$x]['extension_uuid'] = $row['extension_uuid'];
			// 				$_SESSION['user']['extension'][$x]['outbound_caller_id_name'] = $row['outbound_caller_id_name'];
			// 				$_SESSION['user']['extension'][$x]['outbound_caller_id_number'] = $row['outbound_caller_id_number'];
			// 				$_SESSION['user']['extension'][$x]['user_context'] = $row['user_context'];
			// 				$_SESSION['user']['extension'][$x]['description'] = $row['description'];
							
			// 				//set the user context
			// 				$_SESSION['user_context'] = $row["user_context"];
			// 				$x++;
			// 			}
			// 		}
			// 	$_SESSION['authorized'] = true;
			// 	$_SESSION['user'] = $auth;
			// 	// set the session variables
			// 		$_SESSION["domain_uuid"] = $auth["domain_uuid"];
			// 		$_SESSION["user_uuid"] = $auth["user_uuid"];
			// 		$_SESSION['username'] = $auth["username"];
			// 	if (!is_array($_SESSION['domains']) or (!isset($_SESSION["domain_uuid"])) or (strlen($_SESSION["domain_uuid"]) == 0)) {
			// 			//get the domain
			// 				$domain_array = explode(":", $_SERVER["HTTP_HOST"]);
				
			// 			//get the domains from the database
			// 				$result = $this->domainModel->get(['1'=>1], true);
				
			// 				foreach($result as $row) {
			// 					$domain_names[] = $row['domain_name'];
			// 				}
			// 				unset($prep_statement);
				
			// 			//put the domains in natural order
			// 				if (is_array($domain_names)) {
			// 					natsort($domain_names);
			// 				}
				
			// 			//build the domains array in the correct order
			// 				if (is_array($domain_names)) { 
			// 					foreach ($domain_names as $dn) {
			// 						foreach ($result as $row) {
			// 							if ($row['domain_name'] == $dn) {
			// 								$domains[] = $row;
			// 							}
			// 						}
			// 					}
			// 					unset($result);
			// 				}
				
			// 				if (is_array($domains)) { 
			// 					foreach($domains as $row) {
			// 						if (count($domains) == 1) {
			// 							$_SESSION["domain_uuid"] = $row["domain_uuid"];
			// 							$_SESSION["domain_name"] = $row['domain_name'];
			// 						}
			// 						else {
			// 							if ($row['domain_name'] == $domain_array[0] || $row['domain_name'] == 'www.'.$domain_array[0]) {
			// 								$_SESSION["domain_uuid"] = $row["domain_uuid"];
			// 								$_SESSION["domain_name"] = $row["domain_name"];
			// 							}
			// 						}
			// 						$_SESSION['domains'][$row['domain_uuid']] = $row;
			// 					}
			// 					unset($domains);
			// 				}
			// 		}
			// 	return $response->withRedirect('/dashboard', 301);
			// }
			// $this->container->flash->addMessage('error', 'Falha na autenticação, login ou senha inválida');
			return $response->withRedirect($this->container->router->pathFor('login'));
      	} else {
			$errors = $validator->getErrors();
			$this->container->flash->addMessage('error', 'Falha na autenticação, login ou senha inválida');
			return $response->withRedirect($this->container->router->pathFor('login'));
      	}
   	}
// 	/**
// 	 * Destroy session
// 	 *
// 	 * @param [type] $request
// 	 * @param [type] $response
// 	 * @param [type] $args
// 	 * @return void
// 	 */
// 	public function logout($request, $response, $args)
// 	{
// 		if(isset($_SESSION['user'])){
// 			$this->container->logger->info("Route '/logout' Deslogado", array('username'  => 'jorge', 'user_uuid'  => 245));
// 			session_destroy();
// 		}
		 
// 		return $response->withRedirect('/login', 301);
// 	}
//      /**
// 	 *  get_domain used to get the domain name from the URL or username and then sets both domain_name and domain_uuid
// 	 */
// 	public function get_domain() {
// 		//get the domain from the url
//           $domain_name = $_SERVER["HTTP_HOST"];
// 		//get the domain name from the username
// 			$username_array = explode("@", check_str($_REQUEST["username"]));
// 		if (count($username_array) > 1) {
// 			//get the domain name
// 				$domain_name =  $username_array[count($username_array) -1];
// 		}
// 		//get the domain name from the http value
// 			if (isset($_REQUEST["domain_name"]) && strlen(check_str($_REQUEST["domain_name"])) > 0) {
// 				$domain_name = check_str($_REQUEST["domain_name"]);
// 			}
// 		//remote port number from the domain name
// 			$domain_array = explode(":", $domain_name);
// 			if (count($domain_array) > 1) {
// 				$domain_name = $domain_array[0];
// 			}
// 		//get the domain uuid and domain settings
// 		$rs_domain = $this->domainModel->get(['domain_name'=>$domain_name], true);
// 		//if the domain exists then set domain_name and update the username
// 			if ($rs_domain) {
// 				$retorno['domain_name'] = $rs_domain["domain_name"];;
// 				$retorno['domain_parent_uuid'] = $rs_domain["domain_parent_uuid"];;
// 				$retorno['domain_uuid'] = $rs_domain["domain_uuid"];
// 				$retorno['domain_enabled'] = $rs_domain["domain_enabled"];
// 				$retorno['username'] =  substr(check_str($_REQUEST["username"]), 0, -(strlen($domain_name)+1));
// 				$retorno['password'] =  check_str($_REQUEST["password"]);
// 				$_SESSION['domain_uuid'] = $rs_domain["domain_uuid"];
// 			} else {
// 				return false;
// 			}
// 		//set the domain settings
// 			$_SESSION['domain_name'] = $domain_name;
// 			$_SESSION['domain_parent_uuid'] = $_SESSION["domain_uuid"];
// 		//set the domain name
// 		return $retorno;
// 	}
}