<?php include '../components/navbar.php' ?>
<?php include '../components/footer.php' ?>
<?php include '../config/constants.php' ?>
<?php include "../includes/authGuard.php"; ?>
<?php include '../components/input.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl  mx-auto reveal" id="view_page_container">
        <?php RenderNavbar("") ?>
        <section class=" reveal flex flex-col gap-2 place-container">
            <div class="place-header">
                <div>Discover</div> / <div class="category-head head ">Temples</div> / <span
                    id="placeName-head-title">Mahabodhi Temple</span>
            </div>
            <div class="view-location-image-container mt-2">
                <div class="mainImage-container">
                    <img src="../assets/images/signup-bg.jpg" class=" h-64 w-full object-cover " alt="">
                    <div class="location-image-overlay">
                        <div class="location-category-head"> LIVE . <span class="category-head">TEMPLES</span></div>
                        <div class="location-image-footer">
                            <div><span>01</span> / <span>06</span></div>
                            <div>
                                <div> <i class="fa-solid fa-angle-left"></i> </div>
                                <div> <i class="fa-solid fa-angle-right"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-secondary-container">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                </div>
            </div>
            <main class="mt-8 reveal">
                <div>
                    <div
                        class="color-secondary text-xs rounded-full font-bold mb-2 py-2 px-4 w-fit text-center bg-secondary-25 category-head">
                    </div>
                    <div class="location-heading-title">

                    </div>
                    <div class="location-heading-sub text-sm mt-2 color-gray">
                        <span> <i class="fa-solid fa-star"></i> rating</span><span class="totalDistance"> km
                            away</span><span><i class="fa-regular fa-alarm-clock"></i> time</span><span><i
                                class="fa-solid fa-user-group" style="color:#5B3A8E;"></i> crowd</span>
                    </div>
                    <div class="mt-6 text-lg font-semibold mb-2">About this place</div>
                    <p class=" text-sm color-gray" id="location-description"></p>
                    <div class="mt-6 text-lg font-semibold mb-4">
                        What's special
                    </div>
                    <div class="">
                        <div>Best at sunrise</div>
                        <div>photospot</div>
                        <div>Easy access</div>
                        <div>Local Tip</div>
                    </div>
                    <div class="mt-6 text-lg font-semibold mb-4 ">How to get there</div>

                    <div id="map" class="h-80 w-full rounded-2xl border-gray"></div>

                </div>
                <div class="reveal rounded-2xl border-gray p-6 side-form">
                    <div class="color-gray text-xs font-base">ENTRY FORM</div>
                    <div class="mt-2 flex justify-between">
                        <div class="text-black font-bold text-2xl">100 Rs</div>
                        <div
                            class=" flex justify-center items-center py-2 px-4 rounded-full bg-success-light text-success font-semibold text-xs">
                            Open now</div>
                    </div>
                    <div class="border-gray w-full my-4 rounded-full"></div>
                    <div>
                        <div class="flex justify-between my-4">
                            <div class="color-gray text-xs font-medium">ETA</div>
                            <div class="font-bold text-sm" id="busETA">40 min</div>
                        </div>
                        <div class="flex justify-between my-4">
                            <div class="color-gray text-xs font-medium">Fare</div>
                            <div class="font-bold text-sm" id="busEstfair">Rs 40</div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 mt-6">

                        <a href="<?php echo BASEURL . "pages/discover.php" ?>"
                            class="py-3 flex justify-center items-center  text-white bg-secondary gap-2 font-medium shadow rounded-full no-underline nav-link-item-hover">Book
                            seat now <i class="fa-solid fa-arrow-right"></i></a>
                        <a href=""
                            class="py-3 flex justify-center items-center no-underline text-gray-800 shadow border border-gray-200 border-solid nav-link-item-hover rounded-full hover-bg-ternary gap-2 bg-white font-medium"><i
                                class="fa-regular fa-heart"></i> Save
                            Place </a>


                    </div>
                </div>
            </main>
            <section class="mt-8">
                <div class="font-semibold text-3xl">You might also like</div>
                <div id="near_this_place" class="discover_card_container mt-4 reveal"></div>
            </section>
        </section>
        <?php Footer() ?>
    </div>


    <?php include '../includes/footerlinks.php' ?>
</body>

</html>