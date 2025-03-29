#  Student Management System

This is a **Laravel 10** based **Student Management CRUD** application that allows users to **create, read, update, and delete (CRUD)** student records.

## Features
- Add new students
- View student records in a DataTable
- Edit student details
- Delete student records with confirmation

---

## Installation & Setup

### **1. Clone the Repository**
```sh
 git clone https://github.com/manalisawant3107/StudentManagement.git
```

### **2. Install Dependencies**
```sh
composer install
```

### **3. Create `.env` File**
```sh
cp .env.example .env
```

### **4. Generate Application Key**
```sh
php artisan key:generate
```

### **5. Set Up Database**
- Open `.env` and configure the database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### **6. Run Migrations**
```sh
php artisan migrate
```

### **7. Seed Dummy Data (Optional)**
```sh
php artisan db:seed
```
## Troubleshooting

If you face any issues, run these commands:
```sh
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

