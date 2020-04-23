<?php
include('../connect.php');
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
?>


<!DOCTYPE html>
<html>

<head>
	<title>Supplier List</title>
	<link rel="stylesheet" href="../entry.css">
	<script src="../js/jquery-3.1.1.slim.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../DataTables/datatables.min.css">
	<script src="../DataTables/datatables.min.js" type="text/javascript"></script>
</head>

<body>
	<script>
		$(document).ready(function() {
			$('.table').DataTable();
		});
	</script>

	<div class="popup_box" style="width: 100%;">
		<div class="popup_inner">
			<div class="logo text-center">
				<div class="logo-img">
					<a href="displays.php">
						<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>

					</a>

				</div>

			</div>
			<h3 style="text-align:center;">Supplier List</h3>

			<?php
			$List = "SELECT * FROM supplier";
			$ret = mysqli_query($connection, $List);
			$count = mysqli_num_rows($ret);

			if ($count < 1) {
				echo "<p>No Record Found.</p>";
			} else {
			?>
				<table id="tableid" class="table table-hover table-striped table-responsive" style="color:black;width: fit-content">
					<thead>
						<tr class="table-dark">
							<th  scope = "col">No.</th>
							<th scope = "col">Image</th>
							<th scope = "col">StaffID</th>
							<th scope = "col">StaffName</th>
							<th scope = "col">Email</th>
							<th scope = "col">Phone</th>
							<th scope = "col">Address</th>
							<th scope = "col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < $count; $i++) {
							$rows = mysqli_fetch_array($ret);
							//print_r($rows);

							$ID = $rows['supplier_Id'];
							$Image = $rows['supplier_Image'];


							echo "<tr class='table-info'>";
							echo "<td scope = 'row' >" . ($i + 1) . "</tdscope>";
							echo "<td> <img src='$Image' width='80px' height='80px' style = 'border:2px solid white;
        border-radius:100%;'> </td>";
							echo "<td>$ID</td>";
							echo "<td>" . $rows['supplier_Name'] . "</td>";
							echo "<td>" . $rows['supplier_Email']   . "</td>";
							echo "<td>" . $rows['supplier_Phone']   . "</td>";
							echo "<td>" . $rows['supplier_Address']   . "</td>";
							echo "<td>

			  <a href='Supplier_Update.php?SupplierID=$ID' style = 'color:blue;'><button type='button' class='btn btn-primary btn-sm act'>Update</button></a>
			  <a href='Supplier_Delete.php?SupplierID=$ID' style = 'color:blue;'><button type='button' class='btn btn-danger btn-sm act'> Delete</button></a>
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


</body>

</html>
