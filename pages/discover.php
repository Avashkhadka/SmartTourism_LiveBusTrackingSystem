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
    <div class="max-w-9xl mx-auto" id="discover-container">
        <?php RenderNavbar("discover") ?>
        <section class=" reveal flex flex-col gap-4 discover-container">
            <div class="flex flex-col ">

                <div class="flex gap-2 items-center text-gray-600 text-xs font-medium tracking-widest-long ">
                    <span class="relative justify-center items-center flex w-4 h-4">
                        <span class="absolute  w-2 z-1 h-2 bg-secondary rounded-full"></span>
                        <span class="absolute  w-4 z-2 h-4 bg-secondary opacity-10 rounded-full"></span>
                    </span>
                    <div class="discover-title-sub">
                        <p class="text-gray-500">12,482</p>
                        <p class="text-gray-500">PLACES CURATED BY LOCALS</p>
                    </div>
                </div>
                <div class="font-semibold text-5xl mt-4">Discover Places worth a detour.</div>
                <div class="color-gray text-base font-normal mt-4">
                    A living index of cafés, viewpoints, temples and back-alley wonders — pinned by people who actually
                    went.
                </div>
            </div>
            <div class="border-gray search-container">
                <div class="flex border-gray rounded-full p-2 gap-4 flex items-center space-between">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    <input type="text" id="search_box" class="  bg-white text-sm border-none w-full "
                        placeholder=" Search places, categories or moods...">
                </div>
                <div class="flex flex-wrap gap-2 justify-center items-center ">
                    <div class="border-gray search-category active-category rounded-full h-10 curser-pointer">All</div>
                    <div class="border-gray search-category rounded-full h-10 curser-pointer">Temples</div>
                    <div class="border-gray search-category rounded-full h-10 curser-pointer">Nature</div>
                    <div class="border-gray search-category rounded-full h-10 curser-pointer">Food</div>
                    <div class="border-gray search-category rounded-full h-10 curser-pointer">Adventure</div>
                    <div class="border-gray search-category rounded-full h-10 curser-pointer">Historical</div>
                    <div class="border-gray search-category rounded-full h-10 curser-pointer">Lakes</div>
                </div>
                <select name="search-select" id="search-select"
                    class="overflow-hidden py-4 h-full w-auto border-gray px-2 rounded-lg ">
                    <option value="" selected>Sort: Popular</option>
                    <option value="Nearest First">Nearest First</option>
                    <option value="Highest Rated">Highest Rated</option>
                </select>
            </div>
            <div class="my-4">
                <div class="flex w-full justify-between mb-4">

                    <span class="color-gray text-sm">12 Places</span>
                    <a class="border-gray py-2 bg-white px-4 text-sm rounded-full curser-pointer no-underline text-black font-medium"
                        href="live-map.php">Switch to map view</a>

                </div>
                <div class="discover_card_container ">
                    <?php
                    for ($i = 0; $i < 10; $i++) {
                        ?>
                        <article class="w-full reveal card rounded-2xl overflow-hidden shadow-lg"
                            data-location-id="<?php echo $i ?>">
                            <div class="relative">
                                <img src="../assets/images/signin-bg.jpg" alt="" class="w-full">
                                <div class="absolute inset-0 h-full w-full p-4">
                                    <div class="flex justify-between items-center">
                                        <div class="bg-white py-2 px-4 block text-xs font-bold rounded-full">Temples</div>
                                        <div
                                            class="bg-white p-2 block text-lg font-bold rounded-full flex justify-center items-center fav-svg-container">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24"
                                                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:cc="http://creativecommons.org/ns#"
                                                xmlns:dc="http://purl.org/dc/elements/1.1/">
                                                <g transform="translate(0 -1028.4)">
                                                    <path
                                                        d="m7 1031.4c-1.5355 0-3.0784 0.5-4.25 1.7-2.3431 2.4-2.2788 6.1 0 8.5l9.25 9.8 9.25-9.8c2.279-2.4 2.343-6.1 0-8.5-2.343-2.3-6.157-2.3-8.5 0l-0.75 0.8-0.75-0.8c-1.172-1.2-2.7145-1.7-4.25-1.7z" />
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div></div>
                                </div>
                            </div>

                            <div class="w-full p-6">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-md color-black">Mahabodhi Temple</h3>
                                    <h3 class="font-medium text-xs  color-gray">2.4km</h3>
                                </div>
                                <p class="text-xs color-gray font-medium my-4 ">Ancient Buddhist temple where buddha
                                    attained
                                    enlightment</p>
                                <div class="w-full mb-4" style=" border: 1px solid var(--border-gray);"></div>
                                <div class="justify-between flex items-center">
                                    <a class="border-gray flex items-center bg-white py-1 h-8 px-3 text-xs rounded-full curser-pointer no-underline text-black font-medium"
                                        href="live-map.php">Moderate. Rs1000</a> <a
                                        class="border-gray text-white px-4  py-1 h-10 flex items-center text-sm rounded-full curser-pointer no-underline text-black font-medium active-category"
                                        href="live-map.php">Details</a>

                                </div>
                            </div>


                        </article>
                        <?php
                    }
                    ?>

                </div>
        </section>
        <?php Footer() ?>
    </div>


    <?php include '../includes/footerlinks.php' ?>
</body>

</html>