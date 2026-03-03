## Open Library


### Requirements

- Docker desktop or docker engine
- A gemini api key
- A mailtrap user

### Steps

#### Start the docker image

```bash
# Generate the docker image
cd open_library
docker compose build
docker compose up -d
```

#### Migrations and .env

```bash
# Copy environment variables
cp .env.example .env
```

```bash
# Get in the docker image bash
docker exec -it open_library_app bash
```

```bash 
# Generate laravel key
php artisan key:generate
# Run migrations
php artisan migrate
```

#### Start the app

```bash 
# Start 4 different bash inside the docker image "docker exec -it open_library_app bash"
# In the first bash run 
php artisan serve

# In the second bash run 
php artisan queue:work

# In the third bash run 
php artisan reverb:start

# In the fourth bash run 
npm run dev
```

In order to approve or reject books you need an admin user, to get one run this command in the bash terminal inside the docker image:
```bash
php artisan app:create-admin-user
```
