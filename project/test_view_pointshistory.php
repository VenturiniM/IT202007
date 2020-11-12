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
    $stmt = $db->prepare("SELECT ph.id,ph.user_id,ph.points_change,ph.created,Users.username FROM PointsHistory as ph JOIN Users on ph.user_id = Users.id LEFT JOIN Scores on Scores.user_id = ph.user_id where ph.id = :id");
    $r = $stmt->execute([":id" => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $e = $stmt->errorInfo();
        flash($e[2]);
    }
}
?>
    <h3>View Points History</h3>
<?php if (isset($result) && !empty($result)): ?>
    <div class="card">
            <div class="card-body">
            <div>
                <p>Stats</p>
                <div>User ID: <?php safer_echo($result["user_id"]); ?></div>
                <div>Score: <?php safer_echo($result["points_change"]); ?></div>
                <div>Username: <?php safer_echo($result["username"]); ?></div>
                <div>Created: <?php safer_echo($result["created"]); ?></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>Error looking up id...</p>
<?php endif; ?>
<?php require(__DIR__ . "/partials/flash.php");
