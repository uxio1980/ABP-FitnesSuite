<?php
//file: view/main/pricing.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

//$articles = $view->getVariable("articles");
$currentuser = $view->getVariable("currentusername");
$public_info = $view->getVariable("public_info");
$view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
  <ul class="article-container">
    <li id="commercial-box" class="commercial-box">
      <iframe class="commercial-image" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1474.485911566028!2d-7.851737699999999!3d42.3431241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2ffeb9a19e9375%3A0xd24206b864592f26!2sAQA+Ourense!5e0!3m2!1ses!2sus!4v1509640311160"></iframe>
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Contact")?></p>
        <!--<p class="commercial-description"></p>-->
      </div>
    </li>
    <li>
      <div class="form contact-form">
        <form action="index.php?controller=main&amp;action=sendmail" method="POST" enctype="multipart/form-data">
          <strong><?= i18n("Send us a message") ?></strong>
          <div class = "group-piece-contact-form">
            <div class="piece-contact-form">
              <label for="form-field"><?= i18n("Name") ?></label>
              <input type="text" name="name"  minlength="2" maxlength="50" required>
              <?= isset($errors["name"])?$errors["name"]:"" ?>
            </div>
            <div class="piece-contact-form">
              <label for="form-field"><?= i18n("E-mail") ?></label>
              <input type="email" min= "1" name="email" required/>
              <?= isset($errors["email"])?$errors["email"]:"" ?>
            </div>
            <div class="piece-contact-form">
              <label for="form-field"><?= i18n("Subject") ?></label>
              <input type="subject" min= "1" name="subject" required/>
              <?= isset($errors["subject"])?$errors["subject"]:"" ?>
            </div>
          </div>
          <label for="name-field"><?= i18n("Message") ?></label>
          <textarea name="message" rows="4" cols="50"> </textarea>
          <?= isset($errors["message"])?$errors["message"]:"" ?><br>

          <input type="submit" name="submit" value="<?= i18n("Submit your message") ?>">
        </form>
      </div>
    </li>
    <li id="commercial-box" class="commercial-box">
      <div class="commercial-textbox">
        <p class="commercial-title commercial-title-second"><?= i18n("Contact info")?></p>
        <p class="commercial-description">diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis.</p>
        <p class="commercial-description"><?= i18n("Telephone contact")?>: <?= $public_info->getPhone() ?></p>
        <p class="commercial-description"><?= i18n("Email")?>: <?= $public_info->getEmail() ?></p>
      </div>
    </li>
  </ul>
</main>
<script src="js/index.js"></script>
