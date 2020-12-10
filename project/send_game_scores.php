<?php 
require_once(__DIR__ . "/lib/helpers.php"); 

if (!is_logged_in()) {
   die(header(':', true, 403));
 }
   $userid = get_user_id();
   $score = $_POST["sendscore"];

   $db = getDB();
   $stmt = $db->prepare("INSERT INTO Scores (user_id, score) VALUES(:userid, :score)");
   $r = $stmt->execute([
	":userid"=>$userid,
	":score"=>$score,
	]);
?>
