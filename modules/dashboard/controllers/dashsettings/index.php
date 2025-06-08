<?php if (!$this->fatalError): ?>

<?= Form::open(['class'=>'layout settings-page size-large']) ?>
    <div class="layout-row">
        <div class="flex-grow-1">
            <?= $this->formRender() ?>
        </div>
    </div>

    <div class="form-buttons">
        <div data-control="loader-container">
            <?= Ui::ajaxButton("Save", 'onSave')
                ->primary()
                ->ajaxData(['redirect' => false])
                ->hotkey('ctrl+s', 'cmd+s')
                ->loadingMessage(__("Saving...")) ?>

            <?= Ui::ajaxButton(__("Save & Close"), 'onSave')
                ->secondary()
                ->ajaxData(['close' => true])
                ->hotkey('ctrl+enter', 'cmd+enter')
                ->loadingMessage(__("Saving...")) ?>

            <span class="btn-text">
                <span class="button-separator"><?= __("or") ?></span>
                <?= Ui::button("Cancel", 'system/settings')
                    ->textLink() ?>
            </span>

            <span class="pull-right btn-text">
                <?= Ui::ajaxButton("Reset to Default", 'onResetDefault')
                    ->textLink()
                    ->ajaxData(['redirect' => false])
                    ->confirmMessage(__("Are you sure?"))
                    ->loadingMessage(__("Resetting...")) ?>

                <?php /*
                <?= Ui::ajaxButton(e(trans('dashboard::lang.internal_traffic_statistics.purge_button')), 'onPurgeData')
                    ->danger()
                    ->confirmMessage(e(trans('dashboard::lang.internal_traffic_statistics.purge_data_confirm')))
                    ->loadingMessage(e(trans('dashboard::lang.internal_traffic_statistics.purging'))) ?>
                */ ?>

            </span>
        </div>
    </div>

<?php /*
    <div class="form-buttons">
        <div class="loading-indicator-container">
            <span class="btn-text">
                <a href="<?= Backend::url('system/settings') ?>"><?= e(trans('backend::lang.form.cancel')) ?></a>
            </span>

            <button
                type="button"
                class="btn btn-danger pull-right"
                data-request="onPurgeData"
                data-load-indicator="<?= e(trans('dashboard::lang.internal_traffic_statistics.purging')) ?>"
                data-request-confirm="<?= e(trans('dashboard::lang.internal_traffic_statistics.purge_data_confirm')) ?>">
                <?= e(trans('dashboard::lang.internal_traffic_statistics.purge_button')) ?>
            </button>
        </div>
    </div>
*/ ?>

<?= Form::close() ?>

<?php else: ?>
    <p class="flash-message static error"><?= e(__($this->fatalError)) ?></p>
    <p><a href="<?= Backend::url('system/settings') ?>" class="btn btn-default"><?= __('Return to System Settings') ?></a></p>
<?php endif ?>