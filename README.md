# 📊 DMS - Data Management System

*DMS* (Data Management System) is a Laravel-based application built to streamline and automate the data collection and management process in our college. Designed with familiarity and usability in mind, it mimics the existing ERP interface to ensure ease of adoption by faculty and administrators.

---

## 🚀 Features

- 🔐 *Secure Authentication*
  - Google Login via Laravel Socialite
  - Email & Password Login
  - Password reset and change support
- 🧑‍🏫 *Role-Based Access*
  - *HOD* has full access to all features
  - *Faculty* has limited view and actions
- 📁 *Data Management Module*
  - HOD can add, view, and manage user data
  - Faculty can view and submit relevant data
- 🧭 *Clean and familiar UI* based on college ERP design
- 🧾 *Logging, validation, and error handling* included

---

## 🏗 Tech Stack

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

cp .env.example .env

Update database credentials

Update mail configuration

Add Google OAuth credentials (Client ID & Secret)



4. Generate app key

php artisan key:generate


5. Run migrations

php artisan migrate


6. Start the development server

php artisan serve




---

🔒 Security

Passwords are hashed using Laravel’s built-in hashing.

Role-based middleware protects sensitive routes.

All sensitive files (like .env) are listed in .gitignore.




👨‍💻 Author

Shreeram G
Pre-final year CSE student,
GitHub: github.com/Shreeram2k3


---

📄 License

This project is licensed under the MIT License.

---