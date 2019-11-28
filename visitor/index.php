<!DOCTYPE html>
<html lang="en">
<head>
	<title>Check-in/check-out</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<script type="text/javascript">
		
		function checkin(ind){
			var a = document.getElementById("myT").rows[ind].cells;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState==4 & this.status==200){
					alert(this.responseText);
				}
			}
			xhttp.open("GET","checkin.php?email="+a[0].innerHTML,true);
			xhttp.send();
		}

		function checkout(ind){
			var a = document.getElementById("myT").rows[ind].cells;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState==4 & this.status==200){
					alert(this.responseText);
				}
			}
			xhttp.open("GET","checkout.php?email="+a[0].innerHTML,true);
			xhttp.send();
		}

	</script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1">
					<div class="table100-firstcol">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Hosts</th>
								</tr>
							</thead>
							<tbody>
									<?php	

									$servername='localhost';
									$username='root';
									$password='';

									$conn = new mysqli($servername,$username,$password);

									$sql = "use entry";

									$conn->query($sql);

									$sql = "select name from user where status='host';";
									$result = $conn->query($sql);

									while ($row=$result->fetch_assoc()){
										echo "<tr class='row100 body'><td class='cell100 column1'>".$row['name']."</td>";
									}

									$conn->close();

									?>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div class="wrap-table100-nextcols js-pscroll">
						<div class="table100-nextcols">
							<table id="myT">
								<thead>
									<tr class="row100 head">
										<th class="cell100 column2">Email</th>
										<th class="cell100 column3">Phone Number</th>
										<th class="cell100 column4">Check-in</th>
										<th class="cell100 column4">Check-out</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$servername='localhost';
										$username='root';
										$password='';

										$conn = new mysqli($servername,$username,$password);

										$sql = "use entry";

										$conn->query($sql);
										$i=1;

										$sql = "select * from user where status='host';";
										$result = $conn->query($sql);

										while ($row=$result->fetch_assoc()){
											echo '<tr class="row100 body">
												  <td class="cell100 column2">'.$row["email"].'</td>
												  <td class="cell100 column3">'.$row["phone"].'</td>
												  <td class="cell100 column4"><button onclick="checkin('.$i.')">Click here</button></td>
												  <td class="cell100 column5"><button onclick="checkout('.$i.')">Click here</button></td>
												  </tr>';
											$i++;
										}

										$conn->close();

									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})

			$(this).on('ps-x-reach-start', function(){
				$(this).parent().find('.table100-firstcol').removeClass('shadow-table100-firstcol');
			});

			$(this).on('ps-scroll-x', function(){
				$(this).parent().find('.table100-firstcol').addClass('shadow-table100-firstcol');
			});

		});

		
		
		
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>