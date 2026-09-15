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
    <div class="max-w-9xl  " id="drivers-document">
        <?php RenderNavbar("booking") ?>
        <section class="flex flex-col gap-4 py-8 page-container">

            <div class=" head-container">
                <div class="flex flex-col w-full ">
                    <div class="flex gap-2 items-center text-gray-600 font-medium tracking-widest-long py-2 px-2 w-fit rounded-full "
                        style="font-size: 10px;">
                        <span class="relative justify-center items-center flex w-4 h-4">
                            <span class="absolute  w-2 z-1 h-2 bg-secondary rounded-full"></span>
                            <span class="absolute  w-4 z-2 h-4 bg-secondary opacity-10 rounded-full"></span>
                        </span>
                        <div class="discover-title-sub ">
                            <p class="text-gray-500"><span id="DriverStatus" class="text-black">COMPLIANCE</span>
                            </p>

                        </div>
                    </div>
                    <div class="font-semibold  text-4xl mt-4"> My Documents</div>
                    <div class="color-gray font-medium dashboard-driver-det">
                        <span>Submit your license, bill book (RC) and insurance. Admin review usually finishes within 24
                            hours.</span>

                    </div>
                </div>

                <div class="flex gap-2 mt-2 justify-end ">
                    <span id="approved-document"
                        class="py-2 px-4 text-nowrap w-fit text-xs rounded-full border-success font-medium bg-success-light text-success">
                        0/3 approved
                    </span>

                    <span id="pending-document"
                        class="py-2 px-4 text-nowrap w-fit text-xs rounded-full border-danger font-medium bg-danger-light text-danger">
                        0 pending
                    </span>

                    <span id="rejected-document"
                        class="py-2 px-4 text-nowrap w-fit text-xs rounded-full border-warning font-medium bg-warning-light text-warning">
                        0 rejected
                    </span>
                </div>
            </div>

            <form id="document-verification-form">
                <div class="doc-grid-container">
                    <?php
                    foreach ($requiredDoc as $file) {

                        ?>
                        <div class="p-6 border-gray bg-white flex flex-col rounded-xl">

                            <div class="doc-status flex justify-end">--Missing</div>
                            <div>
                                <div>
                                    <p class="text-lg font-semibold"><?php echo $file[0] ?></p>
                                    <p class=" text-xs color-ternary "><?php echo $file[2] ?></p>
                                </div>
                                <div class="flex flex-col gap-3 mt-4">
                                    <?php
                                    Input([
                                        'id' => $file[1] . '_document_number',
                                        'label' => 'Document Number',
                                        'placeholder' => 'Enter Number',
                                        'type' => "number",
                                    ]);

                                    ?>
                                </div>
                                <div class="flex gap-2">

                                    <?php
                                    Image([
                                        "id" => $file[1] . "_front_photo",
                                        "label" => "Upload Front Photo",
                                        "lclass" => "h-32 "
                                    ]);
                                    Image([
                                        "id" => $file[1] . "_back_photo",
                                        "label" => "Upload Back Photo",
                                        "lclass" => "h-32 "
                                    ]);
                                    ?>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div
                    class="border-gray rounded-xl p-8 bg-white flex flex-col md:flex-row gap-4  justify-between items-center  mt-4">
                    <div class="w-full color-ternary text-sm">Files stay on this device in the prototype. Re-uploading a
                        document resets its status to
                        pending
                        review.</div>

                    <div class=" flex  w-full justify-start md:justify-end">
                        <button type="submit" class=" border-none outline-none py-3 px-8 text-white bg-secondary font-medium shadow rounded-full no-underline
                            nav-link-item-hover">Explore
                            Now</button>

                    </div>

                </div>
            </form>

        </section>
        <?php Footer() ?>

    </div>


    <?php include '../../includes/footerlinks.php' ?>
</body>

</html>