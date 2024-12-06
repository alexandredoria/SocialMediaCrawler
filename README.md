# Social media user crawler

This is a Symfony 7.2 project designed to run within a Docker environment, that provides a set of commands to manage the application, ensuring smooth development, testing, and that follows the [Symfony Best Practices][1].

### The coding challenge

1. Write a program that runs every day
2. Find out the number of followers of IG accounts ([**gunshorts**][2] and [**forgottenweapons**][3]) 
3. Update the user data, as well as the last time it ran.

### Requirements

    * Docker
    * PHP 8.3.0 or higher
    * PDO-MySQL PHP extension enabled

## Getting started

### 1. Configure the `.env` file
Make a copy of `.env.example` file to a local `.env` file:

```bash
cp .env.example .env
```

Fill the variables on `.env` file with your own values:

```bash
DB_USERNAME=symfony123
DB_PASSWORD=abc123
```

### 2. Build and start containers
To set up and start the Docker containers for all services, run:
```bash
make up
```

### 3. Install dependencies
Install the project dependencies:
```bash
make install
```

### 4. Run database migrations
Execute all migrations:
```bash
make migrations
```

### 5. Load data fixtures
Seed the database with sample data:
```bash
make data-fixtures
```

### 6. Start messenger worker
Consume messages from a transport broker:
```bash
make messenger-worker
```

### 7. Start scheduler worker
Consume messages from a scheduler, running them like cron jobs:
```bash
make scheduler-worker
```

### 8. Update social media user data by command (optional)
Dispatch a command to update all social media user data:
```bash
php bin/console app:update-all-social-media-user
```

## Tips for schedulers or commands
Run the message worker (step 6) before dealing with the scheduler or command.

Then, run the message dispatcher (steps 7 or 8) simultaneously in a different terminal window.

>    Running a scheduler as message dispatcher:
>
>   ![Running a scheduler as message dispatcher.](/public/images/run-scheduler.png "Running a scheduler as message dispatcher.")

>   Running a command as message dispatcher:
>
>   ![Running a command as message dispatcher.](/public/images/run-command.png "Running a command as message dispatcher.")

## Development environment

### 1. Check code standards and potential issues
Check for PSR12 coding standard violations, bugs, and potential issues using static code analysis tools:
```bash
make check
```

### 2. Run unit tests
Execute all unit tests:
```bash
make test
```

### 3. Generate code coverage report
Create an HTML code coverage report in the /public/coverage directory:
```bash
make coverage
```

![The coverage dashboard.](/public/images/coverage.png "The coverage dashboard.")


### 4. Check mutations on tests
Execute mutants against the covered tests set to see if seeded faults can be detected:
```bash
make test-mutation
```

![The coverage dashboard.](/public/images/infection.png "The infection dashboard.")

[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://www.instagram.com/gunshorts
[3]: https://www.instagram.com/forgottenweapons