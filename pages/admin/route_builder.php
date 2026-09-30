<?php
$requiredDoc = [
    "driving" => ["Driving License", "driving_license", "Commercial / PSV license, both sides"],
    "bill" => ["Bill Book", "bill_book", "Vehicle registration certificate"],
    "insurance" => ["Insurance", "insurance", "Valid third-party or comprehensive cover"],

]

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
    <div class="max-w-9xl mx-auto " id="routeBuilder">
        <?php RenderNavbar("routeBuilder") ?>
        <section class="flex flex-col gap-4 py-8 page-container">

            <div class=" head-container">
                <div class="flex flex-col w-full ">

                    <div class="font-semibold  text-4xl mt-4"> Router Builder</div>
                    <div class="color-gray font-medium dashboard-driver-det">
                        <span>Click on the map to drop stops. Drag pins to fine-tune.</span>

                    </div>
                </div>
                <div class="gap-2 main-control-dashboard justify-end" id="route-builder-control">
                    <button
                        class="no-underline w-fit text-gray-800 border font-semibold border-gray-400 py-2 px-3  border-solid rounded-full nav-link-item-hover hover-bg-ternary bg-body  font-medium  "
                        style="text-wrap: nowrap;">
                        Undo
                    </button>
                    <button
                        class="no-underline w-fit text-gray-800 border font-semibold border-gray-400 py-2 px-3  border-solid rounded-full nav-link-item-hover hover-bg-ternary bg-body  font-medium  "
                        style="text-wrap: nowrap;">
                        Clear
                    </button>

                    <button
                        class="no-underline w-fit text-gray-800 bg-secondary font-semibold  py-2 px-3 border-none rounded-full nav-link-item-hover text-white font-medium  "
                        style="text-wrap: nowrap;">
                        Save Route
                    </button>

                </div>
            </div>
            <div>
                <?php
                Input([
                    'id' => 'route_name',
                    'label' => 'Route Name',
                    'placeholder' => 'Dakshinkali',
                    'dclass' => "w-full flex-col",
                ]);
                ?>
            </div>
            <div>
                <div id="routeBuilderMap" class="h-80 w-full rounded-2xl border-gray"></div>
                <div class="grid md:grid-cols-3 w-full sm:grid-cols-1 justify-between gap-4 mt-6" >
                    <div class="border-gray bg-white p-8 w-full flex flex-col gap-6 rounded-3xl">
                        <span>STOPS</span>
                        <span class="text-lg font-bold" id="totalStops">0</span>
                    </div>
                    <div class="border-gray bg-white p-8 w-full flex flex-col gap-6 rounded-3xl">
                        <span>DISTANCE</span>
                        <span class="text-lg font-bold" id="totalDistance">0.00 km</span>
                    </div>
                    <div class="border-gray bg-white p-8 w-full flex flex-col gap-6 rounded-3xl">
                        <span>EST. TRAVEL</span>
                        <span class="text-lg font-bold" id="estTravel">0 min</span>
                    </div>
                </div>
            </div>
            <div id="stopsLists" class="flex gap-4 flex-col">


            </div>
            <!-- <form id="route-builder-form">
                <div>



                </div>
                <div>

                </div>
            </form> -->

        </section>
        <?php Footer() ?>

    </div>


    <?php include '../../includes/footerlinks.php' ?>
</body>

</html>