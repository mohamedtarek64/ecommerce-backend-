# 🚀 Railway Database Export Guide

## Method 1: Railway CLI (Recommended)

### Step 1: Install Railway CLI
```bash
npm install -g @railway/cli
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

### Step 4: Connect to MySQL and Export
```bash
# Connect to MySQL shell
railway connect mysql

# Then run MySQL commands:
mysqldump -u root -p railway > backup.sql
# Or export specific tables:
mysqldump -u root -p railway users products_women products_men products_kids > products_backup.sql
```

## Method 2: Direct MySQL Connection

### Step 1: Get Database Credentials from Railway
1. Go to Railway Dashboard
2. Click on MySQL service
3. Go to "Variables" tab
4. Copy these values:
   - `MYSQLHOST`
   - `MYSQLPORT`
   - `MYSQLUSER`
   - `MYSQLPASSWORD`
   - `MYSQLDATABASE`

### Step 2: Use mysqldump locally
```bash
mysqldump -h $MYSQLHOST -P $MYSQLPORT -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE > railway_backup.sql
```

## Method 3: PHP Export Script

### Create export script:
```php
<?php
// railway_export.php
$host = 'your_mysql_host';
$user = 'your_mysql_user';
$pass = 'your_mysql_password';
$db = 'your_database_name';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    $exportData = [];

    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT * FROM `$table`");
        $exportData[$table] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Exported $table: " . count($exportData[$table]) . " records\n";
    }

    file_put_contents('railway_export.json', json_encode($exportData, JSON_PRETTY_PRINT));
    echo "Export completed!\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
```

### Run the script:
```bash
php railway_export.php
```

## Method 4: Railway Dashboard Export

### Step 1: Access Railway Dashboard
1. Go to https://railway.app/dashboard
2. Select your project
3. Click on MySQL service

### Step 2: Use Built-in Tools
1. Click "Connect" button
2. Use MySQL Workbench or phpMyAdmin
3. Export data manually

## Recommended Approach

**Use Method 1 (Railway CLI)** because:
- ✅ Direct connection to Railway database
- ✅ No need for external credentials
- ✅ Works with Railway's internal network
- ✅ Can export all data or specific tables

## Quick Start

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login and connect
railway login
railway link

# Export database
railway connect mysql
mysqldump -u root -p railway > backup.sql
```

## Next Steps

1. Choose your preferred method
2. Get the database credentials
3. Run the export command
4. Download the backup file
5. Use the data for seeding or migration
