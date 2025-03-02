ขั้นตอนการ Run project

1.Open VS Code แล้วcloneด้วยลิงค์นี้ https://github.com/CodeUnvaluable/test-backend.git

2.Open Terminal แล้วรันคำสั่ง composer install

3.In Terminal รันคำสั่ง cp .env.example .env

4.สร้างtable ใน phpmyadmin ชื่อ cryptotrade

5.In Terminal รันคำสั่ง php artisan migrate:fresh --seed

ERD
