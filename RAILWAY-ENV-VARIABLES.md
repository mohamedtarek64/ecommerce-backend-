# 🚀 Railway Environment Variables Guide

## 📋 Required Environment Variables for Backend Service

### 🔗 Database Connection (MySQL)
Add these to your **Backend/Web Service** in Railway:

```env
DB_CONNECTION=mysql
DB_HOST=${{MySQL-4hFf.MYSQLHOST}}
DB_PORT=${{MySQL-4hFf.MYSQLPORT}}
DB_DATABASE=${{MySQL-4hFf.MYSQLDATABASE}}
DB_USERNAME=${{MySQL-4hFf.MYSQLUSER}}
DB_PASSWORD=${{MySQL-4hFf.MYSQLPASSWORD}}
```

> **Important:** Replace `MySQL-4hFf` with your actual MySQL service name from Railway.

---

### 🔧 Laravel Application Settings

```env
APP_NAME="E-Commerce API"
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_URL=https://your-backend-url.up.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

SESSION_DRIVER=cookie
SESSION_LIFETIME=120

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

---

### 🔐 Laravel Passport (OAuth Authentication)

```env
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=1
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=your-client-secret-here
```

---

### 💳 Stripe Payment (Optional)

```env
STRIPE_KEY=your_stripe_publishable_key
STRIPE_SECRET=your_stripe_secret_key
STRIPE_WEBHOOK_SECRET=your_stripe_webhook_secret
```

---

### 📧 Email Configuration (Optional)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🎯 How to Add Variables in Railway

### Method 1: Railway Dashboard UI
1. Open your Railway project
2. Click on **Backend Service** (web service)
3. Go to **Variables** tab
4. Click **+ New Variable**
5. Add each variable name and value
6. Click **Add** for each one
7. Service will auto-deploy after changes

### Method 2: Railway CLI
```bash
railway variables set DB_CONNECTION=mysql
railway variables set DB_HOST=\${{MySQL-4hFf.MYSQLHOST}}
railway variables set DB_PORT=\${{MySQL-4hFf.MYSQLPORT}}
# ... etc
```

---

## 🔍 How to Get MySQL Service Name

1. Open Railway Dashboard
2. Go to your MySQL service
3. Look at the service name at the top (e.g., "MySQL-4hFf", "MySQL-abc123")
4. Use that exact name in variable references: `${{SERVICE_NAME.VARIABLE}}`

---

## ✅ Verify Variables Are Set

Run this command locally:
```bash
railway run --service web php artisan config:show database
```

Or check in Railway Dashboard:
- Backend Service → Variables → Should see all DB_ variables

---

## 🔄 After Adding Variables

Railway will automatically:
1. Detect changes
2. Rebuild the service
3. Apply new environment variables
4. Restart the application

Monitor the deploy in **Deployments** tab.

---

## 🛠️ Troubleshooting

### Problem: "SQLSTATE[HY000] [2002] Connection refused"
**Solution:** Make sure `DB_HOST` uses the reference format:
```env
DB_HOST=${{MySQL-4hFf.MYSQLHOST}}
```
Not:
```env
DB_HOST=mysql.railway.internal  # ❌ Wrong
```

### Problem: "Variable not resolving"
**Solution:**
1. Check MySQL service name is correct
2. Make sure both services are in the same project
3. Use exact case-sensitive service name

### Problem: "APP_KEY not set"
**Solution:**
Run locally:
```bash
php artisan key:generate --show
```
Copy the output and add to Railway as `APP_KEY`

---

## 📊 Current Database Status

✅ **Tables Created:** 34 tables
✅ **Records Seeded:** 115 records
✅ **Connection:** Working via TCP Proxy
✅ **Export:** Available in `railway_exports/`

---

## 🎉 Done!

Your backend is now fully configured and connected to MySQL on Railway! 🚀
