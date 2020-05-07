<?php require_once('../private/initialize.php') ?>

<!-- If user hasn't logged in, redirect to index.php-->
<?php if(!check_cookie()){
	redirect_to("index.php");}?>

<!-- Define Title -->
<?php $page_title = 'Pauchase Insurance'; ?>

<!-- Common header for all pages -->
<?php include(SHARED_PATH . '/header.php') ?>

<?php 
	//request must be POST, preventing direct access via url
	//if(!request_is_post()) {redirect_to("index.php");}
	?>
<script>
    function submitFunction()
    {	
    	if (document.getElementById("ins_type").value == "H"){
        	var url = "purchase-home.php";
        } else {
        	var url = "purchase-auto.php";
        }
        document.info.action = url;
        return true;
    }

    function showMe (it, box) {
		var ins_type = document.getElementById("ins_type").value;
		if (ins_type == "A"){
			document.getElementById(it).style.display = "block";
		} else {
			document.getElementById(it).style.display = "none";
		}
	}

</script>
<div class="row" >
      <div class="col-sm-4" ></div>
      <div class="col-sm-4 " >
		
      	<form id="info" name="info" onsubmit="return(submitFunction())" method="POST" class="needs-validation" novalidate>
	      	<!-- Insurance Type -->
		    <div class="form-group">
		     <label for="ins_type">Insurance Type:</label>
		      <select class="form-control" id="ins_type" name="ins_type" onchange="showMe('div1', this)" >
		      		<option value = "H">Home Insurance</option>
					<option value = "A">Auto Insurance</option>
		      </select>
		    </div>
		    
		    <!-- Start Date -->
		    <div class="form-group">
			  <label for="start_date">Start Date</label>
			    <input class="form-control" type="date" value="2020-01-01" id="start_date" name="start_date">
			</div>

			<!-- End Date -->
		    <div class="form-group">
			  <label for="end">End Date</label>
			    <input class="form-control" type="date" id="end_date" name="end_date" value="2021-01-01">
			</div>

			 <!-- Numbers of property -->
		    <div class="form-group">
		     <label for="no_of_pro">Numbers of property (Vehicles / Houses):</label>
		      <select class="form-control" id="no_of_pro" name="no_of_pro">
					<option value = "1">1</option>
					<option value = "2">2</option>
					<option value = "3">3</option>
					<option value = "4">4</option>
					<option value = "5">5</option>
					<option value = "6">6</option>
					<option value = "7">7</option>
					<option value = "8">8</option>
		      </select>
		    </div>

		    <!-- drivers -->
		    <div id="div1" style="display:none" class="form-group">
				 <label for="no_of_dri">Number of drivers you want to register</label>
			    <select class="form-control" id="no_of_dri" name="no_of_dri">
					<option value = "1">1</option>
					<option value = "2">2</option>
					<option value = "3">3</option>
					<option value = "4">4</option>
					<option value = "5">5</option>
					<option value = "6">6</option>
					<option value = "7">7</option>
					<option value = "8">8</option>
		      </select>
			</div>

		    <div class="text-center">
		    	<button type="submit" class="btn btn-primary">Submit</button>
		    </div>
      	
		</form>


</div><div class="col-sm-4 " >
 </div>






<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>