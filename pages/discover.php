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
        <section class="reveal p-12 flex flex-col gap-4">
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
                    <input type="text" id="search_box" class="bg-white text-sm border-none w-full "
                        placeholder=" Search places, categories or moods...">
                </div>
                <div class="flex flex-wrap gap-4 justify-center items-center">
                    <div class="border-gray search-category active-category rounded-full h-8 curser-pointer">All</div>
                    <div class="border-gray search-category rounded-full h-8 curser-pointer">Temples</div>
                    <div class="border-gray search-category rounded-full h-8 curser-pointer">Nature</div>
                    <div class="border-gray search-category rounded-full h-8 curser-pointer">Food</div>
                    <div class="border-gray search-category rounded-full h-8 curser-pointer">Adventure</div>
                    <div class="border-gray search-category rounded-full h-8 curser-pointer">Historical</div>
                    <div class="border-gray search-category rounded-full h-8 curser-pointer">Lakes</div>
                    <select name="search-select" id="search-select" class="h-full w-auto border-gray px-2 rounded-lg ">
                        <option value="" selected>Sort: Popular</option>
                        <option value="Nearest First">Nearest First</option>
                        <option value="Highest Rated">Highest Rated</option>




                    </select>
                </div>
            </div>
        </section>
        <?php Footer() ?>
    </div>


    <?php include '../includes/footerlinks.php' ?>
</body>

</html>