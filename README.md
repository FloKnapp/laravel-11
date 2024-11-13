# About this project

This application makes it possible for epilepsy patients to track their episodes.

# Requirements

- Docker

# Installation

Clone this repository to your desired destination. Run the following commands afterward from the root directory of the application:

```bash
$> ./vendor/bin/sail up -d 
```

### Activate Watcher

This could take a while, when everything is finished get access to the container with the following command:

```bash
$> ./vendor/bin/sail root-shell
```

To watch for changes in the file system, execute the following command:

```bash
root@9164ad43723c$> npm run dev
```

# Run Tests

```bash
$> ./vendor/bin/phpunit -c phpunit.xml
```
