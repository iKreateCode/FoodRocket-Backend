🚀FoodRocket API 
---
A RESTful API which offers flexible eCommerce platform features. 
 
## Demo
Demo of this API can be seen implemented in FoodRocket Project: https://dev.to/bywaleed/foodrocket-5do8

## Requirements
- PHP > 7.2
- Composer
- Laravel Passport
- Twilio WhatsApp (Twillo ID & Token)

## Installation
Received built using Laravel & Laravel Passport for authentication . Basic knowledge in these technologies would be helpful for inspecting the code.

**1/ Clone the repository**
```shell script
git clone https://github.com/iKreateCode/FoodRocket-Backend.git

# Change directory to the newly created folder
cd FoodRocket-Backend
```

**2/ Install dependencies**
```shell script
# Install PHP dependencies
composer install
```

**3/ Prepare .env file**
An example `.env.example` has been shipped with the app. Before proceeding you need to rename this file to `.env` in order to be detected and used by the app.
```shell script
# Using command line
cp .env.example .env
```

**4/ Generate laravel secure key**
Laravel needs a secret key to encrypt the data. It's generated using the following command.
```shell script
php artisan key:generate --ansi
```

**5/ Configure .env values**
Beside the straightforward values like app name, URL and database connection. There's extra values to configure in order to start working with the app.

```dotenv
# Get ID and Token from Twillo console.
TWILLO_ID=
TWILLO_TOKEN=
```

**6/ Setup the database**
As you properly configured your `.env` file. You can proceed to populating the database.
```shell script
# Create the tables
php artisan migrate

# Generate and fill database
php artisan db:seed
```
All set up!

---
A project submission for [Twilio x DEV community hackathon!](https://dev.to/devteam/announcing-the-twilio-hackathon-on-dev-2lh8)
