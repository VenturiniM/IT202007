<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php

$id = get_user_id();
$result = [];

if(isset($id)) {
    $db = getDB();
    $stmt = $db->prepare("SELECT Users.username, user_id, score FROM Scores as Scores JOIN Users on Scores.user_id = Users.id where Scores.user_id = :id ORDER BY Scores.id DESC LIMIT 10");
    $r = $stmt->execute([":id" => $id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
