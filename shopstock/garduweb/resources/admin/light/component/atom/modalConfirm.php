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
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="btn-confirm">CONFIRM</button>
                </form>
            </div>
        </div>
    </div>
</div>