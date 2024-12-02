# Social Media User Crawler

This is a Symfony 7.2 project designed to run within a Docker environment, that provides a set of commands to manage the application, ensuring smooth development, testing, and that follows the [Symfony Best Practices][1].

### The Coding Challenge

1. Write a program that runs every day
2. Finds out the number of followers of IG accounts ([**gunshorts**][2] and [**forgottenweapons**][3]) 
3. Updates the user data, as well as the last time it ran.

## Requirements

    * Docker
    * PHP 8.3.0 or higher
    * PDO-MySQL PHP extension enabled

## Getting Started

### 1. Build and Start Containers
To set up and start the Docker containers for all services, run:
```bash
make up
```

### 2. Install Dependencies
Install the project dependencies:
```bash
make install
```

### 3. Run Database Migrations
Execute all migrations:
```bash
make migrations
```

### 4. Load Data Fixtures
Seed the database with sample data:
```bash
make data-fixtures
```

### 5. Start Messenger Worker
Consume messages from a transport broker:
```bash
make messenger-worker
```

### 6. Start Scheduler Worker
Consume messages from a scheduler, running them like cron jobs:
```bash
make scheduler-worker
```

### 7. Update Social Media User Data by command (Optional)
Dispatch a command to update all social media user data:
```bash
php bin/console app:update-all-social-media-user
```

## Tips for Running Workers and Commands

*   **Schedulers:** Steps 5 and 6 need to run simultaneously in different terminal windows.
*   **Commands:** Steps 5 and 7 should run simultaneously in different terminal windows.

## Development Environment

### 1. Run Unit Tests
Execute all unit tests:
```bash
make test
```

### 2. Generate Code Coverage Report
Create an HTML code coverage report in the /public/coverage directory:
```bash
make coverage
```

### 3. Check Code Standards and Potential Issues
Check for PSR12 coding standard violations, bugs, and potential issues:
```bash
make check
```

### 4. Load Data Fixtures
Seed the database with sample data:
```bash
make data-fixtures
```

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://www.instagram.com/gunshorts
[3]: https://www.instagram.com/forgottenweapons