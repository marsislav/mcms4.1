<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 30px auto; background: #f9f9f9; border: 1px solid #ddd; border-radius: 6px; overflow: hidden; }
        .header { background: #2d2d2d; color: #fff; padding: 20px 30px; }
        .header h2 { margin: 0; font-size: 18px; }
        .body { padding: 25px 30px; }
        .field { margin-bottom: 15px; }
        .label { font-size: 12px; text-transform: uppercase; color: #888; font-weight: bold; }
        .value { margin-top: 3px; font-size: 15px; }
        .message-box { background: #fff; border-left: 4px solid #2d2d2d; padding: 12px 16px; margin-top: 5px; white-space: pre-wrap; }
        .footer { background: #f0f0f0; padding: 12px 30px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>📩 Ново съобщение от контактната форма</h2>
    </div>
    <div class="body">
        <div class="field">
            <div class="label">Изпращач</div>
            <div class="value">{{ $contactMessage->name }}</div>
        </div>
        <div class="field">
            <div class="label">Имейл адрес</div>
            <div class="value"><a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></div>
        </div>
        <div class="field">
            <div class="label">Съобщение</div>
            <div class="message-box">{{ $contactMessage->message }}</div>
        </div>
        <div class="field">
            <div class="label">Получено на</div>
            <div class="value">{{ $contactMessage->created_at->format('d.m.Y H:i') }}</div>
        </div>
    </div>
    <div class="footer">
        Това съобщение е генерирано автоматично от сайта. Можете да отговорите директно на {{ $contactMessage->email }}.
    </div>
</div>
</body>
</html>
