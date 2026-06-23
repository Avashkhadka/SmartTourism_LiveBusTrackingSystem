<?php
function RenderNavbar($activetab)
{
    ?>
    <nav>
        <div>
            <span>K</span>
            <span>Khoja</span>
        </div>
        <div>
            <span class='<?php echo $activetab == "home" ? "active" : "" ?>'><a href="pages/home.php">Home</a></span>
            <span class='<?php echo $activetab == "discover" ? "active" : "" ?>'><a href="pages/discover.php">Discover</a></span>
            <span class='<?php echo $activetab == "live-map" ? "active" : "" ?>'><a href="pages/live-map.php">Live Map</a></span>
            <span class='<?php echo $activetab == "contribute" ? "active" : "" ?>'><a
                    href="pages/for-drivers.php">Contribute</a></span>
            <span class='<?php echo $activetab == "contact" ? "active" : "" ?>'><a href="pages/admin.php">Admin</a></span>
        </div>
        <div>
            <span><a href="">Sign in</a></span>
            <span><a href="">Explore</a></span>
        </div>

    </nav>



    <?php
}

?>