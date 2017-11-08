<?php
 //file: view/articles/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $articles = $view->getVariable("articles");
 //$currentuser = $view->getVariable("currentusername");

 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <ul class="article-container">
      <li id="commercial-box-index" class="commercial-box-index">
          <img class="commercial-image-index" src="resources/images/pic.png" alt="commercial picture" />
          <div class="commercial-textbox-index">
            <p class="commercial-title">Lorem ipsum dolor sit!</p>
            <p class="commercial-description">aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
          </div>
      </li>
      <li class="article-box">
                  <a href="index.php?controller=articles&amp;action=view&amp;idarticle=01">
                  <?php $pathimage = '/resources/images/_missing-thumbnail.png' ?>
                  <img src="<?= $pathimage ?>" alt="Image 1"></a>
                  <div class="article-footer">
                    <div class="tittle-edit">
                      <p class="article-box-title">Nombre</p>
                    </div>
                      <p class="article-seller"><?= i18n("sold by ")?><span>Usuario</span></p>
                      <p class="article-price">20€</p>
                  </div>
          </li>
    <?php foreach ($articles as $article): ?>
	   		<li class="article-box">
                    <a href="index.php?controller=articles&amp;action=view&amp;idarticle=<?= $article->getIdArticle() ?>">
                    <?php if ($article->getUrlImage01()== NULL):
						$pathimage = '/resources/images/_missing-thumbnail.png' ?>
					<?php else:
						$pathimage = file_exists('./resources/images/'.$article->getUrlImage01())  ?
	                    './resources/images/'.$article->getUrlImage01()
    	                :'./resources/images/_missing-thumbnail.png' ?>
					<?php endif ?>
                    <img src="<?= $pathimage ?>" alt="Image 1"></a>
                    <div class="article-footer">
                      <div class="tittle-edit">
                        <p class="article-box-title"><?= $article->getName() ?></p>
                      </div>
                        <p class="article-seller"><?= i18n("sold by ")?><span><?= $article->getUserLogin()->getName() ?></span></p>
                        <p class="article-price"><?=  floatval($article->getPrice()) ?>€</p>
                    </div>
            </li>
    <?php endforeach; ?>
     </ul>
</main>
 <script src="js/index.js"></script>
