@echo off
cd /d "%~dp0"
set "PATH=C:\xampp\php;C:\xampp\mysql\bin;%PATH%"

echo ===================================================
echo   MENYIAPKAN DATABASE DAN MENJALANKAN WEBSITE 2
echo ===================================================

echo [1/3] Memastikan database MySQL 'company_website' tersedia...
mysql -u root -e "CREATE DATABASE IF NOT EXISTS company_website CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>nul

echo [2/3] Menjalankan migrasi dan seeder (tanpa produk dummy)...
php artisan migrate:fresh --seed
php artisan optimize:clear

echo [3/3] Menjalankan server di http://127.0.0.1:8000 ...
echo Login Admin: admin@chempro.co.id / Admin12345!
php artisan serve
pause
