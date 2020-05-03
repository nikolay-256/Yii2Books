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
					'one'    => ['GET', 'DELETE'],
					'update' => ['POST'],
				],
			],
		];
	}

	/**
	 * Get all books
	 *
	 * @return json:
	 *             status=error/success,
	 *             data=json
	 */
	public function actionList()
	{
		$to_return = ['status' => 'success', 'data' => []];
		foreach (Book::find()->all() as $book) {
			$book_row = $book->toArray();
			$book_row['author_name'] = $book->author->name;
			$to_return['data'][] = $book_row;
		}

		return json_encode($to_return);
	}

	/**
	 * View and delete actions for one book
	 *
	 * @return json:
	 *             status=error/success,
	 *             message=''
	 *             data=json
	 */
	public function actionOne($id)
	{
		$to_return = ['status' => 'error', 'message' => '', 'data' => []];
		$book = Book::findOne($id);
		if (!$book) {
			$to_return['status'] = 'error';
			$to_return['message'] = 'not finded';

			return json_encode($to_return);
		}
		if (Yii::$app->request->isGet) {
			$to_return['status'] = 'success';
			$to_return['data'] = $book->toArray();
			$to_return['data']['author_name'] = $book->author->name;

			return json_encode($to_return);
		} elseif (Yii::$app->request->isDelete) {
			$book->delete();
			$to_return['status'] = 'success';
			$to_return['message'] = 'ok';

			return json_encode($to_return);
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
}
