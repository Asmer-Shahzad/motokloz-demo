<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Review</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="620" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1a1a1a; padding: 36px 40px; text-align:center;">
                            <img src="{{ $message->embed(public_path('assets/images/darklogo.png')) }}" alt="Motokloz" height="45" style="display:block; margin: 0 auto 14px;">
                            <h1 style="margin:0 0 6px; color:#ffffff; font-size:21px; font-weight:bold;">New Dealer Review Submitted</h1>
                            <p style="margin:0; color:#888888; font-size:13px;">Submitted via Motokloz Dealer profile</p>
                            <div style="margin:14px auto 0; width:36px; height:3px; background-color:#ff9d00; border-radius:2px; font-size:0; line-height:0;">&nbsp;</div>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 40px 8px;">

                            <p style="margin:0 0 28px; color:#555555; font-size:15px; line-height:1.7;">
                                A new user review was submitted for the dealer below on <strong style="color:#1a1a1a;">Motokloz</strong>.
                            </p>

                            <!-- Info Card -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#fdf8f1; border:1px solid #f3e3cc; border-radius:12px;">

                                <!-- Dealer Name -->
                                <tr>
                                    <td style="padding: 18px 22px; border-bottom: 1px solid #f3e3cc;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">D</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Dealer Name</span><br>
                                                    <strong style="color:#1a1a1a; font-size:16px;">{{ $dealer_name }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Dealer Number -->
                                <tr>
                                    <td style="padding: 18px 22px; border-bottom: 1px solid #f3e3cc;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">#</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Dealer Number</span><br>
                                                    <strong style="color:#1a1a1a; font-size:15px;">{{ $dealer_number }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Rating -->
                                <tr>
                                    <td style="padding: 18px 22px; border-bottom: 1px solid #f3e3cc;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">&#9733;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Rating</span><br>
                                                    <span style="font-size:18px; letter-spacing:2px;">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $rating)
                                                                <span style="color:#ff9d00;">&#9733;</span>
                                                            @else
                                                                <span style="color:#e0d4bc;">&#9733;</span>
                                                            @endif
                                                        @endfor
                                                    </span>
                                                    <strong style="color:#1a1a1a; font-size:13px; margin-left:6px;">({{ $rating }}/5)</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- User Name -->
                                <tr>
                                    <td style="padding: 18px 22px; border-bottom: 1px solid #f3e3cc;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">U</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">User</span><br>
                                                    <strong style="color:#1a1a1a; font-size:15px;">{{ $name }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- User Email -->
                                @if(!empty($email))
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
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">User Email</span><br>
                                                    <a href="mailto:{{ $email }}" style="color:#1a1a1a; font-size:15px; font-weight:bold; text-decoration:none;">{{ $email }}</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif

                                <!-- User Review -->
                                <tr>
                                    <td style="padding: 18px 22px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:top;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">&#9998;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:top; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">User Review</span><br>
                                                    <span style="color:#444444; font-size:14px; line-height:1.7;">{{ $comment }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>

                            <!-- Submitted At -->
                            <p style="margin:14px 4px 0; color:#999999; font-size:12px;">
                                Submitted at <strong style="color:#666666;">{{ $submittedAt }}</strong>
                            </p>

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