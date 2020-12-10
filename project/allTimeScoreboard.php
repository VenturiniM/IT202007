<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
$result = [];

$db = getDB();
$stmt = $db->prepare("SELECT Users.username, user_id, score FROM Scores S JOIN Users on S.user_id = Users.id ORDER BY score DESC LIMIT 10");
$r = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$result) {
       $error = $stmt->errorInfo();
       flash($error[2]);
   }
?>

<?php if (count($result) > 0): ?>
    <?php foreach ($result as $r): ?>
        <div style=" alignment: center ">
            <div><?php safer_echo($r["username"]); ?> </div>
        </div>
        <div style=" alignment: center ">
            <div>Score: <?php safer_echo($r["score"]); ?></div>
        </div>
        <br>
    <?php endforeach; ?>
<?php else: ?>
    <p>No results</p>
<?php endif; ?>
<?php require(__DIR__ . "/partials/flash.php");?>