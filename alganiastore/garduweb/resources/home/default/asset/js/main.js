// START SEARCH -----------------
document.getElementById("btn-search").addEventListener("click", search);
function search() {
  let txtSearch = document.getElementById("txtSearch").value;
  let search = txtSearch.replace(" ", "+");
  location.href = baseurl + "/search/" + search;
}
// END SEARCH -------------------
