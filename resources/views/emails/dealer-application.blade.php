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
                            <img src="/assets/images/darklogo.png" alt="Motokloz" height="48"
                                 style="display:block; margin: 0 auto 16px;">
                            <h1 style="margin:0 0 6px; color:#ff9d00; font-size:24px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
                                New Dealer Application
                            </h1>
                            <p style="margin:0; color:#aaaaaa; font-size:13px; letter-spacing:0.3px;">
                                Submitted via Motokloz Platform
                            </p>
                        </td>
                    </tr>

                    <!-- Alert Banner -->
                    <tr>
                        <td style="background-color:#ff9d00; padding: 12px 40px; text-align:center;">
                            <p style="margin:0; color:#ffffff; font-size:13px; font-weight:600; letter-spacing:0.5px;">
                                &#128276; &nbsp; A new dealer has applied to join the Motokloz network
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 40px 20px;">

                            <p style="margin:0 0 28px; color:#555555; font-size:15px; line-height:1.7;">
                                The following dealership has submitted an application to become a listed dealer on
                                <strong style="color:#222;">Motokloz</strong>. Please review the details below and
                                follow up at your earliest convenience.
                            </p>

                            <!-- Main Info Card -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                   style="background-color:#fafafa; border-radius:12px; border-left: 5px solid #ff9d00; margin-bottom:24px;">
                                <tr>
                                    <td style="padding: 28px 28px 12px;">

                                        <p style="margin:0 0 18px; color:#ff9d00; font-size:11px; font-weight:700;
                                                  text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid #eeeeee; padding-bottom:10px;">
                                            Dealership Information
                                        </p>

                                        <!-- Dealership Name -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="160" style="vertical-align:top; padding: 6px 0;">
                                                    <span style="color:#999999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Dealership Name</span>
                                                </td>
                                                <td style="vertical-align:top; padding: 6px 0; border-bottom:1px solid #eeeeee;">
                                                    <strong style="color:#1a1a1a; font-size:16px;">{{ $dealership_name }}</strong>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Contact Name -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="160" style="vertical-align:top; padding: 6px 0;">
                                                    <span style="color:#999999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Contact Person</span>
                                                </td>
                                                <td style="vertical-align:top; padding: 6px 0; border-bottom:1px solid #eeeeee;">
                                                    <strong style="color:#1a1a1a; font-size:15px;">{{ $contact_name }}</strong>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Email -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="160" style="vertical-align:top; padding: 6px 0;">
                                                    <span style="color:#999999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Email Address</span>
                                                </td>
                                                <td style="vertical-align:top; padding: 6px 0; border-bottom:1px solid #eeeeee;">
                                                    <a href="mailto:{{ $contact_email }}"
                                                       style="color:#ff9d00; font-size:15px; text-decoration:none; font-weight:600;">
                                                        {{ $contact_email }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Phone -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="160" style="vertical-align:top; padding: 6px 0;">
                                                    <span style="color:#999999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Phone Number</span>
                                                </td>
                                                <td style="vertical-align:top; padding: 6px 0; border-bottom:1px solid #eeeeee;">
                                                    <a href="tel:{{ $contact_phone }}"
                                                       style="color:#ff9d00; font-size:15px; text-decoration:none; font-weight:600;">
                                                        {{ $contact_phone }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        @if(!empty($notes))
                                        <!-- Notes -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="160" style="vertical-align:top; padding: 6px 0;">
                                                    <span style="color:#999999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Notes</span>
                                                </td>
                                                <td style="vertical-align:top; padding: 6px 0; border-bottom:1px solid #eeeeee;">
                                                    <span style="color:#444444; font-size:14px; line-height:1.7;">{{ $notes }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                        @endif

                                        <!-- Submitted At -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="160" style="vertical-align:top; padding: 6px 0;">
                                                    <span style="color:#999999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Submitted At</span>
                                                </td>
                                                <td style="vertical-align:top; padding: 6px 0;">
                                                    <span style="color:#666666; font-size:14px;">{{ $submittedAt }}</span>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- CTA Buttons -->
                    <tr>
                        <td style="padding: 0 40px 36px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding-bottom:12px;">
                                        <a href="mailto:{{ $contact_email }}"
                                           style="display:inline-block; background-color:#ff9d00; color:#ffffff;
                                                  text-decoration:none; padding:14px 40px; border-radius:50px;
                                                  font-size:15px; font-weight:700; letter-spacing:0.3px;">
                                            &#9993; &nbsp; Reply to {{ $contact_name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <a href="tel:{{ $contact_phone }}"
                                           style="display:inline-block; background-color:#2a2a2a; color:#ffffff;
                                                  text-decoration:none; padding:12px 36px; border-radius:50px;
                                                  font-size:14px; font-weight:600; letter-spacing:0.3px;">
                                            &#128222; &nbsp; Call {{ $contact_phone }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 40px;">
                            <hr style="border:none; border-top:1px solid #eeeeee; margin:0;">
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f7f7f7; padding: 22px 40px; text-align:center; border-radius:0 0 14px 14px;">
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
