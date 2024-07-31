<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsuid']==0)) {
  header('location:logout.php');
  } else{
      
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Imagica Reosrt | Resort :: View Booking Detail</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/responsiveslides.min.js"></script>
 <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
</script>
</head>
<body>
		<!--header-->
			<div class="header head-top">
				<div class="container">
	<?php include_once('includes/header.php');?>
		</div>
</div>
<!--header-->
		<!-- typography -->
	<div class="typography">
			<!-- container-wrap -->
			<div class="container">
				<div class="typography-info">
					<h2 class="type">Invoice</h2>
				</div>
				<p>My Booking Detail.</p>
				<div class="bs-docs-example">
					<?php
$invid=$_GET['invid'];
$sql="SELECT tbleventbooking.BookingNumber,tbluser.FullName,DATEDIFF(tbleventbooking.CheckoutDate,tbleventbooking.CheckinDate) as ddf,tbluser.MobileNumber,tbluser.Email,tbleventbooking.IDType,tbleventbooking.Address,tbleventbooking.CheckinDate,tbleventbooking.CheckoutDate,tbleventbooking.BookingDate,tbleventbooking.Remark,tbleventbooking.Status,tbleventbooking.payment,tbleventcategory.CategoryName,tbleventcategory.Decsription,tbleventcategory.Price,tblevent.EventDesc,tblevent.Image,tblevent.EventFacility 
from tbleventbooking 
join tblevent on tbleventbooking.EventID=tblevent.ID 
join tbleventcategory on tbleventcategory.ID=tblevent.EventType 
join tbluser on tbleventbooking.UserID=tbluser.ID  
where tbleventbooking.ID=:invid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':invid', $invid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                            <tr>
    <th colspan="5" style="text-align: center;color: red;font-size: 20px">Booking Number: <?php  echo $row->BookingNumber;?></th>
  </tr>
  

  <tr>
    <th>Customer Name</th>
    <td><?php  echo $row->FullName;?></td>
   <th>Mobile Number</th>
    <td colspan="2"><?php  echo $row->MobileNumber;?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
    <th>Booking Date</th>
    <td colspan="2"><?php  echo $row->BookingDate;?></td>
  </tr>
   <tr>
    <th>Event Type</th>
    <td><?php  echo $row->CategoryName;?></td>
    <th>Event Image</th>
    <td><img src="admin/images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"></td>
  </tr>
 <tr>
    <th>Event Price(perday)</th>
    <td>$<?php  echo $row->Price;?></td>
    <th>Total No. of Days</th>
    <td colspan="2"><?php  echo $row->ddf;?></td>
  </tr>
<table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
  <tr>
    <th colspan="5" style="text-align: center;color: red;font-size: 20px">Invoice Detail</th>
  </tr>
  <tr>
    <th style="text-align: center;">Total Days</th>
  
   <th style="text-align: center;">Event Price</th>
   <th style="text-align: center;">Total Price</th>
  </tr>
<tr>
  <td style="text-align: center;"><?php  echo $ddf=$row->ddf;?></td>
 
  <td style="text-align: center;"><?php  echo $tp= $row->Price;?></td>
<td style="text-align: center;"><?php  echo $total= $ddf*$tp;?></td>

  </tr>
  
  <?php 
$grandtotal+=$total;
$cnt=$cnt+1;} ?>
<tr>
  <th colspan="2" style="text-align:center;color: blue">Grand Total </th>
<td colspan="2" style="text-align: center;"><?php  echo $grandtotal;?></td>
</tr>
 
<?php $cnt=$cnt+1;} ?>
</table>
<table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
  <tr>
    <th  style="text-align: center;color: red;font-size: 20px">Admin Remark</th>
    <th  style="text-align: center;color: red;font-size: 20px">Payment</th>
  </tr>
  <tr>
    <th style="text-align: center;">Booking Status</th>
    <th style="text-align: center;">Payment Status</th>
</tr>
<tr>
  <td style="text-align: center;"><?php  echo $status=$row->Status;?></td>
  <td style="text-align: center;"><?php  echo $payment=$row->payment;?></td>
</tr>
</table>
</table> 
<p style="text-align: center;font-size: 20px">
  <input name="Submit2" type="submit" class="btn btn-success" style="color: red;font-size: 20px" value="Print" onClick="return f3();" style="cursor: pointer;"  /></p>
				</div>
			
			</div>
			<!-- //container-wrap -->
	</div>
	<!-- //typography -->
			</div>
			<!--footer-->
				<?php include_once('includes/footer.php');?>
</body>
</html>
<?php }  ?>
