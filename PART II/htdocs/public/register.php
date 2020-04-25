
<?php require_once('../private/initialize.php') ?>


<?php if(check_cookie()){redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Register'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>



      	

      	<?php  if (isset($_GET['usernametaken'])){
      		echo ('<div class="text-danger">Username is taken</div>');
      	} ?>
      	<form action="create-account.php" method="POST" class="needs-validation" novalidate>
		    <!-- Username -->
		    <div class="form-group">
		      <label for="username">Username:</label>
		      <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required pattern="[a-zA-Z0-9]{5,20}">
      		  <div class="invalid-feedback">
      		  	Contains only letters and numbers<br>
      			Length should be between 5 to 20 </div>
		      </div>
		    <!-- Password -->
		    <div class="form-group">
		      <label for="pwd">Password:</label>
		      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required pattern="^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$">
		      <div class="invalid-feedback">
			  Contains both letters and numbers<br>
			  Length between 6 to 20
			  </div>
		      
		    </div>
		    <!-- First Name -->
		    <div class="form-group">
		      <label for="fname">First Name:</label>
		      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" required pattern="[a-zA-Z]{1,30}">
		      <div class="invalid-feedback">Contains only letters<br>At most 30 characters</div>
		    </div>
		    <!-- Last Name -->
		    <div class="form-group">
		    	<label for="lname">Last Name:</label>
		      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" required pattern="[a-zA-Z]{1,30}">
		      <div class="invalid-feedback">Contains only letters<br>At most 30 characters</div>
		    </div>

		    <!-- Gender -->
		    <div>Gender:</div>
		    <div class="form-group text-center">
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
		    <div class="form-group text-center">

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
		      <div class="invalid-feedback">
		      	At most 30 characters<br></div>
		    </div>

		    <!-- city -->
		    <div class="form-group">
		    	<label for="city">City:</label>
		      <input type="text" class="form-control" id="city" placeholder="Enter city" name="city" required pattern="[a-zA-Z]{1,30}">
		      <div class="invalid-feedback">
		      	Contains only letters<br>
		      	At most 30 characters<br>
		        
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
					<option value = "NH">New Hampshire - NH</option>
					<option value = "NJ">New Jersey - NJ</option>
					<option value = "NM">New Mexico - NM</option>
					<option value = "NY">New York - NY</option>
					<option value = "NC">North Carolina - NC</option>
					<option value = "ND">North Dakota - ND</option>
					<option value = "OH">Ohio - OH</option>
					<option value = "OK">Oklahoma - OK</option>
					<option value = "OR">Oregon - OR</option>
					<option value = "PA">Pennsylvania - PA</option>
					<option value = "RI">Rhode Island - RI</option>
					<option value = "SC">South Carolina - SC</option>
					<option value = "SD">South Dakota - SD</option>
					<option value = "TN">Tennessee - TN</option>
					<option value = "TX">Texas - TX</option>
					<option value = "UT">Utah - UT</option>
					<option value = "VT">Vermont - VT</option>
					<option value = "VA">Virginia - VA</option>
					<option value = "WA">Washington - WA</option>
					<option value = "WV">West Virginia - WV</option>
					<option value = "WI">Wisconsin - WI</option>
					<option value = "WY">Wyoming - WY</option>
		      </select>
		    </div>

		    <!-- zip code -->
		    <div class="form-group">
		    	<label for="zipcode">Zip Code:</label>
		      <input type="text" class="form-control" id="zipcode" placeholder="Enter Zip Code" name="zipcode" required pattern="[0-9]{5}">
		      <div class="invalid-feedback">5-digit</div>
		    </div>
		    <div class="text-center">
		    	<button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</form>



<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>


