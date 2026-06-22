<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Subscriber</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1a1a1a; padding: 36px 40px 30px; text-align:center;">
                            <img src="{{ $message->embed(public_path('assets/images/darklogo.png')) }}" alt="Motokloz" height="45" style="display:block; margin: 0 auto 14px;">
                            <h1 style="margin:0; color:#ffffff; font-size:21px; font-weight:bold;">New subscriber alert</h1>
                            <div style="margin:14px auto 0; width:36px; height:3px; background-color:#ff9d00; border-radius:2px; font-size:0; line-height:0;">&nbsp;</div>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 40px 8px;">

                            <p style="margin:0 0 28px; color:#555555; font-size:15px; line-height:1.6;">
                                Someone just joined the list. A new user has subscribed to receive deals and updates from <strong style="color:#1a1a1a;">Motokloz</strong>.
                            </p>

                            <!-- Info Card -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#fdf8f1; border:1px solid #f3e3cc; border-radius:12px;">
                                <tr>
                                    <td style="padding: 18px 22px; border-bottom: 1px solid #f3e3cc;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">@</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Email Address</span><br>
                                                    <strong style="color:#1a1a1a; font-size:15px;">{{ $userEmail }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 18px 22px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">&#9201;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Subscribed At</span><br>
                                                    <strong style="color:#1a1a1a; font-size:14px;">{{ $subscribedAt }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 28px 40px 0;">
                            <div style="border-top:1px solid #ececec; font-size:0; line-height:0;">&nbsp;</div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#fafafa; padding: 22px 40px 26px; text-align:center;">
                            <p style="margin:0; color:#aaaaaa; font-size:12px; line-height:1.6;">
                                This is an automated notification from <strong style="color:#ff9d00;">Motokloz</strong> &mdash; Canada's motorized asset marketplace.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>