<?php include '../components/navbar.php' ?>
<?php include '../components/footer.php' ?>
<?php include '../config/constants.php' ?>
<?php include "../includes/authGuard.php"; ?>
<?php include '../components/input.php'; ?>
<?php include '../components/select.php'; ?>
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
]

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
        <?php RenderNavbar("discover") ?>
        <section class=" reveal flex flex-col gap-4 page-container">
            <div class="flex flex-col ">

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
                <div class="flex flex-col gap-8">
                    <div class="w-full h-1 bg-secondary mt-2"></div>
                    <div class="flex flex-col gap-6">
                        <?php
                        foreach ($fields as $el) {

                            ?>
                            <div id="pin-a-place-options" class="flex gap-4 items-start">
                                <div class="px-2 py-1 <?php if ($el['id'] == 1)
                                    echo "active-primary" ?> font-bold text-base text-center w-8 rounded-xl">
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
                <div>
                    <div class="px-4 py-8 flex flex-col gap-4 w-full" id="pin-a-place-menu-1">
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
                        <div class="flex gap-4 ">
                            <?php
                            Select([
                                "label" => "Category",
                                "id" => "place_category",
                                "option" => ["Nature", "Food", "Temple", "Viewpoint", "Lakes", "Markets"],
                                "dclass" => "flex-col w-full"
                            ]);

                            Input([
                                'id' => 'place_name',
                                'label' => 'Place Name',
                                'placeholder' => 'e.g. Hidden Waterfall on Kathmandu',
                                "dclass" => "flex-col w-full"
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="px-4 py-8 flex flex-col gap-4 hidden" id="pin-a-place-menu-2">d</div>
                    <div class="px-4 py-8 flex flex-col gap-4 hidden" id="pin-a-place-menu-3">d</div>
                    <div class="px-4 py-8 flex flex-col gap-4 hidden" id="pin-a-place-menu-4">d</div>
                </div>
            </div>

        </section>
        <?php Footer() ?>
    </div>

    </div>


    <?php include '../includes/footerlinks.php' ?>
</body>

</html>