<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php if (!Yii::$app->user->isGuest): ?>
		<p>
			<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
			<?= Html::a(
				'Delete', ['delete', 'id' => $model->id], [
					'class' => 'btn btn-danger',
					'data'  => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method'  => 'post',
					],
				]
			) ?>
		</p>

	<?php endif; ?>

	<?= DetailView::widget(
		[
			'model'      => $model,
			'attributes' => [
				'id',
				'author_id',
				[
					'label' => 'Author name',
					'value' => function ($model) {
						return $model->author->name;
					},
				],
				'title',
			],
		]
	) ?>

</div>
