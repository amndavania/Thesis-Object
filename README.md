##  Cara clone

- Clone proyek 
- Buka aplikasi folder menggunakan perintah cd di cmd atau terminal Anda 
- Jalankan penginstalan komposer/ `composer install` di cmd atau terminal Anda
- Salin file `.env.example` ke `.env` di folder root. Anda bisa mengetik copy `.env.example` .env jika menggunakan command prompt Windows atau cp `.env.example` `.env` jika menggunakan terminal, Ubuntu
- Buka file `.env` Anda dan ubah nama basis data (DB_DATABASE) menjadi apa pun yang Anda miliki, bidang nama pengguna (DB_USERNAME) dan kata sandi (DB_PASSWORD) sesuai dengan konfigurasi Anda.
- Jalankan `php artisan key:generate`
- Jalankan `php artisan migrate`
- Jalankan `php artisan serve`
- Buka http://localhost:8000/

## Clone Project
    Clone your project
    Go to the folder application using cd command on your cmd or terminal
    Run composer install on your cmd or terminal
    Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
    Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
    Run php artisan key:generate
    Run php artisan migrate
    Run php artisan serve
    Go to http://localhost:8000/

