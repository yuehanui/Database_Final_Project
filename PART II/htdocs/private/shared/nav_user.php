
<?php require_once('../private/initialize.php') ?>

<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top">
	  <a class="navbar-brand" href="index.php"><strong>WDS</strong></a>
	  <ul class="navbar-nav">
	  	<li class="nav-item">
	      <a class="nav-link" href="dashboard.php">Dashboard</a>
	    </li>
	    <!-- Dropdown -->
	    <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	        <?php echo($_COOKIE['username']);?>
	      </a>
	      <div class="dropdown-menu">
	        <a class="dropdown-item" href="logout.php">Logout</a>

	      </div>
	    </li>
	  </ul>
</nav>