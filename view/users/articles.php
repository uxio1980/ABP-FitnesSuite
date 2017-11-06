<?php
//file: view/users/articles.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $articles = $view->getVariable("articles");
 $currentuser = $view->getVariable("currentusername");

 $view->setVariable("title", "FitnesSuite");

?>
<main id="main-content">
    <ul class="article-container">
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
                        <a href="index.php?controller=articles&amp;action=edit&amp;idarticle=<?= $article->getIdArticle() ?>">
                          <img src="resources/icons/edit_icon.svg" alt="Edit" />
                        </a>
                      </div>
                        <p class="article-seller"><?= i18n("sold by ")?><span><?= $article->getUserLogin()->getName() ?></span></p>
                        <p class="article-price"><?=  floatval($article->getPrice()) ?>€</p>
                    </div>
            </li>
    <?php endforeach; ?>
     </ul>
</main>
 <script src="js/index.js"></script>
