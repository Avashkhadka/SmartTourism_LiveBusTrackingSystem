<?php
include '../config/constants.php';
include "../components/input.php";
include "../components/select.php";
include "../includes/authGuard.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as a driver - Khoja</title>
    <?php include '../includes/headerLinks.php' ?>
</head>

<body>
    <section class=" w-full reveal">
        <div class="reg-log">
            <div class="flex  reveal">
                <div class="py-8 px-12 w-144 mx-auto reveal">
                    <a href="<?php echo BASEURL ?>" class="no-underline flex justify-start items-center gap-2 mb-24 ">
                        <span
                            class="rounded-lg h-6 font-bold w-6 flex justify-center items-center  text-sm bg-black text-white">K</span>
                        <span class="font-bold text-base text-black">Khoja</span>
                    </a>
                    <div class=" pt-8 pb-4 border-b-gray flex flex-col gap-2">
                        <p class="text-gray-500 text-sm font-medium">RIDERS ACCOUNT</p>
                        <p class="text-5xl font-bold text-black">Create your <br> Driver ID.</p>
                        <p class="text-base color-ternary">Drive safely, stay connected, build your reputation. Sign in
                            and get back on the road in under a minute.</p>
                        <div class="mt-4 flex relative item-center justify-between " id="list-dr-sign">
                            <span class="driver-sign-line"></span>
                            <span class="driver-sign-line-bg"></span>
                        </div>
                    </div>
                    <form class="flex flex-col reveal " id="dsign-in-form" enctype="multipart/form-data">
                        <div class="py-6 gap-3 flex flex-col dr-sign-form-content" id="dr-sign-personalIDentity">
                            <p class="text-2xl font-bold text-black">1. Personal Identity</p>

                            <div class="signup-form-control">
                                <?php

                                Input([
                                    'id' => 'full_name',
                                    'label' => 'Full Name',
                                    'placeholder' => 'Avash Khadka'
                                ]);

                                Input([
                                    'id' => 'date_of_birth',
                                    'label' => 'Date Of Birth',
                                    'type' => 'date',
                                ]);

                                Input([
                                    'id' => 'email',
                                    'label' => 'Email',
                                    'placeholder' => 'your@email.com',
                                    'type' => 'email'
                                ]);

                                Input([
                                    'id' => 'phone',
                                    'label' => 'Phone',
                                    'placeholder' => '+977 9800000002',
                                    'type' => 'tel'
                                ]);
                                ?>
                                <div class="w-full">
                                    <?php
                                    Input([
                                        'id' => 'id_front_photo',
                                        'label' => 'Government Id Front Photo',
                                        'type' => 'file',
                                        'iclass' => 'hidden'
                                    ]);
                                    ?>
                                    <label for="id_front_photo" id="label_id_front_photo"
                                        class="file-name w-full p-4 rounded-lg  bg-white flex justify-center item-center border-gray">Choose
                                        Front Photo</label>
                                </div>
                                <div class="w-full">
                                    <?php
                                    Input([
                                        'id' => 'id_back_photo',
                                        'label' => 'Government Id back Photo',
                                        'type' => 'file',
                                        'iclass' => 'hidden'
                                    ]);
                                    ?>
                                    <label for="id_back_photo" id="label_id_back_photo"
                                        class="file-name w-full rounded-lg bg-white p-4 flex justify-center item-center border-gray">Choose
                                        Back Photo</label>
                                </div>
                            </div>



                            <div class="flex flex-col gap-2">
                                <?php Input(['id' => "password", "label" => "Password", "placeholder" => "Minimum 8 characters"]) ?>
                            </div>
                            <div class="flex flex-col gap-2">
                                <?php Input(['id' => "cPassword", "label" => "Confirm Password", "placeholder" => "Minimum 8 characters"]) ?>
                            </div>


                        </div>
                        <div class="py-6 hidden gap-3 dr-sign-form-content" id="dr-sign-license">
                            <p class="text-2xl font-bold text-black">2. Driving License</p>

                            <div class="signup-form-control">
                                <?php

                                Input([
                                    'id' => 'license_number',
                                    'label' => 'License Number',
                                    'placeholder' => '1029-30-595959',
                                    'type' => 'number',
                                ]);

                                Input([
                                    'id' => 'lisence_type',
                                    'label' => 'License Type',
                                    'placeholder' => 'A,B,C'
                                ]);

                                Input([
                                    'id' => 'license_issue_date',
                                    'label' => 'Issue Date',
                                    'type' => 'date'
                                ]);
                                Input([
                                    'id' => 'license_expiry_date',
                                    'label' => 'Expiry Date',
                                    'type' => 'date'
                                ]);

                                Input([
                                    'id' => 'issuing_office',
                                    'label' => 'Issuing Office',
                                    'placeholder' => 'Ekantakuna',
                                ]);

                                Input([
                                    'id' => 'year_of_experience',
                                    'label' => 'Years of Experienct',
                                    'placeholder' => '8',
                                    'type' => 'number',
                                ]);
                                ?>
                                <div class="w-full">
                                    <?php
                                    Input([
                                        'id' => 'license_front_photo',
                                        'label' => 'Liicense Front Photo',
                                        'type' => 'file',
                                        'iclass' => 'hidden'
                                    ]);
                                    ?>
                                    <label for="license_front_photo" id="label_license_front_photo"
                                        class="file-name w-full rounded-lg bg-white p-4 flex justify-center item-center border-gray">Choose
                                        Front Photo</label>
                                </div>
                                <div class="w-full">
                                    <?php
                                    Input([
                                        'id' => 'license_back_photo',
                                        'label' => 'Liicense Back Photo',
                                        'type' => 'file',
                                        'iclass' => 'hidden'
                                    ]);
                                    ?>
                                    <label for="license_back_photo" id="label_license_back_photo"
                                        class="file-name w-full rounded-lg bg-white p-4 flex justify-center item-center border-gray">Choose
                                        Back Photo</label>
                                </div>

                            </div>
                            <div class="flex items-center gap-2">
                                <?php Input([
                                    'id' => "rememberMe",
                                    "label" => "I aggree to the Terms and Privacy Policy",
                                    "placeholder" => "Minimum 8 characters",
                                    "type" => "checkbox",
                                    "dclass" => "flex-row-rev"
                                ]) ?>


                            </div>
                        </div>
                      
                        <div class="flex w-full  gap-4 driver-driver-btn-container">

                            <button id="prevPage" type="button" disabled="true"
                                class=" no-underline py-2 w-full px-4 rounded-full border-none gap-2 h-10 bg-disabled text-black text-base font-medium ">
                                Prev</button>
                            <button id="nextPage" type="button"
                                class=" no-underline py-2 w-full px-4 rounded-full border-none gap-2 h-10 bg bgcolor-secondary text-base text-white font-medium">
                                Next </button>
                            <button id="dr-sign-up-submit" type="submit"
                                class=" no-underline hidden py-2 w-full px-4 rounded-full border-none gap-2 h-10 bg bgcolor-secondary text-base text-white font-medium">
                                Create an account </button>
                        </div>
                    </form>
                    <div class="text-center text-sm mt-4  justify-center gap-2 btn-switch-account">
                        <span>
                            <span class="color-ternary text-left"> Have an account? </span>
                            <a href="<?php echo BASEURL ?>pages/sign-in.php"
                                class="text-black no-underline font-medium ">
                                Sign
                                in</a>
                        </span>
                        <span>
                            <span class="color-ternary text-left"> You are a client? </span>
                            <a href="<?php echo BASEURL ?>pages/sign-up.php"
                                class=" no-underline font-medium color-secondary"> Register as Client </a>
                        </span>

                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-black-75"></div> <img class=" inset-0 object-cover h-full w-full"
                    src="<?php echo BASEURL ?>assets/images/signup-bg.jpg" alt="">
                <!-- <div class="absolute">asdfas</div> -->

            </div>
        </div>
    </section>

    <?php

    include '../includes/footerlinks.php'
        ?>
</body>

</html>