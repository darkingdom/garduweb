<div class="content">

    <?= Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/member/wallet/action/claim-voucher/">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtToken" name="txtToken">
            <label>Token Voucher</label>
        </div>
        <div class="mt-5">
            <hr />
            <button type="submit" name="claim" class="btn btn-success">CLAIM VOUCHER</button>
        </div>
    </form>
</div>