<?php

define('TESTS_LOCATION', 'data/uploaded_tests/');

define('USERS_FILE', __DIR__ . '/../data/users.json');

function login($login, $password) {
	$user = getUser($login);
	if (!$user || $user['password'] != $password) {
		return false;
	} else {
		//устанавливаем данные пользователья в сессии
		unset($user['password']);
		$_SESSION['user'] = $user;
		return true;
	}
}

function isAuthorized () {
	return !empty($_SESSION['user']);
}

function isPost() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function getParam($name) {
	return isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;
}

function getUsers() {
	if (!file_exists(USERS_FILE)) {
		return [];
	}
	$fileData = file_get_contents(USERS_FILE);
	$users = json_decode($fileData, true);
	if (!$users) {
		return [];
	}
	return $users;
}

function getUser($login) {
	$not_exist = true;
	$users = getUsers();
	foreach ($users as $user) {
		if ($user['login'] == $login) {
			$not_exist = false;
			$_SESSION['is_guest'] = false;
			return $user;
			return $not_exist;
		}
		if (not_exist) {
			$user = [
						'id' => 'guest',
						'login' => 'guest',
						'password' => '',
						'username' => $_POST['login']];

			$_SESSION['is_guest'] = true;
			return $user;
		}
	}
	return null;
}

function getAuthorizedUser () {
	return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

function logout () {
	if (isAuthorized) {
		session_destroy();
	}
	redirect('index.php');
}

function redirect($link) {
	header("Location: $link");
	die;
}

function loginCheck () {
	if (!isAuthorized()) {
		redirect('index.php?msg=Пожалуйста, авторизуйтесь!');
		die;
	}
}

function forbiddenForGuests() {
	if ($_SESSION['is_guest']) {
		header("HTTP/1.0 403 Forbidden");
		echo '<h1 style="text-align: center; font-size: 40pt;">403</h1><h1 style="text-align: center;">Доступ запрещён</h1>';
		die;
	}
}
