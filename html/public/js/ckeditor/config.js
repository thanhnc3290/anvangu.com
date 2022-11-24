/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    var base_url = 'https://www.anvangu.com/public/js'
    config.filebrowserBrowseUrl = base_url + '/ckfinder/ckfin2der.html';
    config.filebrowserFlashBrowseUrl = base_url + '/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserFlashUploadUrl = base_url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    config.filebrowserImageBrowseLinkUrl = '';
    config.filebrowserImageBrowseUrl = base_url + '/ckfinder/ckfinder.html?type=Images';
    config.filebrowserImageUploadUrl = base_url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserUploadUrl = '';
};