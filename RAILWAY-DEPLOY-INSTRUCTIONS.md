# 🚀 Railway Deployment Instructions

## ⚠️ **مهم جداً: الإعدادات اليدوية في Railway**

---

## 📋 **خطوات الإعداد:**

### **1️⃣ روح على Railway Dashboard:**
- اختار الـ **Backend Service**
- اضغط على **Settings**

---

### **2️⃣ في قسم Build:**

**Build Command:**
```bash
composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache
```

---

### **3️⃣ في قسم Deploy:**

**Start Command:**
```bash
php artisan config:clear && php artisan cache:clear && sleep 10 && php artisan migrate:fresh --force && php artisan db:seed --force && php export_railway_data.php && php artisan serve --host=0.0.0.0 --port=$PORT
```

**أو استخدم الـ script:**
```bash
chmod +x start.sh && ./start.sh
```

---

### **4️⃣ Environment Variables (مهمة جداً):**

تأكد أن المتغيرات دي موجودة:

```env
# Database
DB_CONNECTION=mysql
DB_HOST=${{MySQL-4hFf.MYSQLHOST}}
DB_PORT=${{MySQL-4hFf.MYSQLPORT}}
DB_DATABASE=${{MySQL-4hFf.MYSQLDATABASE}}
DB_USERNAME=${{MySQL-4hFf.MYSQLUSER}}
DB_PASSWORD=${{MySQL-4hFf.MYSQLPASSWORD}}

# App
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY_HERE

# Railway
PORT=8080
```

---

### **5️⃣ في قسم Networking:**

تأكد أن **Health Check Path** هو:
```
/
```

---

## 🎯 **الترتيب الصحيح:**

1. **Build Phase:**
   - `composer install`
   - `config:cache`
   - `route:cache`

2. **Start Phase:**
   - `config:clear` ← ينضف الكاش القديم
   - `cache:clear` ← ينضف كل الكاش
   - `sleep 10` ← ينتظر الداتابيز
   - `migrate:fresh --force` ← يعمل Migration
   - `db:seed --force` ← يعمل Seeding
   - `php export_railway_data.php` ← يعمل Export
   - `serve` ← يشغل السيرفر

---

## 🔧 **إذا لم تنجح الطريقة:**

### **البديل: استخدام Railway CLI**

1. **نزل Railway CLI:**
```bash
npm install -g @railway/cli
```

2. **سجل دخول:**
```bash
railway login
```

3. **ربط المشروع:**
```bash
railway link
```

4. **شغل الـ Migration يدوياً:**
```bash
railway run php artisan migrate:fresh --force
railway run php artisan db:seed --force
railway run php export_railway_data.php
```

---

## 📊 **للتحقق من النجاح:**

بعد الـ Deployment، شوف الـ Logs، لازم تشوف:

```
=== Clearing Caches ===
=== Waiting for Database ===
=== Running Migration ===
Migration table created successfully.
=== Running Seeder ===
Seeding: UserSeeder
=== Starting Export ===
✓ Export completed!
=== Starting Server ===
Server running on [http://0.0.0.0:8080]
```

---

## 🆘 **إذا استمرت المشكلة:**

**الحل الأخير: Dockerfile مخصص**

سأقوم بإنشاء `Dockerfile` يضمن تنفيذ كل الخطوات.
