<?php
include '../constants.php';
include "../components/input.php"
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your account - Khoja</title>
    <?php include 'headerLinks.php' ?>
</head>

<body>
    <section class="reg-log h-full reveal">
        <div class="flex w-full h-full reveal" style=" flex-grow: 1;">
            <div class="py-8 px-16 w-144 mx-auto ">
                <a href="<?php echo BASEURL ?>" class="no-underline flex justify-start items-center gap-2 mb-24 ">
                    <span
                        class="rounded-lg h-6 font-bold w-6 flex justify-center items-center  text-sm bg-black text-white">K</span>
                    <span class="font-bold text-base text-black">Khoja</span>
                </a>
                <div class=" py-8 border-b-gray flex flex-col gap-2">
                    <p class="text-gray-500 text-sm font-medium">TRAVELER ACCOUNT</p>
                    <p class="text-5xl font-bold text-black">Create your <br> Client ID.</p>
                    <p class="text-base color-ternary">Save places, book rides, earn points. Takes under a minute.</p>
                </div>
                <form class="py-6 gap-3 flex flex-col reveal" id="sign-up-form">
                    <div class="signup-form-control">
                        <?php

                        Input([
                            'id' => 'full_name',
                            'label' => 'Full Name',
                            'placeholder' => 'Avash Khadka'
                        ]);

                        Input([
                            'id' => 'handle',
                            'label' => 'Preferred handle',
                            'placeholder' => '@avasss'
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
                            'type' => 'number'
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
                        <?php Input(['id' => "cpassword", "label" => "Confirm Password", "placeholder" => "Minimum 8 characters"]) ?>
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
                <div class="text-center text-sm flex  justify-center gap-2">
                    <span>
                        <span class="color-ternary text-left"> Have an accound? </span>
                        <a href="<?php echo BASEURL ?>/pages/sign-in.php" class="text-black no-underline font-medium ">
                            Sign
                            in</a>
                    </span>
                    <span>
                        <span class="color-ternary text-left"> Driving a bus? </span>
                        <a href="<?php echo BASEURL ?>/pages/driver-login.php"
                            class=" no-underline font-medium color-secondary"> Register as Driver </a>
                    </span>

                </div>
            </div>
        </div>
        <div class="relative " style=" flex-grow: 1;">
            <div class="absolute inset-0 bg-black-75"></div> <img class=" inset-0  object-cover h-full w-full"
                src="<?php echo BASEURL ?>assets/images/signup-bg.jpg" alt="">
            <!-- <div class="absolute">asdfas</div> -->

        </div>
    </section>

    <?php include 'footerlinks.php' ?>
</body>

</html>