<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl mx-auto" id="live-map-container">
        <?php RenderNavbar("live-map") ?>
        <section class="relative">
            <div class="absolute z-9999 h-80 w-48 bg-body border-gray shadow-lg rounded-2xl flex flex-col p-4" style="top:1rem;left:1rem">
            <button class="bg-transparent py-2 border-gray" id="center-map">Center</button>        
        </div>
            <div id="liveMap" class="relative h-screen"></div>
        </section>
        <?php Footer() ?>
    </div>
    <?php include '../../includes/footerlinks.php' ?>
</body>

</html>