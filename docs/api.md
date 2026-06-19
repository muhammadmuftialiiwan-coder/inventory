# Inventory System API v1
Base URL: http://localhost:8000/api/v1

## Autentikasi
* **POST /register** - Mendaftarkan akun pengguna baru.
* **POST /login** - Masuk ke sistem dan mendapatkan token akses API.

## Kategori Barang
* **GET /categories** - Menarik semua daftar kategori.
* **POST /categories** - Menambahkan kategori baru.
* **GET /categories/{id}** - Melihat detail satu kategori.
* **PUT /categories/{id}** - Memperbarui nama kategori.
* **DELETE /categories/{id}** - Menghapus kategori (Khusus Admin).

## Item Barang
* **GET /items** - Menarik semua daftar item barang.
* **POST /items** - Menambahkan item barang baru.
* **GET /items/{id}** - Melihat detail satu item barang.
* **PUT /items/{id}** - Memperbarui data spesifik item.
* **DELETE /items/{id}** - Menghapus item barang (Khusus Admin).

# Inventory API Documentation

## Register

POST /api/v1/register

### Body

```json
{
  "name": "Admin",
  "email": "admin@gmail.com",
  "password": "password"
}
```

### Response

```json
{
  "success": true,
  "message": "Register berhasil",
  "data": {
    ...
  }
}
```

---

## Login

POST /api/v1/login

### Body

```json
{
  "email": "admin@gmail.com",
  "password": "password"
}
```

### Response

```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "token": "..."
  }
}
```

---

## Get Items

GET /api/v1/items

Authorization: Bearer {token}

### Response

```json
{
  "success": true,
  "message": "Berhasil mengambil data item",
  "data": []
}
```


# API Documentation

## GET /api/v1/items

Mengambil semua item.

## GET /api/v1/items?category_id={id}

Description:
Filter item berdasarkan category.

Example:
GET /api/v1/items?category_id=1