# BoolBnB Backend

BoolBnB is a web application developed with Vue.js that facilitates the rental management of apartments. This README focuses specifically on the backend aspects of the BoolBnB project.

## Features

-   User registration for apartment owners
-   Apartment listing by registered owners
-   Apartment sponsorship with payment integration
-   Client-side and server-side input validation
-   Geographical information storage using latitude and longitude coordinates
-   Integration with TomTom's API for address-to-coordinates conversion
-   Integration with Braintree's payment system for secure transactions
-   Responsive design optimal viewing across PC and Tablet
-   Seamless apartment search and filtering without page refreshes

## Technologies Used

-   PHP
-   Laravel
-   MySQL
-   TomTom API
-   Braintree Payment Gateway

## Functional Requirements

### User Registration

Apartment owners can register on the platform by providing essential information such as email, password, name, surname, and date of birth. Email and password are used for subsequent logins.

### Apartment Listing and Management

Registered apartment owners can add one or more apartments to the platform by providing detailed information about each property, including title, number of rooms, beds, bathrooms, square meters, full address, representative image, and additional amenities. They can also edit, delete, and manage the availability status of their listed apartments.

### Apartment Details and Messaging

Visitors can view detailed information about a selected apartment, including its location on a map. They can also send messages to apartment owners directly through the platform to request additional information about an apartment.

### Message Inbox

Registered apartment owners can view messages received from visitors regarding their apartments.

### Apartment Statistics

Registered apartment owners can access statistics regarding the visibility and interaction with their listed apartments, such as views and messages received.

### Apartment Sponsorship

Registered apartment owners can sponsor their apartments for increased visibility on the platform. Sponsorship options include different packages with varying durations and costs. Payments are processed securely through the Braintree payment system.

## Notes

-   Client-side and server-side input validation is implemented to ensure data accuracy.
-   The location data of apartments is stored using latitude and longitude coordinates obtained from TomTom's API.
-   Braintree's payment system is integrated to facilitate secure transactions for apartment sponsorship.
-   The website is designed to be responsive, ensuring optimal viewing experiences across desktop and tablet devices.
