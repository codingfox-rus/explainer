<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'IndexFinder';
?>
<div class="site-index">
    <div class="query-form-wrapper">
        <?php 
            $form = ActiveForm::begin([
                'id' => 'query-form',
                'action' => '/site/parse',
            ]); 
        ?>
        
        <div class="form-group">
            <label for="query">Введите запрос:</label>
            <textarea class="form-control" rows="15" id="query" name="query"></textarea>
        </div>
        
        <div class="form-group">
            <div class="d-inline">
                <?= Html::submitButton('Погнали', ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="spinner-border d-none" role="status">
                <br>
                <span class="sr-only"></span>
            </div>
        </div>
        
        <?php ActiveForm::end() ?>
    </div>
    <div id="query-result">
        
    </div>
</div>
