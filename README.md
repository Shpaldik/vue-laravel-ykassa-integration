<video src="[https://user-images.githubusercontent.com/12345678/yourfile.mp4](https://github.com/user-attachments/assets/017cc6b0-be81-47a0-b6ba-245509cfbde7)" controls width="100%" />

Setup Guide

System Requirements
•	PHP >= 8.1
•	Composer >= 2.0
•	Node.js >= 18.x with npm or yarn
•	MySQL >= 8.0
•	Web server (e.g., Nginx or Apache)
•	PHP Extensions: mbstring, bcmath, ctype, json, openssl, pdo, tokenizer, xml, fileinfo
•	Laravel Framework 12.9.0 (supported until February 24, 2027)

Note:
Laravel 12 is the latest version with active security fixes and improvements. Unlike older LTS versions (such as Laravel 6, 8, 9, or 10), it supports the latest PHP versions and third-party packages, reducing potential vulnerabilities.
 
Installing Dependencies
1.	Clone the repository:
git clone https://github.com/Shpaldik/vue-laravel-ykassa-integration
cd <project_folder>
   
2.	Install PHP dependencies via Composer:
composer install

3.	Install JavaScript dependencies:
npm install

 
Configure .env File
1.	Create a copy of the example config file:
cp .env.example .env
   
2.	Generate the application key:
php artisan key:generate
   
3.	Set up your database connection in .env:
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=your_database_name
- DB_USERNAME=root (or the username you created)
- DB_PASSWORD=your_password
   
4.	Configure SMTP for email:
- MAIL_MAILER=smtp
- MAIL_HOST=smtp.mail.ru (or another provider—check official docs)
- MAIL_PORT=465
- MAIL_USERNAME=your_email
- MAIL_PASSWORD=your_password
- MAIL_ENCRYPTION=ssl
- MAIL_FROM_ADDRESS=your_email
- MAIL_FROM_NAME="${APP_NAME}"
   
5.	Set up reCAPTCHA:
o	Go to Google reCAPTCHA
o	Click “Get Started”
o	Choose v3 (Score-based reCAPTCHA)
o	Add your site domain
o	Copy your site key and secret key into .env:

- GOOGLE_RECAPTCHA_KEY=your_key
- GOOGLE_RECAPTCHA_SECRET=your_secret

   
7.	Set up YooKassa (Payment):
o	Create a test store and add your domain
o	Go to Integration > HTTP notifications
o	Click “Change Settings”
o	Set the URL to:
    yoursite.com/webhook/yookassa
o	Save the settings

8.	Configure themes:
o	Open tailwind.config.js
o	You’ll see custom color themes for blue, dark, and root (light mode)

 
Running the Project
1.	Run database migrations:
php artisan migrate
   
2.	To preview the full project without hosting (optional – using ngrok):
o	Download ngrok from: https://ngrok.com
o	Run the .exe file as Administrator
o	In the terminal, type:
    ngrok http 8000
o	Copy the generated URL and update your .env:
    APP_URL=https://your-ngrok-url.ngrok-free.app
o	Also update vite.config.js:
    base: 'https://your-ngrok-url.ngrok-free.app',

3. Start the Laravel development server:
php artisan serve

4. Run the frontend dev server (with hot reload):
npm run dev

5. For production build (optimized assets):
npm run build

 
Updating Dependencies and Plugins
•	Update PHP dependencies:
composer update

•	Update JavaScript dependencies:
npm update

•	Rebuild frontend after updates:
npm run build

•	Apply new migrations if any:
php artisan migrate

 


