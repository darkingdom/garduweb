<script src="<?= VENDOR  ?>/vendor/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
<script src="<?= VENDOR ?>/vendor/clipboard/2.0.8/clipboard.min.js"></script>
<script src="<?= BASEURL ?>/garduweb/resources/admin/light/asset/js/main.js"></script>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    // Copy Clipboard
    var clipboard = new ClipboardJS('.copy');

    // Tooltips Bootstrap
    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>