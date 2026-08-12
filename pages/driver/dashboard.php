<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl mx-auto " id="drivers-dashboard">
        <?php RenderNavbar("booking") ?>
        <section class="flex flex-col gap-4 py-8 page-container">
            <div class="reveal head-container ">
                <div class="flex flex-col w-full">

                    <div class="flex gap-2 items-center text-gray-600 font-medium tracking-widest-long py-2 px-2 w-fit rounded-full "
                        style="font-size: 10px;">
                        <span class="relative justify-center items-center flex w-4 h-4">
                            <span class="absolute  w-2 z-1 h-2 bg-secondary rounded-full"></span>
                            <span class="absolute  w-4 z-2 h-4 bg-secondary opacity-10 rounded-full"></span>
                        </span>
                        <div class="discover-title-sub ">
                            <p class="text-gray-500"><span id="DriverStatus" class="text-black">ON PAUSE</span> - <span>BUS B -101</span>
                            </p>

                        </div>
                    </div>
                    <div class="font-semibold  text-4xl mt-4"> <?php echo $_SESSION['user_name'] ?></div>
                    <div class="color-gray font-medium dashboard-driver-det">
                        <span>avash2063@gmail.com</span> ·
                        <span>License DL-2018-9341</span> ·
                        <span>412 trips</span> ·
                        <span>★ 4.9</span>
                    </div>
                </div>
                <div class="gap-2 main-control-dashboard" id="dashboard-control">

                    <button
                        class="no-underline w-fit text-gray-800 border font-semibold border-gray-400 py-2 px-3  border-solid rounded-full nav-link-item-hover hover-bg-ternary bg-body  font-medium  "
                        style="text-wrap: nowrap;">
                        Edit Profile
                    </button>
                    <button
                        class="no-underline w-fit text-gray-800 border font-semibold border-gray-400 py-2 px-3  border-solid rounded-full nav-link-item-hover hover-bg-ternary bg-body  font-medium  "
                        style="text-wrap: nowrap;">
                        Pause Shift
                    </button>

                    <button
                        class="no-underline w-fit text-gray-800 bg-secondary font-semibold  py-2 px-3 border-none rounded-full nav-link-item-hover text-white font-medium  "
                        style="text-wrap: nowrap;">
                        Go Online
                    </button>

                </div>
            </div>
            <div class="border-t-gray w-full"></div>

            <div class="gap-6" id="driver-dashboard-card-container">
                <div class=""></div>
                <div class=""></div>
                <div class=""></div>
                <div class=""></div>
            </div>

            <!-- <div class="bg-ternary w-full text-black gap-2" id="submission-approval-container">

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