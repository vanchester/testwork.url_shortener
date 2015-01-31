<?php
/**
 * @var $urlModel Url
 * @var $form CActiveForm
 * @var $link string|null
 */
?>
<?php
    $form = $this->beginWidget('CActiveForm', [
        'id' => 'user-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'htmlOptions' => [
            'class' => 'form-inline',
        ],
        'clientOptions' => [
            'validateOnChange' => false
        ],
        'focus' => [
            $urlModel,
            'link'
        ],
    ]);
?>

    <div class="form-group">
        <?= $form->label($urlModel, 'link'); ?>
    </div>

    <div class="form-inline">
        <div class="form-group">
            <?=
                $form->textField(
                    $urlModel,
                    'link',
                    [
                        'id' => 'url',
                        'type' => 'url',
                        'placeholder' => 'http://site.com',
                        'class' => 'form-control',
                        'style' => 'width: 403px'
                    ]);
            ?>
            <?=
                CHtml::ajaxSubmitButton(
                    Yii::t('url', 'Shorten'),
                    '/',
                    [
                        'type' => 'post',
                        'success' => 'function (data) {
                            $(".error").hide();

                            data = $.parseJSON(data);

                            if (data.status == "success") {
                                $("#result").html(
                                    $("<input/>")
                                        .val(data.link)
                                        .addClass("form-control")
                                        .attr("readonly", "readonly")
                                );
                            } else {
                                for (var el in data) {
                                    $("#" + el + "_em_")
                                        .html(data[el])
                                        .show();
                                }
                            }
                        }'
                    ],
                    [
                        'class' => 'btn btn-default'
                    ]
                );
            ?>
        </div>
    </div>
    <?php echo $form->error($urlModel, 'link', ['class' => 'form-group error']); ?>
<?php $this->endWidget(); ?>

<div id="result" class="form-group">
    <?php if ($link) : ?>
        <input class="form-control" value="<?= $link ?>" readonly="readonly"/>
    <?php endif ?>
</div>
