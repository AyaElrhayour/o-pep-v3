<?php
include_once("./app/config/db.php");
session_start();
if(!isset($_SESSION["user_id"])) {
    header("login.php");
}
elseif(isset($_SESSION["user_id"])){
    $userid = $_SESSION["user_id"];
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <?php
    $article = $con->prepare("SELECT * FROM THEME");
    $article->execute();
    $result = $article->get_result();
    while($row = $result->fetch_assoc()) {
        ?>
        <div class="card" data-value="<?php echo $row['theme_id']?>">
        <h1><?php echo $row['theme_name']?></h1>
        </div>
    
        <?php
    }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>

    var cards =document.querySelectorAll('.card');

    cards.forEach(btn => {
        btn.addEventListener("click" , function () {
            let value = this.getAttribute('data-value');
            console.log(value);
            window.location.href = 'articles.php?theme=' + value;
        })
    })

  </script>
</body>
</html>