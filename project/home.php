<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
//we use this to safely get the email to display
$email = "";
if (isset($_SESSION["user"]) && isset($_SESSION["user"]["email"])) {
    $email = $_SESSION["user"]["email"];
}
?>
    <p>Welcome, <?php echo $email; ?></p>

<p><b>Scoreboards:</b></p>

<form action="weeklyScoreboard.php" method="get" >
   <input type='submit' name='Weekly' value='Weekly'/>
</form>
<form action="monthlyScoreboard.php" method="get" >
   <input type='submit' name='Monthly' value='Monthly'/>
</form>
<form action="allTimeScoreboard.php" method="get" >
   <input type='submit' name='alltime' value='All Time'/>
</form>




<?php require(__DIR__ . "/partials/flash.php");