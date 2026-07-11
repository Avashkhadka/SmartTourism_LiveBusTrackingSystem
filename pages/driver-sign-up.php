<?php
include '../config/constants.php';
include "../components/input.php";
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
                <div class="py-8 px-16 w-144 mx-auto reveal">
                    <a href="<?php echo BASEURL ?>" class="no-underline flex justify-start items-center gap-2 mb-24 ">
                        <span
                            class="rounded-lg h-6 font-bold w-6 flex justify-center items-center  text-sm bg-black text-white">K</span>
                        <span class="font-bold text-base text-black">Khoja</span>
                    </a>
                    <div class=" py-8 border-b-gray flex flex-col gap-2">
                        <p class="text-gray-500 text-sm font-medium">RIDERS ACCOUNT</p>
                        <p class="text-5xl font-bold text-black">Create your <br> Driver ID.</p>
                        <p class="text-base color-ternary">Drive safely, stay connected, build your reputation. Sign in and get back on the road in under a minute.</p>
                    </div>
                    <form class="py-6 gap-3 flex flex-col reveal" id="drsign-in-form">
                        <div class="signup-form-control">
                            <?php

                            Input([
                                'id' => 'full_name',
                                'label' => 'Full Name',
                                'placeholder' => 'Avash Khadka'
                            ]);

                            Input([
                                'id' => 'nationality',
                                'label' => 'Nationality',
                                'placeholder' => 'Nepali'
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

                            Input([
                                'id' => 'country',
                                'label' => 'Country',
                                'placeholder' => 'Nepal'
                            ]);

                            Input([
                                'id' => 'city',
                                'label' => 'City',
                                'placeholder' => 'Kathmandu'
                            ]);
                            ?>


                        </div>
                        <div class="flex flex-col gap-2">
                            <?php Input(['id' => "password", "label" => "Password", "placeholder" => "Minimum 8 characters"]) ?>
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
                        <button href="" type="submit"
                            class="mt-2 text-white no-underline py-2 px-4 rounded-full border-none gap-2 h-10 bg bgcolor-secondary text-base text-white font-medium text-base">
                            Create
                            an account </button>
                    </form>
                    <div class="text-center text-sm  justify-center gap-2 btn-switch-account">
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
            <div class="relative" >
                <div class="absolute inset-0 bg-black-75"></div> <img class=" inset-0 object-cover h-full w-full"
                    src="<?php echo BASEURL ?>assets/images/signup-bg.jpg" alt="">
                <!-- <div class="absolute">asdfas</div> -->

            </div>
        </div>
    </section>

    <script type="module" src="<?php echo BASEURL ?>/js/main.js"></script>
</body>

</html>