<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm your registration</title>
    <style>
        /* Email-safe, inline-friendly styles */
        body { background:#f6f8fb; margin:0; padding:0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif; color:#2b2e3a; }
        .wrapper { width:100%; background:#f6f8fb; padding:30px 0; }
        .container { max-width:560px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 6px 20px rgba(18, 38, 63, 0.12); }
        .header { background:#0d6efd; padding:20px 24px; color:#fff; }
        .brand { margin:0; font-size:22px; font-weight:800; letter-spacing:0.2px; }
        .content { padding:28px 24px; }
        h1 { margin:0 0 10px; font-size:20px; color:#1d2433; }
        p { line-height:1.6; margin:0 0 14px; }
        .btn { display:inline-block; background:#0d6efd; color:#ffffff !important; text-decoration:none; padding:12px 18px; border-radius:10px; font-weight:700; letter-spacing:0.3px; }
        .btn:hover { opacity:0.92; }
        .muted { color:#6c757d; font-size:13px; }
        .footer { padding:18px 24px; text-align:center; color:#6c757d; font-size:12px; }
        .code-box { background:#f6f8fb; border:1px solid #e9edf5; padding:12px; border-radius:8px; word-break:break-all; font-family: Menlo, Consolas, Monaco, monospace; font-size:12px; }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="container">
        <div class="header">
          <h2 class="brand">{{ config('app.name', 'Restoran') }}</h2>
        </div>
        <div class="content">
          <h1>Confirm your registration</h1>
          <p>Hello{{ isset($name) ? ' ' . e($name) : '' }},</p>
          <p>Thanks for signing up. To finish creating your account, please confirm your email address.</p>
          <p style="margin:22px 0;">
            <a class="btn" href="{{ $confirmUrl }}" target="_blank" rel="noopener">Confirm my email</a>
          </p>
          <p class="muted">If the button doesn't work, copy and paste this URL into your browser:</p>
          <div class="code-box">{{ $confirmUrl }}</div>
          <p class="muted">This link will expire in 60 minutes.</p>
        </div>
        <div class="footer">
          <p>© {{ date('Y') }} {{ config('app.name', 'Restoran') }}. All rights reserved.</p>
        </div>
      </div>
    </div>
  </body>
 </html>


