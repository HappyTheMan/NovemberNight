<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');
?>


<!DOCTYPE html>
<html>

<head>
	<title>Staff List</title>
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

<div class="container">


	<div class="popup_box" style="width: 100%;margin-left:3%;">
		<div class="popup_inner">
			<div class="logo text-center">
				<div class="logo-img">
					<a href="displays.php">
						<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>

					</a>

				</div>

			</div>
			<h3 style="text-align:center;">Staff List</h3>
			<?php
			$Staff_List = "SELECT s.*, st.*
			 FROM staff s, staff_type st
			 WHERE s.staff_TypeId=st.staff_TypeId
			 ";
			$Staff_ret = mysqli_query($connection, $Staff_List);
			$Staff_count = mysqli_num_rows($Staff_ret);

			if ($Staff_count < 1) {
				echo "<p>No Staff Record Found.</p>";
			} else {
			?>
				<table  class="table table-striped table-responsive table-hover" style="color:black;">
					<thead>
						<tr class="table-dark" >
							<th scope = "col">No.</th>
							<th scope = "col">Image</th>
							<th scope = "col">StaffID</th>
							<th scope = "col">StaffName</th>
							<th scope = "col">Email</th>
							<th scope = "col">Phone</th>
							<th scope = "col">Address</th>
							<th scope = "col">Role</th>
							<th scope = "col">Gender</th>
							<th scope = "col">Age</th>
							<th scope = "col">Experience</th>
							<th scope = "col">Branch</th>
							<th scope = "col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < $Staff_count; $i++) {
							$rows = mysqli_fetch_array($Staff_ret);
							//print_r($rows);

							$StaffID = $rows['staff_Id'];
							$StaffImage = $rows['staff_Image'];
							$StaffName = $rows['staff_Name'];

							$StaffTypeId = $rows['staff_TypeId'];
							$BranchId = $rows['branch_Id'];
							$staffTypeQuery = "Select st.Type, b.Branch FROM staff_type st, branch b WHERE staff_TypeId = '$StaffTypeId' AND Branch_Id = '$BranchId'";
							$staffTyperet = mysqli_query($connection, $staffTypeQuery);
							$staffType = mysqli_fetch_array($staffTyperet);

							echo "<tr class='table-info' >";
							echo "<td scope = 'row'>" . ($i + 1) . "</td>";
							echo "<td> <img src='$StaffImage' width='80px' height='80px' style = 'border:2px solid white;
        border-radius:100%;'> </td>";
							echo "<td>$StaffID</td>";
							echo "<td>$StaffName</td>";
							echo "<td>" . $rows['staff_Email']   . "</td>";
							echo "<td>" . $rows['staff_Phone']   . "</td>";
							echo "<td>" . $rows['staff_Address']   . "</td>";
							echo "<td>" . $staffType[0]   . "</td>";
							echo "<td>" . $rows['staff_Gender']   . "</td>";
							echo "<td>" . $rows['staff_Age']   . "</td>";
							echo "<td>" . $rows['staff_Exp']   . "</td>";
							echo "<td>" . $staffType[1]   . "</td>";
							echo "<td>

			  <a href='Staff_Update.php?StaffID=$StaffID' style = 'color:blue;'><button type='button' class='btn btn-primary btn-sm act'>Update</button></a>
			  <a href='Staff_Delete.php?StaffID=$StaffID' style = 'color:blue;'><button type='button' class='btn btn-danger btn-sm act'> Delete</button></a>
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
