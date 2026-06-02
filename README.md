# CareFund Backend API

Backend API untuk aplikasi CareFund menggunakan Laravel 13 (Sanctum).

## Struktur Response
Semua endpoint mengembalikan format JSON yang konsisten menggunakan `ApiResponse` Trait:
```json
{
    "success": true,
    "message": "Pesan opsional",
    "data": { ... }
}
```

## Dokumentasi API Otomatis
Project ini menggunakan **Scramble** untuk dokumentasi API otomatis. Anda dapat mengakses dokumentasi interaktif (Swagger-like) melalui:
- URL: `http://localhost:8000/docs/api`

## Daftar Endpoint API

### 🔐 Autentikasi (Public)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `POST` | `/api/register` | Pendaftaran user baru & generate token |
| `POST` | `/api/login` | Login user & generate token |

### 👤 User & Profil (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/me` | Ambil data profil user yang sedang login |
| `POST` | `/api/logout` | Hapus token akses aktif |
| `GET` | `/api/users` | List semua user dalam sistem |
| `GET/PUT/DELETE` | `/api/users/{id}` | Management detail user |
| `GET/POST` | `/api/user-identities` | Management dokumen identitas (KTP/Passport) |
| `GET` | `/api/user-sessions` | Monitoring riwayat login |

### 📋 Program & Kampanye (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET/POST` | `/api/programs` | Management program donasi utama |
| `GET/PUT/DELETE` | `/api/programs/{id}` | Detail program |
| `GET/POST` | `/api/program-campaigns` | Management kampanye penggalangan dana |
| `GET/POST` | `/api/program-categories` | Pengaturan kategori program |

### 💸 Transaksi & Distribusi (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET/POST` | `/api/donations` | Pencatatan donasi masuk |
| `GET/POST` | `/api/distributions` | Penyaluran dana ke penerima manfaat |
| `GET/POST` | `/api/payment-logs` | Log aktivitas transaksi pembayaran |
| `GET/POST` | `/api/distribution-updates` | Update progress penyaluran dana |

### 📚 Edukasi & Monitoring (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET/POST` | `/api/education-articles` | CMS Artikel edukasi filantropi |
| `GET/POST` | `/api/education-views` | Statistik pembaca artikel |
| `GET` | `/api/security-monitorings` | Log keamanan sistem |
| `GET/POST` | `/api/term-versions` | Management versi Syarat & Ketentuan |

---

## Cara Menjalankan Project
1. `composer install`
2. `php artisan key:generate`
3. `php artisan migrate`
4. `php artisan serve`

## Cara Menjalankan Test
Gunakan perintah berikut (tidak butuh server menyala):
```bash
php artisan test
```
