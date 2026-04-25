📘 Web-Based Guest Service System
📌 Description

This is a web-based Guest Service System built using native PHP to manage guest book entries and guest reservations digitally. The system provides an admin dashboard, data visualization, and automated WhatsApp notifications using the Fonte API.

🚀 Features
Digital Guest Book
Guest Reservation System
Admin Dashboard
Data Visualization with Chart.js
Interactive Tables with DataTables.js
WhatsApp Notification (Fonte API Integration)
🛠️ Technologies Used
Backend: PHP Native
Frontend: HTML, CSS, Bootstrap
Database: MySQL
Libraries:
Chart.js
DataTables.js
API:
Fonte (WhatsApp Notification)
📂 Project Structure
/project
│── /server
│   ├── server-side-buku-tamu.php
│   ├── server-side-reservasi-tamu.php
│
│── /service
│   ├── koneksi.php        # Database connection
│   ├── index.php
│
│── /crud
│   ├── /add
│   ├── /edit
│   ├── /delete
│   ├── login.php
│
│── /css
│── /js
│── /img
│── /icon
│── /export
│
│── /page
│   ├── /admin
│   │   ├── dashboard.php
│   │   ├── buku-tamu.php
│   │   ├── daftar-hadir.php
│   │   ├── daftar-reservasi.php
│   │   ├── login-admin.php
│   │   ├── reservasi.php
│   │   ├── /form-edit
│   │
│   ├── /user
│       ├── buku-tamu.php
│       ├── dashboard.php
│       ├── reservasi.php
│
│── /response
│   ├── resCon-survey-buku-tamu.php
│   ├── resCon-survey-reservasi-tamu.php
│   ├── resData.php
│   ├── resPhone-daftar-hadir-tamu.php
│   ├── resPhone-daftar-reservasi-tamu.php
│
│── /script
│   ├── bootstrap
│   ├── datatables
│   ├── jquery
⚙️ Installation

Clone repository:

git clone https://github.com/username/project-name.git
Move to local server directory (htdocs for XAMPP)
Import database:
Open phpMyAdmin
Create database
Import .sql file

Configure database connection
File:

/service/koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "your_database";

Run project:

http://localhost/project-name
📲 WhatsApp Notification (Fonte API)

The system uses Fonte API to send WhatsApp notifications automatically after:

Guest book submission
Reservation submission
📍 API Configuration Location

API integration is implemented inside:

/response/resPhone-daftar-hadir-tamu.php
/response/resPhone-daftar-reservasi-tamu.php
🔑 Example Configuration
$token = "YOUR_API_KEY";

Make sure to replace it with your own Fonte API key.

🔐 Authentication
Admin login system available
Session-based authentication
Protected admin pages
📊 System Workflow
User fills guest book or reservation form
Data is processed and stored in MySQL
System triggers WhatsApp notification via Fonte API
Admin can view data in dashboard
Data is displayed using charts and tables
👨‍💻 Developer
Name: Agung Anugrah Illahi
Project: Guest Service System
Year: 2026
📄 License

This project is intended for academic purposes and can be modified as needed.

✨ Notes
Ensure your local server is running (XAMPP/Laragon)
Internet connection is required for WhatsApp API
Do not expose your API key publicly in production
