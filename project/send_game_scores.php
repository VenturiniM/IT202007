<?php require_once(__DIR__ . "/partials/helpers.php"); ?>
<?php
if (is_logged_in() && isset($_POST["score"])) {
  //$userid = $_POST["user_id"];
   $userid = get_user_id();
   $score = $_POST["score"];

   $db = getDB();
   $stmt = $db->prepare("INSERT INTO Scores (user_id, score) VALUES(:userid, :score)");
   $r = $stmt->execute([
	":userid"=>$userid,
	":score"=>$score,
	]);
   
   if ($r) {
    $response = ["status" => 200, "score" => $score];
    echo json_encode($response);
    die();
}
else {
    $e = $stmt->errorInfo();
    $response = ["status" => 400, "error" => $e];
    echo json_encode($response);
    die();
}
}
?>
