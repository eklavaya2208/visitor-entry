# Visitor entry

This is an automated software to guide user entry and share information between the user and the host. It may cater to organisations and offices in need.

## Pre-requisites

- PHPMyAdmin for localhosting and testing
- Twilio API and secret key.
- PHP Mailer
- A Google email account.
- Read the [Deployment and Testing](https://github.com/eklavaya2208/visitor-entry#deployment--testing) section carefully before usage.

## Technology Stack

- **Programming Languages**
    - HTML
    - CSS
    - JavaScript
    - Ajax
    - PHP
    
- **Database**
    - MySQL

- **APIs**
    - Twilio test version for sending sms.
    - PHPMailer for sending emails.

## Implementation

The application can be primarily used for the following three tasks:

- Registration for hosts and visitors
- Check currently checked in users for a particular host
- Easy check in and check out for visitors

### Log in and sign up

As soon as the website is opened a login form appears, giving an option to sign up in case of a new user. Log in/ Sign up is common for all users
- **Login Page Demo**

![login page](https://drive.google.com/uc?export=view&id=1NF5i9LsIRHNfwbqTEMHytBV1_lsPK_uN "LOGIN PAGE")

- **Signup Page Demo**

![signup page](https://drive.google.com/uc?export=view&id=1GS_e3slaSwqVQxUs5EAyYg7S8_zMFj-b "SIGNUP PAGE")

> Once sign up is completed, the user is redirected to the login page. After logging in, the user may be redirected to one of two pages. This depends on, if the user is a visitor or a host.


### Visitor

- **Visitor Page Demo**

![visitor](https://drive.google.com/uc?export=view&id=1bEzoeq8CBr2_r51ID9wTy2on8110rbei "VISITOR HOME PAGE")

> The visitor will be redirected to the home page, that is, the check in page as soon as the check out is successful. The intial login functionality, now allows the user to check in/check out at the click of a button. This is done by sending an AJAX request in the background. Added constraints map one visitor to one host. Visitor is not allowed to checkin with another host as long as checkout is not done.

- **Host Page Demo**

![host](https://drive.google.com/uc?export=view&id=16Jmg3dDR0QdI83wmJJupRQNTzEE8O3a3 "HOST HOME PAGE")

> This page allows the host to view currently checked in users.

## The MySQL database

The structure used to handle data in this website is very simple. It is accessed via a single database and two tables: one which stores all user details and the other which logs all host and visitor entry

## Data Validation

Added constraints include : email is treated as a foreign key and will remain unique as constraints are added to make sure that no user registers with the same email id twice. All other data is accessed via email of the user. JS functions have been added which deny entry of characters in places where phone numbers are required

## Deployment & Testing

The application will soon be deployed on a PHP based web server.

To test/run the app locally:
- Install Xampp(recommended) for creating apache web server for hosting PHP.
- Clone this repository into the htdocs folder for Xampp
- Run the MySql commands inside Initialisation.txt for setting up database
- Remember to replace MySQL username and password with your original local username and passwords in required files. (For convenience, try to use root as username and have no password when setting up Xampp. In that case you wont need to make any changes)

## Bugs and improvements
- The given twilio account is a free trial version and hence it cannot send messages to all numbers
- Mailing is done via bit insecure gmail smtp server

## Future Enhancements

This is a basic application. There are a lot of possible additions possible, the initial ones which include:
- Email and phone number verification for added security.
- Prior host approvals for visitors and security measurements where host can report/ban visitors for bad conduct
- A complete host/visitor dashboard and expansion in such a manner that it can be used my multiple organisations, and allowing multi level access

## Credits

-Created and Developed By: Eklavaya Singh 
-Contact Email: 17ucs054@lnmiit.ac.in
