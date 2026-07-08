<?php include 'components/navbar.php' ?>
<?php include 'components/hero.php' ?>
<?php include 'components/footer.php' ?>

<?php include_once 'constants.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>

    <?php include 'pages/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl mx-auto">
        <?php RenderNavbar("home") ?>
        <?php Hero() ?>
        <section class="py-12 px-12 reveal mt-8">
            <div class="flex flex-col gap-3">
                <!-- <div class="flex gap-2 items-center text-gray-600 text-xs  font-medium tracking-widest-long "> -->
                <p class="text-gray-500 text-sm font-medium">WHAT KHOJA DOES</p>
                <div class="page-head">
                    <h3>One canvas for the city, the ride and the people who know it.</h3>
                    <span>

                        <a
                            class=" no-underline text-gray-800 border border-gray-200 border-solid nav-link-item-hover rounded-full hover-bg-ternary bg-white font-medium">Browse
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
                <?php

                for ($i = 0; $i < 5; $i++) {
                    ?>
                    <div class="card reveal ">
                        <div class="card-img">
                            <div class="p-4  border-gray ">🚗</div>
                        </div>
                        <div>Live transit — no more "5 minutes" lies.</div>
                        <div>Real GPS, live seat counts, honest ETAs. Buses move on the map, not in your imagination.</div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
        <section class="py-12 px-12 reveal">
            <div class="flex flex-col gap-3">
                <p class="text-gray-500 text-sm font-medium">HOW A SATURDAY LOOKS LIKE</p>
                <div class="page-head">
                    <div>
                        <h3>From "I'm bored" to
                            "I'm there" — in three taps.</h3>
                        <span class="flex my-4 color-gray fw-normal text-base ">
                            No tab-switching, no comparing apps. Discovery, transit and booking on a single canvas — the
                            way mapping should have worked from day one.

                        </span>
                        <div class="home-sec2-list reveal ">
                            <div>
                                <div>1</div>
                                <div>Open the map. See what's interesting around you.</div>
                            </div>
                            <div>
                                <div>2</div>
                                <div>
                                    Tap a place — get distance, live bus, and a seat price.</div>
                            </div>
                            <div>
                                <div>3</div>
                                <div>
                                    Book the ride. Watch your bus arrive in real time. </div>
                            </div>
                        </div>
                    </div>

                    <aside class="flex flex-col justify-between  border-gray rounded-xl overflow-hidden mb-2 reveal">
                        <div class="flex p-6 justify-between border-b-gray">
                            <div class="flex justify-center items-center gap-2 ">
                                <span
                                    class="rounded-lg h-6 font-bold w-6 flex justify-center items-center  text-sm bg-black text-white">K</span>
                                <span class="font-bold text-base">Trip: Sat 7:30 AM</span>

                            </div>
                            <div class="text-green-800 font-medium py-2 px-4 text-sm bg-green-100 rounded-full">
                                Confirmed</div>
                        </div>
                        <div class="p-6 flex flex-col gap-2 reveal ">
                            <div class="flex gap-2 items-center ">
                                <div class="w-4 h-4 bgcolor-secondary rounded-full"></div>
                                <div class="flex flex-col gap-1">
                                    <div class=" font-bold">Center Square</div>
                                    <div class="color-gray font-medium text-xs">25.2824N - 85.1234E</div>
                                </div>
                            </div>
                            <div class="w-full h-12 ml-2 border-l-gray"></div>
                            <div class="flex gap-2 items-center">
                                <div class="w-4 h-4 bg-gray-600 rounded-full"></div>
                                <div class="flex flex-col gap-1">
                                    <div class=" font-bold">Sunrise Point</div>
                                    <div class="color-gray font-medium text-xs">25.2824N - 85.1234E</div>
                                </div>
                            </div>


                        </div>
                        <div class="flex px-6 py-4 justify-between bgcolor-ternary border-t-gray ">
                            <div>
                                <div class="color-gray text-sm mb-1">Total</div>
                                <div class="font-bold text-lg">$85.00</div>
                            </div>
                            <button
                                class="px-4 rounded-full border-none gap-2 h-10 bg bgcolor-secondary text-base text-white font-semibold">Track
                                ride <i class="fa-solid fa-arrow-right"></i> </button>
                        </div>
                    </aside>
                </div>

        </section>
        <section class="relative footer-section-container reveal">
            <div class="p-12 rounded-xl bg-black flex flex-col justify-center items-center text-white gap-8">

                <div class="flex gap-4">
                    <div class="relative flex items-center justify-center">
                        <div class="absolute w-4 h-4 bg-white rounded-full"></div>
                        <div class="absolute w-2 h-2 bg-secondary rounded-full"></div>
                    </div> <span class="text-sm">FREE TO START</span>
                </div>
                <div class="font-medium text-4xl">Open the Maps. The city does the rest </div>
                <div class="footer-sec gap-4">
                    <a href=""
                        class="text-white no-underline py-2 px-4 rounded-full border-none gap-2 h-10 bg bgcolor-secondary text-base text-white font-medium text-base">Open
                        the app</a>
                    <a href=""
                        class="text-white no-underline text-white no-underline py-2 px-4 rounded-full border-gray gap-2 h text-base text-white">See
                        live Map <br></a>
                </div>
            </div>
        </section>
        <?php Footer() ?>
    </div>

    <?php
  
    include 'pages/footerlinks.php'
        ?>

</body>

</html>