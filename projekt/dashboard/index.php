<?php
session_start();

// ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['login_user'])) {
	// ha nincs bejelentkezve, átirányítás a bejelentkezési oldalra
	header('Location: ../admin/');
	exit;
}

// ha be van jelentkezve, megjelenítjük a dashboard oldalt
?>
<!DOCTYPE html>
<html>

<head>
	<title>Dashboard</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<?php
	include_once '../navbar.php'; ?>
	<div class="container">
		<h1 class="my-5">Dashboard</h1>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Eredeti URL</th>
					<th>Rövid URL</th>
					<th>Létrehozva</th>
					<th>Művelet</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include('../db.php');
				$result = mysqli_query($conn, "SELECT * FROM links ORDER BY id ASC");

				while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['url']; ?></td>
						<td>
							<a href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/projekt/<?php echo $row['code']; ?>" target="_blank">
								<?php echo $row['code']; ?>
							</a>
						</td>
						<td><?php echo $row['created_at']; ?></td>
						<td>
							<form method="post" class="delete-form" data-id="<?php echo $row['id']; ?>">
								<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Biztosan törölni akarja ezt a linket?')">Törlés</button>
							</form>
							<form method="post" class="update-form" style="display: inline-block;">
								<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<input type="text" name="code" value="<?php echo $row['code']; ?>">
								<button type="submit" class="btn btn-primary btn-sm">Mentés</button>
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<script>
		$(document).ready(function() {
			$('.delete-form').submit(function(event) {
				event.preventDefault(); // Megakadályozzuk az alapértelmezett POST kérést
				var id = $(this).data('id'); // Az űrlap data-id attribútumából lekérjük az id értéket
				$.ajax({
					type: 'POST',
					url: 'delete.php',
					data: {
						id: id
					}, // Az id értéket küldjük el a DELETE művelet végrehajtásához
					success: function(response) {
						alert(response); // Azonnali visszajelzés megjelenítése
						location.reload(); // Az oldal frissítése
					},
					error: function(xhr, status, error) {
						console.log(xhr.responseText);
					}
				});
			});
		});
		$(document).ready(function() {
			$('.update-form').submit(function(event) {
				event.preventDefault(); // Megakadályozzuk az alapértelmezett POST kérést
				var id = $(this).find('input[name="id"]').val(); // Az id értéket lekérjük az űrlapból
				var code = $(this).find('input[name="code"]').val(); // A kódot lekérjük az űrlapból
				$.ajax({
					type: 'POST',
					url: 'update.php',
					data: {
						id: id,
						code: code
					}, // Az id és a kód értékeit küldjük el az UPDATE művelet végrehajtásához
					success: function(response) {
						alert(response); // Azonnali visszajelzés megjelenítése
						location.reload(); // Az oldal frissítése
					},
					error: function(xhr, status, error) {
						console.log(xhr.responseText);
					}
				});
			});
		});
	</script>
</body>

</html>