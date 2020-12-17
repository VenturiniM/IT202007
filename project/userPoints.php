<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!is_logged_in()) {
   die(header(':', true, 403));
 }

?>
<?php
//Update User Points. Sum from points_change column
$id = get_user_id();
if(isset($id)) {
   $db = getDB();
   $stmt = $db ->prepare("UPDATE Users set points = (SELECT IFNULL(SUM(points_change), 0) FROM PointsHistory points_change where points_change.user_id = :id) WHERE id = :id");
   $r = $stmt->execute([":id" => $id]);
 }

?>
<?php
//Get points column (used to diplay in profile)
$id = get_user_id();
$result = [];
if(isset($id)) {
    $db = getDB();
    $stmt = $db->prepare("SELECT points FROM Users WHERE id = $id");
    $r = $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $e = $stmt->errorInfo();
        flash($e[2]);
    }
}
?>

