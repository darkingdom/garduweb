<div style="clear: both; margin-top:40px"></div>

<footer>
    <div class="container">
        <!-- <div>Categories</div> -->
        <nav id="nav-bottom-ct-wrapper">
            <?php foreach ($data->categories as $category) : ?>
                <div><a href=""><?= $category->kategori ?></a></div>
            <?php endforeach; ?>
        </nav>
    </div>
    <div id="nav-bottom-wrapper">
        <div class="container">
            <div id="copy">
                Alganiastore &copy; 2023
            </div>
            <nav id="nav-bottom">
                <ul>
                    <li><a href="<?= BASEURL ?>">Home</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="https://ionic.io/ionicons" target="_blank">ionicons</a></li>
                    <li><a href="https://www.amazon.com/" target="_blank">Amazon</a></li>
                    <li><a href="https://www.aliexpress.com/" target="_blank">AliExpress</a></li>
                </ul>
            </nav>
        </div>
    </div>
</footer>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="<?= BASEURL ?>/garduweb/resources/home/default/asset/js/main.js"></script>
</body>

</html>