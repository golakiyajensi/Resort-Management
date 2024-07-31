<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
if (strlen($_SESSION['hbmsuid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Imagica Resort| Resort :: My Booking</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />

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
            <?php
                     if(isset($_POST['submit']))
                     {
                        $invid=intval($_GET['invid']);
                        $uid=$_SESSION['hbmsuid'];
                        $city=$_POST['city'];
                        $card=$_POST['card'];
                        $nameoncard=$_POST['nameoncard'];
                        $cardno=$_POST['cardno'];
                        $expmonth=$_POST['expmonth'];
                        $expyear=$_POST['expyear'];
                        $cvv=$_POST['cvv'];
                      
                   $sql="insert into payment(ID,UserId,cid,Price,city,cardname,cardno,expmo,expy,cvv)values(:invid,:uid,:cid,:price,:city,:card,:nameoncard,:cardno,:expmonth,:expyear,:cvv)";
                   $query=$dbh->prepare($sql);
                   $query->bindParam(':rid',$rid,PDO::PARAM_STR);
                   $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                   $query->bindParam(':city',$city,PDO::PARAM_STR);
                   $query->bindParam(':',$gender,PDO::PARAM_STR);
                   $query->bindParam(':address',$address,PDO::PARAM_STR);
                   $query->bindParam(':checkindate',$checkindate,PDO::PARAM_STR);
                   $query->bindParam(':checkoutdate',$checkoutdate,PDO::PARAM_STR);
                   $query->execute();
                   
                      $LastInsertId=$dbh->lastInsertId();
                      if ($LastInsertId>0)
                   {
                      echo '<script>alert("Your room has been book successfully. Booking Number is "+"'.$booknum.'")</script>';
                      echo "<script>window.location.href ='index.php'</script>";
                   }
                     else
                       {
                            echo '<script>alert("Something Went Wrong. Please try again")</script>';
                       }
                   
              ?>
            <div class="con">
<form method="POST">

    <div class="row">

        <div class="col">

            <h3 class="title">billing address</h3>

            <div class="inputBox">
                <span>full name :</span>
                <input type="text" placeholder="Enter Full Name" value="<?php  echo $row->FullName;?>" required="true" readonly="true" name="name">
            </div>
            <div class="inputBox">
                <span>email :</span>
                <input type="email" placeholder="example@example.com" value="<?php  echo $row->Email;?>" name="email" required="true" readonly="true"<?php $cnt=$cnt+1; ?>>
            </div>
            
            <div class="inputBox">
                <span>address :</span>
                <input type="text" placeholder="room - street - locality" name="address">
            </div>
            <div class="inputBox">
                <span>city :</span>
                <input type="text" placeholder="mumbai" name="city">
            </div>

            <div class="inputBox">
                <span>Total Amount :</span>
                <input type="text" placeholder="00,000,00" name="price">
            </div>

        </div>

        <div class="col">

            <h3 class="title">payment</h3>

            <div class="inputBox">
                <span>cards accepted :</span>
                <img src="images/card_img.png" alt="" name="card">
            </div>
            <div class="inputBox">
                <span>name on card :</span>
                <input type="text" placeholder="Enter name " name="nameoncard">
            </div>
            <div class="inputBox">
                <span>credit card number :</span>
                <input type="number" placeholder="1111-2222-3333-4444" name="cardno">
            </div>
            <div class="inputBox">
                <span>exp month :</span>
                <input type="text" placeholder="january" name="expmonth">
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>exp year :</span>
                    <input type="number" placeholder="2024" name="expyear">
                </div>
                <div class="inputBox">
                    <span>CVV :</span>
                    <input type="password" placeholder="1234" name="cvv">
                </div>
            </div>

        </div>

    </div>

    <input type="submit" value="Payment " class="btn btn-success" name="Submit">
    <a href="invoice.php?invid=<?php echo htmlentities ($row->tid);?>" class="btn btn-success" name="Submit">Invoice</a>
    
</form>
</div>  			   
				</div>
			
			<!-- //container-wrap -->
</div>
	
	<!-- //typography -->
		
			<!--footer-->
				<?php include_once('includes/footer.php');?>
</body>
</html><?php }  ?>
