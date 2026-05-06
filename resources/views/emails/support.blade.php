<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type ?? 'Support Request' }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#222222; padding: 32px 40px; text-align:center;">
                            <img src="/assets/images/darklogo.png" alt="Motokloz" height="45" style="display:block; margin: 0 auto 12px;">
                            <h1 style="margin:0; color:#ff9d00; font-size:22px; font-weight:700; letter-spacing:1px;">
                                {{ strtoupper($type) }}
                            </h1>
                            @if(!empty($source))
                            <p style="margin:8px 0 0; color:#aaa; font-size:13px;">Source: <strong style="color:#ff9d00;">{{ $source }}</strong></p>
                            @endif
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 40px;">

                            <p style="margin:0 0 24px; color:#555; font-size:15px; line-height:1.6;">
                                A new <strong>{{ $type }}</strong> has been submitted via the Motokloz platform. Details are below.
                            </p>

                            <!-- Info Card -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9f9f9; border-radius:10px; border-left: 4px solid #ff9d00; overflow:hidden;">
                                <tr>
                                    <td style="padding: 24px 28px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">

                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #eeeeee;">
                                                    <span style="color:#999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Dealership Name</span><br>
                                                    <strong style="color:#222; font-size:15px;">{{ $dealership_name }}</strong>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #eeeeee;">
                                                    <span style="color:#999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Contact Name</span><br>
                                                    <strong style="color:#222; font-size:15px;">{{ $contact_name }}</strong>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #eeeeee;">
                                                    <span style="color:#999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Email</span><br>
                                                    <a href="mailto:{{ $contact_email }}" style="color:#ff9d00; font-size:15px; text-decoration:none;">{{ $contact_email }}</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #eeeeee;">
                                                    <span style="color:#999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Phone</span><br>
                                                    <a href="tel:{{ $contact_phone }}" style="color:#ff9d00; font-size:15px; text-decoration:none;">{{ $contact_phone }}</a>
                                                </td>
                                            </tr>

                                            @if(!empty($notes))
                                            <tr>
                                                <td style="padding: 10px 0; border-bottom: 1px solid #eeeeee;">
                                                    <span style="color:#999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Notes</span><br>
                                                    <span style="color:#444; font-size:14px; line-height:1.6;">{{ $notes }}</span>
                                                </td>
                                            </tr>
                                            @endif

                                            <tr>
                                                <td style="padding: 10px 0;">
                                                    <span style="color:#999; font-size:12px; text-transform:uppercase; letter-spacing:0.5px;">Submitted At</span><br>
                                                    <strong style="color:#222; font-size:14px;">{{ $submittedAt }}</strong>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Reply CTA -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:28px;">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $contact_email }}"
                                           style="display:inline-block; background-color:#ff9d00; color:#ffffff; text-decoration:none; padding:14px 36px; border-radius:50px; font-size:15px; font-weight:700;">
                                            Reply to {{ $contact_name }}
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f0f0f0; padding: 20px 40px; text-align:center; border-top: 1px solid #e0e0e0;">
                            <p style="margin:0; color:#aaa; font-size:12px;">
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
