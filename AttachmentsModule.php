<?php

# Profile Attachments system
# @Author: WASasquatch

class AttachmentsModule extends HWebModule
{

    public static function onWallInit($event) {
        // ...
    }
    
    public static function onAdminMenuInit($event) {
        $event->sender->addItem(array(
            'label' => Yii::t('AttachmentsModule.base', 'Profile Attachments'),
            'url' => Yii::app()->createUrl('//attachments/config'),
            'group' => 'manage',
            'icon' => '<i class="fa fa-picture-o"></i>',
            'isActive' => (Yii::app()->controller->module && Yii::app()->controller->module->id == 'attachments' && Yii::app()->controller->id == 'admin'),
            'sortOrder' => 300,
        ));

    }
    
    public static function renderAttachments($event) {
            
        $allowAttachments = HSetting::Get('allowProfileAttachments', 'attachments');
        $controller = $event->sender;

        if ($allowAttachments && $controller->id == 'user') {

            if (!Yii::app()->user->isGuest) {
                 $event->isValid = false;
                 $controller->render('application.modules.attachments.views.attachments');
            }
            
        }
            
    }

    public static function onSidebarInit($event) {
        if (Yii::app()->moduleManager->isEnabled('attachments')) {
            
            $event->sender->addWidget('application.modules.attachments.widgets.AttachmentsWidget', array(), array(
                'sortOrder' => 0
            ));
        }
    }

    public function getConfigUrl() {
        return Yii::app()->createUrl('//attachments/config/config');
    }

    public function enable() {
        if (! $this->isEnabled()) {
            // set default config values
            if (!HSetting::Get('allowProfileAttachments', 'attachments')) {
                HSetting::Set('allowProfileAttachments', 'attachments', 0);
            }
        }
        parent::enable();
    }
}
?>
