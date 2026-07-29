<div align="center">

# 🚌 Smart Tourism Live Bus Tracking System

**Real-time bus tracking & tourism companion for smarter, easier commuting**

[![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Leaflet](https://img.shields.io/badge/Leaflet.js-Maps-199900?style=flat-square&logo=leaflet&logoColor=white)](https://leafletjs.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-UI-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=flat-square&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![License](https://img.shields.io/badge/License-Not%20Specified-lightgrey?style=flat-square)](#license)

[Features](#-features) •
[Tech Stack](#-tech-stack) •
[Getting Started](#-getting-started) •
[Database Setup](#-database-setup) •
[API Endpoints](#-api-endpoints) •
[Project Structure](#-project-structure) •
[Documentation](#-documentation)

</div>

---

## 📖 Overview

**Smart Tourism Live Bus Tracking System** is a PHP + MySQL web application that helps tourists and commuters track buses in real time, explore nearby places, and estimate fare and ETA for their journeys. It pairs an interactive Leaflet/OpenStreetMap frontend with a lightweight PHP API for live location updates, driver/user authentication, and an admin dashboard for managing routes and buses.

> 🔗 **Repository:** [github.com/Avashkhadka/SmartTourism_LiveBusTrackingSystem](https://github.com/Avashkhadka/SmartTourism_LiveBusTrackingSystem)

---

## ✨ Features

| | |
|---|---|
| 🗺️ **Live Bus Tracking** | Real-time bus location updates rendered on an interactive map |
| 📍 **Nearby Places** | Distance-based recommendations for tourist attractions near a route |
| 💰 **Fare & ETA Estimation** | Distance-based fare calculation and estimated arrival time |
| 🔐 **Auth Flows** | Separate sign-up/sign-in for riders and drivers, including license/ID document uploads |
| 🛠️ **Admin Dashboard** | Manage buses, routes, and users from a dedicated admin panel |
| 📱 **Responsive UI** | Clean, mobile-friendly interface built with Bootstrap |
| 🧭 **Route Visualization** | View stops, schedules, and route paths on the map |

---

## 🧰 Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 7.4+ (mysqli) |
| **Database** | MySQL / MariaDB |
| **Frontend** | HTML, CSS, vanilla JavaScript, Tailwind |
| **Maps** | Leaflet.js + OpenStreetMap |
| **Local Dev** | XAMPP / WAMP / PHP built-in server |

<!-- --- -->

<!-- ## 🖼️ Screenshots -->

<!-- > Add screenshots or a demo GIF here once available — drop image files into an `assets/screenshots/` folder and reference them like this:
>
> ```markdown
> ![Live map view](assets/screenshots/map-view.png)
> ![Admin dashboard](assets/screenshots/admin-dashboard.png)
> ``` -->

---

## 📂 Project Structure

```
SmartTourism_LiveBusTrackingSystem/
├── admin/                  # Admin pages & management tools
├── api/                    # Server-side API endpoints
│   ├── auth.php            # Login / registration
│   └── location.php        # Bus location get/post
├── assets/
│   ├── css/                # Stylesheets
│   ├── js/
│   │   ├── viewLocation.js     # Map rendering & location polling
│   │   ├── drivers-sign-up.js  # Driver registration flow
│   │   └── auth.js             # Client-side auth integration
│   └── img/                # Images & icons
├── components/              # Shared UI components (navbar, hero, footer)
├── config/
│   ├── conn.php             # Database connection (mysqli)
│   └── createDb.php         # Schema creation script
├── includes/
│   └── authGuard.php        # Server-side route protection
├── documentation/
│   ├── project1_SmartTourism_BusBookingSystem.pptx
│   ├── project1 Smart tourism and bus tracking.pdf
│   └── ganttChart.html
└── index.php                # Main entry point
```
---

## 🚀 Getting Started

### Prerequisites

- PHP 7.4+ with the `mysqli` extension enabled
- MySQL or MariaDB
- Apache, Nginx, or the PHP built-in server
- A modern web browser (for map & client-side features)
- *(Optional)* XAMPP or WAMP for quick local setup

### Installation

**Option A — XAMPP/WAMP (Windows)**

1. Clone or copy the project into your web root:
   ```bash
   C:\xampp\htdocs\SmartTourism_LiveBusTrackingSystem
   ```
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Open the app in your browser:
   ```
   http://localhost/SmartTourism_LiveBusTrackingSystem
   ```

**Option B — PHP built-in server (any OS)**

```bash
git clone https://github.com/Avashkhadka/SmartTourism_LiveBusTrackingSystem.git
cd SmartTourism_LiveBusTrackingSystem
php -S localhost:8000
```

Then open [http://localhost:8000/](http://localhost:8000/) in your browser.

---

## 🗄️ Database Setup

1. Create a database in phpMyAdmin or via the MySQL CLI (e.g. `smarttourism_db`).
2. Edit `config/conn.php` with your local credentials:
   ```php
   $host     = "localhost";
   $dbname   = "smarttourism_db";
   $username = "root";
   $password = "";
   ```
3. Initialize the schema:
   - **Browser:** open `http://localhost:8000/config/createDb.php`
   - **CLI:**
     ```bash
     php config/createDb.php
     ```
4. Confirm the tables were created using phpMyAdmin or the `mysql` CLI.

---

## ⚙️ Configuration

- `config/conn.php` holds the database connection settings — **never commit real credentials.**
- For multiple environments, consider adopting a `.env`-style config (not included by default).

---

## 🔌 API Endpoints

| Endpoint | Method | Description |
|---|---|---|
| `api/auth.php` | `POST` | Handles login and registration for riders and drivers |
| `api/location.php` | `POST` / `GET` | Posts or retrieves live bus location data |

**Example — post a bus location:**
```bash
curl -X POST http://localhost:8000/api/location.php \
  -d "device_id=BUS123&lat=27.7000&lng=85.3333&timestamp=2026-07-29T12:00:00Z"
```

**Example — authenticate a driver:**
```bash
curl -X POST http://localhost:8000/api/auth.php \
  -d "username=driver1&password=secret"
```

> Check `assets/js/auth.js` and `assets/js/viewLocation.js` to see the exact payloads the frontend sends.

---

## 📑 Documentation

The `documentation/` folder includes the full project report, presentation slides, and a Gantt chart:

- 📊 `project1_SmartTourism_BusBookingSystem.pptx` — presentation deck
- 📄 `project1 Smart tourism and bus tracking.pdf` — project report
- 📅 `ganttChart.html` — project timeline

---

## 🔒 Security Notes

- Never commit real database credentials — use environment variables or a git-ignored config file.
- Validate and sanitize all API input server-side.
- Use HTTPS in production.
- Use strong, unique passwords for admin accounts.
- Disable debug output before deploying.

---

## 🗺️ Roadmap

- [ ] Move DB credentials to a `.env` file with an example template
- [ ] Add unit/integration tests for API endpoints
- [ ] Document exact request/response JSON schemas for each endpoint
- [ ] Add a proper `LICENSE` file
- [ ] Add screenshots/demo GIFs to this README

---

## 🤝 Contributing

Contributions are welcome!

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes
4. Open a PR describing your changes and how you tested them

Please avoid committing credentials or sensitive data.

---

## 📄 License

No license file is currently included in this repository.
---

## 📬 Contact

Maintained by **[Avashkhadka](https://github.com/Avashkhadka)** — open an issue or PR on the repo for questions, bugs, or suggestions.