<?php include '../components/navbar.php' ?>
<?php include '../components/footer.php' ?>
<?php include '../config/constants.php' ?>
<?php include "../includes/authGuard.php"; ?>
<?php include '../components/input.php'; ?>
<?php include '../components/select.php'; ?>
<?php include "../components/photo.php" ?>
<?php



$fields = [
    [
        "id" => 1,
        "name" => "Basics",
        "label" => "Name, type, vibe",
    ],
    [
        "id" => 2,
        "name" => "Location",
        "label" => "Pin on the map",
    ],
    [
        "id" => 3,
        "name" => "Photos",
        "label" => "Up to 6 images",
    ],
    [
        "id" => 4,
        "name" => "Details",
        "label" => "Hours, fees, tips",
    ],
];

$vibe = ["Romantic", "Family", "Solo", "Sunrise", "Sunset", "Quite", "Crowded", "Photo spot", "Free", "Offbeat", "LocalFav", "instragrammable"];

$amenities = ["Parking", "Restrooms", "Food nearby", "Wifi", "WheelChair access", "Pet friendly", "Guided tours", "ATM nearby", "First aid", "lockers", "Shaded seating", "Drinking water"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl mx-auto" id="contribute-page-container">
        <?php RenderNavbar("contribute") ?>
        <section class="flex flex-col gap-4 py-12 page-container">
            <div class="reveal   flex flex-col ">

                <div class="flex gap-2 items-center text-gray-600 text-xs font-medium tracking-widest-long ">
                    <span class="relative justify-center items-center flex w-4 h-4">
                        <span class="absolute  w-2 z-1 h-2 bg-secondary rounded-full"></span>
                        <span class="absolute  w-4 z-2 h-4 bg-secondary opacity-10 rounded-full"></span>
                    </span>
                    <div class="discover-title-sub">
                        <p class="text-gray-500">STEP <span id="startStep" class="text-black font-bold">1</span> of
                            <span id="totalStep" class="font-bold">4</span>
                        </p>
                        <p class="text-gray-500">EARN 50 PTS ON APPROVAL</p>
                    </div>
                </div>
                <div class="font-semibold  text-head mt-4">Pin a place.<span class="color-secondary">Shape the
                        map.</span></div>
                <div class="color-gray text-base font-normal mt-4">
                    Four short steps. Reviewed in ~24h.
                </div>
            </div>

            <div class="contirbute-form">
                <div class="flex flex-col gap-8 mb-6">
                    <div class="w-full h-1 bg-secondary mt-2"></div>
                    <div class="flex flex-col gap-6">
                        <?php
                        foreach ($fields as $el) {

                            ?>
                            <div  class="flex gap-4 items-start cursor-pointer pin-a-place-options">
                                <div class="px-2 py-1 <?php echo ($el['id'] == 1) ?  "active-primary":  "bg-white"
                                   ?>  border-gray num-pin font-bold text-base  text-center w-8 rounded-xl">
                                    <?php echo $el['id'] ?>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <div class="font-bold text-black text-sm"><?php echo $el['name'] ?></div>
                                    <div class="color-gray text-sm"><?php echo $el['label'] ?></div>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
                <form id="pin-place-menu-container" class="p-8 bg-white border-gray rounded-3xl  flex flex-col gap-8">
                    <div class="flex flex-col gap-4 w-full pin-place-menu">
                        <div>
                            <div class="text-lg text-black font-semibold">Tell us about the place</div>
                            <div class="text-sm color-gray mt-1 ">Start with the essentials. You can edit anything
                                later.</div>
                        </div>
                        <div>
                            <?php

                            Input([
                                'id' => 'place_name',
                                'label' => 'Place Name',
                                'placeholder' => 'e.g. Hidden Waterfall on Kathmandu'
                            ]);
                            ?>
                        </div>
                        <div class="gap-4 form-control">
                            <?php
                            Select([
                                "label" => "Category",
                                "id" => "place_category",
                                "option" => ["Nature", "Food", "Temple", "Viewpoint", "Lakes", "Markets"],
                                "dclass" => "flex-col w-full color-gray"
                            ]);

                            Input([
                                'id' => 'city_region',
                                'label' => 'City / region',
                                'placeholder' => 'Kathmandu, Lalitpur',
                                "dclass" => "flex-col w-full"
                            ]);
                            ?>
                        </div>
                        <div class="gap-4">
                            <?php
                            Input([
                                'id' => 'short_pitch',
                                'label' => 'Short Pitch',
                                'placeholder' => 'Two lines that would make a friend go.',
                                "dclass" => "flex-col w-full",
                                "iclass" => "h-20"
                            ]);
                            ?>
                        </div>
                        <div class="color-gray text-sm font-semibold">Vibe (Pick up to 4)</div>
                        <div class="flex gap-4 flex-wrap">
                            <?php
                            foreach ($vibe as $v) {
                                ?>
                                <div
                                    class="vibe-tags flex justify-center cursor-pointer items-center color-gray rounded-full py-2 px-4 font-medium text-sm">
                                    <?php echo $v ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>



                    </div>
                    <div class=" gap-4 w-full hidden pin-place-menu">
                        <div>
                            <div class="text-lg text-black font-semibold">Pin it on the map</div>
                            <div class="text-sm color-gray mt-1 ">Drag the pin or enter coordinate manually.</div>
                        </div>
                        <div id="pinmap" class="h-80 w-full rounded-2xl border-gray"></div>
                        <div class=" gap-4 form-control ">
                            <?php

                            Input([
                                'id' => 'latitude',
                                'label' => 'Latitude',
                                'placeholder' => '25.6024',
                                "dclass" => "flex-col w-full"
                            ]);
                            Input([
                                'id' => 'longitude',
                                'label' => 'Longitude',
                                'placeholder' => '85.1234',
                                "dclass" => "flex-col w-full"
                            ]);
                            ?>
                        </div>
                        <div class=" gap-4  form-control">
                            <?php

                            Input([
                                'id' => 'nearest_landmark',
                                'label' => 'Nearest Langmark',
                                'placeholder' => 'Taudha Lake',
                                "dclass" => "flex-col w-full"
                            ]);
                            Select([
                                "label" => "How to reach",
                                "id" => "how-to-reach",
                                "option" => ["Walking", "Bus  + Walk", "Trek"],
                                "dclass" => "flex-col w-full color-gray",
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class=" gap-4 w-full hidden pin-place-menu">
                        <div>
                            <div class="text-lg text-black font-semibold">Add photos</div>
                            <div class="text-sm color-gray mt-1 ">First photo becomes the cover. Original shots only -
                                no stock images.</div>
                        </div>
                        <div class="pin-img-container gap-4">

                            <?php
                            for ($i = 0; $i < 6; $i++) {
                                if (!$i == 0) {

                                    Image([
                                        "id" => "locimg-$i",
                                        "label" => "+ ",
                                        "lclass" => "h-48 "
                                    ]);
                                } else {
                                    Image([
                                        "id" => "locimg-$i",
                                        "label" => "+ Cover ",
                                        "lclass" => "h-48 "
                                    ]);
                                }

                            }
                            ?>
                        </div>
                        <div class="bg-secondary-light rounded-2xl flex gap-4 p-6">
                            <div class="flex justify-between items-center text-3xl">📷</div>
                            <div class="flex flex-col gap-2">
                                <div class="text-sm font-bold text-black">Photo Guidelines</div>
                                <div class="text-sm font-medium color-gray">Landscape prefered . No watermarks. You own
                                    the rights</div>
                            </div>
                        </div>

                    </div>
                    <div class=" gap-4 w-full hidden pin-place-menu">
                        <div>
                            <div class="text-lg text-black font-semibold">Visitors Details</div>
                            <div class="text-sm color-gray mt-1 ">Help fellow travelers plan their trip.</div>
                        </div>
                        <div class="gap-4 form-control">
                            <?php

                            Input([
                                'id' => 'best_time_to_visit',
                                'label' => 'Best time to visit',
                                'placeholder' => 'Sunrise Jan - Feb'
                            ]);
                            // Input([
                            //     'id' => 'ideal_duration',
                            //     'label' => 'Ideal Duration',
                            //     'placeholder' => '< 30 min'
                            // ]);
                            Select([
                                "id" => "opening_hours",
                                "label" => "Opening Hours",
                                "option" => ["Nature", "Food", "Temple", "Viewpoint", "Lakes", "Markets"],
                                "dclass" => "flex-col w-full color-gray"
                            ]);
                            ?>
                        </div>
                        <div class="gap-4 form-control">
                            <?php
                            Input([
                                "id" => "opening_hours",
                                "label" => "Opening Hours",
                                "dclass" => "flex-col w-full",
                                "type" => "time"
                            ]);
                            Input([
                                "id" => "closing_hours",
                                "label" => "Closing Hours",
                                "dclass" => "flex-col w-full",
                                "type" => "time"
                            ]);


                            ?>
                        </div>
                        <div>
                            <?php
                            Input([
                                "id" => "entry_fee",
                                "label" => "Entry Fee",
                                'placeholder' => 'Free . Rs 50 . Rs 200',
                                "dclass" => "flex-col w-full"
                            ]); ?>
                        </div>

                        <div class="color-gray text-sm font-semibold">Amenities</div>
                        <div class="flex gap-4 flex-wrap">
                            <?php
                            foreach ($amenities as $a) {
                                ?>
                                <div
                                    class="amenities-tags flex justify-center border-gray items-center color-gray cursor-pointer rounded-full py-2 px-4 font-medium text-sm">
                                    <?php echo $a ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="gap-4 form-control mt-4">
                            <?php
                            Input([
                                "id" => "your_name",
                                "label" => "Your name",
                                "dclass" => "flex-col w-full",
                                "value" => $_SESSION['user_name']

                            ]);
                            Input([
                                "id" => "email",
                                "label" => "Email",
                                "dclass" => "flex-col w-full",
                                "type" => "email",
                                "value" => $_SESSION['user_email']
                            ]);


                            ?>
                        </div>
                        <div><?php
                        Input([
                            "id" => "contribute_aggrement",
                            "label" => "I have visited this place and own the rights to the photos",
                            "dclass" => "flex flex-row-rev w-full justify-end",
                            "type" => "checkbox"
                        ]);
                        ?></div>

                    </div>
                    <div class="w-full bgcolor-ternary " style="height: 2px;"></div>
                    <div class="flex justify-between">
                        <div
                            class="no-underline text-gray-800 border border-gray-200  py-2 px-4  border-solid rounded-full nav-link-item-hover hover-bg-ternary" id="pin-back">
                            <span class="text-sm font-medium  ">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </span>
                        </div>
                        <div 
                            class="no-underline text-gray-800 bg-secondary border border-gray-200  py-2 px-4  border-solid rounded-full nav-link-item-hover " id="pin-next">
                            <span class="text-sm font-medium text-white">
                                Continue <i class="fa-solid fa-arrow-right"></i>

                            </span>
                        </div>
                        <button
                            class=" hidden no-underline text-gray-800 bg-secondary border border-gray-200  py-2 px-4  border-solid rounded-full nav-link-item-hover " id="pin-submit">
                            <span class="text-sm font-medium text-white">
                                Sumbit <i class="fa-solid fa-arrow-right"></i>

                            </span>
                        </button>
                    </div>
                </form>
            </div>

        </section>
        <?php Footer() ?>
    </div>

    </div>


    <?php include '../includes/footerlinks.php' ?>
</body>

</html>