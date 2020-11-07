<?php require_once(__DIR__ . "/partials/nav.php"); ?>
<?php
if (!has_role("Admin")) {
    //this will redirect to login and kill the rest of this script (prevent it from executing)
    flash("You don't have permission to access this page");
    die(header("Location: login.php"));
}
?>

<form method="POST">
	<label>Name</label>
	<input name="name"/>
	<label>user_id</label>
	<input name="user_id" type="number"/>
	<label>Score</label>
	<input name="score" type="number" placeholder="0"/>
	<label>Created</label>
	<input name="created"/>
	<input type="submit" name="save" value="Save"/>
</form>

<?php
if(isset($_POST["save"])){
	//TODO add proper validation/checks
	$name = $_POST["name"];
	$userid = $_POST["user_id"];
	$score = $_POST["score"];
	$created = date('Y-m-d H:i:s');//calc
	$user = get_user_id();
	$db = getDB();
	$stmt = $db->prepare("INSERT INTO Scores (id, user_id, score, created) VALUES(:name, :userid, :score, :created)");
	$r = $stmt->execute([
		":name"=>$name,
		":userid"=>$userid,
		":score"=>$score,
		":created"=>$created,
		//":user"=>$user
	]);
	if($r){
		flash("Created successfully with id: " . $db->lastInsertId());
	}
	else{
		$e = $stmt->errorInfo();
		flash("Error creating: " . var_export($e, true));
	}
}
?>
<?php require(__DIR__ . "/partials/flash.php");
