# Email Verification Setup Guide

## ✅ What's Already Done

Your application is already configured for email verification:
- ✅ User model implements `MustVerifyEmail`
- ✅ Routes have `verified` middleware
- ✅ `.env` file updated with SMTP configuration

## 🔧 Setup Steps

### Step 1: Choose Your Email Provider

I've configured Gmail SMTP by default, but you can use any of these:

#### **Option A: Gmail (Recommended for Development)**
- Free and reliable
- Requires App Password (not your regular password)

#### **Option B: Mailtrap (Best for Testing)**
- Catches all emails (doesn't send to real users)
- Perfect for development/testing
- Free tier available at https://mailtrap.io

#### **Option C: SendGrid**
- Professional email service
- Free tier: 100 emails/day
- Better for production

#### **Option D: Mailgun**
- Another professional option
- Free tier available

---

## 📧 Gmail Setup (Most Common)

### 1. Enable 2-Factor Authentication on Your Gmail Account
1. Go to https://myaccount.google.com/security
2. Enable **2-Step Verification**

### 2. Generate App Password
1. Go to https://myaccount.google.com/apppasswords
2. Select **Mail** and **Windows Computer** (or Other)
3. Click **Generate**
4. Copy the 16-character password (e.g., `abcd efgh ijkl mnop`)

### 3. Update Your `.env` File
Replace these values in your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-actual-email@gmail.com
MAIL_PASSWORD=your-16-char-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-actual-email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Important:** 
- Use the **App Password**, NOT your regular Gmail password
- Remove any spaces from the app password

---

## 🧪 Mailtrap Setup (Best for Testing)

If you want to test without sending real emails:

### 1. Create Account
1. Go to https://mailtrap.io
2. Sign up for free account

### 2. Get SMTP Credentials
1. Go to **Email Testing** → **Inboxes**
2. Click on your inbox
3. Go to **SMTP Settings**
4. Copy the credentials

### 3. Update Your `.env` File
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@restoran.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🚀 After Configuration

### 1. Clear Configuration Cache
Run this command in your terminal:
```bash
php artisan config:clear
```

### 2. Test Email Sending
Create a test route to verify email is working:

**Add to `routes/web.php`:**
```php
Route::get('/test-email', function () {
    try {
        Mail::raw('Test email from Restoran app', function ($message) {
            $message->to('test@example.com')
                    ->subject('Test Email');
        });
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
```

Then visit: `http://localhost:8000/test-email`

### 3. Test User Registration
1. Register a new user at `/register`
2. Check your email inbox (or Mailtrap inbox)
3. Click the verification link
4. User should be verified and redirected

---

## 🔍 Troubleshooting

### Problem: "Connection could not be established"
**Solution:** 
- Check your internet connection
- Verify SMTP credentials are correct
- Make sure 2FA is enabled (for Gmail)
- Try port 465 with `MAIL_ENCRYPTION=ssl` instead of 587/tls

### Problem: "Authentication failed"
**Solution:**
- For Gmail: Use App Password, not regular password
- Double-check username and password
- Remove any spaces from the password

### Problem: Emails not arriving
**Solution:**
- Check spam/junk folder
- Verify `MAIL_FROM_ADDRESS` is valid
- For Gmail: Check "Less secure app access" settings
- Run `php artisan config:clear`

### Problem: "Address in mailbox given does not comply with RFC 2822"
**Solution:**
- Remove quotes from `MAIL_FROM_ADDRESS` in `.env`
- Change from `"email@example.com"` to `email@example.com`

---

## 📝 Configuration Examples

### Gmail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=myrestoran@gmail.com
MAIL_PASSWORD=abcdefghijklmnop
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=myrestoran@gmail.com
MAIL_FROM_NAME="Restoran App"
```

### Mailtrap Configuration (Testing)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=1a2b3c4d5e6f7g
MAIL_PASSWORD=1a2b3c4d5e6f7g
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@restoran.com
MAIL_FROM_NAME="Restoran App"
```

### SendGrid Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@restoran.com
MAIL_FROM_NAME="Restoran App"
```

---

## 🎨 Customizing Verification Email

### Option 1: Publish Email Templates
```bash
php artisan vendor:publish --tag=laravel-notifications
```

Then edit: `resources/views/vendor/notifications/email.blade.php`

### Option 2: Create Custom Notification
Create a custom verification notification class for more control over the email content.

---

## ✅ Verification Flow

1. **User registers** → Account created but `email_verified_at` is NULL
2. **Verification email sent** → Contains unique signed URL
3. **User clicks link** → Redirected to `/email/verify/{id}/{hash}`
4. **Email verified** → `email_verified_at` timestamp set
5. **User redirected** → To home page or intended destination

---

## 🔒 Security Notes

- ✅ Never commit `.env` file to Git (already in `.gitignore`)
- ✅ Use App Passwords, not regular passwords
- ✅ For production, use professional email service (SendGrid, Mailgun)
- ✅ Keep email credentials secure
- ✅ Verification links expire after 60 minutes (configurable in `config/auth.php`)

---

## 📚 Additional Resources

- [Laravel Email Verification Docs](https://laravel.com/docs/12.x/verification)
- [Laravel Mail Docs](https://laravel.com/docs/12.x/mail)
- [Gmail App Passwords](https://support.google.com/accounts/answer/185833)
- [Mailtrap Documentation](https://mailtrap.io/docs/)

---

## 🎯 Quick Start (TL;DR)

1. **Get Gmail App Password:**
   - Enable 2FA on Gmail
   - Generate App Password at https://myaccount.google.com/apppasswords

2. **Update `.env`:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   MAIL_FROM_NAME="Restoran"
   ```

3. **Clear cache:**
   ```bash
   php artisan config:clear
   ```

4. **Test:** Register a new user and check your email!

---

**Need Help?** Check the troubleshooting section above or Laravel documentation.
