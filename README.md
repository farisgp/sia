## Cara Menjalankan Aplikasi

**Langkah-langkah untuk menjalankan aplikasi:**
- Clone Repository pada terminal menggunakan perintah berikut:     
``` git clone https://github.com/farisgp/sia.git ```
- Masuk ke direktori yang dibuat oleh perintah sebelumnya   
``` cd sia ```
- Install package composer yang diperlukan      
``` composer install ```
- Copy .env.example      
``` cp .env.example .env ```
- Generate Kunci Aplikasi     
``` php artisan key:generate ```
- Buat database MySQL baru dengan nama *“sia”* (sesuai dengan .env)        
- Database tidak pakai database migrate, tetapi sudah ada di folder database dengan nama sia.sql
- Import database sia.sql 
- Jalankan server website      
``` php artisan serve ```
- Sekarang web bisa diakses melalui http://localhost:8000      

Saya telah menyediakan beberapa akun demo dengan kredensial sebagai berikut:

- **Akun Role Admin:**    
Username: admin  
Password: 12345678

- **Akun Role Guru:**     
Username: andi     
Password: 12345678

- **Akun Role Siswa:**     
Username: budi     
Password: 12345678

- **Akun Role Kepala Sekolah:**     
Username: hubner     
Password: 12345678
