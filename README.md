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

## Daftar Endpoint API

### Autentikasi (Public)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `POST` | `/api/register` | Pendaftaran user baru |
| `POST` | `/api/login` | Login untuk mendapatkan token |

### User & Profil (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET` | `/api/me` | Ambil data profile user login |
| `POST` | `/api/logout` | Revoke token / Logout |
| `GET` | `/api/users` | List semua user |
| `GET/PUT/DELETE` | `/api/users/{id}` | Detail, Update, Hapus user |

### Program & Kampanye (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET/POST` | `/api/programs` | List & Create Program |
| `GET/PUT/DELETE` | `/api/programs/{id}` | CRUD Program |
| `GET/POST` | `/api/program-campaigns` | List & Create Kampanye |
| `GET/POST` | `/api/program-categories` | List & Create Kategori |

### Transaksi & Distribusi (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET/POST` | `/api/donations` | List & Create Donasi |
| `GET/POST` | `/api/distributions` | List & Create Distribusi |
| `GET/POST` | `/api/payment-logs` | List & Create Log Pembayaran |
| `GET/POST` | `/api/distribution-updates` | Update progress distribusi |

### Edukasi & Monitoring (Protected)
| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| `GET/POST` | `/api/education-articles` | CRUD Artikel Edukasi |
| `GET/POST` | `/api/education-views` | Log view artikel |
| `GET` | `/api/security-monitorings` | List log keamanan |

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
