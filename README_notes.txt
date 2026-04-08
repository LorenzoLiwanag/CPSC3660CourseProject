Lethbridge JonesAuto - Starter Project Notes

1. Place the project folder in your web server root:
   - For XAMPP, use: C:\xampp\htdocs\CPSC3660CourseProject
   - For WAMP, use: C:\wamp64\www\CPSC3660CourseProject

2. Import the database schema:
   - Open phpMyAdmin or MySQL shell.
   - Run the file: database/schema.sql
   - This creates the jonesauto_db database and all tables.

3. Import the sample data:
   - Run the file: database/seed.sql
   - This adds sellers, buyers, customers, salespersons, vehicles, purchases, repairs, and warranty policies.

4. Configure database access if needed:
   - Open config.php
   - Update $db_host, $db_user, $db_pass, and $db_name if your MySQL settings are different.

5. Open the homepage in your browser:
   - Visit http://localhost/CPSC3660CourseProject/index.php
   - You should see the project title, description, and a database connection message.

6. What is included in this starter foundation:
   - index.php: simple home page and future navigation
   - config.php: MySQLi database connection file
   - includes/header.php and includes/footer.php: shared page layout
   - database/schema.sql: database setup script
   - database/seed.sql: sample data for future testing

7. Next steps later:
   - Build forms for purchase, sale, warranty, payment
   - Build reports for inventory, sales, payment
   - Keep using plain PHP and MySQLi for simplicity
