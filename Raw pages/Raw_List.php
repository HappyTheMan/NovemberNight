<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>Raw List</title>
	<link rel="stylesheet" href="../entry.css">
	<script src="../js/jquery-3.1.1.slim.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../DataTables/datatables.min.css">
	<script src="../DataTables/datatables.min.js" type="text/javascript"></script>
</head>

<body>
	<script>
		$(document).ready(function() {
			$('#tableid').DataTable();
		});
	</script>

<div class="container">

	<div class="popup_box" style="width: 100%;margin-left:2%;">
		<div class="popup_inner">
			<div class="logo text-center">
				<div class="logo-img">
					<a href="displays.php">
						<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>

					</a>

				</div>

			</div>
			<h3 style="text-align:center;">Raw List</h3>
			<?php
			$List = "SELECT * FROM raw";
			$ret = mysqli_query($connection, $List);
			$count = mysqli_num_rows($ret);
			if ($count < 1) {
				echo "<p>No Record Found.</p>";
			} else {
			?>
				<table id="tableid" class=" table table-striped table-responsive table-hover" style="color:black;width:fit-content;">
					<thead>
						<tr class="table-dark">
							<th>No.</th>
							<th>Image</th>
							<th>RawID</th>
							<th>Name</th>
							<th>Type</th>
							<th>Quantity</th>
							<th>Pricing type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < $count; $i++) {
							$rows = mysqli_fetch_array($ret);
							$type_Id = $rows['raw_TypeId'];
							//print_r($rows);
							$query = "SELECT Type FROM raw_type WHERE raw_TypeId = '$type_Id'";
							$typeqry = mysqli_query($connection, $query);
							$type = mysqli_fetch_array($typeqry);
							$ID = $rows['raw_Id'];
							$Image = $rows['raw_Image'];


							echo "<tr class='table-info'>";
							echo "<td>" . ($i + 1) . "</td>";
							echo "<td> <img src='$Image' width='80px' height='80px' style = 'border:2px solid white;
        border-radius:100%;'> </td>";
							echo "<td>$ID</td>";
							echo "<td>" . $rows['raw_Name'] . "</td>";
							echo "<td>" . $type['Type'] . "</td>";
							echo "<td>" . $rows['quantity']   . "</td>";
							echo "<td>" . $rows['pricing_Type']   . "</td>";
							echo "<td>

			  <a href='Raw_Update.php?RawID=$ID' style = 'color:blue;'><button type='button' class='btn btn-primary btn-sm act'>Update</button></a>
			  <a href='Raw_Delete.php?RawID=$ID' style = 'color:blue;'><button type='button' class='btn btn-danger btn-sm act'> Delete</button></a>
			  </td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			<?php
			}
			?>
		</div>
	</div>


	</div>

</body>

</html>
