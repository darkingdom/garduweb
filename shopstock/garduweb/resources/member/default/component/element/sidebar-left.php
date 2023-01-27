<div id="sidebar-left">
    <div id="sidebar-top">
        <div>HALAMAN MEMBER</div>
    </div>
    <?php //include "logo.php"; 
    ?>
    <?php include "menu-sidebar.php"; ?>
</div>

<style>
    #sidebar-left {
        min-width: 210px;
        max-width: 210px;
        background-color: #2edb2e;
        height: 100vh;
        /* box-shadow: 0 0 10px #333; */
        border-right: 1px solid #ccc;
        overflow: auto;
        z-index: 1;
    }

    #sidebar-top {
        height: 50px;
        background-color: #0eb30e;
        /* border-bottom: 1px solid #00ff00; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #sidebar-top div {
        font-weight: bold;
        color: #002b05;
    }

    #sidebar-left::-webkit-scrollbar {
        display: none;
    }

    #sidebar-left {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>