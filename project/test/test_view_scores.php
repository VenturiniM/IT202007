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
//fetching
$result = [];
if (isset($id)) {
    $db = getDB();
    $stmt = $db->prepare("SELECT Scores.id,user_id,score, created, Users.username FROM Users as Scores JOIN Users on Scores.user_id = Users.id where Scores.id = :id");
    $r = $stmt->execute([":id" => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $e = $stmt->errorInfo();
        flash($e[2]);
    }
}
?>
<?php if (isset($result) && !empty($result)): ?>
    <div class="card">
        <div class="card-title">
            <?php safer_echo($result["id"]); ?>
        </div>
        <div class="card-body">
            <div>
                <p>Stats</p>
                <div>Rate: <?php safer_echo($result["base_rate"]); ?></div>
                <div>Modifier: <?php safer_echo($result["mod_min"]); ?> - <?php safer_echo($result["mod_max"]); ?></div>
                <div>Current State: <?php getState($result["state"]); ?></div>
                <div>Next Stage: <?php safer_echo($result["next_stage_time"]); ?></div>
                <div>Owned by: <?php safer_echo($result["username"]); ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>Error looking up id...</p>
<?php endif; ?>
<?php require(__DIR__ . "/partials/flash.php");
