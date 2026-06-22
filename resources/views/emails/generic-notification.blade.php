<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Motokloz Notification' }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="640" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,0.10);">
                    <tr>
                        <td style="background-color:#1a1a1a; padding:36px 40px; text-align:center;">
                            <img src="{{ asset('assets/images/darklogo.png') }}" alt="Motokloz" height="48" style="display:block; margin:0 auto 16px;">
                            <h1 style="margin:0 0 6px; color:#ff9d00; font-size:24px; font-weight:700; letter-spacing:1px;">
                                {{ $heading ?? ($title ?? 'Motokloz Notification') }}
                            </h1>
                            @if(!empty($subtitle))
                                <p style="margin:0; color:#aaaaaa; font-size:13px;">{{ $subtitle }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 40px 24px;">
                            @if(!empty($intro))
                                <p style="margin:0 0 24px; color:#555555; font-size:15px; line-height:1.7;">{{ $intro }}</p>
                            @endif

                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#fafafa; border-radius:12px; border-left:5px solid #ff9d00;">
                                <tr>
                                    <td style="padding:28px;">
                                        @foreach(($rows ?? []) as $row)
                                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:14px;">
                                                <tr>
                                                    <td width="170" style="vertical-align:top; color:#999999; font-size:12px; text-transform:uppercase;">{{ $row['label'] ?? '' }}</td>
                                                    <td style="color:#1a1a1a; font-size:15px; line-height:1.7; font-weight:600;">
                                                        {!! $row['html'] ?? e($row['value'] ?? '') !!}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @if(!empty($footer))
                        <tr>
                            <td style="padding:0 40px 36px; color:#999999; font-size:12px; line-height:1.6;">
                                {{ $footer }}
                            </td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
