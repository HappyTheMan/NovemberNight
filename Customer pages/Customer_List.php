<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');
?>


<!DOCTYPE html>
<html>

<head>
	<title>Customer List</title>
	<link rel="stylesheet" href="../entry.css">
	<script src="../js/jquery-3.1.1.slim.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../DataTables/datatables.min.css">
	<script src="../DataTables/datatables.min.js" type="text/javascript"></script>

</head>

<body>
	<script>
		$(document).ready(function() {
			$('#tab').DataTable();
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
			<h3 style="text-align:center;">Customer List</h3>
			<?php
			$Staff_List = "SELECT * from customer
			 ";
			$Staff_ret = mysqli_query($connection, $Staff_List);
			$Staff_count = mysqli_num_rows($Staff_ret);

			if ($Staff_count < 1) {
				echo "<p>No Staff Record Found.</p>";
			} else {
			?>
				<table id = "tab" class="table table-striped table-responsive table-hover" style="color:black;width:fit-content;">
					<thead>
						<tr class="table-dark" >
							<th scope = "col">No.</th>
							<th scope = "col">Image</th>
							<th scope = "col">CustomerID</th>
							<th scope = "col">CustomerName</th>
							<th scope = "col">Email</th>
							<th scope = "col">Phone</th>
							<th scope = "col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < $Staff_count; $i++) {
							$rows = mysqli_fetch_array($Staff_ret);
							//print_r($rows);

							$StaffID = $rows['customer_Id'];
							$StaffImage = $rows['customer_Image'];
							$StaffName = $rows['customer_Name'];

							echo "<tr class='table-info' >";
							echo "<td scope = 'row'>" . ($i + 1) . "</td>";
							echo "<td> <img src='$StaffImage' width='80px' height='80px' style = 'border:2px solid white;
        border-radius:100%;'> </td>";
							echo "<td>$StaffID</td>";
							echo "<td>$StaffName</td>";
							echo "<td>" . $rows['customer_Email']   . "</td>";
							echo "<td>" . $rows['customer_Phone']   . "</td>";
							echo "<td>

			  <a href='Customer_Update.php?StaffID=$StaffID' style = 'color:blue;'><button type='button' class='btn btn-primary btn-sm act'>Update</button></a>
			  <a href='Customer_Delete.php?StaffID=$StaffID' style = 'color:blue;'><button type='button' class='btn btn-danger btn-sm act'> Delete</button></a>
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
