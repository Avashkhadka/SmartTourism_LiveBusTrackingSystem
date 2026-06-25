<?php
function RenderNavbar($activetab)
{
    ?>


    <nav class="flex justify-between py-4 px-12 justify-center items-center shadow-sm">
        <div class="flex gap-2 justify-center items-center">
            <span class="rounded-lg h-8 font-bold w-8 flex justify-center items-center bg-black text-white">K</span>
            <span class="font-bold">Khoja</span>
        </div>
        <div class="flex justify-between items-center gap-1 p-1 text-sm font-medium border border-gray-200 border-solid rounded-full bg-ternary">
            <a class="no-underline nav-link <?php echo $activetab == "home" ? "active-link shadow" : "color-ternary" ?> "
                href='<?php echo BASEURL ?>index.php'>Home</a>

            <a class="no-underline nav-link <?php echo $activetab == "discover" ? "active-link shadow" : "color-ternary" ?>"
                href='<?php echo BASEURL ?>pages/discover.php'>Discover</a>

            <a class="no-underline nav-link <?php echo $activetab == "live-map" ? "active-link shadow" : "color-ternary" ?>"
                href='<?php echo BASEURL ?>pages/live-map.php'>Live Map</a>

            <a class="no-underline nav-link <?php echo $activetab == "contribute" ? "active-link shadow" : "color-ternary" ?>"
                href='<?php echo BASEURL ?>pages/contribute.php'>Contribute</a>

            <a class="no-underline nav-link <?php echo $activetab == "booking" ? "active-link shadow" : "color-ternary" ?>"
                href='<?php echo BASEURL ?>pages/booking.php'>Booking</a>
        </div>
        <div class="flex gap-2">
            <a href='<?php echo BASEURL?>pages/signup.php' class="no-underline text-gray-800 border border-gray-200  py-2 px-4  border-solid rounded-full nav-link-item-hover hover-bg-ternary">
                <span
                    class="text-sm font-medium  ">
                    Sign in
                </span>
            </a>
              <a href='<?php echo BASEURL?>pages/discover.php' class="no-underline text-gray-800 bg-black border border-gray-200  py-2 px-4  border-solid rounded-full nav-link-item-hover ">
                <span
                    class="text-sm font-medium text-white">
                    Explore

                </span>
            </a>
        </div>

    </nav>



    <?php
}

?>