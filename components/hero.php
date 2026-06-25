<?php include 'components/card.php' ?>
<?php
function Hero()
{
    $heroCard1 = [
        "img" => "ssdf",
        "title" => "idont know",
        "desc" => "hihihi"
    ]
        ?>
    <div id="heroContainer" class="py-60 px-12">
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
                <div class="flex flex-col  gap-6">

                    <div class="text-8xl font-bold "> The navigation
                        layer for cities
                        worth <span class="color-secondary">exploring</span>.</div>
                    <p class="text-gray-500 font-normal text-18 ">Tourity blends community-pinned places, live transit and
                        one-tap booking into a single spatial canvas. Built for travelers, drivers, and the cities that
                        connect them.</p>
                    <div class="flex gap-2">

                        <a href=""
                            class="py-4 px-8  text-white bg-black font-medium shadow rounded-full no-underline nav-link-item-hover">Open
                            the app</a>
                        <a href=""
                            class="py-4 px-8 no-underline text-gray-800 shadow border border-gray-200 border-solid nav-link-item-hover rounded-full hover-bg-ternary font-medium">See
                            it on the map </a>
                    </div>
                </div>
                <div class="relative bg-black rounded-3xl h-128 overflow-hidden">
                    <div class="absolute inset-0 z-1 "> 
                        <span class="circle" id="bg-circle"
                            style="top: 60px; left:180px; background-color: var(--color-secondary);"></span>
                        <span class="circle" id="bg-circle"
                            style="top: 300px; left:400px; background-color:#489af8;"></span>
                        <!-- <span class="circle" id="bg-circle"
                            style="top: 170px; left:180px; background-color: var(--color-secondary);"></span> -->
                        </div>
                    <div class="absolute inset-0 z-2 w-full h-full backdrop-blur-60 grid-bg-layout "></div>
                    <div class="absolute inset-0 z-3 w-full h-full "></div>
                    <div class="absolute inset-0 z-4   bg-black-75  w-full h-full">
                        <!-- <?php Card("absolute left-4 border-solid border bg-border inline-flex flex-col rounded-xl p-3 text-white", $heroCard1, "top:20px; left:20px") ?> -->


                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>