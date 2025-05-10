<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PropositionForm */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/js/Site.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>
<div id="notification-banner" class="alert" style="display: none;"></div>
<h1>Proposer un voyage</h1>



<?php $form = ActiveForm::begin([
    'id' => 'proposer-voyage-form', // ID utilisé pour l'appel AJAX
    'enableClientValidation' => true,
]); ?>

<?= $form->field($model, 'villeDepart')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'villeArrivee')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'typevehicule')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'marque')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'tarif')->input('number', ['step' => '0.01']) ?>
<?= $form->field($model, 'nbplacedispo')->input('number') ?>
<?= $form->field($model, 'nbbagage')->input('number') ?>
<?= $form->field($model, 'heuredepart')->input('number', ['min' => 00, 'max' => 23]) ?>
<?= $form->field($model, 'contraintes')->textarea(['rows' => 4]) ?>

<div class="form-group">
    <?= Html::submitButton('Proposer le voyage', ['class' => 'btn btn-primary', 'id' =>'submit-btn-proposition']) ?>
</div>

<?php ActiveForm::end(); ?>
