<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>
<?php
$query = "";
$results = [];
if (isset($_POST["query"])) {
    $query = $_POST["query"];
}
if (isset($_POST["search"]) && !empty($query)) {
    $db = getDB();
    $stmt = $db->prepare("SELECT ph.id,ph.user_id,ph.points_change, ph.created, Users.username from PointsHistory as ph JOIN Users on ph.user_id = Users.id LEFT JOIN Scores as Scores on ph.user_id = Scores.id WHERE ph.id like :q");
    $r = $stmt->execute([":q" => "%$query%"]);
    if ($r) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        flash("There was a problem fetching the results " . var_export($stmt->errorInfo(), true));
    }
}
?>
<h3>List Point History</h3>
<form method="POST">
    <input name="query" placeholder="Search" value="<?php safer_echo($query); ?>"/>
    <input type="submit" value="Search" name="search"/>
</form>
<div class="results">
    <?php if (count($results) > 0): ?>
        <div class="list-group">
            <?php foreach ($results as $r): ?>
                <div class="list-group-item">
                    <div>
                        <div>id:</div>
                        <div><?php safer_echo($r["id"]); ?></div>
                    </div>
		    <div>
                        <div>user_id:</div>
                        <div><?php safer_echo($r["user_id"]); ?></div>
                    </div>

                    <div>
                        <div>Score:</div>
                        <div><?php safer_echo($r["points_change"]); ?></div>
                    </div>
                    <div>
                        <div>username:</div>
                        <div><?php safer_echo($r["username"]); ?></div>
                    </div>
                    <div>
                        <a type="button" href="test_edit_pointshistory.php?id=<?php safer_echo($r['id']); ?>">Edit</a>
                        <a type="button" href="test_view_pointshistory.php?id=<?php safer_echo($r['id']); ?>">View</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No results</p>
    <?php endif; ?>
</div>
