# Resume creator
#### <em>This project is a SPA, developed using Laravel, Vue.js and Bootstrap.</em>

## Table of contents

* [General info](#general-info)
* [Demonstration GIFs](#demonstration-gifs)
* [Used Technologies](#used-technologies)
* [Setup](#setup)

## General info

This project has these features:

* Creating, viewing, saving, editing, deleting a resume
* Viewing created resume list for current user


* Resumes sorted by their modification date
* Work experience and education sorted by their start date and those positions that are still active, will show on top


* Visible error and success messages as well as input validation

## Demonstration GIFs

<div style="text-align: center">
    <h3>Login</h3>
    <p align="center">
        <img src="/demonstration_content/login.gif"  width="95%" alt="animated-demo" /><br>
    </p>
    <h3>Validation and editing</h3>
    <p align="center">
        <img src="/demonstration_content/error_and_editing.gif" width="95%" alt="animated-demo" /><br>
    </p>
    <h3>Deleting</h3>
    <p align="center">
        <img src="/demonstration_content/deleting.gif" width="95%" alt="animated-demo" /><br>
    </p>
    <h3>Creating and editing</h3>
    <p align="center">
        <img src="/demonstration_content/creating_and_editing.gif" width="95%" alt="animated-demo" /><br>
    </p>
</div>

## Used Technologies

* Laravel `^8.75`
* PHP `^7.3|^8.0`
* Vue.js `3.2`
* MySQL `8.0`


* Composer `2.6.6`
* Npm `8.19.3`
* Node `18.13.0`

Style:
* Bootstrap 5.3

## Setup

To install this project on your local machine, follow these steps:

##### Getting the workplace ready
1. Clone this repository - `git clone https://github.com/guztus/lara-vue-resume`
2. Locate "/public"
3. Install composer dependencies - `composer install`
4. Install node dependencies - `npm install`
6. Rename the ".env.example" file to ".env" <br>
7. Create a database and add the credentials to the ".env" file
##### Running the project
8. Generate your key for the project `php artisan key:generate`
9. To run the project, enter `php artisan serve` (to run the backend) and `npm run dev` (to run the frontend).
10. Make a demo account (will include resumes, work experience and education) `php artisan db:seed --class=DemoSeeder`

(Demo account login details - email: demo@demo.gz, password: demo@demo.gz)
