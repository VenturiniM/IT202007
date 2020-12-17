<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
    <h3>Create PointHistory</h3>
    <form method="POST">
        <label>id</label>
        <input type="number" name="id"/>
        <label>user_id</label>
        <input type="number" name="user_id"/>
        <label>points_change</label>
        <input type="number" min="1" name="points_change"/>
	<label>reason</label>
	<input name="reason"/>
        <label>created</label>
        <input name="created"/>
        <input type="submit" name="save" value="Create"/>
    </form>

<?php
if (isset($_POST["save"])) {
    //TODO add proper validation/checks
    $id = $_POST["id"];
   // $userid = $_POST["user_id"];
    //$id = $_POST[value="<?php echo $result["id"]];
    $pc = $_POST["points_change"];
    $reason = $_POST["reason"];
    $created = $_POST["created"];
    $userid = get_user_id();
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO PointsHistory (id, user_id, points_change, reason, created) VALUES(:id, :userid, :pc, :reason, :created)");
    $r = $stmt->execute([
        ":id" => $id,
        ":userid" => $userid,
        ":pc" => $pc,
	":reason" => $reason,
        ":created" => $created
        //":user" => $user
    ]);
    if ($r) {
        flash("Created successfully with id: " . $db->lastInsertId());
    }
    else {
        $e = $stmt->errorInfo();
        flash("Error creating: " . var_export($e, true));
    }
}
?>
<?php require(__DIR__ . "/partials/flash.php");
