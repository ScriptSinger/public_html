<?php

namespace Controllers;

use Core\Request;
use Model\ArticleModel;
use Model\CategoryModel;

class ArticlesController extends BaseController
{
	public function __construct(Request $request)
	{
		parent::__construct();
		$this->request = $request;
		$this->path = 'articles';
		$this->pk = 'id_article';
		$this->categoryModel = CategoryModel::getInstance();
		$this->articleModel = ArticleModel::getInstance();
	}

	public function allAction()
	{
	    $this->scripts[] = 'popup';
	    
		$get = $this->request->get;
		$categoryUrl = isset(URL_PARAMS['url']) ? URL_PARAMS['url'] : null;
		$page = isset($get['page']) ? $get['page'] : 1; //получаем текущий номер страницы (по умолчанию номер страницы равен 1)
		$page = ctype_digit($page) ? $page  : 1;
		$page = (int)$page;
		$pagination = $this->getPagination($page, $categoryUrl);
			$category = $this->categoryModel->getOnebyUrl($categoryUrl);
		if ($this->checkHasEntity($category) && $pagination !== null) {
		$articles = $this->articleModel->getArticles($page, $categoryUrl);
		foreach ($articles as $name => $article) {
			$articles[$name]['intro'] = $this->previewText($article['content'], 0, 200);
		}
		$cats = $this->categoryModel->getAll();
	
			$this->pageTitle = $title = ($categoryUrl !== null) ? $category['title_cat'] : 'Статьи';
			$this->description = ($categoryUrl !== null) ? $category['description_cat'] : 'Ремонт холодильников и стиральных машин с выездом на дом.';
			$navbar = $this->tmpGenerate('v_navbar', $pagination);
			$sidebar = $this->tmpGenerate('main/v_sidebar', ['cats' => $cats]);
			$content = $this->tmpGenerate('articles/v_articles', [
				'title' => $title,
				'articles' => $articles,
				'navbar' => $navbar
			]);
			$this->pageContent = $this->tmpGenerate(
				'base/v_con2col',
				[
					'sidebar' => $sidebar,
					'content' => $content
				]
			);
		} else {
			$this->generateError(404);
		};
	}

	public function oneAction()
	{
		$this->scripts[] = 'popup';
		$this->scripts[] = 'scroll';
		
		$this->apiScripts[] = 'https://vk.com/js/api/openapi.js?169';
		$this->scripts[] = 'vk_comments';
		
		$this->apiScripts[] = 'https://yastatic.net/share2/share.js';
     

		$url = URL_PARAMS['url'];
		$article = $this->articleModel->oneArticle($url);
		if ($this->checkHasEntity($article)) {
			$cats = $this->categoryModel->getAll();
			$currentUrl = $this->getUrl();
			$sidebar = $this->tmpGenerate('main/v_sidebar', ['cats' => $cats]);
			$content = $this->tmpGenerate('articles/v_article', [
				'currentUrl' => $currentUrl,
				'article' => $article,
				'cats' => $cats,
			]);
			$this->pageTitle =  $article['title'];
			$this->description = $article['description'];
			$this->pageContent = $this->tmpGenerate(
				'base/v_con2col',
				[
					'sidebar' => $sidebar,
					'content' => $content
				]
			);
		} else {
			$this->generateError(404);
		}
	}
}
