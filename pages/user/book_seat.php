<?php
$availablebus = [1, 2, 3]


    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl mx-auto" id="bookBusContainer">
        <?php RenderNavbar("overview") ?>
        <section class="flex flex-col gap-4 py-8 page-container">
            <div class="reveal head-container ">
                <div class="flex flex-col w-full">
                    <div class="font-semibold  text-4xl mt-4">Book a seat</div>
                    <div class="color-gray text-sm font-medium mt-4">
                        Reserve in 30 seconds. Cancle free up to 1 hour before.
                    </div>
                </div>
            </div>

            <main class="mt-8 reveal grid-main">

                <div>
                    <div class="mb-2 text-lg font-semibold">
                        <span>Available Buses</span>
                    </div>

                    <div class="available_bus_container flex flex-col gap-2">
                        <?php foreach ($availablebus as $a) {

                            ?>

                        <?php } ?>
                    </div>



                </div>
                <div class="reveal rounded-2xl border-gray p-6 side-form">
                    <div class="color-gray text-xs font-base">ENTRY PRICE</div>
                    <div class="mt-2 flex justify-between">
                        <div class="text-black font-bold text-2xl" id="busEstEntryFeesl"></div>
                        <div
                            class=" flex justify-center items-center py-2 px-4 rounded-full bg-success-light text-success font-semibold text-xs">
                            Open now</div>
                    </div>
                    <div class="border-gray w-full my-4 rounded-full"></div>
                    <div>
                        <div class="flex justify-between my-4">
                            <div class="color-gray text-xs font-medium">ETA</div>
                            <div class="font-bold text-sm" id="busETAsl"></div>
                        </div>
                        <div class="flex justify-between my-4">
                            <div class="color-gray text-xs font-medium">Fare</div>
                            <div class="font-bold text-sm" id="busEstfairsl"></div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 mt-6">

                        <a href="<?php echo BASEURL . "pages/user/book_seat.php" ?>"
                            class="py-3 flex justify-center items-center  text-white bg-secondary gap-2 font-medium shadow rounded-full no-underline nav-link-item-hover">Book
                            seat now <i class="fa-solid fa-arrow-right"></i></a>



                    </div>
                </div>
            </main>
        </section>
        <?php Footer() ?>

    </div>


    <?php include '../../includes/footerlinks.php' ?>
</body>

</html>