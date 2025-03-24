# 🛍️ E-Commerce Management System

## 📌 Project Overview
This is a **web-based e-commerce management system** designed for a **grocery store**.  
It allows **admins, vendors, and clients** to manage products, place orders, and track sales efficiently.

## 🚀 Features

### 🎯 **For Clients**
- Register and log in securely.
- Browse available products categorized by type.
- Add products to a shopping cart and place orders.
- Choose delivery type (home delivery or in-store pickup).
- Track orders and view purchase history.

### 🏩 **For Vendors**
- Log in to manage products (add, edit, delete).
- Track stock levels and receive alerts for low stock.
- Apply discounts or promotions to products.
- View a list of client orders.

### ⚙️ **For Administrators**
- Manage users (clients, vendors, and other admins).
- Supervise store operations and generate reports.
- View and analyze sales trends.

## 📂 Project Structure

```
/magasin_project
  ├── /controllers
  ├── /models
  ├── /views
  │   ├── /partials               # Shared components (header, footer)
  │   ├── /auth                   # Authentication pages
  │   ├── /admin                  # Admin dashboard and management
  │   ├── /vendeur                # Vendor dashboard and product management
  │   ├── /client                 # Client pages
  │   └── home.php                # Home page (product listing)
  ├── index.php                   # Redirects to home.php
  ├── /images                     # Stores uploaded product images
  ├── /uploads                    # Stores other uploaded files
  ├── .htaccess                   # Apache configuration file
  └── README.md                    # Documentation file
```

## 🛠️ Installation & Setup

### 1️⃣ **Clone the Repository**
```sh
git clone https://github.com/Derkaoui05/magasin_project.git
cd magasin_project
```

### 2️⃣ **Configure the Database**
- Import the SQL file **`database.sql`** into **MySQL**.
- Create a `.env` file for database credentials:
```sh
DB_HOST: localhost
DB_USER: root
DB_PASSWORD: yourpassword
DB_NAME: alimentaire
```

## 🐟 License
This project is open-source and available under the **MIT License**.

---

## 🎯 Next Steps
- ✅ Implement **cart functionality** and checkout system.
- ✅ Improve **UI/UX with Tailwind CSS**.
- 🖐️ Add **payment gateway integration**.
- 🖐️ Export **sales reports in PDF/Excel format**.

---

## 💌 Need Help?
Feel free to **open an issue** or contact me at **derkaouidev@gmail.com**. 🚀

