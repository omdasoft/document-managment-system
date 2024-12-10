# Assignment Test Solution

This document outlines the details of the assignment test solution, including the technologies used and installation instructions.

---

## Table of Contents
1. [General Information](#general-information)
2. [Technologies Used](#technologies-used)
3. [Project Status](#project-status)
4. [Installation Guide](#installation-guide)

---

## General Information
This project is a solution to the given assignment test.

---

## Technologies Used
The project is built with the following technologies:
- **Laravel 11**
- **SQLite Database**

---

## Project Status
**Current Status:** Completed

---

## Installation Guide
Follow these steps to set up the project locally:

1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```bash
   cd <project-directory>
   ```

3. Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
   
4. Install PHP dependencies:
   ```bash
   composer install

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Create the primary database and module-specific databases as needed.

7. Run the shared database migrations and seed data:
   ```bash
   php artisan migrate:fresh --seed
   ```

8. Migrate module-specific databases (replace `Modulename` with the actual module name):
   ```bash
   php artisan module-migrate Modulename
   ```

---
