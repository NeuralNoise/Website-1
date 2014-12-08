<!DOCTYPE html >
<html>  
<head>  
  <title>Character Burner</title> 
  <link rel="stylesheet" href="main.css">
</head>
<script>

</script>
<body onpageshow="createMainPage()">
<h3 onclick="goHome()">
<a href="index.php">Home</a></h3>
<h2>
Character Burner</h2>
<div class="nav">
<ul id="menuBar">
<li class="menuButton" onclick="createMainPage()">
Main</li>
<li class="menuButton" onclick="createRetrieveReviews(&quot;tempDiv&quot;)">
Search Reviews</li>
<li class="menuButton" onclick="createWriteReview(&quot;tempDiv&quot;)">
Write Review</li>
<li class="menuButton" onclick="createUser(&quot;tempDiv&quot;)">
Create User
</li>
</ul>
</div>
<br><br>
<nav id="sidebar">

</nav>
<div id="tempDiv">

</div>

<footer>Testing</footer>
</body>
</html>