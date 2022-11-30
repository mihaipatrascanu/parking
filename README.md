
## Parking system
 Please use 
 composer update
 composer install
 npm install
 npm run dev

 php artisan:migrate
 php artisan db:seed

 For the local server I have used Xampp for the database and
 php artisan serve

 After migration please register a user(no seed for the user model)

 For the API documentation please visit http://127.0.0.1:8000/docs

 Future Work:
 The price of a spot is made in cents
 For the moment is just generic 1000 cents.

 Implementing the price for the summer/winter.

 When a user is creating a reservation I have made an observer, 
 maybe in the future we can use websockets.

 I have also think that we can have a vehicle table to save the data
 for the reservation there.

 Also in the reservation table I have made a column 'status'->default(NULL)
 here I want to change the status after the final price is made.

 I have not implemented softdelete, just earasing a reservation if the status is NULL.




