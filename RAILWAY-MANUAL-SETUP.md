# 🚨 Railway Manual Setup Required

## ⚠️ Railway بيتجاهل nixpacks.toml start command!

---

## ✅ الحل الوحيد: إعدادات يدوية في Railway Dashboard

---

## 📋 الخطوات بالتفصيل:

### **1️⃣ افتح Railway Dashboard:**
```
https://railway.app/dashboard
```

### **2️⃣ اختار المشروع:**
- اضغط على اسم المشروع
- اختار **Backend Service** (الـ web service)

### **3️⃣ اذهب إلى Settings:**
- من القائمة الجانبية اضغط **Settings**

### **4️⃣ ابحث عن "Deploy" Section:**
- لف لتحت حتى تجد قسم **"Deploy"**

### **5️⃣ ابحث عن "Custom Start Command":**
قد تجدها بأسماء مختلفة:
- **Custom Start Command**
- **Start Command**
- **Override Start Command**
- **Custom Deploy Command**

### **6️⃣ الصق هذا الأمر:**
```bash
php artisan config:clear && php artisan cache:clear && sleep 10 && php artisan migrate:fresh --force && php artisan db:seed --force && php export_railway_data.php && php artisan serve --host=0.0.0.0 --port=$PORT
```

### **7️⃣ احفظ:**
- اضغط **Save** أو **Update**

### **8️⃣ أعد النشر:**
- اضغط **Redeploy** أو **Deploy**

---

## 🎯 بديل: استخدم Railway CLI

إذا لم تجد "Custom Start Command"، استخدم Railway CLI:

### **تثبيت Railway CLI:**
```bash
npm install -g @railway/cli
```

### **تسجيل الدخول:**
```bash
railway login
```

### **ربط المشروع:**
```bash
railway link
```

### **تشغيل Migration يدوياً:**
```bash
railway run php artisan migrate:fresh --force
railway run php artisan db:seed --force
railway run php export_railway_data.php
```

---

## 📊 ما يجب أن تراه بعد النجاح:

```log
✅ Configuration cleared
✅ Cache cleared
✅ Waiting for database (10 seconds)
✅ Running migrations...
✅ Migration table created successfully
✅ Migrated: 2024_01_18_000000_create_users_table
✅ Migrated: ... (all migrations)
✅ Seeding: UserSeeder
✅ Seeding: CategorySeeder
✅ Seeding: BrandSeeder
✅ Seeding: ProductSeeder
✅ Database Seeded!
✅ Exporting database...
✅ Export completed!
✅ Server running on [http://0.0.0.0:8080]
```

---

## 🆘 إذا استمرت المشكلة:

أرسل لي:
1. Screenshot من Settings → Deploy section
2. Deploy Logs الجديدة بعد تطبيق الإعدادات
