
# Gestion-Etudiants

![PHP](https://img.shields.io/badge/PHP-8.0+-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)

A simple student management system built with PHP and MySQL. This application provides basic CRUD (Create, Read, Update, Delete) operations for managing student records.

## Features
- **Add Students**: Easily add new students with their details (name, email, CNE, address, class, etc.).
- **View Students**: Display a list of all students in a clean table format.
- **Modify Students**: Update student information with a simple form.
- **Delete Students**: Remove students from the database by their ID.
- **Search Students**: Find students quickly by their ID.

## Technologies Used
- **PHP**: Backend logic and database interactions.
- **MySQL**: Database for storing student records.
- **HTML/CSS**: Frontend design and layout.

## Database Methods
This project uses two different approaches to database interaction:
1. **MySQLi**: The `main` branch uses the MySQLi extension for database operations.
2. **PDO**: The `pdo` branch uses PHP Data Objects (PDO) for database operations.

To switch between methods, check out the respective branch:
```bash
# For MySQLi (default)
git checkout main

# For PDO
git checkout pdo
```


## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/Arxsher/Gestion-Etudiants.git
   ```
2. Import the database:
   - Create a database named `biblio` in MySQL.
   - Create the necessary table.

3. Configure the database connection:
   - Open `config/config.php` and update the database credentials:
     ```php
     $servername = "localhost";
     $username = "your-username";
     $password = "your-password";
     $dbname = "biblio";
     ```

4. Run the application:
   - Place the project in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Access the application via `http://localhost/biblio/public/`.

## Usage
1. **Add a Student**: Navigate to `Ajouter un étudiant` and fill out the form.
2. **View Students**: Go to `Liste des étudiants` to see all records.
3. **Modify a Student**: Use `Modifier un étudiant` to update student details.
4. **Delete a Student**: Visit `Supprimer un étudiant` and enter the student ID.
5. **Search a Student**: Use `Rechercher un étudiant` to find a student by ID.

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
