<?php  
session_start();
include('includes/dbconnection.php');
$invid = $_GET['invid'];
$sql = "SELECT tblbooking.BookingNumber, DATEDIFF(tblbooking.CheckoutDate, tblbooking.CheckinDate) as ddf, tblbooking.IDType, tblcategory.CategoryName, tblcategory.Price 
        FROM tblbooking 
        JOIN tblroom ON tblbooking.RoomID = tblroom.ID 
        JOIN tblcategory ON tblcategory.ID = tblroom.RoomType 
        WHERE tblbooking.ID = :invid";
$query = $dbh->prepare($sql);
$query->bindParam(':invid', $invid, PDO::PARAM_STR);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "No data found!";
    exit; // Stop further execution
}

$ddf = $row['ddf']; // Number of days difference
$price_per_day = $row['Price']; // Fetching price per day from the database
$total = $ddf * $price_per_day;
$bookingNumber = $row['BookingNumber']; 


if(isset($_POST['submit']))
{
  include('includes/dbconnection1.php');
  $cardno = $_POST['cardno'];
  $cardholder = $_POST['cardholder'];
  $month = $_POST['month'];
  $year = $_POST['year'];
  $cvv = $_POST['cvv'];
  $price=$_POST['price'];
  $invid=$_GET['invid'];
  $q1 = "INSERT INTO payment (Type,BookingNumber,cardno, cardholder, month, year, cvv,price) VALUES ('Room','$bookingNumber','$cardno', '$cardholder', '$month', '$year', '$cvv','$price')";
  $data = mysqli_query($con, $q1);  
  if($data)
  {
    echo '<script>alert("Payment has successfully")</script>';
    $q2="UPDATE tblbooking SET payment = 'Paid' WHERE BookingNumber=$bookingNumber";
    $data = mysqli_query($con, $q2);  
    echo "<script>window.location.href = 'invoice.php?invid=" . $invid . "'</script>";
  }
  else
  {
    echo '<script>alert("Payment has  not successfully")</script>';
  }
}


?>
<?php
//include('includes/dbconnection.php');
// session_start();
//error_reporting(0);
if (strlen($_SESSION['hbmsuid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Imagica Resort| Resort :: Payment</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/card.css">

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
<form method="post">
<div class="wrapper" id="app">
    <div class="card-form">
      <div class="card-list">
        <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
          <div class="card-item__side -front">
            <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
            <div class="card-item__cover">
              <!-- <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg"> -->
          <img src="images/b1.jpg">
            </div>
            
            <div class="card-item__wrapper">
              <div class="card-item__top">
             
                <!-- <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip"> -->
                <div class="card-item__type">
                  <transition name="slide-fade-up">
                  <img src="images/card.png" class="chip">
                    <!-- <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg"> -->
                  </transition>
                </div>
              </div>
              <label for="cardNumber" class="card-item__number" ref="cardNumber">
                <template v-if="getCardType === 'amex'">
                 <span v-for="(n, $index) in amexCardMask" :key="$index">
                  <transition name="slide-fade-up">
                    <div
                      class="card-item__numberItem"
                      v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''"
                    >*</div>
                    <div class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      :key="$index" v-else-if="cardNumber.length > $index">
                      {{cardNumber[$index]}}
                    </div>
                    <div
                      class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      v-else
                      :key="$index + 1"
                    >{{n}}</div>
                  </transition>
                </span>
                </template>

                <template v-else>
                  <span v-for="(n, $index) in otherCardMask" :key="$index">
                    <transition name="slide-fade-up">
                      <div
                        class="card-item__numberItem"
                        v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''"
                      >*</div>
                      <div class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        :key="$index" v-else-if="cardNumber.length > $index">
                        {{cardNumber[$index]}}
                      </div>
                      <div
                        class="card-item__numberItem"
                        :class="{ '-active' : n.trim() === '' }"
                        v-else
                        :key="$index + 1"
                      >{{n}}</div>
                    </transition>
                  </span>
                </template>
              </label>
              <div class="card-item__content">
                <label for="cardName" class="card-item__info" ref="cardName">
                  <div class="card-item__holder">Card Holder</div>
                  <transition name="slide-fade-up">
                    <div class="card-item__name" v-if="cardName.length" key="1">
                      <transition-group name="slide-fade-right">
                        <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                      </transition-group>
                    </div>
                    <div class="card-item__name" v-else key="2">Full Name</div>
                  </transition>
                </label>
                <div class="card-item__date" ref="cardDate">
                  <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                  <label for="cardMonth" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                      <span v-else key="2">MM</span>
                    </transition>
                  </label>
                  /
                  <label for="cardYear" class="card-item__dateItem">
                    <transition name="slide-fade-up">
                      <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                      <span v-else key="2">YY</span>
                    </transition>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-item__side -back">
            <div class="card-item__cover">
            <img src="images/b1.jpg">
            <!-- <img src="css/image/card.jpg"> -->
              <!-- <img
              v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg"> -->
            </div>
            <div class="card-item__band"></div>
            <div class="card-item__cvv">
                <div class="card-item__cvvTitle">CVV</div>
                <div class="card-item__cvvBand">
                  <span v-for="(n, $index) in cardCvv" :key="$index">
                    *
                  </span>

              </div>
                <div class="card-item__type">
                <!-- <img src="css/image/x2.jpg"> -->
                    <!-- <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg"> -->
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-form__inner">
        <div class="card-input">
          <label for="cardNumber" class="card-input__label">Card Number</label>
          <input type="text" name="cardno" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off" required="true">
        </div>
        <div class="card-input">
          <label for="cardName" class="card-input__label">Card Holders</label>
          <input type="text" name="cardholder" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off" required="true">
        </div>
        <div class="card-form__row">
          <!-- <div class="card-form__col">
            <div class="card-form__group">
              <label for="cardMonth" class="card-input__label">Expiration Date</label>
              <select name="month" class="card-input__input -select" id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value=""  disabled selected>Month</option>
                <option  v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">
                    {{n < 10 ? '0' + n : n}}
                </option>
              </select>
              <select name="year" class="card-input__input -select" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value="" disabled selected>Year</option>
                <option   v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
                    {{$index + minCardYear}}
                </option>
              </select>
            </div>
          </div> -->

          <div class="card-form__col">
        <div class="card-form__group">
            <label for="cardMonth" class="card-input__label">Expiration Date</label>
            <select class="card-input__input -select" id="cardMonth" name="month" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value="" disabled selected>Month</option>
                <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">
                    {{n < 10 ? '0' + n : n}}
                </option>
            </select>
            <select class="card-input__input -select" id="cardYear" name="year" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                <option value="" disabled selected>Year</option>
                <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
                    {{$index + minCardYear}}
                </option>
            </select>
        </div>
    </div>
          <div class="card-form__col -cvv">
            <div class="card-input">
              <label for="cardCvv" class="card-input__label">CVV</label>
              <input type="text" name="cvv" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="4" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off" required="true">
            </div>
          </div>
        </div>
        <div class="card-input">
          <label for="cardName" class="card-input__label">Price</label>
          <input type="text" name="price"  class="card-input__input" <?php // echo $row->Price;?> value="<?php echo $total; ?>" readonly="true">
        </div>

        <button class="card-form__button" name="submit" readonly="true"> Payment  </button>
        <!-- <a href="eventinvoice.php?invid=<?php //echo htmlentities($row['tid']); ?>" class="btn btn-success" name="Submit">Invoice</a> -->
        <!-- <a href="eventinvoice.php?invid=<?php //echo htmlentities($invid); ?>" class="btn btn-success" name="viewInvoice">View Invoice</a> -->
      </div>
    </div>
    
    
  </div>
  </form>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>

</body>
</html>
<!-- partial -->
  <script  src="js/card.js"></script>
  <?php include_once('includes/footer.php');?>

</body>
</html><?php } ?>
