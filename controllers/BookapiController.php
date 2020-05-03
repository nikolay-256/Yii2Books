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
					'list'   => ['GET'],
					'view'   => ['GET'],
					'update' => ['POST'],
					'delete' => ['DELETE'],
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

	/**
	 * Update book fields by id
	 *
	 *fields to update:
	 * author_id
	 * title
	 *
	 * @return json:
	 *             status=error/success,
	 *             message=''
	 */
	public function actionUpdate($id)
	{
		$to_return = ['status' => 'error', 'message' => ''];
		$fields_to_update = ['author_id', 'title'];
		$book = Book::findOne($id);
		if (!$book) {
			$to_return['status'] = 'error';
			$to_return['message'] = 'not finded';

			return json_encode($to_return);
		}
		$post = Yii::$app->request->post();
		if (!array_intersect(array_keys($post), $fields_to_update)) {
			$to_return['status'] = 'error';
			$to_return['message'] = 'not updated';

			return json_encode($to_return);
		}
		$book->load(['Book' => $post]) && $book->save();
		$to_return['status'] = 'success';
		$to_return['message'] = 'ok';

		return json_encode($to_return);
	}

	/**
	 * Delete book by id
	 *
	 * @return json:
	 *             status=error/success,
	 *             message=''
	 */
	public function actionDelete($id)
	{
		$to_return = [];
		$book = Book::findOne($id);
		if (!$book) {
			$to_return['status'] = 'error';
			$to_return['message'] = 'not finded';

			return json_encode($to_return);
		}
		$book->delete();
		$to_return['status'] = 'success';
		$to_return['message'] = 'ok';

		return json_encode($to_return);
	}
}
