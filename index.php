<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Document</title>
</head>
<body>
<header>
  <h3> YOUTUBE KEYWORDS </h3>
</header>

<main>
  <div class="tab">
    <!--<button class="tablinks" onclick="openCity(event, 'keywords')">Get a YouTube Video Keywords</button>
    <button class="tablinks" onclick="openCity(event, 'count-keywords')">Count Keywords</button>-->
    <a href="index.php">Get YouTube Keywords</a>
    <a href="count-keywords.php">Count Keywords</a>
  </div>

  <!--  Get YouTube Video Keywords -->
  <div class="menu center">
    <form action='' method='POST'>
      <label for='videoID'>YouTube Video ID: </label>
      <input type='text' id='videoID' name='videoID'>
      <input type='submit' value='Submit'>
    </form>
</div>  

  <?php
    // Have the input of video ID 
    if (!empty($_POST['videoID'])) {
            $videoID = trim($_POST["videoID"]);
            $tags = exec("python get-youtube-keywords.py $videoID");
            echo '<label>Result: </label>'." <textarea id='tags' name='tags' rows='20' cols='50'> " . $tags . "</textarea>";
    }
  ?>  
</main>
</body>
</html>

