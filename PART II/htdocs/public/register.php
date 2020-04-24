
<?php require_once('../private/initialize.php') ?>

<!-- Define Title -->
<?php $page_title = 'Register'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>


<div class="row">
      <div class="col-sm-4" ></div>
      <div class="col-sm-4" >

      	<h1 class="text-center">Register</h1>

      	<form action="create-account.php" method="POST" class="needs-validation" novalidate>
		    <div class="form-group">
		      <label for="username">Username:</label>
		      <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
      		  <div class="invalid-feedback">Length should be between 6 to 20 </div>
		    </div>
		    <div class="form-group">
		      <label for="pwd">password:</label>
		      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required pattern="^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$">
		      <div class="invalid-feedback">
			  Contains both letters and digits<br>
			  Length between 6 to 20
			</div>
		      
		    </div>
		    
		    <div class="form-group">
		      <label for="fname">First Name:</label>
		      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" required pattern="[a-zA-Z]{1-30}">
		      <div class="invalid-feedback">Can only contain letters</div>
		    </div>
		    <div class="form-group">
		    	<label for="lname">Last Name:</label>
		      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" required pattern="[a-zA-Z]{1-30}">
		      <div class="invalid-feedback">Can only contain letters</div>
		    </div>

		    <!-- Gender -->
		    <div>Gender:</div>
		    <div class="form-group">
			    <div class="form-check-inline">
			      <label class="form-check-label" for="Male">
			        <input type="radio" class="form-check-input" id="Male" name="gender" value="M" checked>Male
			      </label>
			    </div>
			    <div class="form-check-inline">
			      <label class="form-check-label" for="Female">
			        <input type="radio" class="form-check-input" id="Female" name="gender" value="F">Female
			      </label>
			    </div>
			    <div class="form-check-inline">
			      <label class="form-check-label" for ="gender_not_reveal">
			        <input type="radio" class="form-check-input" id="gender_not_reveal" name="gender" value="N">Prefer not to reveal
			      </label>
			    </div>
			</div>

		     <!-- Martial status -->
		   <div>Martial Status:</div>
		    <div class="form-group">

			    <div class="form-check-inline">
			      <label class="form-check-label" for="Married">
			        <input type="radio" class="form-check-input" id="Married" name="martial" value="S" checked>Married
			      </label>
			    </div>
			    <div class="form-check-inline">
			      <label class="form-check-label" for="Single">
			        <input type="radio" class="form-check-input" id="Single" name="martial" value="S">Single
			      </label>
			    </div>
			    <div class="form-check-inline">
			      <label class="form-check-label" for="Widow/Widower" >
			        <input type="radio" class="form-check-input" id="Widow/Widower" name="martial" value="W">Widow/Widower
			      </label>
			    </div>
			</div>


		    <!-- steeet address-->
		    <div class="form-group">
		    	<label for="street_ad">Street Address:</label>
		      <input type="text" class="form-control" id="street_ad" placeholder="Enter Street Address" name="street_ad" required maxlength="30">
		      <div class="invalid-feedback">Enter street address</div>
		    </div>

		    <!-- city -->
		    <div class="form-group">
		    	<label for="city">City:</label>
		      <input type="text" class="form-control" id="city" placeholder="Enter city" name="city" required pattern="[a-zA-Z]{1,30}">
		      <div class="invalid-feedback">
		      	Enter City that only contains letters and at most 30 characters<br>
		        
		      	</div>
		    </div>

		    <!-- state -->
		    <div class="form-group">
		     <label for="state">State:</label>
		      <select class="form-control" id="state" name="state">
		        <option value = "AL">Alabama - AL</option>
					<option value = "AK">Alaska - AK</option>
					<option value = "AZ">Arizona - AZ</option>
					<option value = "AR">Arkansas - AR</option>
					<option value = "CA">California - CA</option>
					<option value = "CO">Colorado - CO</option>
					<option value = "CT">Connecticut - CT</option>
					<option value = "DE">Delaware - DE</option>
					<option value = "FL">Florida - FL</option>
					<option value = "GA">Georgia - GA</option>
					<option value = "HI">Hawaii - HI</option>
					<option value = "ID">Idaho - ID</option>
					<option value = "IL">Illinois - IL</option>
					<option value = "IN">Indiana - IN</option>
					<option value = "IA">Iowa - IA</option>
					<option value = "KS">Kansas - KS</option>
					<option value = "KY">Kentucky - KY</option>
					<option value = "LA">Louisiana - LA</option>
					<option value = "ME">Maine - ME</option>
					<option value = "MD">Maryland - MD</option>
					<option value = "MA">Massachusetts - MA</option>
					<option value = "MI">Michigan - MI</option>
					<option value = "MN">Minnesota - MN</option>
					<option value = "MS">Mississippi - MS</option>
					<option value = "MO">Missouri - MO</option>
					<option value = "MT">Montana - MT</option>
					<option value = "NE">Nebraska - NE</option>
					<option value = "NV">Nevada - NV</option>
					<option value = "HampshireNH">New Hampshire - NH</option>
					<option value = "JerseyNJ">New Jersey - NJ</option>
					<option value = "MexicoNM">New Mexico - NM</option>
					<option value = "YorkNY">New York - NY</option>
					<option value = "CarolinaNC">North Carolina - NC</option>
					<option value = "DakotaND">North Dakota - ND</option>
					<option value = "OH">Ohio - OH</option>
					<option value = "OK">Oklahoma - OK</option>
					<option value = "OR">Oregon - OR</option>
					<option value = "PA">Pennsylvania - PA</option>
					<option value = "IslandRI">Rhode Island - RI</option>
					<option value = "CarolinaSC">South Carolina - SC</option>
					<option value = "DakotaSD">South Dakota - SD</option>
					<option value = "TN">Tennessee - TN</option>
					<option value = "TX">Texas - TX</option>
					<option value = "UT">Utah - UT</option>
					<option value = "VT">Vermont - VT</option>
					<option value = "VA">Virginia - VA</option>
					<option value = "WA">Washington - WA</option>
					<option value = "VirginiaWV">West Virginia - WV</option>
					<option value = "WI">Wisconsin - WI</option>
					<option value = "WY">Wyoming - WY</option>
		      </select>
		    </div>

		    <!-- zip code -->
		    <div class="form-group">
		    	<label for="zipcode">Zip Code:</label>
		      <input type="text" class="form-control" id="zipcode" placeholder="Enter Zip Code" name="zipcode" required pattern="[0-9]{5}">
		      <div class="invalid-feedback">Enter a five-digit zip code</div>
		    </div>

		    <button type="submit" class="btn btn-primary">Submit</button>
		</form>


      </div>
      <div class="col-sm-4" ></div>
</div>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>


