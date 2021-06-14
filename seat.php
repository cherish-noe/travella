<?php require_once 'connect.php';?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Bus Ticket Reservation Widget Flat Responsive Widget Template :: w3layouts</title>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Bus Ticket Reservation Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/jquery.seat-charts.css">
<link href="css/seat.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery.seat-charts.js"></script>
</head>
<body>
<div class="content">
<form id="seatForm" method="post">
<div class="backnav"><a href="home(index.php">Home</a><a href="#">/</a><a href="searchbus.php">Search Bus</a><a href="#">/</a><a href="#"><span class="activenav">Choose Seat</span></a></div>
<br>

	<div class="main">
		<h2>Book Your Seat Now?</h2>
		<div class="wrapper">
			<div id="seat-map">
				<div class="front-indicator"><h3>Front</h3></div>
			</div>
			<div class="booking-details">
						<div id="legend"></div>	          
			</div>
			<div class="clear"></div>
		</div>
		<script>
		var booked = new Array();
		<?php 
				$bid = $_POST["bid"];
				$no_of_seat = "SELECT NO_OF_SEAT FROM bus WHERE BUSID='".$bid."'";
				$totalSeat = $connection->query($no_of_seat);
				foreach ($totalSeat as $ts)
				{
				    $nos = $ts["NO_OF_SEAT"];
				    echo "var nos = '{$ts["NO_OF_SEAT"]}';";
				}
				
				$booked = "SELECT SeatID FROM Seat_Detail WHERE BUSID='".$bid."' and Seat_Status='booked'";
				$bookedSeat = $connection->query($booked);
				foreach ($bookedSeat as $bs)
				{
				    if($bs["SeatID"]< $nos-3 )
				    {
				        switch($bs["SeatID"]%4){
				            case 0:echo "booked.push('{$bs["SeatID"]}'/4+'_'+'5');";break;
				            case 3:echo "booked.push(Math.floor('{$bs["SeatID"]}'/4)+1+'_'+'4');";break;
				            default:echo "booked.push(Math.floor('{$bs["SeatID"]}'/4)+1+'_'+'{$bs["SeatID"]}'%4);";break;
				        }
				    }
				    else{
				        switch($bs["SeatID"]){
				            case $nos:echo "booked.push(".((($nos-5)/4)+1)."+'_'+'5');";break;
				            case $nos-1:echo "booked.push(".((($nos-5)/4)+1)."+'_'+'4');";break;
				            default:echo "booked.push(".((($nos-5)/4)+1)."+'_'+'3');";break;
				        }
				    }
				}
				?>
				
				var firstSeatLabel = 1;
				var nop = <?php echo $_POST["noofpassenger"];?>;
				var seatsNo = new Array();
				$(document).ready(function() {
					var $cart = $('#selected-seats'),
						$counter = $('#counter'),
						$total = $('#total'),
						$seatsLocation = new Array();
					nos = nos-5;
					for(var i=1; i<=nos/4;i++)
							{$seatsLocation.push('ee_ee');}
						$seatsLocation.push('eeeee');
						sc = $('#seat-map').seatCharts({
						map: $seatsLocation,
						seats: {
							e: {
								price: <?php echo $_POST['price'];?>,
								classes : 'economy-class', //your custom CSS class
								category: 'Available'
							}					
						
						},
						naming : {
							top : false,
							getLabel : function (character, row, column) {
								return firstSeatLabel++;
							},
						},
						legend : {
							node : $('#legend'),
							items : [
								[ 'e', 'available',   'Available'],
								[ 'f', 'unavailable', 'Already Booked']
							]					
						},
						click: function () {
							if (this.status() == 'available' && Number($counter.text())<nop ) {
								//let's create a new <li> which we'll add to the cart items
								$('<li>'+this.data().category+' : Seat no '+this.settings.label+'<button class="cancel-cart-item" style="background-color:red;cursor: pointer;border:none;">Cancel</button></li>')
									.attr('id', 'cart-item-'+this.settings.id)
									.data('seatId', this.settings.id)
									.appendTo($cart);
								seatsNo.push(this.settings.label);
								document.getElementById("seatID").value=seatsNo;
								 /*
								 * Lets update the counter and total
								 *
								 * .find function will not find the current seat, because it will change its stauts only after return
								 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
								 */
								$counter.text(sc.find('selected').length+1);
								$total.text(recalculateTotal(sc)+this.data().price);
								
								return 'selected';
							} else if (this.status() == 'selected') {
								//update the counter
								$counter.text(sc.find('selected').length-1);
								//and total
								$total.text(recalculateTotal(sc)-this.data().price);
							
								//remove the item from our cart
								$('#cart-item-'+this.settings.id).remove();
								//seatsNo.pop(this.settings.label);
								//seat has been vacated
								
								seatsNo.splice(seatsNo.indexOf(this.settings.label),1);
								document.getElementById("seatID").value=seatsNo;
								return 'available';
							} else if (this.status() == 'unavailable') {
								//seat has been already booked
								return 'unavailable';
							} else {
								return this.style();
							}
						}
					});

					//this will handle "[cancel]" link clicks
					$('#selected-seats').on('click', '.cancel-cart-item', function () {
						//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
						sc.get($(this).parents('li:first').data('seatId')).click();
					});

					//let's pretend some seats have already been booked
					sc.get(booked).status('unavailable');
			
			});

			function recalculateTotal(sc) {
				var total = 0;
			
				//basically find every selected seat and sum its price
				sc.find('selected').each(function () {
					total += this.data().price;
				});
				
				return total;
			}
		</script>
	</div>
    <div class="calculate">
    					<h3> Selected Seats (<span id="counter">0</span>):</h3>
						<ul id="selected-seats"></ul>
						<input type="hidden" id="seatID" name="seatID">
					Total: <b>$<span id="total">0</span></b>
					<input type="hidden" name="bid" value="<?php echo $_POST["bid"];?>">	
		<button class="checkout-button" name="checkout" type="submit" onClick="<?php if($_POST["trip_type"]=='round'){?>document.getElementById('seatForm').action='searchbus.php';<?php }else{?>document.getElementById('seatForm').action='checkout.php';<?php }?>">Book</button>
       	
       	<!-- go to trip -->
        <input type="hidden" name="from" value="<?php echo $_POST["from"]?>">
        <input type="hidden" name="to" value="<?php echo $_POST["to"]?>">
        <input type="hidden" name="deptDate" value="<?php echo $_POST["deptDate"]?>">
        <input type="hidden" name="cname" value="<?php echo $_POST["cname"]?>">
        <input type="hidden" name="price" value="<?php echo $_POST["price"]?>">
        
        <!-- return trip -->
        <input type="hidden" id="from1" name="from1">
        <input type="hidden" id="to1" name="to1">
        <input type="hidden" id="deptDate1" name="deptDate1">
        <input type="hidden" id="cname1" name="cname1">
        <input type="hidden" id="price1" name="price1">
        
        <input type="hidden" name="tripDetail" value="<?php echo $_POST["tripDetail"]?>">
        <input type="hidden" name="trip_type" value="trip">
        <input type="hidden" name="return_Date" value="<?php echo $_POST["return_Date"]?>">
        <input type="hidden" name="trip" value="<?php echo $_POST["trip"]?>">
        <input type="hidden" name="noofpassenger" value="<?php echo $_POST["noofpassenger"];?>">
    </div>
    <div class="clear"></div>
</div>
<?php 
if(isset($_POST["btnreturn"])){
    ?>
    <script type="text/javascript">
    	document.getElementById("from1").value="<?php echo $_POST["from"]?>";
    	document.getElementById("to1").value="<?php echo $_POST["to"]?>";
    	document.getElementById("deptDate1").value="<?php echo $_POST["deptDate"]?>";
    	document.getElementById("cname1").value="<?php echo $_POST["cname"]?>";
    	document.getElementById("price1").value="<?php echo $_POST["price"]?>";
    </script>
    <input type="hidden" name="round" value="round">
<?php 
}
?>
</form>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
</script>
</body>
</html>
