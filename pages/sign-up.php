<?php
include '../constants.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your account - Khoja</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/csslibrary.css">
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
                <form class="py-6 gap-3 flex flex-col reveal">
                    <div class="signup-form-control">
                        <div class="flex flex-col gap-2 mb-2">
                            <label for="full_name" class="text-sm color-ternary">Full name</label>
                            <input type="text" id="full_name" placeholder="Avash Khadka">
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            <label for="handle" class="text-sm color-ternary">Preferred handle</label>
                            <input type="text" id="handle" placeholder="@avassss">
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            <label for="email" class="text-sm color-ternary">Email</label>
                            <input type="email" id="email" placeholder="your@email.com">
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            <label for="phone" class="text-sm color-ternary">Phone</label>
                            <input type="phone" id="phone" placeholder="+977 9800000002">
                        </div>
                        <div class="flex flex-col gap-2 mb-2">
                            <label for="city" class="text-sm color-ternary">City</label>
                            <input type="text" id="city" placeholder="Kathmandu">
                        </div>
                        <div class="flex flex-col gap-2 mb-2">

                            <label for="date" class="text-sm color-ternary">Date of birth</label>
                            <input type="date" id="date" max="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">

                        <label for="password" class="text-sm color-ternary">Password</label>
                        <input type="password" id="password" placeholder="Minimum 8 characters"
                            class="outline-none py-2 px-4 text-base border-gray bg-white rounded-lg">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="rememberMe"
                            class="outline-none text-base border-gray bg-white rounded-lg">
                        <label for="rememberMe" class="text-sm color-ternary ">I aggree to the Terms and Privacy
                            Policy</label>
                    </div>
                    <!-- <label for="password" class="text-sm color-ternary mt-2">Password</label>
                    <input type="password" id="password"
                        class="outline-none py-2 px-4 text-base border-gray bg-white rounded-lg"
                        placeholder="* * * * * * *  *">
                    <div class="flex justify-center items-center mt-2">
                        <div class="">
                            <input type="checkbox" id="rememberMe"
                                class="outline-none py-3 px-4 text-base border-gray bg-white rounded-lg">
                            <label for="rememberMe" class="text-sm color-ternary mt-2">Remember Me</label>
                        </div>
                        <a class="color-ternary ml-auto text-sm">Forgot?</a>
                    </div> -->
                    <button href=""
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
                src="<?php echo BASEURL?>assets/images/signup-bg.jpg" alt="">
            <!-- <div class="absolute">asdfas</div> -->

        </div>
    </section>
    
    <script type="module" src="<?php echo BASEURL ?>/js/main.js"></script>
</body>

</html>