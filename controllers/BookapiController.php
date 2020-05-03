<?php

namespace app\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\Book;

class BookapiController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'list' => ['GET'],
					'view' => ['GET'],
				],
			],
		];
	}

	/**
	 * Get all books
	 *
	 * @return json
	 */
	public function actionList()
	{
		$to_return = [];
		foreach (Book::find()->all() as $book) {
			$book_row = $book->toArray();
			$book_row['author_name'] = $book->author->name;
			$to_return[] = $book_row;
		}

		return json_encode($to_return);

	}

	/**
	 * Get book by id
	 *
	 * @return json
	 */
	public function actionView($id)
	{
		$to_return = [];
		$book = Book::findOne($id);
		if ($book) {
			$to_return = $book->toArray();
			$to_return['author_name'] = $book->author->name;
		}

		return json_encode($to_return);
	}
}
