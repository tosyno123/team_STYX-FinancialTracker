<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:login.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>STYX Finance Tracker || Yearly Expense Report</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
	<style type="text/css">
		.panel {
			-webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
			border: 0;
			font-weight: 400;
		}

	</style>
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Yearly Expense Report</li>
			</ol>
		</div><!--/.row-->
		
		<div class="container">
			<div class="row" style="margin-top: 30px;">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Yearly Expense Report</div>
					<div class="panel-body">
						<div class="col-md-12">					
						<?php
							$fdate=$_POST['fromdate'];
							$tdate=$_POST['todate'];
							$rtype=$_POST['requesttype'];
						?>
						<h5 align="center" style="color:blue">
							Yearly Expense Report from <?php echo $fdate?> to <?php echo $tdate?>
						</h5>
						<hr />
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                	<tr>
										<th>S.NO</th>
										<th>Year</th>
										<th>Expense Amount</th>
                					</tr>
                                </tr>
                            </thead>
							<?php
								$userid=$_SESSION['userId'];
								$ret=mysqli_query($conn,"SELECT year(ExpenseDate) AS rptyear,SUM(ExpenseCost) AS totalyear FROM tblexpense  where (ExpenseDate BETWEEN '$fdate' AND '$tdate') && (UserId='$userid') GROUP BY year(ExpenseDate)");
								$cnt=1;
								while ($row=mysqli_fetch_array($ret)) {
							?>
              
                			<tr>
								<td><?php echo $cnt;?></td>
							
								<td><?php  echo $row['rptyear'];?></td>
								<td><?php  echo $ttlsl=$row['totalyear'];?></td>
                			</tr>
							<?php
								$totalsexp+=$ttlsl; 
								$cnt=$cnt+1;
								}
							?>

							<tr>
							<th colspan="2" style="text-align:center">Grand Total</th>     
							<td><?php echo $totalsexp;?></td>
							</tr>     

                         </table>

					</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
		</div>
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
<?php } ?>