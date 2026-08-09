<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl mx-auto" id="location-approval-container">
        <?php RenderNavbar("approval") ?>
        <section class="flex flex-col gap-4 py-8 page-container">
            <div class="reveal head-container ">
                <div class="flex flex-col w-full">

                    <div
                        class="flex gap-2 items-center text-gray-600 text-xs font-medium tracking-widest-long py-2 px-4 border-gray w-fit rounded-full bg-gray-200">
                        <span class="relative justify-center items-center flex w-4 h-4">
                            <span class="absolute  w-2 z-1 h-2 bg-secondary rounded-full"></span>
                            <span class="absolute  w-4 z-2 h-4 bg-secondary opacity-10 rounded-full"></span>
                        </span>
                        <div class="discover-title-sub">
                            <p class="text-gray-500">MODERATION QUEUE
                            </p>

                        </div>
                    </div>
                    <div class="font-semibold  text-4xl mt-4">Place
                        submission</div>
                    <div class="color-gray text-sm font-medium mt-4">
                        Review user-submitted famous places before they go live.
                    </div>
                </div>
                <div class="flex gap-2 sm:mt-4 ">
                    <button
                        class="no-underline w-fit  bg-skin color-warm font-semibold border-none py-2 px-4 rounded-full  text-sm font-medium "
                        style="text-wrap: nowrap;">

                        <span>3</span> pending
                    </button>
                    <button
                        class="no-underline w-fit text-gray-800 border font-semibold border-gray-500 py-2 px-4  border-solid rounded-full nav-link-item-hover hover-bg-ternary text-sm font-medium  "
                        style="text-wrap: nowrap;">
                        Bulk approve
                    </button>

                </div>
            </div>
            <div class="border-t-gray w-full"></div>
            <div class="bg-ternary w-full text-black gap-2" id="submission-approval-container">

                <!-- <div class='w-full p-16 text-black rounded-lg text-lg text-center border-gray'>
                    Loading Please wait...
                </div> -->



            </div>

        </section>
        <?php Footer() ?>
    </div>


    <?php include '../../includes/footerlinks.php' ?>
</body>

</html>