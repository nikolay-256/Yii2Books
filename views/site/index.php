<?php

/* @var $this yii\web\View */

$this->title = 'Books&Authors';

use yii\helpers\Html; ?>
<div class="site-index">
	<?= Html::a('Books list(with authors)', ['/book/index'], ['class'=>'btn btn-primary']) ?>
	<?= Html::a('Authors list(with books count)', ['/author/index'], ['class'=>'btn btn-primary']) ?>
</div>
