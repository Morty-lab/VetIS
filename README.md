# Veterinary Information System (VETIS)

VETIS is a web-based application currently in development as a capstone project. It is designed to provide a comprehensive management system for veterinary clinics. The system has the following features:

* **Appointment Scheduling**
* **Record Keeping**
* **Inventory Management**
* **Point of Sale (POS)**

## Commands

To get started with the application, use the following commands:

### Fresh Database Schema

`php artisan migrate:fresh`

This command will create a fresh database schema based on the provided migrations.

### Seed Dummy Data

`php artisan db:seed`

This command will seed the database with dummy data.

### Run Scheduled Commands

`php artisan schedule:work`

This command will run all scheduled commands.

### Vaccination Reminders

`php artisan vaccinations:send-reminders`

This command will send reminders to all clients with pets that have vaccinations due today.

### Appointment Reminders

`php artisan appointments:send-reminders`

This command will send reminders to all clients with appointments scheduled for today.

### Check Low Stock

`php artisan stocks:check-low`

This command will check the current stock levels and send a notification if any item is running low.

