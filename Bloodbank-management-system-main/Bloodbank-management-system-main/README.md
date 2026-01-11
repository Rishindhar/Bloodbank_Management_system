# Blood Bank Management System

## Overview
The Blood Bank Management System is a comprehensive solution developed with PHP, MySQL, HTML, and CSS, aimed at efficiently managing blood bank operations. This system facilitates donor and recipient information management and ensures effective monitoring of blood stock. 

## Project Background
This project was developed as part of my B.Tech program and reflects my effort in designing and implementing a robust and user-friendly blood bank management system.

## Key Features
- **Donor Registration**: Allows new donors to easily register by providing necessary details.
- **Blood Stock Management**: Enables seamless tracking and management of available blood stock.
- **Search Functionality**: Provides a user-friendly search feature for accessing donor and recipient information swiftly.
- **Donation and Transfusion Records**: Maintains comprehensive records of all blood donations and transfusions for effective tracking.
- **User Authentication**: Ensures secure access to the system for authorized users.

## Screenshots
Below are some screenshots showcasing the Blood Bank Management System's interface and functionalities:


![Login Page](https://github.com/Rishindhar/Bloodbank-management-system/blob/main/miniproject_dbms/images/Login_Page.png)
![Home Page](https://github.com/Rishindhar/Bloodbank-management-system/blob/main/miniproject_dbms/images/Homepage.png)
![Donor Registration](https://github.com/Rishindhar/Bloodbank-management-system/blob/main/miniproject_dbms/images/Donor_registration_Page.png)



## Entity-Relationship (ER) Diagram
The ER Diagram illustrates the data model of the system, depicting the relationships between different entities.
![ER Diagram](https://github.com/Rishindhar/Bloodbank-management-system/blob/main/miniproject_dbms/images/ER-Diagram.png)


## Database Schema
The database schema diagram presents the structure and relationships within the database, providing insights into how data is organized and managed.
![Database Schema](https://github.com/Rishindhar/Bloodbank-management-system/blob/main/miniproject_dbms/images/Database_Schema.png)

## Technologies Used
- **Front-end Development**: HTML5, CSS
- **Back-end Development**: PHP
- **Database Management**: MySQL (PHPMyAdmin)
- **Server**: Apache (XAMPP)

## Run Locally (XAMPP)
1. Start **Apache** and **MySQL** from the XAMPP Control Panel.
2. Copy the `miniproject_dbms` folder into your Apache web root (example: `C:\xampp\htdocs\miniproject_dbms`).
3. Create a database named `blooding` in phpMyAdmin.
4. Import `miniproject_dbms/bloodmg.sql` into the `blooding` database.
5. Verify database config in `miniproject_dbms/config.php`:
   - `DB_SERVER`: `localhost`
   - `DB_USERNAME`: `root`
   - `DB_PASSWORD`: *(empty)*
   - `DB_NAME`: `blooding`(example)

### URLs
- Frontend login: `http://localhost/miniproject_dbms/login.php`
- Dashboard: `http://localhost/miniproject_dbms/dashboard.php`
- Admin panel: `http://localhost/miniproject_dbms/admin/`
- phpMyAdmin: `http://localhost/phpmyadmin`






