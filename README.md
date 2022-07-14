# Employees App
## Installation

###Step 1 : Setup Up .env file
- Copy the .env.example file and add the necessary environment variables. (Pay attention to APP_PORT AND FORWARD_DB_PORT environment variables)
```
eg.
  APP_PORT=8092
  FORWARD_DB_PORT=3392
```

###Step 2: Install Dependencies
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

###Step 3.1 : Start Container
```
./vendor/bin/sail up
./vendor/bin/sail up -d (detached mode)
```

### Step 3.2 : Start Vite Dev Server
```
./vendor/bin/sail npm run dev
```

### Step 3.3 : Build the Application for Production
```
./vendor/bin/sail npm run build
```

###Step 4 : Migrate Database
```
./vendor/bin/sail php artisan migrate
```

###Step 5 : Seed the database with dummy data (optional)
```
./vendor/bin/sail php artisan db:seed
```

###Step 6 : Add Alias for the Sail Command (optional)
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```
- This alias will allow you to do something like:
```
sail up
sail stop
sail down -v
```

###Step 7.1 : Stop Container
```
./vendor/bin/sail stop
```

###Step 7.2 : Stop Container and remove volumes
```
./vendor/bin/sail down -v
```

###Step 7.3: Rebuild a docker container
```
./vendor/bin/sail build --no-cache
```












