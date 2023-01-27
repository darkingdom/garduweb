<link rel="stylesheet" href="<?= HOST ?>/vendor/jquery.treeview/1.4/jquery.treeview.css" />
<!-- <link rel="stylesheet" href="<?= HOST ?>/vendor/jquery.treeview/1.4/css/screen.css" /> -->
<script src="<?= HOST ?>/vendor/jquery.treeview/1.4/lib/jquery.cookie.js"></script>
<script src="<?= HOST ?>/vendor/jquery.treeview/1.4/jquery.treeview.js"></script>
<script>
    $(document).ready(function() {

        // first example
        $("#navigation").treeview({
            collapsed: true,
            unique: true,
            persist: "location"
        });


        // second example
        $("#browser").treeview({
            animated: "normal",
            persist: "cookie"
        });

        $("#samplebutton").click(function() {
            var branches = $("<li><span class='folder'>New Sublist</span><ul>" +
                "<li><span class='file'>Item1</span></li>" +
                "<li><span class='file'>Item2</span></li></ul></li>").appendTo("#browser");
            $("#browser").treeview({
                add: branches
            });
        });


        // third example
        $("#red").treeview({
            animated: "fast",
            collapsed: true,
            control: "#treecontrol"
        });


    });
</script>

<div class="content">
    <ul id="red">
        <li><span>Anda</span>
            <?php
            //-- UPLINE 1
            $countUpline1 = MemberModel::countUplineByNoAnggota(Session::get('idMB'))->total;
            if ($countUpline1 > 0) :
                echo "<ul>";
                $upline1 = MemberModel::getAllUplineByNoAnggota(Session::get('idMB'));
                foreach ($upline1 as $up1) :
                    echo "<li>";
                    echo "<span>" . $up1->no_anggota . "</span>";

                    //-- UPLINE 2
                    $countUpline2 = MemberModel::countUplineByNoAnggota($up1->no_anggota)->total;
                    if ($countUpline2 > 0) :
                        echo "<ul>";
                        $upline2 = MemberModel::getAllUplineByNoAnggota($up1->no_anggota);
                        foreach ($upline2 as $up2) :
                            echo "<li>";
                            echo "<span>" . $up2->no_anggota . "</span>";

                            //-- UPLINE 3
                            $countUpline3 = MemberModel::countUplineByNoAnggota($up2->no_anggota)->total;
                            if ($countUpline3 > 0) :
                                echo "<ul>";
                                $upline3 = MemberModel::getAllUplineByNoAnggota($up2->no_anggota);
                                foreach ($upline3 as $up3) :
                                    echo "<li>";
                                    echo "<span>" . $up3->no_anggota . "</span>";

                                    //-- UPLINE 4
                                    $countUpline4 = MemberModel::countUplineByNoAnggota($up3->no_anggota)->total;
                                    if ($countUpline4 > 0) :
                                        echo "<ul>";
                                        $upline4 = MemberModel::getAllUplineByNoAnggota($up3->no_anggota);
                                        foreach ($upline4 as $up4) :
                                            echo "<li>";
                                            echo "<span>" . $up4->no_anggota . "</span>";

                                            //-- UPLINE 5
                                            $countUpline5 = MemberModel::countUplineByNoAnggota($up4->no_anggota)->total;
                                            if ($countUpline5 > 0) :
                                                echo "<ul>";
                                                $upline5 = MemberModel::getAllUplineByNoAnggota($up4->no_anggota);
                                                foreach ($upline5 as $up5) :
                                                    echo "<li>";
                                                    echo "<span>" . $up5->no_anggota . "</span>";
                                                    echo "</li>";
                                                endforeach;
                                                echo "</ul>";
                                            endif;
                                            //-- END UOLINE 5
                                            echo "</li>";
                                        endforeach;
                                        echo "</ul>";
                                    endif;
                                    //-- END UOLINE 4
                                    echo "</li>";
                                endforeach;
                                echo "</ul>";
                            endif;
                            //-- END UOLINE 3
                            echo "</li>";
                        endforeach;
                        echo "</ul>";
                    endif;
                    //-- END UOLINE 2
                    echo "</li>";
                endforeach;
                echo "</ul>";
            endif;
            //-- END UOLINE 1
            ?>
        </li>
    </ul>


    <!-- <ul id="red">
        <li><span>Item 1</span>
            <ul>
                <li><span>Item 1.0</span>
                    <ul>
                        <li><span>Item 1.0.0</span></li>
                    </ul>
                </li>
                <li><span>Item 1.1</span></li>
                <li><span>Item 1.2</span>
                    <ul>
                        <li><span>Item 1.2.0</span>
                            <ul>
                                <li><span>Item 1.2.0.0</span></li>
                                <li><span>Item 1.2.0.1</span></li>
                                <li><span>Item 1.2.0.2</span></li>
                            </ul>
                        </li>
                        <li><span>Item 1.2.1</span>
                            <ul>
                                <li><span>Item 1.2.1.0</span></li>
                            </ul>
                        </li>
                        <li><span>Item 1.2.2</span>
                            <ul>
                                <li><span>Item 1.2.2.0</span></li>
                                <li><span>Item 1.2.2.1</span></li>
                                <li><span>Item 1.2.2.2</span></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><span>Item 2</span>
            <ul>
                <li><span>Item 2.0</span>
                    <ul>
                        <li><span>Item 2.0.0</span>
                            <ul>
                                <li><span>Item 2.0.0.0</span></li>
                                <li><span>Item 2.0.0.1</span></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><span>Item 2.1</span>
                    <ul>
                        <li><span>Item 2.1.0</span>
                            <ul>
                                <li><span>Item 2.1.0.0</span></li>
                            </ul>
                        </li>
                        <li><span>Item 2.1.1</span>
                            <ul>
                                <li><span>Item 2.1.1.0</span></li>
                                <li><span>Item 2.1.1.1</span></li>
                                <li><span>Item 2.1.1.2</span></li>
                            </ul>
                        </li>
                        <li><span>Item 2.1.2</span>
                            <ul>
                                <li><span>Item 2.1.2.0</span></li>
                                <li><span>Item 2.1.2.1</span></li>
                                <li><span>Item 2.1.2.2</span></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><span>Item 3</span>
            <ul>
                <li class="open"><span>Item 3.0</span>
                    <ul>
                        <li><span>Item 3.0.0</span></li>
                        <li><span>Item 3.0.1</span>
                            <ul>
                                <li><span>Item 3.0.1.0</span></li>
                                <li><span>Item 3.0.1.1</span></li>
                            </ul>

                        </li>
                        <li><span>Item 3.0.2</span>
                            <ul>
                                <li><span>Item 3.0.2.0</span></li>
                                <li><span>Item 3.0.2.1</span></li>
                                <li><span>Item 3.0.2.2</span></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul> -->

</div>