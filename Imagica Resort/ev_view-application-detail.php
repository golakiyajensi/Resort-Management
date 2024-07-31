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
<title>Imagica Resort | Resort :: View Booking Detail</title>
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
					<h2 class="type">My Event Booking Detail</h2>
				</div>
				
				<div class="bs-docs-example">
					<?php
                  $vid=$_GET['viewid'];

$sql="SELECT tbleventbooking.BookingNumber,tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tbleventbooking.ID as tid,tbleventbooking.IDType,tbleventbooking.Address,tbleventbooking.CheckinDate,tbleventbooking.CheckoutDate,tbleventbooking.BookingDate,tbleventbooking.Remark,tbleventbooking.Status,tbleventbooking.payment,tbleventcategory.CategoryName,tbleventcategory.Decsription,tbleventcategory.Price,tblevent.EventName,tblevent.EventDesc,tblevent.Image,tblevent.EventFacility 
from tbleventbooking 
join tblevent on tbleventbooking.EventID=tblevent.ID 
join tbleventcategory on tbleventcategory.ID=tblevent.EventType 
join tbluser on tbleventbooking.UserID=tbluser.ID  
where tbleventbooking.ID=:vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
   //echo "$cnt";
foreach($results as $row)
{               ?>
                            <table border="1" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                            	<tr>
  <th colspan="4" style="color: red;font-weight: bold;text-align: center;font-size: 20px"> Booking Number: <?php echo $row->BookingNumber;?></th>
</tr>
<tr>
  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Booking Detail:</th>
</tr>
<tr>
    <th>Customer Name</th>
    <td><?php  echo $row->FullName;?></td>
    <th>Mobile Number</th>
    <td><?php  echo $row->MobileNumber;?></td>
  </tr>
  

  <tr>
    
   <th>Email</th>
    <td><?php  echo $row->Email;?></td>
    <th>ID Type</th>
    <td><?php  echo $row->IDType;?></td>
  </tr>
  <tr>
  <tr>
    <th>Check in Date</th>
    <td><?php  echo $row->CheckinDate;?></td>
    <th>Check out Date</th>
    <td><?php  echo $row->CheckoutDate;?></td>
  </tr>
  
   <tr>
    <tr>
  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Event Detail:</th>
</tr>
    <th>Event Type</th>
    <td><?php  echo $row->CategoryName;?></td>
    <th>Event Price(perday)</th>
    <td>$<?php  echo $row->Price;?></td>
  </tr>
 
 <tr>
    
    <th>Event Name</th>
    <td><?php  echo $row->EventName;?></td>
    <th>Event Description</th>
    <td><?php  echo $row->EventDesc;?></td>
  </tr>
  <tr>
    
    <th>Event Facility</th>
    <td><?php  echo $row->EventFacility;?></td>
    <th>Booking Date</th>
    <td><?php  echo $row->BookingDate;?></td>
  </tr>
   <tr>
  
<tr>
  <th>Image</th>
    <td><img src="admin/images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>"></td>
    <tr></tr>
  </tr>
  
  <th colspan="4" style="color: blue;font-weight: bold;font-size: 15px"> Admin Remarks:</th>
</tr>
  <tr>
    
     <th>Order Final Status</th>

    <td> <?php  $status=$row->Status;
    
if($row->Status=="Approved")
{
  echo "Your Booking has been approved";
}

if($row->Status=="Cancelled")
{
 echo "Your Booking has been cancelled";
}


if($row->Status=="")
{
  echo "Not Response Yet";
}


     ;?></td>
     <th >Admin Remark</th>
    <?php if($row->Status==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>
  </tr>
  
 
<?php $cnt=$cnt+1;}} ?>

</table> 
<?php
if($row->Status=="Approved")
{
  if($row->payment=="unpaid")
  {
    ?><a href="ecard.php?invid=<?php echo htmlentities ($row->tid);?>" class="btn btn-success">Payment</a><?php
  }
  else{
    ?> <a href="eventinvoice.php?invid=<?php echo htmlentities ($row->tid);?>" class="btn btn-success">Invoice</a><?php
  }
}
else if($row->Status=="Cancelled")
{
    
 ?> <a href="eventinvoice.php?invid=<?php echo htmlentities ($row->tid);?>" class="btn btn-success">Invoice</a><?php
}
else
{
  ?> <a href="eventinvoice.php?invid=<?php echo htmlentities ($row->tid);?>" class="btn btn-success">Invoice</a><?php
}?>
				</div>
			
			</div>
			<!-- //container-wrap -->
	</div>
  
	<!-- //typography -->
			</div>
			<!--footer-->
				<?php include_once('includes/footer.php');?>
</body>
</html><?php  } ?>