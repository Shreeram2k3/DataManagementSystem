# 📊 DMS - Data Management System
---


![GitHub stars](https://img.shields.io/github/stars/Shreeram2k3/DataManagementSystem?style=social)
![Unique Clones](https://img.shields.io/badge/Unique%20Clones-68-blue)
![GitHub forks](https://img.shields.io/github/forks/Shreeram2k3/DataManagementSystem?style=social)
![GitHub contributors](https://img.shields.io/github/contributors/Shreeram2k3/DataManagementSystem)
![GitHub issues](https://img.shields.io/github/issues/Shreeram2k3/DataManagementSystem)
![GitHub pull requests](https://img.shields.io/github/issues-pr/Shreeram2k3/DataManagementSystem)
![License](https://img.shields.io/github/license/Shreeram2k3/DataManagementSystem)

---

*DMS* (Data Management System) is a Laravel-based application built to streamline and automate the data collection and management process in our college. Designed with familiarity and usability in mind, it mimics the existing ERP interface to ensure ease of adoption by faculty and administrators. While the code is open under MIT license for learning purposes, unauthorized commercial use is not permitted without prior consent.

---


##  Features

- 🔐 *Secure Authentication*
  - Google Login via Laravel Socialite
  - Email & Password Login
  - Password reset and change support
-  *Role-Based Access*
  - *HOD* has full access to all features
  - *Faculty* has limited view and actions
-  *Data Management Module*
  - HOD can add, view, and manage user data
  - Faculty can view and submit relevant data
-  *Clean and familiar UI* based on college ERP design
-  *Logging, validation, and error handling* included

---

##  Tech Stack

- *Backend*: Laravel 12.x (PHP 8.2)
- *Frontend*: Blade + Tailwind CSS
- *Authentication*: Laravel Breeze + Socialite (Google OAuth)
- *Database*: MySQL
- *Version Control*: Git + GitHub

---

## ⚙ Setup Instructions

1. *Clone the repo*
   ```bash
   git clone https://github.com/Shreeram2k3/DataManagementSystem.git
   cd DataManagementSystem

2. Install dependencies

composer install
npm install && npm run dev


3. Configure environment

copy .env.example .env

Update the .env file 

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=dmsdb

DB_USERNAME=root

DB_PASSWORD=

# DB AdminUserSeeder
# Important: Update these before running migrations

ADMIN_NAME=Admin

ADMIN_EMAIL=your-admin@example.com

ADMIN_PASSWORD=your-secure-password


SESSION_DOMAIN=null

Update mail configuration

Add Google OAuth credentials (Client ID & Secret)



4. Generate app key

php artisan key:generate


5. Run migrations

php artisan migrate 

php artisan migrate --path=database/migrations/StudentActivityMigrations

php artisan migrate --path=database/migrations/FacultyActivityMigrations

php artisan migrate --path=database/migrations/DepartmentActivityMigrations

# Run migrations and seed the default admin user

php artisan migrate --seed




6. Start the development server

php artisan serve

7. Grant read access to everyone(for view the document)

icacls storage /grant Everyone:(R)

8. Laravel storage link command

php artisan storage:link



---

🔒 Security

Passwords are hashed using Laravel’s built-in hashing.

Role-based middleware protects sensitive routes.

All sensitive files (like .env) are listed in .gitignore.


---


# 👨‍💻 Authors

Shreeram G
Pre-final year CSE student,

Connect with me: 

 [<img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" width="18" height="18"/> Shreeram2k3](https://github.com/Shreeram2k3)

[<img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" width="18" height="18"/> shreeram2k3](https://www.linkedin.com/in/shreeram2k3)

---
 Sathish K.U
 Pre-final year CSE student,
 GitHub: github.com/Sathish21-cse

 ---
Shailesh Kumar
Pre-final year CSE student,
GitHub: github.com/shaileshkumar36


---

📄 License

This project is licensed under the MIT License.

---
