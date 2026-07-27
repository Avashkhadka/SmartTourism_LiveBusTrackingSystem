<?php include '../components/navbar.php' ?>
<?php include '../components/footer.php' ?>
<?php include '../config/constants.php' ?>
<?php include "../includes/authGuard.php"; ?>
<?php include '../components/input.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl  mx-auto" id="view_page_container">
        <?php RenderNavbar("") ?>
        <section class=" reveal flex flex-col gap-2 place-container">
            <div class="place-header"><div>Discover</div> / <div>Temples</div> / <span>Mahabodhi Temple</span></div>
            <div class="view-location-image-container mt-2">
                <div class="mainImage-container">
                    <img src="../assets/images/signup-bg.jpg" class=" h-64 w-full object-cover " alt="">
                    <div class="location-image-overlay">
                        <div class="location-category-head"> LIVE . TEMPLES</div>
                        <div class="location-image-footer">
                            <div><span>01</span> / <span>06</span></div>
                            <div>
                                <div> <i class="fa-solid fa-angle-left"></i> </div>
                                <div> <i class="fa-solid fa-angle-right"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-secondary-container">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                    <img src="../assets/images/signup-bg.jpg" alt="">
                </div>
            </div>
            <main>
                <div>
                    <div class="color-secondary text-xs rounded-full font-bold py-2 px-4 w-24 text-center bg-secondary-25">Temple</div>
                    <div class="location-heading-titile">
                        Mahabodi Temple
                    </div>
                    <div class="location-heading-sub mt-2">
                        <span>rating</span><span>km away</span><span>time</span><span>crowd</span>
                    </div>
                    <div class="mt-6 text-lg font-bold mb-2">About this place</div>
                    <p class=" text-base">Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates dolorem corporis
                        quae error! Quas quidem magnam incidunt nihil libero minima blanditiis! Sit voluptates dolorum
                        incidunt vel repellendus doloribus perferendis natus!</p>
                    <div class="mt-6 text-lg font-bold mb-2">
                        what Special
                    </div>
                    <div class="">
                        <div>Best at sunrise</div>
                        <div>photospot</div>
                        <div>Easy access</div>
                        <div>Local Tip</div>
                    </div>
                    <div class="mt-6 text-lg font-bold mb-2 ">How to get there</div>
                    <div class="w-full h-80 bg-body"></div>
                </div>
                <div>
                    <div>ENTRY FORM</div>
                    <div>
                        <div>100 Rs</div>
                        <div>Open now</div>
                    </div>
                    <div>
                        <div>
                            <div>ETA</div>
                            <div>40min</div>
                        </div>
                        <div>
                            <div>Fare</div>
                            <div>Rs 40</div>
                        </div>
                    </div>
                    <button>Book seat now</button>
                    <button>Save Place</button>
                </div>
            </main>
        </section>
        <?php Footer() ?>
    </div>


    <?php include '../includes/footerlinks.php' ?>
</body>

</html>