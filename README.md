# 🛒 UMKM Salakan - E-Commerce Platform

![CodeIgniter 3](https://img.shields.io/badge/CodeIgniter-3.1.11-firebrick)
![PHP](https://img.shields.io/badge/PHP-%3E%3D5.6-blue)
![MySQL](https://img.shields.io/badge/Database-MySQL-orange)
![iPaymu](https://img.shields.io/badge/Payment-iPaymu-green)

Web-based E-Commerce platform designed to empower MSMEs (UMKM) in Salakan. This application connects local sellers with buyers, facilitating online transactions with integrated payment gateways.

## 🌟 Features

### 🛍️ For Buyers (User)

- **Browse Products:** Explore a wide range of local products.
- **Shopping Cart:** Add items to cart and manage orders.
- **User Profile:** Manage personal information and order history.
- **Reviews:** Rate and review purchased products.
- **Secure Payment:** Integrated with **iPaymu** for seamless transactions.

### 🏪 For Sellers (UMKM)

- **Shop Management:** Create and customize your online store.
- **Product Management:** Add, edit, and delete products easily.
- **Order Management:** Process incoming orders and update status.
- **Sales Reports:** View sales performance and transaction history.
- **Review Management:** Respond to customer reviews.

### 🛡️ For Administrators

- **User Management:** Oversee all registered users and sellers.
- **Shop Verification:** Approve or reject new shop registrations.
- **Category Management:** Organize product categories.
- **System Monitoring:** Dashboard for overall platform statistics.

## 🛠️ Tech Stack

- **Framework:** CodeIgniter 3 (PHP)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript (Bootstrap/Custom)
- **Payment Gateway:** iPaymu API

## 🚀 Installation Guide

### Prerequisites

- Web Server (Apache/Nginx)
- PHP >= 5.6 (Recommended PHP 7.4 or 8.0)
- MySQL Database
- Git

### Steps

1.  **Clone the Repository**

    ```bash
    git clone https://github.com/Gimm17/salakan-umkm.git
    ```

2.  **Database Setup**
    - Create a new MySQL database (e.g., `db_umkm_salakan`).
    - Import the SQL file located in `database/` folder (e.g., `db_umkm_salakan (13).sql`).

3.  **Application Configuration**
    - Open `application/config/config.php` and set your `base_url`:
      ```php
      $config['base_url'] = 'http://localhost/salakan_umkm/';
      ```
    - Open `application/config/database.php` and configure your database connection:
      ```php
      $db['default'] = array(
          'hostname' => 'localhost',
          'username' => 'root',
          'password' => '',
          'database' => 'db_umkm_salakan',
          'dbdriver' => 'mysqli',
      );
      ```

4.  **Run the Application**
    - Move the project folder to your web server root (e.g., `xampp/htdocs/`).
    - Access via browser: `http://localhost/salakan_umkm/`

## ⚙️ Deployment (cPanel)

For deployment instructions, please refer to the `deployment_guide.md` included in this repository (if available) or follow standard CodeIgniter deployment procedures.

## 📄 License

This project is licensed under the MIT License - see the `license.txt` file for details.
