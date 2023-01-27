<?php
$dataPerPage = $data->dataPerPage;
$countData = $data->countData;
$countPage = ceil($countData / $dataPerPage);

$noPage = $data->page;

// if ($noPage > 1) echo  "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . ($noPage - 1) . "'>Previous</a>";
// for ($page = 1; $page <= $countPage; $page++) {
//     if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $countPage)) {
//         if ((@$showPage == 1) && ($page != 2))  echo "...";
//         if ((@$showPage != ($countPage - 1)) && ($page == $countPage))  echo "...";
//         if ($page == $noPage) echo " <b>" . $page . "</b> ";
//         else echo " <a href='" . $_SERVER['PHP_SELF'] . "?page=" . $page . "'>" . $page . "</a> ";
//         $showPage = $page;
//     }
// }
// if ($noPage < $countPage) echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . ($noPage + 1) . "'>Next</a>";

?>

<nav aria-label="Page navigation">
    <ul class="pagination">

        <?php
        if ($noPage > 1) echo "<li class='page-item'><a href='" . BASEURL . "/admin/{$data->halaman}/page/" . ($noPage - 1) . "' class='page-link'>Previous</a></li>";
        for ($page = 1; $page <= $countPage; $page++) {
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $countPage)) {
                if ($page == $noPage) echo "<li class='page-item active' aria-current='page'><a class='page-link'>" . $page . "</a></li> ";
                else echo "<li class='page-item'><a class='page-link' href='" . BASEURL . "/admin/{$data->halaman}/page/" . $page . "'>" . $page . "</a></li>";
            }
        }
        if ($noPage < $countPage) echo "<li class='page-item'><a href='" . BASEURL . "/admin/{$data->halaman}/page/" . ($noPage + 1) . "' class='page-link'>Next</a>";
        ?>
    </ul>
</nav>