<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
<?php
//we'll put this at the top so both php block have access to it
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
?>
<?php
//saving
if (isset($_POST["save"])) {
    //TODO add proper validation/checks
    $id = $_POST["id"];
   // $userid = $_POST["user_id"];
    //$id = get_id();
    $userid = get_user_id();
    $pc = $_POST["points_change"];
    $reason = $_POST["reason"];
    $created = $_POST["created"];
    //$max = $_POST["mod_max"];
    
    $db = getDB();
    if (isset($id)) {
        $stmt = $db->prepare("UPDATE PointsHistory set id=:id, user_id=:userid, points_change=:pc, reason=:reason, created=:created where user_id=:userid");
	$r = $stmt->execute([
            ":id" => $id,
            ":userid" => $userid,
            ":pc" => $pc,
            ":reason" => $reason,
            ":created" => $created
            
        ]);
        if ($r) {
            flash("Updated successfully with id: " . $id);
        }
        else {
            $e = $stmt->errorInfo();
            flash("Error updating: " . var_export($e, true));
        }
    }
    else {
        flash("ID isn't set, we need an ID in order to update");
    }
}
?>
<?php
//fetching
$result = [];
if (isset($id)) {
   // $id = $_GET["id"];
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM PointsHistory where id = :id");
    $r = $stmt->execute([":id" => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
//get eggs for dropdown
$db = getDB();
$stmt = $db->prepare("SELECT * from PointsHistory");
$r = $stmt->execute();
$scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <h3>Edit Point History</h3>
    <form method="POST">
        <label>id</label>
        <input name="id"; />
	<label>user_id</label>
        <input name="user_id"; />
        <label>Edit Score</label>
	<input name="points_change"; />        
        <label>Reason</label>
        <input name="reason"; />
        <label>Created</label>
        <input name="created"; />
        <input type="submit" name="save" value="Update"/>
    </form>


<?php require(__DIR__ . "/partials/flash.php");
