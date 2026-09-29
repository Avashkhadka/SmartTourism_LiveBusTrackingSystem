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
    <div class="max-w-9xl  " id="bus-registeration">
        <?php RenderNavbar("registerBus") ?>
        <section class="flex flex-col gap-4 py-8 page-container">

            <div class=" head-container">
                <div class="flex flex-col w-full ">

                    <div class="font-semibold  text-4xl mt-4"> Register a New Bus</div>
                    <div class="color-gray font-medium dashboard-driver-det">
                        <span>Submit for verification — usually approved within 24 hours.</span>

                    </div>
                </div>

            </div>

            <form id="bus-registartion-form">
                <div class="">
                    <div class="signup-form-control bg-white p-6 border-gray rounded-2xl">
                        <div class="flex w-full gap-4">

                            <?php

                            Input([
                                'id' => 'bus_number',
                                'label' => 'Bus Number',
                                'placeholder' => 'BR-01-AC-3201',
                                'dclass' => "w-full flex-col",
                            ]);

                            Select([
                                "label" => "Type",
                                "id" => "bus_type",
                                "option" => ["AC Seater", "Mini Bus", "AC Sleeper"],
                                "dclass" => "flex-col w-full color-gray"
                            ]);


                            ?>
                        </div>
                        <div class="flex w-full gap-4">

                            <?php
                            Input([
                                'id' => 'total_seats',
                                'label' => 'Total Seats',
                                'placeholder' => '32',
                                'dclass' => "w-full flex-col",
                            ]);

                            Input([
                                'id' => 'bus_fare',
                                'label' => 'Fare per km (Rs.)',
                                'type' => 'number',
                                'placeholder' => "5",
                                'dclass' => "w-full flex-col",
                            ]);
                            ?>
                        </div>
                        <div class="flex w-full gap-4">

                            <?php
                            Input([
                                'id' => 'insurance_number',
                                'label' => 'Insurance Number',
                                'placeholder' => '1024-231-24',
                                'type' => 'text',
                                'dclass' => "w-full flex-col",
                            ]);

                            Input([
                                'id' => 'bill_book_no',
                                'label' => 'Bill Book No',
                                'type' => 'text',
                                'placeholder' => "1234-05-1234",
                                'dclass' => "w-full flex-col",
                            ]);
                            ?>
                        </div>
                        <?php
                        Select([
                            "label" => "Operating Route",
                            "id" => "operating_route",
                            "option" => ["Dakshinkali", "Kalimati", "Kritipur"],
                            "dclass" => "flex-col w-full color-gray"
                        ]); ?>

                        <div>
                            <div class="mt-8">
                                <div class="text-lg text-black font-semibold">Add photos</div>
                                <div class="text-sm color-gray mt-1 ">Submit Bus Images</div>
                            </div>
                            <div class="pin-img-container gap-4">

                                <?php
                                for ($i = 0; $i < 6; $i++) {
                                    if (!$i == 0) {

                                        Image([
                                            "id" => "busimg-$i",
                                            "label" => "+ ",
                                            "lclass" => "h-48 "
                                        ]);
                                    } else {
                                        Image([
                                            "id" => "busimg-$i",
                                            "label" => "+ Cover ",
                                            "lclass" => "h-48 "
                                        ]);
                                    }

                                }
                                ?>
                            </div>
                        </div>


                        <div class="flex justify-between mt-6">
                            <button
                                class=" no-underline text-gray-800 bg-secondary border border-gray-200  py-2 px-8  border-solid rounded-full nav-link-item-hover "
                                id="register-submit" type="submit">
                                <span class="text-sm font-medium text-white">
                                    Sumbit <i class="fa-solid fa-arrow-right"></i>

                                </span>
                            </button>
                        </div>
                    </div>

                </div>
                <div>

                </div>
            </form>

        </section>
        <?php Footer() ?>

    </div>


    <?php include '../../includes/footerlinks.php' ?>
</body>

</html>