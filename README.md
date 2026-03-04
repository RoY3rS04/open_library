## Open Library


### Requirements

- Docker desktop or docker engine
- node lts
- php and composer
- A gemini api key
- A mailtrap user

### Steps

### Get into working directory 

```bash
cd open_library
```

#### Install Dependencies

```bash
composer install
npm install
```

#### Start the docker image

```bash
# Generate the docker image
docker compose build
```

#### .env file

```bash
# Copy environment variables
cp .env.example .env
```
Replace the .env values with your gemini api key, mailtrap user and password and reverb keys

```bash
# Generate app key
php artisan key:generate
```
#### Start the app

```bash
# Start the images
docker compose up -d
```

```bash 
# Run npm run dev outside the docker image
npm run dev
```

- Go to http://localhost

In order to approve or reject books you need an admin user, to get one run this command in the bash terminal inside the docker image:
```bash
php artisan app:create-admin-user
```
