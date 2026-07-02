# 🚀 Nexus Platform

**Nexus Platform** is a centralized Laravel web application designed to connect **investors** and **entrepreneurs** in one digital ecosystem.  
The platform allows startups to showcase their projects while investors can discover, connect, and invest in innovative ventures.

---

## 🌟 Overview

Nexus Platform helps bridge the gap between investors and entrepreneurs by creating a professional environment where ideas meet capital.  
It provides features for profile management, startup presentation, and secure communication.

---

## 👨‍💼 Features

### 🧠 For Entrepreneurs
- Create and manage startup profiles  
- Add information such as industry, funding need, and team size  
- Upload startup logo and detailed pitch summary  
- View connected investors  

### 💰 For Investors
- Create investor profiles  
- Add company details, investment range, and focus industries  
- Discover and view entrepreneur startups  
- Send messages and make investment offers  

### ⚙️ General Features
- Secure authentication using **Laravel Sanctum**  
- CRUD (Create, Read, Update, Delete) operations for startups and investors  
- RESTful API integration for scalable frontend communication  
- Responsive UI built with **Bootstrap 5**  
- Profile image upload and management  
- Dynamic dashboards for both investor and entrepreneur users  

---

## 🧩 Tech Stack

| Category | Technology Used |
|-----------|-----------------|
| **Backend** | Laravel 11 (PHP 8+) |
| **Frontend** | Blade Templates, Bootstrap 5, JavaScript |
| **Database** | MySQL |
| **Authentication** | Laravel Sanctum |
| **Version Control** | Git & GitHub |
| **Server Environment** | XAMPP / Apache |
| **IDE Recommended** | VS Code / PHPStorm |

---

## 📁 Project Structure
# 1. Clone the repository
git clone https://github.com/Hassankhan111/Nexus-Platform.git
cd Nexus-Platform

# 2. Install PHP dependencies
composer install

# 3. Create environment file
copy .env.example to .env

# 4. Generate application key
php artisan key:generate

# 5. Configure database in .env file
# (Set your DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 6. Run database migrations
php artisan migrate --seed

# 7. Install frontend dependencies
npm install
npm run dev

# 8. Create storage link
php artisan storage:link

# 9. Start the development server
php artisan serve
