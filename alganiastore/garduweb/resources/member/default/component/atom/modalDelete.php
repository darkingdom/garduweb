<!-- MODAL DELETE -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="modalLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- ############# START ############ -->
                Apakah anda ingin menghapus data ini?
                <!-- ############# END ############ -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form id="modalDeleteURL" action="#" method="POST">
                    <input id="modal-delete-id" name="id" type="hidden" value="" />
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div>