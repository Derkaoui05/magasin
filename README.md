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
  │   ├── AuthController.php      # Handles authentication (login, register)
  │   ├── ProductController.php   # Manages products (CRUD operations)
  │   ├── OrderController.php     # Handles order placement and tracking
  │   ├── UserController.php      # Manages user accounts
  │   └── CartController.php      # Manages shopping cart actions
  ├── /models
  │   ├── User.php                # User model (clients, vendors, admins)
  │   ├── Product.php             # Product model
  │   ├── Order.php               # Order model
  │   ├── Cart.php                # Cart model
  │   └── connection.php          # Database connection (PDO)
  ├── /views
  │   ├── /partials               # Shared components (header, footer)
  │   │   ├── header.php
  │   │   └── footer.php
  │   ├── /auth                   # Authentication pages
  │   │   ├── login.php
  │   │   └── register.php
  │   ├── /admin                  # Admin dashboard and management
  │   │   ├── dashboard.php
  │   │   ├── list_users.php
  │   │   └── sales_report.php
  │   ├── /vendeur                # Vendor dashboard and product management
  │   │   ├── dashboard.php
  │   │   ├── list_products.php
  │   │   ├── add_product.php
  │   │   └── edit_product.php
  │   ├── /client                 # Client pages (cart, orders)
  │   │   ├── dashboard.php
  │   │   ├── list_products.php
  │   │   ├── cart.php
  │   │   ├── checkout.php
  │   │   ├── track_order.php
  │   │   └── order_history.php
  │   └── home.php                # Home page (product listing)
  ├── index.php                   # Redirects to home.php
  ├── /images                     # Stores uploaded product images
  ├── /uploads                    # Stores other uploaded files
  ├── .env                        # Environment variables for database connection
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

