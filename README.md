# 📊 DMS - Data Management System
---


![GitHub stars](https://img.shields.io/github/stars/Shreeram2k3/DataManagementSystem?style=social)
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

Update .env file 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dmsdb
DB_USERNAME=root
DB_PASSWORD=

SESSION_DOMAIN=null

Update mail configuration

Add Google OAuth credentials (Client ID & Secret)



4. Generate app key

php artisan key:generate


5. Run migrations

php artisan migrate


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




👨‍💻 Authors

Shreeram G
Pre-final year CSE student,
  GitHub: github.com/Shreeram2k3

  Linkedin:
[shreeram2k3](https://www.linkedin.com/in/shreeram2k3)

 Sathish K.U
 Pre-final year CSE student,
 GitHub: github.com/Sathish21-cse


---

📄 License

This project is licensed under the MIT License.

---
