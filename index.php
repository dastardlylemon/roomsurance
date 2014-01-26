<?php
  require_once("./db_connect.php");
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
  <div id="content-login">
    <div id="fb-root">
      <h2>The final solution to the roommate question</h2>
      <button id="login" class="none-button" onclick="fbLogin();">Login with Facebook</button>
    </div>  
  </div>
  <div id="content-none" style="display: none;">
    <h2>It looks like you&rsquo;re not currently in any groups!</h2>
    <div id="button-group">
      <button id="host" class="none-button">Create a group</button>
      <button id="join" class="none-button">Join a group</button>
    </div>
    <br><br>
    <form id="host-form" style="display: none">
      <input type="text" name="gname" class="none-form" placeholder="Enter your group&rsquo;s name"><br>
      <input type="text" name="gmails" class="none-form" placeholder="Enter the group members&rsquo; emails, separated by commas"><br>
      <input type="submit" class="none-button" id="host-submit" value="Let&rsquo;s go">
    </form>
    <form id="join-form" style="display: none">
      <input type="text" name="gid" class="none-form" placeholder="Enter your group password"><br>
      <input type="submit" class="none-button" id="join-submit" value="Let&rsquo;s go">
    </form>  
  </div>
</body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId: '493687680748660',
      status: true,
      cookie: true,
      xfbml: true
    });
  };

  function fbLogin() {
    FB.login(function (response) {
      if (response.authResponse) {
        console.log('fetching ur info');
        access_token = response.authReponse.accessToken;
        user_id = response.authResponse.userID;
        FB.api('/me', function (response) {
          user_email = response.email;
        });
      } else {
        console..log('cancelled login');
      }
    })
  }

  (function () {
    var e = document.createElement('script');
    e.src = 'http://connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }())
</script>
<script src="./scripts/fs.js"></script>
</html>
