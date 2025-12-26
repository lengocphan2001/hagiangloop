# Hướng dẫn Deploy Laravel lên VPS Ubuntu - mon88.click

## 📋 Yêu cầu hệ thống

- Ubuntu 20.04/22.04 LTS
- Root hoặc sudo access
- Domain: mon88.click đã trỏ về IP VPS
- Tối thiểu 1GB RAM, 20GB storage

---

## 🔧 Bước 1: Cập nhật hệ thống và cài đặt dependencies

```bash
# Cập nhật hệ thống
sudo apt update && sudo apt upgrade -y

# Cài đặt các package cần thiết
sudo apt install -y software-properties-common curl wget git unzip
```

---

## 🐘 Bước 2: Cài đặt PHP 8.2 và các extensions

```bash
# Thêm repository PHP
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Cài đặt PHP 8.2 và các extensions cần thiết
sudo apt install -y php8.2 php8.2-fpm php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath php8.2-intl php8.2-readline

# Kiểm tra phiên bản PHP
php -v
```

---

## 🗄️ Bước 3: Cài đặt MySQL/MariaDB

```bash
# Cài đặt MySQL
sudo apt install -y mysql-server

# Bảo mật MySQL
sudo mysql_secure_installation

# Đăng nhập MySQL và tạo database
sudo mysql -u root -p
```

Trong MySQL console:

```sql
CREATE DATABASE hagiangloop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'hagiangloop_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON hagiangloop.* TO 'hagiangloop_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

**Lưu ý:** Thay `your_strong_password_here` bằng mật khẩu mạnh của bạn.

---

## 🎨 Bước 4: Cài đặt Composer

```bash
# Tải Composer installer
cd ~
curl -sS https://getcomposer.org/installer | php

# Di chuyển Composer vào thư mục global
sudo mv composer.phar /usr/local/bin/composer

# Cấp quyền thực thi
sudo chmod +x /usr/local/bin/composer

# Kiểm tra Composer
composer --version
```

---

## 📦 Bước 5: Cài đặt Node.js và NPM

```bash
# Cài đặt Node.js 20.x (LTS)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Kiểm tra phiên bản
node -v
npm -v
```

---

## 🌐 Bước 6: Cài đặt Nginx

```bash
# Cài đặt Nginx
sudo apt install -y nginx

# Khởi động và bật tự động khởi động cùng hệ thống
sudo systemctl start nginx
sudo systemctl enable nginx

# Kiểm tra trạng thái
sudo systemctl status nginx
```

---

## 📁 Bước 7: Tạo user và thư mục cho project

```bash
# Tạo user mới (nếu chưa có)
sudo adduser --disabled-password --gecos "" www-data

# Tạo thư mục cho project
sudo mkdir -p /var/www/mon88.click
sudo chown -R www-data:www-data /var/www/mon88.click
```

---

## 📥 Bước 8: Clone và cấu hình project

```bash
# Chuyển sang user www-data
sudo su - www-data

# Clone project (thay YOUR_REPO_URL bằng URL repository của bạn)
cd /var/www/mon88.click
git clone YOUR_REPO_URL .

# Hoặc nếu bạn upload code qua SCP/SFTP, giải nén vào /var/www/mon88.click

# Cài đặt dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Thoát khỏi user www-data
exit
```

---

## ⚙️ Bước 9: Cấu hình file .env

```bash
# Copy file .env.example
sudo cp /var/www/mon88.click/.env.example /var/www/mon88.click/.env

# Chỉnh sửa file .env
sudo nano /var/www/mon88.click/.env
```

Cấu hình các giá trị sau trong file `.env`:

```env
APP_NAME="Hà Giang Loop Tours"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://mon88.click

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hagiangloop
DB_USERNAME=hagiangloop_user
DB_PASSWORD=your_strong_password_here

# Cấu hình mail (tùy chọn)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@mon88.click"
MAIL_FROM_NAME="${APP_NAME}"

# Cấu hình filesystem
FILESYSTEM_DISK=local

# Session và Cache
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Sau đó tạo APP_KEY:

```bash
cd /var/www/mon88.click
sudo php artisan key:generate
```

---

## 🔐 Bước 10: Cấu hình quyền thư mục

```bash
# Cấp quyền cho storage và bootstrap/cache
sudo chown -R www-data:www-data /var/www/mon88.click
sudo chmod -R 755 /var/www/mon88.click
sudo chmod -R 775 /var/www/mon88.click/storage
sudo chmod -R 775 /var/www/mon88.click/bootstrap/cache
```

---

## 🗃️ Bước 11: Chạy migrations và seeders

```bash
cd /var/www/mon88.click
sudo php artisan migrate --force
sudo php artisan db:seed --force
```

---

## 🌐 Bước 12: Cấu hình Nginx

```bash
# Tạo file cấu hình Nginx
sudo nano /etc/nginx/sites-available/mon88.click
```

Thêm nội dung sau:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name mon88.click www.mon88.click;
    root /var/www/mon88.click/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Kích hoạt site:

```bash
# Tạo symbolic link
sudo ln -s /etc/nginx/sites-available/mon88.click /etc/nginx/sites-enabled/

# Xóa default site (nếu có)
sudo rm /etc/nginx/sites-enabled/default

# Kiểm tra cấu hình Nginx
sudo nginx -t

# Khởi động lại Nginx
sudo systemctl restart nginx
```

---

## 🔒 Bước 13: Cài đặt và cấu hình SSL với Let's Encrypt

```bash
# Cài đặt Certbot
sudo apt install -y certbot python3-certbot-nginx

# Lấy chứng chỉ SSL
sudo certbot --nginx -d mon88.click -d www.mon88.click

# Certbot sẽ tự động:
# - Tạo chứng chỉ SSL
# - Cập nhật cấu hình Nginx
# - Thiết lập auto-renewal

# Kiểm tra auto-renewal
sudo certbot renew --dry-run
```

Sau khi chạy certbot, file cấu hình Nginx sẽ được tự động cập nhật với SSL.

---

## ⏰ Bước 14: Cấu hình Cron Job cho Laravel Scheduler

```bash
# Mở crontab
sudo crontab -e -u www-data

# Thêm dòng sau (chạy mỗi phút)
* * * * * cd /var/www/mon88.click && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🔥 Bước 15: Cấu hình Firewall (UFW)

```bash
# Cho phép SSH (quan trọng!)
sudo ufw allow OpenSSH

# Cho phép HTTP và HTTPS
sudo ufw allow 'Nginx Full'

# Kích hoạt firewall
sudo ufw enable

# Kiểm tra trạng thái
sudo ufw status
```

---

## 🚀 Bước 16: Tối ưu hóa Laravel cho Production

```bash
cd /var/www/mon88.click

# Cache config
sudo php artisan config:cache

# Cache routes
sudo php artisan route:cache

# Cache views
sudo php artisan view:cache

# Cache events
sudo php artisan event:cache

# Optimize autoloader
sudo composer install --optimize-autoloader --no-dev
```

---

## 📊 Bước 17: Cấu hình PHP-FPM (Tùy chọn - tối ưu hiệu suất)

```bash
# Chỉnh sửa cấu hình PHP-FPM
sudo nano /etc/php/8.2/fpm/pool.d/www.conf
```

Tìm và chỉnh sửa các giá trị sau (tùy theo RAM của server):

```ini
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 500
```

Khởi động lại PHP-FPM:

```bash
sudo systemctl restart php8.2-fpm
```

---

## ✅ Bước 18: Kiểm tra và Testing

1. **Kiểm tra website:**
   ```bash
   curl -I https://mon88.click
   ```

2. **Kiểm tra SSL:**
   - Truy cập: https://www.ssllabs.com/ssltest/analyze.html?d=mon88.click

3. **Kiểm tra logs nếu có lỗi:**
   ```bash
   # Laravel logs
   sudo tail -f /var/www/mon88.click/storage/logs/laravel.log
   
   # Nginx error logs
   sudo tail -f /var/log/nginx/error.log
   
   # PHP-FPM logs
   sudo tail -f /var/log/php8.2-fpm.log
   ```

---

## 🔄 Các lệnh hữu ích sau khi deploy

### Clear cache khi cần:
```bash
cd /var/www/mon88.click
sudo php artisan cache:clear
sudo php artisan config:clear
sudo php artisan route:clear
sudo php artisan view:clear
```

### Rebuild cache:
```bash
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache
```

### Cập nhật code:
```bash
cd /var/www/mon88.click
sudo git pull origin main
sudo composer install --optimize-autoloader --no-dev
sudo npm install
sudo npm run build
sudo php artisan migrate --force
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache
```

### Kiểm tra permissions:
```bash
sudo chown -R www-data:www-data /var/www/mon88.click
sudo chmod -R 755 /var/www/mon88.click
sudo chmod -R 775 /var/www/mon88.click/storage
sudo chmod -R 775 /var/www/mon88.click/bootstrap/cache
```

---

## 🐛 Troubleshooting

### Lỗi 502 Bad Gateway:
```bash
# Kiểm tra PHP-FPM
sudo systemctl status php8.2-fpm
sudo systemctl restart php8.2-fpm

# Kiểm tra socket path trong Nginx config
ls -la /var/run/php/php8.2-fpm.sock
```

### Lỗi 500 Internal Server Error:
```bash
# Kiểm tra Laravel logs
sudo tail -f /var/www/mon88.click/storage/logs/laravel.log

# Kiểm tra permissions
sudo chmod -R 775 /var/www/mon88.click/storage
sudo chmod -R 775 /var/www/mon88.click/bootstrap/cache
```

### Lỗi Permission Denied:
```bash
sudo chown -R www-data:www-data /var/www/mon88.click
sudo chmod -R 755 /var/www/mon88.click
```

### SSL không hoạt động:
```bash
# Kiểm tra certbot
sudo certbot certificates

# Renew thủ công nếu cần
sudo certbot renew

# Kiểm tra Nginx config
sudo nginx -t
sudo systemctl restart nginx
```

---

## 📝 Checklist sau khi deploy

- [ ] Website truy cập được qua HTTPS
- [ ] SSL certificate hợp lệ
- [ ] Database kết nối thành công
- [ ] Migrations đã chạy
- [ ] Storage có quyền ghi
- [ ] Cron job đã cấu hình
- [ ] Firewall đã bật
- [ ] Logs không có lỗi
- [ ] Assets (CSS/JS) load đúng
- [ ] Images upload được

---

## 🔐 Bảo mật bổ sung (Khuyến nghị)

1. **Giới hạn truy cập admin:**
   - Cấu hình firewall chỉ cho phép IP cụ thể truy cập `/admin`

2. **Backup tự động:**
   ```bash
   # Tạo script backup
   sudo nano /usr/local/bin/backup-hagiangloop.sh
   ```
   
   Nội dung script:
   ```bash
   #!/bin/bash
   BACKUP_DIR="/backups/hagiangloop"
   DATE=$(date +%Y%m%d_%H%M%S)
   
   mkdir -p $BACKUP_DIR
   
   # Backup database
   mysqldump -u hagiangloop_user -p'your_password' hagiangloop > $BACKUP_DIR/db_$DATE.sql
   
   # Backup files
   tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/mon88.click
   
   # Xóa backup cũ hơn 7 ngày
   find $BACKUP_DIR -type f -mtime +7 -delete
   ```
   
   Thêm vào crontab:
   ```bash
   sudo crontab -e
   # Chạy backup mỗi ngày lúc 2h sáng
   0 2 * * * /usr/local/bin/backup-hagiangloop.sh
   ```

3. **Cài đặt fail2ban để chống brute force:**
   ```bash
   sudo apt install -y fail2ban
   sudo systemctl enable fail2ban
   sudo systemctl start fail2ban
   ```

---

## 📞 Hỗ trợ

Nếu gặp vấn đề trong quá trình deploy, kiểm tra:
1. Laravel logs: `/var/www/mon88.click/storage/logs/laravel.log`
2. Nginx logs: `/var/log/nginx/error.log`
3. PHP-FPM logs: `/var/log/php8.2-fpm.log`

---

**Chúc bạn deploy thành công! 🎉**

