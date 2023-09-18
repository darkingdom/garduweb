<script src="<?= VENDOR ?>/vendor/ckEditor/ckeditor5-31.0.0/build/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('.editor'), {

            licenseKey: '',

        })
        .then(editor => {

            window.editor = editor;

        })
        .catch(error => {
            console.error('Oops, something went wrong!');
            console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
            console.warn('Build id: e2nlunotv7ed-fdhyxvasphha');
            console.error(error);
        });
</script>