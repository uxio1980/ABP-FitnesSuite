<?php
//file: view/layouts/default.php

require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../core/I18n.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$typeuser = $view->getVariable("typeuser");
$imageUser = $view->getVariable("imageUser");
$numberOfNotifications = $view->getVariable("numberOfNotifications");
$default_notifications_user = $view->getVariable("default_notifications_user");
$loginerrors = $view->getVariable("loginerrors");
$registererrors = $view->getVariable("register");
$controller = $view->getVariable("controller");
$i18n = I18n::getInstance();
$language = $i18n->getLanguage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Gimnasio FitnesSuite">
  <meta name="keywords" content="gimnasio, fitnessuite">
  <meta name="author" content="Jose Eugenio González, Andrés Fernández, Iago Fernández, Sandra Pastoriza">

  <link rel="stylesheet" href="style.css" type="text/css">
  <link rel="shortcut icon" type="image/png" href="favicon.ico"/>
  <script src="index.php?controller=language&amp;action=i18njs"></script>
  <title><?= $view->getVariable("title", "no title") ?></title>
  <?= $view->getFragment("css") ?>
  <?= $view->getFragment("javascript") ?>
</head>
<body>
  <header>
    <div id="header-menu-logo">
      <a id="icon-burger" href="index.php">
        <img src="resources/icons/ic_menu.svg" alt="Menu icon"/>
      </a>
        <img id="start-logo" src="resources/icons/start-logo.png" alt="Menu icon"/>
      <a id="text-logo" href="index.php">
        <h1>FitnesSuite</h1>
      </a>
        <img id="end-logo" src="resources/icons/end-logo.png" alt="Menu icon"/>
    </div>

      <div id="header-search">
        <form id="form-search" action="index.php?controller=<?= $controller ?>&amp;action=index" method="POST">
          <input id="input-search"  type="text" name="search"
          placeholder="<?= i18n("Search products")?>"  />
      </div>
    </form>

    <div id="header-login">
      <!-- ******* LANGUAGE BUTTON   **************************** -->
      <button id="language-button">
        <div class="container-user-circle">
          <?php if ($language == 'es'): ?>
            <?php $flag="resources/icons/spain.svg"?>
          <?php else: ?>
            <?php $flag="resources/icons/uk.svg"?>
          <?php endif ?>
          <div class="circle kitten" style="background-image: url('<?= $flag ?>');">
            <div class="aligner">
              <!-- text inside the icon -->
            </div>
          </div>
        </div>
      </button>
      <div id="dropdown-language-content" class="dropdown-content" style="display:none">
        <div >
          <?php include(__DIR__."/language_select_element.php");?>
        </div>
      </div>
      <?php if (isset($currentuser)):?>
        <!-- ******* Profile ALERT BUTTON  ************************  -->
        <button id="alert-button">
          <div class="container-user-circle">
            <?php if (isset($numberOfNotifications) && $numberOfNotifications>0):?>
                <div class="circle kitten notificationYes" style="background-image: url('resources/icons/ic_notifications_black_24px.svg');">
                  <div class="aligner">
                    <!-- text inside the icon -->
                  </div>
            <?php else:?>
                <div class="circle kitten" style="background-image: url('resources/icons/ic_notifications_none_black_24px.svg');">
            <?php endif ?>
            </div>
          </div>
        </button>
        <?php if (isset($numberOfNotifications) && $numberOfNotifications>0):?>
        <div id="dropdown-notification-content" class="dropdown-content" style="display:none">
          <div >
            <?php include(__DIR__."/notification_select_element.php");?>
          </div>
        </div>
        <?php endif ?>

        <!-- ******* Profile MESSAGE BUTTON  ************************
        <button id="message-button">
          <div class="container-user-circle">
            <div class="circle kitten" style="background-image: url('resources/icons/ic_mail_black_24px.svg');">
              <div class="aligner">
              </div>
            </div>
          </div>
        </button>
        -->
        <!-- ******* Profile image    -->
        <?php if ($imageUser != NULL): ?>
          <?php $ruta="resources/profiles/". $imageUser?>
        <?php else: ?>
          <?php $ruta="resources/profiles/profile-default.png"?>
        <?php endif ?>
        <button id="login-button">
          <div class="container-user-circle">
            <div class="circle kitten" style="background-image: url('<?=$ruta?>');">
              <div class="aligner">
                <!-- text inside the icon -->
              </div>
            </div>
          </div>
          <span id="hellouser"><?= i18n("Hello")?>, <?= sprintf($currentuser) ?></span>
        </button>
        <div id="dropdown-content" class="dropdown-content" style="<?= isset($loginerrors)?'display:flex': ''?>">
          <div>
            <ul class="nav-container">
              <li class="nav-item">
                <a href="index.php?controller=users&amp;action=profile&amp;login=<?= $currentuser ?>" method="POST">
                  <img src="resources/icons/profile_icon.svg" alt="Profile icon"/>
                  <div class="text-item"><?= i18n("My profile")?></div></a>
                </li>
                <li class="nav-item">
                  <a href="index.php?controller=users&amp;action=logout">
                    <img src="resources/icons/ic_power_settings_new_black_24px.svg" alt="About icon"/>
                    <div class="text-item"><?= i18n("Sign off")?></div></a>
                  </li>
                </ul>
              </div>
            </div>
          <?php else:?>
            <button id="login-button"><?= i18n("My account")?></button>
            <!-- CSS empotrado para mostar el formulario en caso de error de login-->
            <div id="dropdown-content" style="<?= isset($loginerrors)?'display:flex': ''?>">
              <div id="wrap-form-login">
                <form id="form-sign" action="index.php?controller=users&amp;action=login" method="POST">
                  <span class="login-error"> <?= isset($loginerrors["general"])?$loginerrors["general"]:"" ?></span><br>
                  <input type="text" name="login" placeholder="<?= i18n("Username")?>"/>
                  <input type="password" name="password" placeholder="<?= i18n("Password")?>"/>
                  <input type="submit" value="<?= i18n("Sign in")?>"/>
                  <p class="message"><?= i18n("Not registered yet?")?>
                    <a href="#"><?= i18n("Create an account")?></a>
                  </p>
                </form>
                <form id="form-sign-up" action="index.php?controller=users&amp;action=register" method="POST">
                  <input type="text" name="login"  placeholder="<?= i18n("Username")?>"/>
                  <?= isset($registererrors["register-register"])?$registererrors["register-login"]:"" ?>
                  <input type="text" name="name" placeholder="<?= i18n("Name")?>"/>
                  <?= isset($registererrors["register-name"])?$registererrors["register-name"]:"" ?>
                  <input type="password" name="password" placeholder="<?= i18n("Password")?>"/>
                  <?= isset($registererrors["register-password"])?$registererrors["register-password"]:"" ?>
                  <input type="text" name="email" placeholder="E-mail"/>
                  <?= isset($registererrors["register-email"])?$registererrors["register-email"]:"" ?>
                  <input type="submit" value="<?= i18n("Sign up")?>"/>
                  <p class="message"><?= i18n("Already registered?")?>
                    <a href="#"><?= i18n("Log in")?></a>
                  </p>
                </form>
              </div>
            </div>
          <?php endif ?>
        </div>
        <script src='js/jquery.min.js'></script>
      </header>

      <nav id="main-navigation">
        <ul class="nav-container">
          <?php if (!isset($currentuser)):?>
            <li class="nav-item">
              <a href="index.php?controller=trainers&amp;action=index">
                <img src="resources/icons/weight.svg" alt="Trainer icon"/>
                <div class="text-item"><?= i18n("Trainers")?></div>
              </a>
            </li>
            <li class="nav-item">
            <a href="index.php?controller=activities&amp;action=index">
                <img src="resources/icons/activities.svg" alt="Activity icon"/>
                <div class="text-item"><?= i18n("Activities")?></div>
              </a>
            </li>
            <li class="nav-item">
            <a href="index.php?controller=schedule&amp;action=index">
                <img src="resources/icons/ic_dashboard_black_24px.svg" alt="Schedule icon"/>
                <div class="text-item"><?= i18n("Schedules")?></div>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?controller=exercise&amp;action=index">
                  <img src="resources/icons/ic_exercices_table.svg" alt="Exercise icon"/>
                  <div class="text-item"><?= i18n("Exercises")?></div>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?controller=main&amp;action=pricing">
                <img src="resources/icons/ic_local_atm_black_24px.svg" alt="Pricing icon"/>
                <div class="text-item"><?= i18n("Pricing")?></div>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?controller=main&amp;action=contact">
                <img src="resources/icons/ic_contact_phone_black_24px.svg" alt="Contact icon"/>
                <div class="text-item"><?= i18n("Contact")?></div>
              </a>
            </li>
          <?php else: ?>
              <?php if (($typeuser)==usertype::AthleteTDU || ($typeuser)==usertype::AthletePEF ):?>
                <li class="nav-item">
                  <a href="index.php?controller=activities&amp;action=index">
                    <img src="resources/icons/activities.svg" alt="Activities icon"/>
                    <div class="text-item"><?= i18n("Activities")?></div>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?controller=workout_tables&amp;action=index">
                        <img src="resources/icons/workout_table_icon.svg"  width="24" height="24" alt="Exercise icon"/>
                        <div class="text-item"><?= i18n("Workout tables")?></div>
                    </a>
                </li>
                  <li class="nav-item">
                    <a href="index.php?controller=sessions&amp;action=index">
                      <img src="resources/icons/sessions_icon.svg" alt="Session icon"/>
                      <div class="text-item"><?= i18n("Sessions")?></div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?controller=notifications_user&amp;action=index">
                      <img src="resources/icons/ic_notifications_black_24px.svg" alt="Activities icon"/>
                      <div class="text-item"><?= i18n("Notifications")?></div>
                    </a>
                  </li>
                <?php endif ?>
                <?php if (($typeuser)==usertype::Trainer):?>
                  <li class="nav-item">
                      <a href="index.php?controller=users&amp;action=index">
                          <img src="resources/icons/ic_group_black_24px.svg" alt="Users icon"/>
                          <div class="text-item"><?= i18n("Users")?></div>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="index.php?controller=activities&amp;action=index">
                          <img src="resources/icons/activities.svg" alt="Activities icon"/>
                          <div class="text-item"><?= i18n("Activities")?></div>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="index.php?controller=workout_tables&amp;action=index">
                          <img src="resources/icons/workout_table_icon.svg"  width="24" height="24" alt="Exercise icon"/>
                          <div class="text-item"><?= i18n("Workout tables")?></div>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="index.php?controller=exercise&amp;action=index">
                          <img src="resources/icons/ic_exercices_table.svg"  alt="Exercise icon"/>
                          <div class="text-item"><?= i18n("Exercises")?></div>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?controller=notification&amp;action=index">
                      <img src="resources/icons/ic_notifications_black_24px.svg" alt="Activities icon"/>
                      <div class="text-item"><?= i18n("Notifications")?></div>
                    </a>
                  </li>
                <?php endif ?>
                <?php if (($typeuser)==usertype::Administrator):?>
                <div class="customHr">.</div>
                <li class="nav-item">
                  <a href="index.php?controller=users&amp;action=index">
                    <img src="resources/icons/ic_group_black_24px.svg" alt="Users icon"/>
                    <div class="text-item"><?= i18n("Users")?></div>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?controller=resources&amp;action=index">
                      <img src="resources/icons/resources.svg" alt="MyStatistics icon"/>
                      <div class="text-item"><?= i18n("Resources")?></div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?controller=activities&amp;action=index">
                      <img src="resources/icons/activities.svg" alt="Activities icon"/>
                      <div class="text-item"><?= i18n("Activities")?></div>
                    </a>
                  </li>
                  <li class="nav-item">
                      <a href="index.php?controller=exercise&amp;action=index">
                          <img src="resources/icons/ic_exercices_table.svg" alt="Exercise icon"/>
                          <div class="text-item"><?= i18n("Exercises")?></div>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?controller=notification&amp;action=index">
                      <img src="resources/icons/ic_notifications_black_24px.svg" alt="Activities icon"/>
                      <div class="text-item"><?= i18n("Notifications")?></div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?controller=public_info&amp;action=index">
                      <img src="resources/icons/about_24px.svg" alt="Public_Info icon"/>
                      <div class="text-item"><?= i18n("Public info")?></div>
                    </a>
                  </li>
                <?php endif ?>
                <li class="nav-item">
                  <a href="index.php?controller=statistics&amp;action=index">
                    <img src="resources/icons/weight.svg" alt="Trainer icon"/>
                    <div class="text-item"><?= i18n("Statistics")?></div>
                  </a>
                </li>
                <div class="customHr">.</div>
              <?php endif ?>
            </ul>
          </nav>
          <div id="flash">
            <?php $message = $view->popFlash(); ?>
            <?php if($message != ""): ?>
              <div id="notification" style="display: none; font-size:20px">
                <span class="dismiss" onclick="closeNotification()"><a title="dismiss this notification">X</a></span>
              </div>
              <script >
              var mensajeFlash = '<?php echo $message ?>';
              function closeNotification(){
                     $("#notification").fadeOut("slow");
              }

              function notification(mensaje){
                document.getElementById("notification").style.display = "none";
                $("#notification").fadeIn("slow").append(mensaje);
                setTimeout(closeNotification, 2500);
              }
              notification(mensajeFlash);
              </script>

            <?php endif;?>
          </div>

          <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>

        </body>
        </html>
