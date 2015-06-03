<?php

	Yii::app()->moduleManager->register(array(
		'id' => 'attachments',
		'class' => 'application.modules.attachments.AttachmentsModule',
		'import' => array(
			'application.modules.attachments.*',
		),
		// Events to Catch 
		'events' => array(
			array('class' => 'AdminMenuWidget', 'event' => 'onInit', 'callback' => array('AttachmentsModule', 'onAdminMenuInit')),
			array('class' => 'DashboardSidebarWidget', 'event' => 'onInit', 'callback' => array('AttachmentsModule', 'onSidebarInit')),
			),
	));
	

?>