<!-- MODAL INFO -->
<div class="modal fade" id="detailMember" tabindex="-1" aria-labelledby="detailMemberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailMemberLabel">Member Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- ############# START ############ -->
                <div class="modal-item">
                    <div class="label-item">Nama</div>
                    <div id="nameModal"></div>
                </div>
                <div class="modal-item">
                    <div class="label-item">Saldo Simpanan</div>
                    <div id="saldoSimpananModal"></div>
                </div>
                <!-- ############# END ############ -->

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>


<!-- MODAL DELETE -->
<div class="modal fade" id="deleteMember" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                <form id="memberDeleteURL" action="#" method="POST">
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-item {
        display: flex;
    }

    .label-item {
        margin-right: 15px;
        font-weight: bold;
    }
</style>