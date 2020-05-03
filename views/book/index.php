<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php if (!Yii::$app->user->isGuest): ?>
	<p>
		<?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?php endif; ?>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget(
		[
			'dataProvider' => $dataProvider,
			'filterModel'  => $searchModel,
			'columns'      => [
				['class' => 'yii\grid\SerialColumn'],
				'id',
				[
					'label'     => 'Author Id',
					'attribute' => 'author_id',
				],
				[
					'label' => 'Author name',
					'value' => function ($model) {
						return $model->author->name;
					},
				],
				'title',
				[
					'class'   => 'yii\grid\ActionColumn',
					'visible' => !Yii::$app->user->isGuest,
				],
			],
		]
	); ?>


</div>
