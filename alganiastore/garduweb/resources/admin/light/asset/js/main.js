// ============= START SIDEBAR TOOGLE
$(document).ready(function () {
  // var mWidth = screen.width;
  var mWidth = $(window).width();
  var mHeight = screen.height;

  $("#sidebarCollapse").on("click", function () {
    $(this).toggleClass("active");
    $("#sidebar").toggleClass("active");
    $(".dark-layer").toggleClass("active");
    $("#content-wrapper").toggleClass("active");
    $("#top-nav-right").toggleClass("active");
    $("#nav-bottom").toggleClass("active");
  });

  $(window).resize(function () {
    var mWidth = $(window).width();
    if (mWidth <= 768) {
      $("#content").css("width", mWidth);
    } else {
      $("#content").css("width", "100%");
    }
  });

  if (mWidth <= 768) {
    $("#content").css("width", mWidth);
  }
});

function goBack() {
  window.history.back();
}
//=========== END SIDEBAR TOOGLE

//=========== START CHECKBOX TABLE
function checkAll(ele) {
  var checkboxes = document.getElementsByName("chkID[]");
  if (ele.checked) {
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == "checkbox") {
        checkboxes[i].checked = true;
      }
    }
  } else {
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type == "checkbox") {
        checkboxes[i].checked = false;
      }
    }
  }
}
//=========== END CHECKBOX TABLE

//=========== ALERT AUTO HIDE
$(document).ready(function () {
  window.setTimeout(function () {
    $(".alert")
      .fadeTo(500, 0)
      .slideUp(500, function () {
        $(this).remove();
      });
  }, 4000);
});
//=========== END ALERT AUTO HIDE
