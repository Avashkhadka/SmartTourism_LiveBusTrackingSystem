<!DOCTYPE html>
<html>
<head>
    <title>QR Generator</title>
</head>
<body>

<h2>QR Code Generator</h2>

<div id="qrcode"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    new QRCode(document.getElementById("qrcode"), {
        text: "http://192.168.120.189/SmartTourism_LiveBusTrackingSystem/",
        width: 200,
        height: 200
    });
</script>

</body>
</html>



  <!-- <div class="py-6 gap-3 hidden dr-sign-form-content" id="dr-sign-vehicle">
                            <p class="text-2xl font-bold text-black">3. Vechile & Operations</p>

                            <div class="signup-form-control">
                                <?php

                                Input([
                                    'id' => 'vechicle_number',
                                    'label' => 'Vechicle Number',
                                    'placeholder' => 'B1 kha 3040',
                                ]);

                                Select([
                                    'id' => 'vechicle_type',
                                    'label' => "Vechicle Type",
                                    'option' => ['Ac Seater', 'Non-Ac Seater', "Mini Bus", "Tourist Coach"],

                                ]);
                                Input([
                                    'id' => 'seat_capacity',
                                    'label' => 'Seat Capacity',
                                    'type' => 'number',
                                    'placeholder' => "50",
                                ]);
                                Input([
                                    'id' => 'operating_city',
                                    'placeholder' => "Kathmandu",
                                    'label' => 'Operating City',
                                ]);
                                ?>
                                <div class="w-full">
                                    <?php
                                    Input([
                                        'id' => 'billbook_front_photo',
                                        'label' => 'Bill-Book Front Photo',
                                        'type' => 'file',
                                        'iclass' => 'hidden'
                                    ]);
                                    ?>
                                    <label for="billbook_front_photo" id="label_billbook_front_photo"
                                        class="file-name bg-white rounded-lg w-full p-4 flex justify-center item-center border-gray">Choose
                                        Front Photo</label>
                                </div>
                                <div class="w-full">
                                    <?php
                                    Input([
                                        'id' => 'billbook_back_photo',
                                        'label' => 'Bill-Book Back Photo',
                                        'type' => 'file',
                                        'iclass' => 'hidden'
                                    ]);
                                    ?>
                                    <label for="license_back_photo" id="label_license_back_photo"
                                        class="file-name w-full rounded-lg bg-white p-4 flex justify-center item-center border-gray">Choose
                                        Back Photo</label>
                                </div> -->

                        <!-- </div> -->