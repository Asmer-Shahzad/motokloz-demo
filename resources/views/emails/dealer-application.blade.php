<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Dealer Application</title>
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
                            <h1 style="margin:0 0 6px; color:#ffffff; font-size:23px; font-weight:bold; letter-spacing:0.5px;">
                                New Dealer Application
                            </h1>
                            <p style="margin:0; color:#888888; font-size:13px; letter-spacing:0.3px;">
                                Submitted via Motokloz Platform
                            </p>
                            <div style="margin:16px auto 0; width:36px; height:3px; background-color:#ff9d00; border-radius:2px; font-size:0; line-height:0;">&nbsp;</div>
                        </td>
                    </tr>

                    <!-- Alert Banner -->
                    <tr>
                        <td style="background-color:#fff1dc; padding: 13px 40px; text-align:center; border-bottom:1px solid #f3e3cc;">
                            <p style="margin:0; color:#995c00; font-size:13px; font-weight:bold; letter-spacing:0.3px;">
                                A new dealer has applied to join the Motokloz network
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 40px 8px;">

                            <p style="margin:0 0 28px; color:#555555; font-size:15px; line-height:1.7;">
                                The following dealership has submitted an application to become a listed dealer on
                                <strong style="color:#1a1a1a;">Motokloz</strong>. Please review the details below and
                                follow up at your earliest convenience.
                            </p>

                            <!-- Info Card -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#fdf8f1; border:1px solid #f3e3cc; border-radius:12px;">

                                <!-- Dealership Name -->
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
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Dealership Name</span><br>
                                                    <strong style="color:#1a1a1a; font-size:16px;">{{ $dealership_name }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Contact Name -->
                                <tr>
                                    <td style="padding: 18px 22px; border-bottom: 1px solid #f3e3cc;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">C</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Contact Person</span><br>
                                                    <strong style="color:#1a1a1a; font-size:15px;">{{ $contact_name }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Email -->
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
                                                    <a href="mailto:{{ $contact_email }}" style="color:#1a1a1a; font-size:15px; font-weight:bold; text-decoration:none;">{{ $contact_email }}</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Phone -->
                                <tr>
                                    <td style="padding: 18px 22px; {{ empty($notes) ? '' : 'border-bottom: 1px solid #f3e3cc;' }}">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">&#9742;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Phone Number</span><br>
                                                    <a href="tel:{{ $contact_phone }}" style="color:#1a1a1a; font-size:15px; font-weight:bold; text-decoration:none;">{{ $contact_phone }}</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                @if(!empty($notes))
                                <!-- Notes -->
                                <tr>
                                    <td style="padding: 18px 22px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:36px; vertical-align:middle;">
                                                    <table width="30" height="30" cellpadding="0" cellspacing="0" style="background-color:#fff1dc; border-radius:8px;">
                                                        <tr>
                                                            <td align="center" valign="middle" style="color:#ff9d00; font-size:14px; font-weight:bold;">&#9998;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="vertical-align:middle; padding-left:10px;">
                                                    <span style="color:#a08a6a; font-size:11px; letter-spacing:0.6px; text-transform:uppercase;">Notes</span><br>
                                                    <span style="color:#444444; font-size:14px; line-height:1.7;">{{ $notes }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif

                            </table>

                            <!-- Submitted At -->
                            <p style="margin:14px 4px 0; color:#999999; font-size:12px;">
                                Submitted at <strong style="color:#666666;">{{ $submittedAt }}</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- CTA Buttons -->
                    <tr>
                        <td style="padding: 24px 40px 8px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding-bottom:12px;">
                                        <a href="mailto:{{ $contact_email }}"
                                           style="display:inline-block; background-color:#ff9d00; color:#fff;
                                                  text-decoration:none; padding:13px 40px; border-radius:8px;
                                                  font-size:15px; font-weight:bold; letter-spacing:0.3px;">
                                            Reply to {{ $contact_name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <a href="tel:{{ $contact_phone }}"
                                           style="display:inline-block; background-color:#f4f4f4; color:#fff;
                                                  text-decoration:none; padding:11px 36px; border-radius:8px;
                                                  font-size:14px; font-weight:bold; letter-spacing:0.3px; border:1px solid #e5e5e5;">
                                            Call {{ $contact_phone }}
                                        </a>
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
                            <p style="margin:0 0 6px; color:#aaaaaa; font-size:12px; line-height:1.6;">
                                This is an automated notification from
                                <strong style="color:#ff9d00;">Motokloz</strong> &mdash;
                                Canada's motorized asset marketplace.
                            </p>
                            <p style="margin:0; color:#cccccc; font-size:11px;">
                                Please do not reply directly to this email.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>