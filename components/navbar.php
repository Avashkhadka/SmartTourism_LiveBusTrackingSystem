<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
function RenderNavbar($activetab)
{
    ?>


    <nav class="reveal flex justify-between py-4 px-12 justify-center items-center shadow-sm" style="z-index: 9999;">
        <a href="<?php echo BASEURL ?>" class=" no-underline flex gap-2 justify-center items-center" id="rootimg">
            <span class="rounded-lg h-8 font-bold w-8 flex justify-center items-center bg-black text-white">K</span>
            <span class="font-bold text-black">Khoja</span>
        </a>

        <div class="flex justify-between items-center gap-1 p-1 text-sm font-medium border border-gray-200 border-solid rounded-full bg-ternary"
            id="wide-nav">
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
        <div class="flex gap-2" id="wide-nav-link"> <a href='<?php echo BASEURL ?>pages/sign-up.php'
                class="no-underline text-gray-800 border border-gray-200  py-2 px-4  border-solid rounded-full nav-link-item-hover hover-bg-ternary">
                <span class="text-sm font-medium  ">
                    Sign up
                </span>
            </a>
            <a href='<?php echo BASEURL ?>pages/sign-in.php'
                class="no-underline text-gray-800 bg-black border border-gray-200  py-2 px-4  border-solid rounded-full nav-link-item-hover ">
                <span class="text-sm font-medium text-white">
                    Sign in

                </span>
            </a>

        </div>

        <button id="mob-nav-ham" class="inset-0 border-none bg-transparent" popovertarget="mob-nav"
            popovertargetaction="show"><i class="fa-solid fa-bars text-2xl"></i></button>

        <div class="w-screen h-screen bg-white z-9999 px-12" popover id="mob-nav">

            <button id="mob-nav-ham" class="inset-0 border-none bg-transparent" popovertarget="mob-nav"
                popovertargetaction="hide"><i class="fa-solid fa-bars text-2xl"></i></button>


        </div>

    </nav>



    <script type="module" src="<?php echo BASEURL ?>/js/main.js"></script>
    <?php
}

?>