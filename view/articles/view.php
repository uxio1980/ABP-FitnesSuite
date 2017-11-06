<?php
 //file: view/articles/view.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $article = $view->getVariable("article");
 $currentuser = $view->getVariable("currentusername");
 $newchatline = $view->getVariable("chatline");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", $article->getName());

?>
<article id="main-detail-content">
        <div class="article-slideshow">
          <div class="slideshow-picture">
          <?php if ($article->getUrlImage01()!= NULL): ?>
				<?php $pathimage = file_exists('./resources/images/'.$article->getUrlImage01())  ?
				'./resources/images/'.$article->getUrlImage01()
				:'./resources/images/_missing-thumbnail.png' ?>
                <img class="slide" src="<?= $pathimage ?>" alt="Image 1">
          <?php else:?>
                <img class="slide" src="resources/images/_missing-thumbnail.png" alt="Image missing">
		  <?php endif ?>
          <?php if ($article->getUrlImage02()!= NULL): ?>
          		<?php $pathimage = file_exists('./resources/images/'.$article->getUrlImage02())  ?
				'./resources/images/'.$article->getUrlImage02()
				:'./resources/images/_missing-thumbnail.png' ?>
          		<img class="slide" src="<?= $pathimage ?>" alt="Image 2">
		  <?php endif ?>
          <?php if ($article->getUrlImage03()!= NULL): ?>
		        <?php $pathimage = file_exists('./resources/images/'.$article->getUrlImage03())  ?
				'./resources/images/'.$article->getUrlImage03()
				:'./resources/images/_missing-thumbnail.png' ?>
		        <img class="slide" src="<?= $pathimage ?>" alt="Image 3">
          <?php endif ?>
          </div>

          <div class="slideshow-button">
                <button class="previous-btn" onclick="plusDivs(-1)"><?= i18n("❮ Prev")?></button>
                <button class="next-btn" onclick="plusDivs(1)"><?= i18n("Next ❯")?></button>
          </div>
          <div class="article-gallery">
			<?php if ($article->getUrlImage01()!= NULL): ?>
				<?php $paththumbnail = file_exists('./resources/images/'.$article->getUrlImage01())  ?
                    './resources/images/'.$article->getUrlImage01()
                    :'./resources/images/_missing-thumbnail.png' ?>
                <div class="article-gallery-picture" onclick="currentDiv(1)"><img class="thumbnail" src="<?= $paththumbnail ?>" alt="Image 1"></div>
			<?php endif ?>
            <?php if ($article->getUrlImage02()!= NULL): ?>
	            <?php $paththumbnail = file_exists('./resources/images/'.$article->getUrlImage02())  ?
                    './resources/images/'.$article->getUrlImage02()
                    :'./resources/images/_missing-thumbnail.png' ?>
                <div class="article-gallery-picture" onclick="currentDiv(2)"><img class="thumbnail" src="<?= $paththumbnail ?>" alt="Image 2"></div>
			<?php endif ?>
            <?php if ($article->getUrlImage03()!== NULL): ?>
	            <?php $paththumbnail = file_exists('./resources/images/'.$article->getUrlImage03())  ?
                    './resources/images/'.$article->getUrlImage03()
                    :'./resources/images/_missing-thumbnail.png' ?>
                <div class="article-gallery-picture" onclick="currentDiv(3)"><img class="thumbnail" src="<?= $paththumbnail ?>" alt="Image 3"></div>
			<?php endif ?>
          </div>
        </div>
		<div class="article-user">
			<div class="article-description">
        <div class="article-title">
          <div class="article-name">
            <p><?= $article->getName()?></p>
          </div>
          <div class="article-price">
            <p><?=  floatval($article->getPrice()) ?>€</p>
        </div>
        </div>
				<p class="article-detail"><?= $article->getDescription()?></p>
				<div class="social-network-icon">
					<a href="#"><img src="resources/icons/facebook-icon.svg" alt="Facebook icon"></a>
					<a href="#"><img src="resources/icons/google-plus-icon.svg" alt="Google plus icon"></a>
					<a href="#"><img src="resources/icons/twitter-icon.svg" alt="Twitter icon"></a>
				</div>
			</div>

			<div class="article-autor">
            <?php
			$path = $article->getUserLogin()->getProfileImage()!=NULL?
      (file_exists('./resources/profiles/'.$article->getUserLogin()->getProfileImage())  ?
				'./resources/profiles/'.$article->getUserLogin()->getProfileImage()
				:'./resources/profiles/profile-default.png'): './resources/profiles/profile-default.png';
			?>
            <a href="#"><div class="image-profile"><img src="<?= $path ?>" alt="image profile"></div><?= $article->getUserLogin()->getName() ?></a>
				<p class="autor-detail"> <?= $article->getUserLogin()->getDescription() ?></p>
			</div>
		</div>
	</article>
	<footer>
	<!--Chat desplegable-->
		<div id="mySidenav" class="sidechat">
			<div class="chat-title">
				<div class="chat-user-name" >
					<a href="#"><img src="<?= $path ?>" alt="image profile chat"></img><?= $article->getUserLogin()->getName() ?></a>
				</div>
				<div class="chat-close" >
					<a href="javascript:void(0)" onclick="closeNav()">&times;</a>
				</div>
			</div>
			<div id="chat-container" class="chat-container">
        <!-- Rellenado via AJAX -->
			</div>
				<!--<form action="" method="POST">-->
	            <!--<form id="form-chat-writter" action="index.php?controller=chats&amp;action=add&amp;idchat=     ?= $article->getIdArticle() ?>" method="POST">-->
            	<div class="chat-writter">
				        <input id="write-text" name="write-text" type="text" placeholder="<?= i18n("Write message")?>" >
                <input id="idarticle-text" type="text" value="<?=$article->getIdArticle()?>">
				        <button id= "send-text" name="send-text" type="submit"> <?= i18n("Send")?></button>
              </div>
        <!--</form>-->
		</div>
		<!--Contenedor del chat-->
		<div class="chat">
      <?php if ($article->getUserLogin()->getLogin() != $currentuser) :?>
          <button class="button button5" onClick="openNav()"><img src="resources/icons/ic_chat.svg"></img></button>
      <?php endif; ?>
		</div>

		<script src="js/index.js"></script>
    <script type="text/javascript" src="js/XHConn.js"></script>
	  <script type="text/javascript" src="js/ajax-chat.js"></script>
	</footer>
