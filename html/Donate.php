<!DOCTYPE html>
<html lang="en">

      	<head>
            <meta charset="UTF-8">
            <title>Let's Party</title> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <meta name="viewport" content="width=device-width, initial-scale=1">  
        	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      	</head>
        
       <body>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        
        <article class="card"><h2>Donate!</h2>
        <div class="card-body p-5">
        
        <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
        	<li class="nav-item">
        		<a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
        		<i class="fa fa-credit-card"></i> Credit Card</a></li>
        	<li class="nav-item">
        		<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
        		<i class="fab fa-paypal"></i>  Paypal</a></li>
        	<li class="nav-item">
        		<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
        		<i class="fa fa-university"></i>  Bank Transfer</a></li>
        </ul>
        
        <div class="tab-content">
        <div class="tab-pane fade show active" id="nav-tab-card">
        	
        	<form role="form" action="../php/cardDonate.php" method="POST">
        	
        	<div class="form-group">
        		<label>Amount</label>
        		<input type="text" class="form-control" name="amount">
        	</div>
        	
        	<div class="form-group">
        		<label>Full name (on the card)</label>
        		<input type="text" class="form-control" name="username">
        		</div> <!-- form-group.// -->
        
        	<div class="form-group">
        		<label>Card number</label>
        		<div class="input-group">
        			<input type="number" class="form-control" name="cardNumber">
        			<div class="input-group-append">
        				<span class="input-group-text text-muted">
        					<i class="fab fa-cc-visa"></i><i class="fab fa-cc-amex"></i>
        					<i class="fab fa-cc-mastercard"></i> 
        				</span>
        			</div>
        		</div>
        	</div> <!-- form-group.// -->
        
        	<div class="row">
        	    <div class="col-sm-8">
        	        <div class="form-group">
        	            <label><span class="hidden-xs">Expiration</span> </label>
        	        	<div class="input-group">
        	        		<input type="number" class="form-control" placeholder="MM" name="month">
        		            <input type="number" class="form-control" placeholder="YY" name="year">
        	        	</div>
        	        </div>
        	    </div>
        	    <div class="col-sm-4">
        	        <div class="form-group">
        	            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
        	            <input type="number" name="cvv" class="form-control">
        	        </div> <!-- form-group.// -->
        	    </div>
        	</div> <!-- row.// -->
        	<button class="subscribe btn btn-primary btn-block" type="submit"> Confirm  </button>
        	</form>
        </div> <!-- tab-pane.// -->
        <div class="tab-pane fade" id="nav-tab-paypal">
        <p>Paypal is easiest way to pay online</p>
        <p>
        <button type="button" class="btn btn-primary" onclick="window.location.href = 'https://www.paypal.com/us/signin';"> <i class="fab fa-paypal"></i> Log in my Paypal </button>
        </p>
        <p><strong>Note:</strong> Paypal offers a free-guarantee on your purchases, that's why we recommend it. </p>
        </div>
        <div class="tab-pane fade" id="nav-tab-bank">
        <p>Bank account details</p>
        <dl class="param">
          <dt>BANK: </dt>
          <dd> THE WORLD BANK</dd>
        </dl>
        <dl class="param">
          <dt>Account number: </dt>
          <dd> 12345678912345</dd>
        </dl>
        <dl class="param">
          <dt>IBAN: </dt>
          <dd> 123456789</dd>
        </dl>
        <p><strong>Note:</strong> This payment method could cost you a little bit more, due to bank's transaction taxes. We recommend using paypal!. </p>
        </div> <!-- tab-pane.// -->
        </div> <!-- tab-content .// -->
        
        </div> <!-- card-body.// -->
        </article> <!-- card.// -->
       
       </body>