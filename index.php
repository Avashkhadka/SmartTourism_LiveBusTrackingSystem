<?php include 'components/navbar.php' ?>
<?php include 'components/hero.php' ?>

<?php include_once 'constants.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/csslibrary.css">
</head>

<body>
    <div class="max-w-9xl mx-auto">
        <?php RenderNavbar("home") ?>
        <?php Hero() ?>
        <div id="heroContainer" class="py-12 px-12">
            <div class="flex flex-col gap-3">
                <!-- <div class="flex gap-2 items-center text-gray-600 text-xs  font-medium tracking-widest-long "> -->
                <p class="text-gray-500 text-sm font-medium">WHAT KHOJA DOES</p>
                <div class="page-head">
                    <div>One canvas for the city, the ride and the people who know it.</div>
                    <span>

                        <a
                            class=" no-underline text-gray-800 shadow border border-gray-200 border-solid nav-link-item-hover rounded-full hover-bg-ternary bg-white font-medium">Browse
                            the product <i class="fa-solid fa-arrow-right text-xs"></i></a>
                    </span>
                </div>
                <!-- </div> -->
            </div>
            <div class="index-page-grid">
                <div class="card">
                    <div class="relative bg-black rounded-3xl head-trackcont overflow-hidden">
                        <div class="absolute inset-0 z-1 ">
                            <span class="circle delay-3" id="bg-circle"
                                style="top: 10%; left:20%; background-color: var(--color-secondary);"></span>
                            <span class="circle" id="bg-circle"
                                style="top: 70%; left:60%; background-color:#489af8;"></span>
                        </div>
                        <div class="absolute inset-0 z-2  backdrop-blur-60 grid-bg-layout "></div>
                        <div class="absolute inset-0 z-3  "></div>
                        <div class="absolute inset-0 z-4   bg-black-75  ">



                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="p-4 border-gray card-img">d</div><div>asdfasd</div>
                </div>
                <div class="card">
                    <div class="p-4 border-gray card-img">d</div><div>asdfasd</div>
                </div>
                <div class="card">
                    <div class="p-4 border-gray card-img">d</div><div>asdfasd</div>
                </div>
                <div class="card">
                    <div class="p-4 border-gray card-img">d</div><div>asdfasd</div>
                </div>
                <div class="card">
                    <div class="p-4 border-gray card-img">d</div><div>asdfasd</div>
                </div>
            </div>
        </div>
        <div class="h-screen w-full"></div>
    </div>


</body>

</html>