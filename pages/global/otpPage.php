<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Khoja</title>
    <?php include '../../includes/headerLinks.php' ?>
</head>

<body>
    <?php RenderNavbar() ?>
    <section class="container email-container bg-white rounded-lg reveal" id="otp-container">
        <div class="flex">
            <a class=" no-underline flex gap-2 justify-center items-center">
                <span class="rounded-lg h-8 font-bold w-8 flex justify-center items-center text-white"
                    style=" background-color: #FF5A1F;">K</span>
                <span class="font-bold text-black">Khoja</span>
            </a>
        </div>
        <div class="flex flex-col mt-6 gap-4">
            <div class="flex gap-2 items-center text-gray-600 text-xs font-medium tracking-widest-long "
                style="color: #a35a2e;">
                <p>STEP 02 - PASSCODE</p>
            </div>
            <div class="flex flex-col gap-4">
                <p class="text-2xl font-bold">Confirm it's <span style="color:#ff5a1f">really you</span></p>
                <p class="text-gray-500 text-sm" style="max-width:46ch">Use the code sent to your mail <span class="text-base text-red-500" id="emailReadOnly"></span> to finish signing in to
                    Tourity.
                    It's valid for 10 minutes and
                    can only be used once.
                    If you didn't request it, you can safely ignore this email.</p>
            </div>
            <div class="rounded-2xl bg-black p-6 mt-4 mb-2">
                <div
                    class="flex gap-2 items-center text-white/80 text-xs font-bold text-gray-400 tracking-widest-long ">
                    <p>ENTER PASSCODE</p>
                </div>
                <div class="flex justify-between items-center py-4 font-bold" id="passcode-container">
                    <input type="number" class="passcode-digit" maxlength="1">
                    </input>
                    <input type="number" class="passcode-digit" maxlength="1">
                    </input>
                    <input type="number" class="passcode-digit" maxlength="1">
                    </input>
                    <input type="number" class="passcode-digit" maxlength="1">
                    </input>
                    <input type="number" class="passcode-digit" maxlength="1">
                    </input>
                    <input type="number" class="passcode-digit" maxlength="1">
                    </input>

                </div>
                <div class="flex justify-between items-center text-white/80 text-xs font-semibold text-gray-400 ">
                    <div>Expires on <span class="text-white" id="expiresOnText">
                        </span></div>
                    <div>Request ID - <span class="text-white" id="requestIdOnText">
                        </span></div>
                </div>
            </div>
            <div class="flex gap-4">
                <button class="w-full outline-none bg- border-gray text-white bg-gray-700 font-bold py-4 px-6 rounded-lg">
                    Resend Code
                </button>
                <button id="submit_otp" class="w-full outline-none border-none bg-secondary text-white font-bold py-4 px-6 rounded-lg">
                    Submit Code
                </button>
            </div>
            <div class="border-gray p-6 rounded-lg text-gray-600"
                style="background-color:#faf9f4;font-size:12.5px;color:##4d4d4d">
                <span class="font-bold ">Heads Up:</span><span>
                    Tourity will never ask for your code by phone, chat or email. If someone requests it, refuse and
                    report
                    it to <span class="color-secondary">security@khoja.travel.</span>
                </span>
            </div>
        </div>
    </section>
    <?php Footer() ?>
    <?php include '../../includes/footerLinks.php' ?>
</body>

</html>