<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
$result = [];

$db = getDB();
$stmt = $db->prepare("SELECT Users.username, user_id, score FROM Scores S JOIN Users on S.user_id = Users.id WHERE 'created' between DATE_FORMAT(CURDATE(), '%Y-%M-01') and CURDATE() ORDER BY score DESC LIMIT 10");
$r = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Ways to get monthly high scores
//("SELECT Users.username, user_id, score FROM Scores S JOIN Users on S.user_id = Users.id WHERE DATE_SUB(CURDATE(), INTERVAL 1 MONTH)  ORDER BY score DESC LIMIT 10")
//("SELECT Users.username, user_id, score FROM Scores S JOIN Users on S.user_id = Users.id WHERE 'created' between DATE_FORMAT(CURDATE(), '%Y-%M-01') and CURDATE() ORDER BY score DESC LIMIT 10")

$currMonth = getdate(date("U"));
?>

<div style=" alignment: center ">
      <div>High Scores for <?php echo "$currMonth[month]"; ?>:</div>
 </div>
      <br>

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