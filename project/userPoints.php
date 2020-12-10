<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!is_logged_in()) {
   die(header(':', true, 403));
 }

?>
<?php
$id = get_user_id();
$points = 0;
if(isset($id)) {
    $db = getDB();
    $stmt = $db->prepare("SELECT points FROM Users WHERE id = $id");
    $r = $stmt->execute(["points" => $points]);
}
?>
<?php safer_echo($points); ?>


