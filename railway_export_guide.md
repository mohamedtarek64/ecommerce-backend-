# Railway Database Export Guide

## Method 1: Railway CLI (Recommended)

### Step 1: Install Railway CLI
```bash
# Install Railway CLI
npm install -g @railway/cli

# Or using curl
curl -fsSL https://railway.app/install.sh | sh
```

### Step 2: Login to Railway
```bash
railway login
```

### Step 3: Connect to your project
```bash
railway link
# Select your project when prompted
```

### Step 4: Export Database
```bash
# Connect to MySQL and export
railway connect mysql

# Or use mysqldump directly
railway run mysqldump -h $MYSQLHOST -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE > backup.sql
```

## Method 2: Direct Connection

### Step 1: Get Database Credentials
```bash
# Get database variables
railway variables
```

### Step 2: Export using mysqldump
```bash
# Export all data
mysqldump -h $MYSQLHOST -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE > railway_backup.sql

# Export only data (no structure)
mysqldump -h $MYSQLHOST -u $MYSQLUSER -p$MYSQLPASSWORD --no-create-info $MYSQLDATABASE > railway_data_only.sql

# Export specific tables
mysqldump -h $MYSQLHOST -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE users products_women products_men products_kids > specific_tables.sql
```

## Method 3: Using PHP Script (Already Created)

### Step 1: Upload export script to Railway
```bash
# Push the export script
git add export_database_data.php
git commit -m "Add database export script"
git push
```

### Step 2: Run export script on Railway
```bash
# SSH into Railway service
railway shell

# Run the export script
php export_database_data.php
```

## Method 4: Railway Dashboard Export

### Step 1: Access Railway Dashboard
1. Go to https://railway.app/dashboard
2. Select your project
3. Click on MySQL service

### Step 2: Use Built-in Tools
1. Click "Query" tab
2. Use SQL queries to export data
3. Download results as CSV/JSON

## Method 5: Automated Export Script

### Create a scheduled export script
```php
<?php
// railway_auto_export.php
require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Export and save to Railway persistent volume
$exportDir = '/app/storage/exports';
if (!File::exists($exportDir)) {
    File::makeDirectory($exportDir, 0755, true);
}

$timestamp = date('Y-m-d_H-i-s');
$exportFile = "{$exportDir}/railway_export_{$timestamp}.json";

// Your existing export logic here...
// (Same as export_database_data.php)

echo "Export saved to: {$exportFile}\n";
echo "File size: " . filesize($exportFile) . " bytes\n";
```

## Recommended Approach

For Railway, I recommend **Method 3** (PHP Script) because:
1. ✅ Already created and tested
2. ✅ Works with your existing Laravel setup
3. ✅ Can be run directly on Railway
4. ✅ Generates structured JSON output
5. ✅ Includes all your custom data

## Next Steps

1. Push the export script to Railway
2. Run it via Railway CLI or dashboard
3. Download the generated JSON file
4. Use the data for seeding or migration
