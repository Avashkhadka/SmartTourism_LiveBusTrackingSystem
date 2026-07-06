<?php
include '../constants.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Khoja</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/csslibrary.css">
</head>

<body>
    <section class="reg-log h-screen overflow-hidden ">
        <div class="flex w-full reveal" style=" flex-grow: 1;">
            <div class="py-6 px-16 w-144 mx-auto">
                <a href="<?php echo BASEURL ?>" class="no-underline flex justify-start items-center gap-2 mb-24 ">
                    <span
                        class="rounded-lg h-6 font-bold w-6 flex justify-center items-center  text-sm bg-black text-white">K</span>
                    <span class="font-bold text-base text-black">Khoja</span>
                </a>
                <div class=" py-4 border-b-gray flex flex-col gap-2">
                    <p class="text-gray-500 text-sm font-medium">WHAT KHOJA DOES</p>
                    <p class="text-5xl font-bold text-black">Sign in.</p>
                    <p class="text-base color-ternary">Pick up your trips, saved places and live routes</p>
                   
                </div>
                <form class="py-4 flex flex-col gap-2 reveal ">

                    <label for="email" class="text-sm color-ternary">Email</label>
                    <input type="email" id="email"
                        class="outline-none py-2 px-4 text-base border-gray bg-white rounded-lg"
                        placeholder="your@email.com">
                    <label for="password" class="text-sm color-ternary mt-2">Password</label>
                    <input type="password" id="password"
                        class="outline-none py-2 px-4 text-base border-gray bg-white rounded-lg"
                        placeholder="* * * * * * *  *">
                    <div class="flex justify-center items-center mt-2">
                        <div class="">
                            <input type="checkbox" id="rememberMe"
                                class="outline-none py-3 px-4 text-base border-gray bg-white rounded-lg">
                            <label for="rememberMe" class="text-sm color-ternary mt-2">Remember Me</label>
                        </div>
                        <a href="" class="no-underline color-ternary ml-auto text-sm">Forgot?</a>
                    </div>
                    <button href=""
                        class="mt-2 text-white no-underline py-2 px-4 rounded-full border-none gap-2 h-10 bg bgcolor-secondary text-base text-white font-medium text-base ">Sign
                        in</button>
                </form>
                <div class="text-center text-sm flex flex-col">
                    <span class="color-ternary">New here?</span>
                    <div class="flex gap-2 justify-center items-center mt-4">

                        <a href="<?php echo BASEURL ?>/pages/sign-up.php"
                            class="text-black no-underline font-medium py-2 px-4 border-gray rounded-full">Create
                            an account</a>
                        <a href="<?php echo BASEURL ?>/pages/driver-login.php" class="text-black no-underline font-medium py-2 px-4  rounded-full bg-secondary text-white ">Be
                            a Driver</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative " style=" flex-grow: 1;">
            <div class="absolute inset-0 bg-black-75"></div> <img class=" object-cover h-full w-full"
                src="<?php echo BASEURL?>assets/images/signin-bg.jpg" alt="">
            <!-- <div class="absolute">asdfas</div> -->

        </div>
    </section>
    
    <script type="module" src="<?php echo BASEURL ?>/js/main.js"></script>
</body>

</html>