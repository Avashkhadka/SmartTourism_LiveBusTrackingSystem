<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoja - Avash khadka</title>
    <?php include '../../includes/headerLinks.php' ?>
</head>

<body>
    <div class="max-w-9xl mx-auto" id="driverAdmin">
        <?php RenderNavbar("overview") ?>
        <section class="flex flex-col gap-4 py-8 page-container">

            <div class=" head-container">
                <div class="flex flex-col w-full ">

                    <div class="font-semibold  text-4xl mt-4"> Platform Users</div>
                    <div class="color-gray font-medium dashboard-driver-det">
                        <span>Users using the khoja platform</span>
                    </div>
                </div>

            </div>
            <div id="platform_users_list_container">

            </div>
        </section>

        <?php Footer() ?>

    </div>


    <?php include '../../includes/footerlinks.php' ?>
</body>

</html>