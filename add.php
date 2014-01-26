<?php
  require_once("./utils/db_connect.php");
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Roomsurance</title>
  <link rel="stylesheet" href="./styles/styles.css">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>
	<h1>roomsurance</h1>
	<div id="content-none" style="display: none;">
	 <form id="host-form" style="display: none">
		<input type="text" name="cname" class="none-form" placeholder="Enter the task&rsquo;s name"><br>
    <input type="text" name="cdesc" class="none-form" placeholder="Describe the chore"><br>
    <input type="text" name="cdiff" class="none-form" placeholder="How difficult is the chore on a scale from 1 to 10?"><br>
    <input type="text" name="clength" class="none-form" placeholder="How long is the chore"><br>
    <input type="text" name="cpoints" class="none-form" placeholder="How many points is the chore worth?"><br>
    <input type="text" name="cdate" class="none-form" placeholder="When is the chore due? (YYYY-MM-DD)"><br>
    <input type="text" name="cuser" class="none-form" placeholder="Who needs to do this chore?"><br>
    <input type="text" name="ccompl" class="none-form" placeholder="Check"><br>
   </form>
	</div>
</body>
<script>
	function createChore(choreName, pointValue, groupID, userID, chore_description, diffi, timer, due_Date) {
	    $.ajax({
	      url: './utils/update_task.php',
	     data: {'taskName': choreName, 'taskDesc': chore_description, 'diff': diffi, 'acpoints': pointValue, 'dueDate': due_Date, 'user': userID, 'group': groupID, 'len': timer},
	      type: 'post',
	      success: function(output) {
	        console.log(output);
	      }
	    });
	  }

</script>