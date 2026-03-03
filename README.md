## Open Library


### Requirements

- Docker desktop or docker engine
- node lts
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

#### .env file

```bash
# Copy environment variables
cp .env.example .env
```
Replace the .env values with your gemini api key, mailtrap user and password and reverb keys

#### Start the app

```bash 
# Run npm install and npm run dev
npm install
npm run dev
```

- Go to http://localhost

In order to approve or reject books you need an admin user, to get one run this command in the bash terminal inside the docker image:
```bash
php artisan app:create-admin-user
```
