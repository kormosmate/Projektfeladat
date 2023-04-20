<!DOCTYPE html>
<html>

<head>
	<title>Link Rövidítő</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
	<?php
	session_start();

	include_once 'navbar.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="text-center">Link Rövidítő</h2>
				<div id="url-form">
					<div class="form-group">
						<label for="url">URL:</label>
						<input type="text" class="form-control" id="url" name="url" placeholder="Írja be az URL-t">
					</div>
					<div class="text-center">
						<button type="button" class="btn btn-primary" id="shorten-btn">Rövidítés</button>
					</div>
				</div>
				<div class="text-center" style="margin-top: 20px;">
					<h5><a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/projekt/dashboard">Dashboard - Kattints ide!</a></h5>
				</div>
			</div>

		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#shorten-btn').click(function() {
				var url = $('#url').val(); // Az URL értékének lekérése

				// Ellenőrzés, hogy van-e érvényes URL
				if (url != '' && (url.indexOf("http://") === 0 || url.indexOf("https://") === 0)) {

					// AJAX kérés küldése a shorten.php felé
					$.ajax({
						type: 'POST',
						url: 'shorten.php',
						data: {
							url: url
						},
						success: function(data) {
							// Ha sikeres az adatbázis művelet, a válasz tartalmát kiírjuk az index.php-ra
							$('#url-form').html(data);
						}
					});

				} else {
					// Ha a URL nem érvényes, hibaüzenet jelenik meg
					$('#url').val('');
					alert("Az URL-nek a http:// vagy https:// protokollal kell kezdődnie.");
				}
			});
		});
	</script>

</body>

</html>