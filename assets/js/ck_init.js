document.addEventListener("DOMContentLoaded", function (event) {
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: '/public_html/adm/article/uploader',
        filebrowserBrowseUrl: '/public_html/adm/article/manager',
        extraPlugins: 'youtube',
        allowedContent: true, // режет теги, которые мы используем при редактировании записи
        filebrowserUploadMethod: 'form', //без этого скрипт не работал

    });




});

