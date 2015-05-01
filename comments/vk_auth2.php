<?php
/*1 стартуем сессию, если куков нет, просим авторизироваться через вк
  после авторизации попадаем в тело if в котором ставик куки, после чего
  осуществляем редирект на предыдущую страницу*/
session_start();
//данные для инициализации в вк
$client_id = '4832378'; // ID приложения
$client_secret = '7S006k5mPrcsGwGY7FCI'; // Защищённый ключ
if(!$_GET['code']){
$_SESSION['redirect_uri'] = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // Адрес страницы авторизации на сайте
}
$url = 'http://oauth.vk.com/authorize';
$params = array(
	'client_id'     => $client_id,
	'redirect_uri'  => $_SESSION['redirect_uri'],
	'response_type' => 'code'
);

if (isset($_GET['code'])) {//авторизация чеерез вк
	$set_cookie_result = false;
	$params = array(
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'code' => $_GET['code'],
		'redirect_uri' => $_SESSION['redirect_uri']
	);

	$token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

	if (isset($token['access_token'])) {
		$params = array(
			'uids'         => $token['user_id'],
			'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_50',
			'access_token' => $token['access_token']
		);

		$userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
		if (isset($userInfo['response'][0]['uid'])) {
			$userInfo = $userInfo['response'][0];
			$set_cookie_result = true;
		}
	}


	if ( isset( $userInfo )) {//Устанавливаем сессию и куки
		$_SESSION['first_name']   = $userInfo['first_name'];
		$_SESSION['last_name']    = $userInfo['last_name'];
		$_SESSION['image']		  = $userInfo['photo_50'];
		$_SESSION['network']      = "vk.com";
		$_SESSION['identity']     = $userInfo['uid'];
		
		$life_time     = time() + ( 60 * 60 * 24 * 7 );
		$access_path   = "/";
		$access_domain = "bsmu.akson.by";
		setcookie( 'first_name', $_SESSION['first_name'], $life_time, $access_path,
			$access_domain );
		setcookie( 'last_name', $_SESSION['last_name'], $life_time, $access_path,
			$access_domain );
		setcookie('image', $_SESSION['image'], $life_time, $access_path,
			$access_domain);
		setcookie( 'network', $_SESSION['network'], $life_time, $access_path,
			$access_domain );
		setcookie( 'identity', $_SESSION['identity'], $life_time, $access_path,
			$access_domain );
		setcookie( 'page_adress', $_SESSION['page_adress'], $life_time, $access_path,
			$access_domain );
		header("Location: http://".$_SESSION['page_adress']);
	}
}
//формирование ссылки для авторизации
if(!isset($_COOKIE['first_name'])||!isset($_SESSION['first_name'])){
header('Content-type: text/html; charset=utf-8');
echo $link = '<p><a href="' . $url . '?' .urldecode(http_build_query($params)) . '">Нажмите, чтобы войти через VK</a></p>';
}

?>