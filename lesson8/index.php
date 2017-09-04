<?php 

	if (!empty($_GET['msg'])) {
		$message = $_GET['msg'];
	} else {
		$message = 'Вход';
	}

	require_once 'core/core.php';

	$errors = [];

	if (isPost()) {
		if(login(getParam('login'), getParam('password'))) {
			redirect ('list.php');
	} else {
		$errors[] = 'Неверные логин или пароль';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Вход</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
</head>
<body>
	<div class="container">
		<div class="row vertical-offset-100">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><?=$message?></h3>
					</div>
					<div class="panel-body">
						<?php if (!empty($errors)): ?>
						<ul>
							<?php foreach ($errors as $error): ?>
	                			<li><?=$error?></li>
	                		<?php endforeach; ?>
	                	</ul>
	                	<?php endif; ?>
	                    <form method="POST">
	                        <fieldset>
	                            <div class="form-group">
	                                <input class="form-control" placeholder="Login" name="login" type="text">
	                            </div>
	                            <div class="form-group">
	                                <input class="form-control" placeholder="Password" name="password" type="text">
	                            </div>
	                            <input class="btn btn-success btn-block" type="submit" value="Войти">
	                        </fieldset>
	                    </form>
	                    <div class="row" style="height: 16px;"></div>
	                    <a href="sign_up.php" class="btn btn-warning btn-block">Зарегистрироваться</a>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>