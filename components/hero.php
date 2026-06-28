<?php include 'components/card.php' ?>
<?php
function Hero()
{
    ?>
    <div class="py-60 px-12 reveal">
        <div class="flex flex-col">
            <div class="flex gap-2 items-center text-gray-600 text-xs  font-medium tracking-widest-long ">
                <span class="relative justify-center items-center flex w-4 h-4">
                    <span class="absolute  w-2 z-1 h-2 bg-secondary rounded-full"></span>
                    <span class="absolute  w-4 z-2 h-4 bg-secondary opacity-10 rounded-full"></span>
                </span>
                <p class="text-gray-500">V1</p>
                <span class=" w-1 z-1 h-1 bg-gray-500 opacity-30 rounded-full"></span>

                <p class="text-gray-500">NOW LIVE IN 1 CITIES</p>
            </div>
            <div class="hero-container mt-18">
                <div class="flex flex-col gap-6">

                    <div class="font-bold head-info "> The navigation <br>
                        layer for cities <br>
                        worth <span class="color-secondary">exploring</span>.</div>
                    <p class="text-gray-500 font-normal text-18 ">Tourity blends community-pinned places, live transit and
                        one-tap booking into a single spatial canvas. Built for travelers, drivers, and the cities that
                        connect them.</p>
                    <div class="flex gap-3 flex-wrap ">

                        <a href=""
                            class="py-4 px-8  text-white bg-black font-medium shadow rounded-full no-underline nav-link-item-hover">Open
                            the app</a>
                        <a href=""
                            class="py-4 px-8 no-underline text-gray-800 shadow border border-gray-200 border-solid nav-link-item-hover rounded-full hover-bg-ternary bg-white font-medium">See
                            it on the map <i class="fa-solid fa-arrow-right text-xs"></i> </a>
                    </div>
                    <div class="grid border-t border-b py-6 w-full mt-4 hero-count"
                        style="border:1px solid #e2e2e1; border-inline-color: transparent;">

                        <div class="flex flex-col px-4 py-2"><span
                                class="text-3xl  font-semibold mb-1">12,482</span><span
                                class="text-gray-500 text-xs">Place curated</span></div>
                        <div class="flex flex-col px-4 py-2"><span
                                class="text-3xl  font-semibold mb-1">3,218</span><span
                                class="text-gray-500 text-xs">Live vehicles</span></div>
                        <div class="flex flex-col px-4 py-2"><span
                                class="text-3xl  font-semibold mb-1">240</span><span
                                class="text-gray-500 text-xs">Cities online</span></div>
                        <div class="flex flex-col px-4 py-2 " style="border-color: transparent;"><span
                                class="text-3xl  font-semibold mb-1">4.9</span><span
                                class="text-gray-500 text-xs">Traveler rating</span></div>


                    </div>
                </div>
                <div class="relative bg-black rounded-3xl head-trackcont overflow-hidden">
                    <div class="absolute inset-0 z-1 ">
                        <span class="circle delay-3" id="bg-circle"
                            style="top: 10%; left:20%; background-color: var(--color-secondary);"></span>
                        <span class="circle" id="bg-circle" style="top: 70%; left:60%; background-color:#489af8;"></span>
                    </div>
                    <div class="absolute inset-0 z-2  backdrop-blur-60 grid-bg-layout "></div>
                    <div class="absolute inset-0 z-3  "></div>
                    <div class="absolute inset-0 z-4   bg-black-75  ">



                    </div>
                </div>
            </div>
            <div class="flex flex-wrap justify-center gap-16 mx-auto mt-10 hero-leg">
                <div class="font-bold  ">Kathmandu</div>
                <div class="font-bold  ">Bhaktapur</div>
                <div class="font-bold  ">Lalitpur</div>
                <div class="font-bold  ">Chitwan</div>
                <div class="font-bold  ">Pokhara</div>
                <div class="font-bold  ">Biratnagar</div>
            </div>
        </div>
    </div>
    <?php
}
?>