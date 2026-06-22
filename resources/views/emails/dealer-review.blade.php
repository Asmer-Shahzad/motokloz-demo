<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Review</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="620" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,0.10);">
                    <tr>
                        <td style="background-color:#1a1a1a; padding:36px 40px; text-align:center;">
                            <h1 style="margin:0 0 6px; color:#ff9d00; font-size:24px; font-weight:700;">Motokloz User Submits Dealer Review</h1>
                            <p style="margin:0; color:#aaaaaa; font-size:13px;">Submitted via Motokloz dealer profile</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 40px 20px;">
                            <p style="margin:0 0 20px; color:#555555; font-size:15px; line-height:1.7;">
                                A new user review was submitted for the dealer below.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#fafafa; border-radius:12px; border-left:5px solid #ff9d00;">
                                <tr>
                                    <td style="padding:28px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="150" style="color:#999999; font-size:12px; text-transform:uppercase;">Dealer Name</td>
                                                <td style="color:#1a1a1a; font-size:16px; font-weight:700;">{{ $dealer_name }}</td>
                                            </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="150" style="color:#999999; font-size:12px; text-transform:uppercase;">Dealer #</td>
                                                <td style="color:#1a1a1a; font-size:16px; font-weight:700;">{{ $dealer_number }}</td>
                                            </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="150" style="color:#999999; font-size:12px; text-transform:uppercase;">Rating</td>
                                                <td style="color:#ff9d00; font-size:18px; font-weight:700;">{{ $rating }} / 5</td>
                                            </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="150" style="vertical-align:top; color:#999999; font-size:12px; text-transform:uppercase;">User</td>
                                                <td style="color:#1a1a1a; font-size:15px; font-weight:700;">{{ $name }}</td>
                                            </tr>
                                        </table>
                                        @if(!empty($email))
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                            <tr>
                                                <td width="150" style="vertical-align:top; color:#999999; font-size:12px; text-transform:uppercase;">User Email</td>
                                                <td style="color:#ff9d00; font-size:15px;">{{ $email }}</td>
                                            </tr>
                                        </table>
                                        @endif
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="150" style="vertical-align:top; color:#999999; font-size:12px; text-transform:uppercase;">User Review</td>
                                                <td style="color:#444444; font-size:14px; line-height:1.7;">{{ $comment }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 40px 36px; color:#999999; font-size:12px;">
                            Submitted at {{ $submittedAt }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
