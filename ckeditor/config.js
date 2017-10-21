/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.toolbar = [
		{ name: 'document', 	items: [ 'Source' ] },
		{ name: 'basicstyles',	items: [ 'Bold','Italic','Underline','RemoveFormat' ] },
		{ name: 'styles',		items: [ 'Format' ] },
		{ name: 'paragraph',	items: [ 'NumberedList', 'BulletedList' ] },
		{ name: 'links',		items: [ 'Link','Unlink' ] },
		{ name: 'clipboard',	items: [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] }
	];
	config.width = '720px';
	config.height = '300px';
	config.resize_enabled = false;
	config.format_tags = 'p;h3;h4';
};