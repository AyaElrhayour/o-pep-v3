<?php
session_start();
if (isset($_SESSION["logged"]) && $_SESSION["logged"] && isset($_SESSION["role_id"]) && $_SESSION["role_id"] == 1) {
  header("Location: ./home.php");
}
require_once('./app/config/db.php');
// require_once('./app/funcs/logout.php');

require_once("./app/controllers/categoryController.php");
require_once("./app/controllers/plantController.php");
require_once("./app/controllers/themeController.php");
require_once("./app/controllers/tagController.php");


$categoryController = new CategoryController();
$categories = $categoryController->getAllCategories();
$categoryController->handleCategory();

$plantController = new plantController();
$plants = $plantController->getAllPlants();
$plantController->handleplant();




// function adminLogout()
// {
//   if (isset($_POST["logout"])) {

//     if (logout()) {
//       // die("here");
//       header("Location: index.php");
//     }
//   }
// }

// adminLogout();

$themeController = new ThemeController();
$themes = $themeController->getAllThemes();
$themeController->handleTheme();

$tagController = new TagController();
$tags = $tagController->getAllTags();
$tagController->handleTag();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/dashboard.css">
  <link rel="shortcut icon" href="assets/imgs/logoG.png" type="image/x-icon">
  <title>Admin Dashboard</title>
</head>

<body>
  <div class="container">
    <div class="navigation">
      <ul>
        <li class="logo">
          <a href="#">
            <span class="icon">
              <img src="./assets/imgs/logoWo.png" alt="">
            </span>
            <span class="title"><img src="./assets/imgs/logoWw.png" alt=""></span>
          </a>
        </li>

        <li>
          <a href="#">
            <span class="icon">
              <ion-icon name="home-outline"></ion-icon>
            </span>
            <span class="title">Dashboard</span>
          </a>
        </li>

        <li>
          <a href="#">
            <span class="icon">
              <ion-icon name="albums-outline"></ion-icon>
            </span>
            <span class="title">Categories</span>
          </a>
        </li>

        <li>
          <a href="#">
            <span class="icon">
              <ion-icon name="leaf-outline"></ion-icon>
            </span>
            <span class="title">Plants</span>
          </a>
        </li>

        <li>
          <a href="#">
            <span class="icon">
              <ion-icon name="file-tray-full-outline"></ion-icon>
            </span>
            <span class="title">Orders</span>
          </a>
        </li>

        <li>
          <a href="#">
            <span class="icon">
              <ion-icon name="settings-outline"></ion-icon>
            </span>
            <span class="title">Settings</span>
          </a>
        </li>
        <li>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <span class="icon">
              <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <button type="submit" name="logout" class="title">log Out</button>
          </form>
        </li>
      </ul>
    </div>

    <main class="main">
      <div class="topbar">
        <div class="toggle">
          <ion-icon name="menu-outline"></ion-icon>
        </div>



        <div class="user">
          <img src="assets/imgs/customer01.jpg" alt="">
        </div>
      </div>

      <div class="cardBox">
        <div class="card">
          <div>
            <div class="numbers"><?php echo sizeof($categories); ?></div>
            <div class="cardName">Category</div>
          </div>

          <div class="iconBx">
            <ion-icon name="albums-outline"></ion-icon>
          </div>
        </div>

        <div class="card">
          <div>
            <div class="numbers"><?php echo sizeof($plants); ?></div>
            <div class="cardName">Plants</div>
          </div>

          <div class="iconBx">
            <ion-icon name="leaf-outline"></ion-icon>
          </div>
        </div>

        <div class="card">
          <div>
            <div class="numbers">155</div>
            <div class="cardName">Clients</div>
          </div>

          <div class="iconBx">
            <ion-icon name="people-outline"></ion-icon>
          </div>
        </div>

        <div class="card">
          <div>
            <div class="numbers">23</div>
            <div class="cardName">Order</div>
          </div>

          <div class="iconBx">
            <ion-icon name="file-tray-full-outline"></ion-icon>
          </div>
        </div>
      </div>

      <div class="details">
        <!-- Category -->
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Plant's Categories</h2>
            <a href="#" class="btn" onclick="openPopupC()">Add Category</a>
          </div>
          <div id="categoryPopup" class="popup">
            <form class="popup-content" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <span class="close" onclick="closePopupC()">&times;</span>
              <label for="categoryName">Category Name:</label>
              <input type="text" id="categoryName" name="categoryName">
              <button type="submit" name="addCategory">Add</button>
            </form>
          </div>
          <table>
            <thead>
              <tr>
                <td>Name</td>
                <td>Operations</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $category) {
              ?>
                <tr>
                  <td><?php echo $category["category_name"]; ?></td>
                  <td class="btns">
                    <input type="hidden" value="<?php echo $category["category_id"]; ?>">
                    <button name="modifyCategory" class="btn update_btn">Modify</button>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <input id="updateCategoryName" name="category_id" type="hidden" value="<?php echo $category["category_id"]; ?>">
                      <button name="deleteCategory" class="btn bred" type="submit">Delete</button>
                    </form>

                  </td>
                </tr>
              <?php
              }    ?>
              <div id="modifyPopup" class="popup">
                <form class="popup-content" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <span class="close" onclick="closeModifyPopup()">&times;</span>
                  <label for="categoryName">New Category Name:</label>
                  <input name="updatedCategoryID" id="categoryID" type="hidden" value="">
                  <input name="newCategoryName" type="text" id="categoryNameModify">
                  <button name="updateCategoryName" type="submit">Change</button>
                </form>
              </div>
            </tbody>
          </table>
        </div>
        <!-- Plant -->
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Plants</h2>
            <a href="#" class="btn" onclick="openPopupP()">Add Plant</a>
          </div>
          <div id="plantPopup" class="popup">
            <form class="popup-content" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
              <span class="close" onclick="closePopupP()">&times;</span>
              <label for="plantName">Plant Name:</label>
              <input type="text" id="plantName" name="plant_name">
              <label for="plantImg">Plant Image:</label>
              <input type="file" id="plantImg" name="plant_img">
              <label for="plantPrice">Plant Price:</label>
              <input type="number" id="plantPrice" name="plant_price">
              <label for="categoryName">Plant category:</label>
              <select name="category_id">
                <?php foreach ($categories as $category) {
                ?>
                  <option value="<?php echo $category["category_id"]; ?>"><?php echo $category["category_name"]; ?></option>
                <?php  } ?>
              </select>
              <button type="submit" name="addPlant">Add</button>
            </form>
          </div>
          <table>
            <thead>
              <tr>
                <td>Image</td>
                <td>Name</td>
                <td>Price</td>
                <td>Catgory</td>
                <td>Operations</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($plants as $plant) {
              ?>
                <tr>
                  <td><img style="width: 50px;" src="./assets/imgs/<?php echo $plant["plant_img"]; ?>" alt=""></td>
                  <td><?php echo $plant["plant_name"]; ?></td>
                  <td><?php echo $plant["plant_price"]; ?>$</td>
                  <td><?php echo $plant["category_name"]; ?></td>
                  <td>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <input name="plant_id" type="hidden" value="<?php echo $plant['plant_id']; ?>">
                      <button name="deletePlant" class="btn bred" type="submit">Delete</button>
                    </form>
                  </td>
                </tr>
              <?php
              }    ?>

            </tbody>
          </table>
        </div>
        <!-- theme -->
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Blog Themes</h2>
            <a href="#" class="btn" onclick="openPopupT()">Add Themes</a>
          </div>
          <div id="themePopup" class="popup">
            <form class="popup-content" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
              <span class="close" onclick="closePopupT()">&times;</span>
              <label for="themeName">Theme Name:</label>
              <input type="text" id="themeName" name="themeName">
              <label for="themeImg">Theme Image:</label>
              <input type="file" id="themeImg" name="theme_img">
              <button type="submit" name="addTheme">Add</button>
            </form>
          </div>
          <table>
            <thead>
              <tr>
                <td>Image</td>
                <td>Name</td>
                <td>Operations</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($themes as $theme) {
              ?>
                <tr>
                  <td><img style="width: 50px;" src="./assets/imgs/<?php echo $theme["theme_img"]; ?>" alt=""></td>
                  <td><?php echo $theme["theme_name"]; ?></td>
                  <td class="btns">
                    <input type="hidden" value="<?php echo $theme["theme_id"]; ?>">
                    <button name="modifyThemePopup" class="btn update_theme_btn" onclick="openModifyPopupT()">Modify</button>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <input id="updateThemeName" name="theme_id" type="hidden" value="<?php echo $theme["theme_id"]; ?>">
                      <button name="deleteTheme" class="btn bred" type="submit">Delete</button>
                    </form>

                  </td>
                </tr>
              <?php
              }    ?>
              <div id="modifyThemePopup" class="popup">
                <form class="popup-content" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <span class="close" onclick="closeModifyPopupT()">&times;</span>
                  <label for="themeName">New Theme Name:</label>
                  <input name="updatedThemeID" id="themeID" type="hidden" value="">
                  <input name="newThemeName" type="text" id="themeNameModify">
                  <button name="updateThemeName" type="submit">Change</button>
                </form>
              </div>
            </tbody>
          </table>
        </div>
        <!-- tag -->
        <div class="recentOrders">
          <div class="cardHeader">
            <h2>Theme's Tag</h2>
            <a href="#" class="btn" onclick="openPopupTag()">Add Tag</a>
          </div>
          <div id="tagPopup" class="popup">
            <form class="popup-content" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
              <span class="close" onclick="closePopupTag()">&times;</span>
              <label for="tagName">Tag Name:</label>
              <input type="text" id="tagName" name="tagName">
              <label for="tagName">Theme:</label>
              <select name="theme_id">
                <option value="">Select Theme</option>
                <?php foreach ($themes as $theme) { ?>
                  <option value="<?php echo $theme["theme_id"]; ?>"><?php echo $theme["theme_name"]; ?></option>
                <?php

                } ?>

              </select>
              <button type="submit" name="addTag">Add</button>
            </form>
          </div>
          <table>
            <thead>
              <tr>
                <td>Tag</td>
                <td>Theme</td>
                <td>Operations</td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tags as $tag) {
              ?>
                <tr>

                  <td><?php echo $tag["tag_name"]; ?></td>
                  <td><?php echo $tag["theme_name"]; ?></td>
                  <td class="btns">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <input name="tag_id" type="hidden" value="<?php echo $tag["tag_id"]; ?>">
                      <button name="deleteTag" class="btn bred" type="submit">Delete</button>
                    </form>

                  </td>
                </tr>
              <?php
              }    ?>

            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>




  <script src="./assets/js/main.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>