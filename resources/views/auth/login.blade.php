<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Book Store</title>
	@vite(['resources/js/app.js'])
</head>
<body class="h-100">
	<div class="login">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<h3>Book Store</h3>
				<p>Login</p>
				<fieldset>
					<form action="{{route('login')}}" method="POST">
						@csrf
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" placeholder="Type your email..." required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" placeholder="Type your password..." required>
						</div>
						<button class="btn btn-success mt-2" type="submit">Login</button>
					</form>
				</fieldset>
			</div>
		</div>
	</div>

</body>
</html>