<?php

/* @var $this yii\web\View */

$this->title = 'Books&Authors';

use yii\helpers\Html; ?>
<div class="site-index">
	<?= Html::a('Authors list (with books count)', ['/author/index'], ['class'=>'btn btn-primary']) ?>
	<span style="margin-right: 20px;"></span>
	<?= Html::a('Books list (with authors)', ['/book/index'], ['class'=>'btn btn-primary']) ?>
	
</div>
