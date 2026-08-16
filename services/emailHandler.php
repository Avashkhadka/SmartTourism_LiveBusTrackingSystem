
<?php

function sendTemplate($props)
{
    $code = $props['passcode'];
    $expiresOn = $props['expiresOn'];
    $requestId = $props['requestId'];

    ob_start();
?>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;margin:0;padding:0;background-color:#ffffff;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;">
    <tr>
        <td align="center" style="padding:0;margin:0;">

            <table role="presentation" width="640" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:640px;margin:0 auto;padding:0;background-color:#ffffff;border-collapse:collapse;font-family:Arial,Helvetica,sans-serif;">

                <!-- LOGO -->
                <tr>
                    <td style="padding:32px 7% 0 7%;">
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                            <tr>
                                <td width="32" height="32" align="center" valign="middle" style="width:32px;height:32px;background-color:#FF5A1F;border-radius:8px;color:#ffffff;font-size:16px;font-weight:700;text-align:center;vertical-align:middle;">
                                    K
                                </td>
                                <td style="padding-left:8px;color:#000000;font-size:16px;font-weight:700;">
                                    Khoja
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- CONTENT -->
                <tr>
                    <td style="padding:24px 7% 40px 7%;">

                        <!-- LABEL -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                            <tr>
                                <td style="padding:0;color:#a35a2e;font-size:12px;line-height:18px;font-weight:500;letter-spacing:2px;">
                                    ONE - TIME PASSWORD
                                </td>
                            </tr>
                        </table>

                        <!-- HEADING -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                            <tr>
                                <td style="padding:16px 0 0 0;color:#000000;font-size:24px;line-height:32px;font-weight:700;">
                                    Confirm it's <span style="color:#ff5a1f;">really you</span>
                                </td>
                            </tr>
                        </table>

                        <!-- DESCRIPTION -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                            <tr>
                                <td style="padding:16px 0 0 0;color:#6b7280;font-size:14px;line-height:20px;">
                                    Use the code below to finish signing in to Tourity. It's valid for 10 minutes and can only be used once. If you didn't request it, you can safely ignore this email.
                                </td>
                            </tr>
                        </table>

                        <!-- PASSCODE BOX -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-top:28px;background-color:#000000;border-collapse:separate;border-radius:16px;">
                            <tr>
                                <td style="padding:20px 3%;">

                                    <!-- PASSCODE TITLE -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                        <tr>
                                            <td style="padding:0;color:#9ca3af;font-size:12px;line-height:18px;font-weight:700;letter-spacing:2px;">
                                                YOUR PASSCODE
                                            </td>
                                        </tr>
                                    </table>

                                    <!-- DIGITS -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;table-layout:fixed;">
                                        <tr>

                                            <!-- DIGIT 1 -->
                                            <td width="16.666%" style="width:16.666%;padding:16px 3px 16px 0;">
                                                <table role="presentation" width="100%" height="64" cellpadding="0" cellspacing="0" border="0" style="width:100%;height:64px;background-color:#242426;border:1px solid #494949;border-radius:8px;border-collapse:separate;">
                                                    <tr>
                                                        <td align="center" valign="middle" style="height:64px;color:#ffffff;font-size:26px;line-height:30px;font-weight:700;text-align:center;vertical-align:middle;">
                                                            <?php echo htmlspecialchars($code[0]); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!-- DIGIT 2 -->
                                            <td width="16.666%" style="width:16.666%;padding:16px 3px;">
                                                <table role="presentation" width="100%" height="64" cellpadding="0" cellspacing="0" border="0" style="width:100%;height:64px;background-color:#242426;border:1px solid #494949;border-radius:8px;border-collapse:separate;">
                                                    <tr>
                                                        <td align="center" valign="middle" style="height:64px;color:#ffffff;font-size:26px;line-height:30px;font-weight:700;text-align:center;vertical-align:middle;">
                                                            <?php echo htmlspecialchars($code[1]); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!-- DIGIT 3 -->
                                            <td width="16.666%" style="width:16.666%;padding:16px 3px;">
                                                <table role="presentation" width="100%" height="64" cellpadding="0" cellspacing="0" border="0" style="width:100%;height:64px;background-color:#242426;border:1px solid #494949;border-radius:8px;border-collapse:separate;">
                                                    <tr>
                                                        <td align="center" valign="middle" style="height:64px;color:#ffffff;font-size:26px;line-height:30px;font-weight:700;text-align:center;vertical-align:middle;">
                                                            <?php echo htmlspecialchars($code[2]); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!-- DIGIT 4 -->
                                            <td width="16.666%" style="width:16.666%;padding:16px 3px;">
                                                <table role="presentation" width="100%" height="64" cellpadding="0" cellspacing="0" border="0" style="width:100%;height:64px;background-color:#242426;border:1px solid #494949;border-radius:8px;border-collapse:separate;">
                                                    <tr>
                                                        <td align="center" valign="middle" style="height:64px;color:#ffffff;font-size:26px;line-height:30px;font-weight:700;text-align:center;vertical-align:middle;">
                                                            <?php echo htmlspecialchars($code[3]); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!-- DIGIT 5 -->
                                            <td width="16.666%" style="width:16.666%;padding:16px 3px;">
                                                <table role="presentation" width="100%" height="64" cellpadding="0" cellspacing="0" border="0" style="width:100%;height:64px;background-color:#242426;border:1px solid #494949;border-radius:8px;border-collapse:separate;">
                                                    <tr>
                                                        <td align="center" valign="middle" style="height:64px;color:#ffffff;font-size:26px;line-height:30px;font-weight:700;text-align:center;vertical-align:middle;">
                                                            <?php echo htmlspecialchars($code[4]); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                            <!-- DIGIT 6 -->
                                            <td width="16.666%" style="width:16.666%;padding:16px 0 16px 3px;">
                                                <table role="presentation" width="100%" height="64" cellpadding="0" cellspacing="0" border="0" style="width:100%;height:64px;background-color:#242426;border:1px solid #494949;border-radius:8px;border-collapse:separate;">
                                                    <tr>
                                                        <td align="center" valign="middle" style="height:64px;color:#ffffff;font-size:26px;line-height:30px;font-weight:700;text-align:center;vertical-align:middle;">
                                                            <?php echo htmlspecialchars($code[5]); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>
                                    </table>

                                    <!-- EXPIRES / REQUEST ID -->
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                        <tr>
                                            <td align="left" style="padding:0;color:#9ca3af;font-size:11px;line-height:18px;font-weight:600;">
                                                Expires on <span style="color:#ffffff;"><?php echo htmlspecialchars($expiresOn); ?></span>
                                            </td>
                                            <td align="right" style="padding:0;color:#9ca3af;font-size:11px;line-height:18px;font-weight:600;">
                                                Request ID-<span style="color:#ffffff;"><?php echo htmlspecialchars($requestId); ?></span>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>

                        <!-- WARNING -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-top:16px;border:1px solid #e5e7eb;border-radius:8px;background-color:#faf9f4;border-collapse:separate;">
                            <tr>
                                <td style="padding:20px;color:#4d4d4d;font-size:12.5px;line-height:18px;">
                                    <span style="font-weight:700;">Heads Up:</span>
                                    Tourity will never ask for your code by phone, chat or email. If someone requests it, refuse and report it to
                                    <span style="color:#FF5A1F;">security@khoja.travel</span>.
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

<?php
    return ob_get_clean();
}

