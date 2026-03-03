## Open Library


### Requirements

- docker desktop or docker engine

### Steps


```bash
# Generate the docker image
docker compose build
docker compose up -d
```

```bash
# Get in the docker image bash
docker exec -it open_library_app bash
```

```bash 
# Generate laravel key
php artisan key:generate
```

```bash 
# Start 3 different bash inside the docker image "docker exec -it open_library_app bash"
# In the first bash run 
php artisan queue:work

# In the second bash run 
php artisan reverb:start

# In the third bash run 
npm run dev
```

In order to approve or reject books you need an admin user, to get one run this command in the bash terminal inside the docker image:
```bash
php artisan app:create-admin-user
```
