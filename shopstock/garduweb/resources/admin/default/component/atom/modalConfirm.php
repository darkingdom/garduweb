<!-- MODAL CONFIRM -->
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="modalLabel">Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- ############# START ############ -->
                <div id="modal-desc"></div>
                <!-- ############# END ############ -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form id="modalConfirmURL" action="#" method="POST">
                    <input id="modal-confirm-id" name="id" type="hidden" value="" />
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- 
<a href="#" title="Confirm" class="text-light media-confirm" data-id="<?= $kategori->id ?>" data-bs-toggle="modal" data-bs-target="#modalConfirm">
</a>

< ?php
    include COMPONENTADM . "/component/atom/modalConfirm.php";
?>

<script>
    $(document).ready(function() {
        $(".media-confirm").on("click", function() {
            const id = $(this).data("id");
            $("#modal-confirm-id").val(id);
            $("#modal-desc").html("Proses Order ini?");
            $("#modalConfirmURL").attr(
                "action",
                baseurl + "/admin/produk/action/confirm-order/"
            );
        });
    });
</script> 
-->