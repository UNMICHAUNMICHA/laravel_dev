apt install composer


1. ติดตั้ง Docker และ Docker Compose
ถ้ายังไม่ได้ติดตั้ง Docker ให้ทำตามคำแนะนำนี้ก่อน:
🔗 ติดตั้ง Docker บน Ubuntu





2. สร้างโปรเจกต์ Laravel
คุณสามารถใช้ Laravel ใหม่หรือใช้โปรเจกต์ที่มีอยู่แล้ว

ถ้ายังไม่มี Laravel ให้รัน:
composer create-project --prefer-dist laravel/laravel my-laravel-app
cd my-laravel-app
หากยังไม่มี Composer ให้ติดตั้งก่อน:


sudo apt install composer -y






3. สร้างไฟล์ docker-compose.yml
สร้างไฟล์ docker-compose.yml ที่ root ของโปรเจกต์:


version: '3.8'

services:
  app:
    image: php:8.2-fpm
    container_name: laravel_app
    restart: always
    working_dir: /var/www
    volumes:
      - .:/var/www
    networks:
      - laravel

  web:
    image: nginx:alpine
    container_name: laravel_nginx
    restart: always
    ports:
      - "8000:80"
    volumes:
      - .:/var/www
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
    networks:
      - laravel

  db:
    image: mysql:8.0
    container_name: laravel_db
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel
      MYSQL_USER: laravel
      MYSQL_PASSWORD: secret
    ports:
      - "3306:3306"
    networks:
      - laravel
    volumes:
      - db_data:/var/lib/mysql

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: laravel_phpmyadmin
    restart: always
    environment:
      PMA_HOST: db
      MYSQL_ROOT_PASSWORD: root
    ports:
      - "8080:80"
    networks:
      - laravel

networks:
  laravel:

volumes:
  db_data:




  
4. สร้างไฟล์ nginx/default.conf
สร้างโฟลเดอร์ nginx และไฟล์ default.conf:

mkdir nginx
nano nginx/default.conf
เพิ่มโค้ด:

nginx
คัดลอก
แก้ไข
server {
    listen 80;
    index index.php index.html;
    root /var/www/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
กด CTRL + X → Y → Enter เพื่อบันทึก




5. อัปเดต .env
แก้ไขไฟล์ .env ของ Laravel ให้เชื่อมต่อ MySQL ที่เรากำหนด:


DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret




6. สร้างและรัน Docker Containers

docker compose up -d
🔹 -d = รันเป็น background (detached mode)

ตรวจสอบว่า Container ทำงานได้:
docker ps








7. ตั้งค่า Permission
ตั้งค่าการเขียนไฟล์ของ Laravel:

docker exec -it laravel_app chmod -R 777 /var/www/storage /var/www/bootstrap/cache





8. ตั้งค่า Laravel Key

docker exec -it laravel_app php artisan key:generate




9. เปิดใช้งาน Laravel
Laravel: http://localhost:8000
phpMyAdmin: http://localhost:8080 (User: root, Pass: root)

10. คำสั่งที่ใช้บ่อย
🔹 ดู log

docker compose logs -f
🔹 เข้าไปใน Container


docker exec -it laravel_app bash
🔹 รัน migration


docker exec -it laravel_app php artisan migrate
🔹 หยุดและลบ Container
        
docker compose down
✅ เสร็จแล้ว! 🎉 Laravel พร้อมใช้งานบน Docker 🚀

ต้องการปรับแต่งอะไรเพิ่มไหม? 😊
