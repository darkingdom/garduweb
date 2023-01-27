$(document).ready(function () {
  //================================================================== MEMBER
  // MODAL
  //========== MEMBER INFO
  $(".member-detail").on("click", function () {
    const uid = $(this).data("id");
    $.ajax({
      url: baseurl + "/admin/memberInfo/",
      data: {
        uid: uid,
      },
      method: "POST",
      dataType: "JSON",
      success: function (response) {
        $("#nameModal").html(response.nama);
        $("#saldoSimpananModal").html(response.saldoSimpanan);
      },
    });
  });
  //========== END MEMBER INFO

  //========== DELETE MEMBER
  $(".member-delete").on("click", function () {
    const uid = $(this).data("id");
    $("#memberDeleteURL").attr(
      "action",
      baseurl + "/admin/setMember/delete/" + uid
    );
  });
  //========== END DELETE MEMBER
  // END MODAL
  //================================================================== END MEMBER

  //================================================================== POST KATEGORI
  // MODAL
  //========== DELETE KATEGORI
  $(".kategori-delete").on("click", function () {
    const uid = $(this).data("id");
    $("#modalDeleteURL").attr(
      "action",
      baseurl + "/admin/setPostKategori/delete/" + uid
    );
  });
  //========== END DELETE MEMBER
  // END MODAL
  //================================================================== END POST KATEGORI

  //================================================================== PRODUK
  //AJAX FORM
  //========== SELECT ONCHANGE ETALASE
  $("#parentEtalase").on("change", function () {
    const id = $(this).val();
    $.ajax({
      url: baseurl + "/admin/produk/etalase/getSelectSubParent/",
      data: { id: id },
      method: "POST",
      success: function (response) {
        $("#subParentEtalase").html(response);
      },
    });
  });
  //========== END SELECT ONCHANGE ETALASE
  //END AJAX FORM

  // MODAL
  //========== DELETE ETALASE
  $(".etalase-modal-delete").on("click", function () {
    const uid = $(this).data("id");
    $("#modal-delete-id").val(uid);
    $("#modalDeleteURL").attr(
      "action",
      baseurl + "/admin/setProdukEtalase/delete/"
    );
  });
  //========== END DELETE MEMBER
  // END MODAL
  //================================================================== END PRODUK
});

// Cotrol Upload Product //
// $(document).ready(function () {});

// $(document).ready(function () {
//   //upload file
// });
// End Cotrol Upload Product //
