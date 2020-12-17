<link rel="stylesheet" href="static/css/styles.css">
<?php
//we'll be including this on most/all pages so it's a good place to include anything else we want on those pages
require_once(__DIR__ . "/../lib/helpers.php");
?>
<nav>
<ul class="nav">
    <li><a href="home.php">Home</a></li>
    <?php if (!is_logged_in()): ?>
	<li><a href="arcadeShooter.php">Game</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    <?php endif; ?>

 <?php if (has_role("Admin")): ?>
       <!--     <li><a href="test_create_scores.php">Create Scores</a></li>
            <li><a href="test_list_scores.php">View Scores</a></li>
	    <li><a href="test_create_pointshistory.php">Create Point History</a></li>
            <li><a href="test_list_pointshistory.php">View Point History</a></li>
        <?php endif; ?> 
			 -->

    <?php if (is_logged_in()): ?>
	<li><a href="listComps.php">Active Competitions</a></li>
	<li><a href="myComps.php">My Competitions</a></li>
	<li><a href="createComp.php">Create Competition</a></li>
	<li><a href="arcadeShooter.php">Game</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
    <?php endif; ?>
</ul>
</nav>