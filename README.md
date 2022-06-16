------
This package provides a **PHP Vanilla**

> **Requires [Docker](https://www.docker.com/)**

👨‍💻 To start the application, run the command below:
```
docker-compose up -d
```

📦 To connect on PHP container, run the command below:
```
docker exec -it php bash
```

✔️ To run command to Create User
```
➜ docker exec -it php php public/index.php CreateUser {name} {email}
```

✅ Run unit tests with **PHPUnit**
```bash
composer test
```
