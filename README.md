# PHP-Ecommerce
## Database design and implementation

The store's database is MySQL, created with the help of the web tool phpMyAdmin, which greatly facilitates creating tables, adding fields, creating relationships, etc.


We have the following tables:
* User
* Product
* Category
* Order
* Product_order

### User
![user](https://github.com/user-attachments/assets/d97c2980-d980-477a-9ebe-2dcedf147663)

- The field id is the primary key of the table.
- The field password stores the hashed password using the sha1 algorithm.
- The field lastlogin stores the timestamp after each login.
- The field role represents the user’s role.

### Product
![product](https://github.com/user-attachments/assets/7345524f-5cc1-4f13-8dda-8eb6e2cee6e7)

- The field id is the primary key of the table.
- The field cat is the foreign key that links the product with the Category table.

### Category
![category](https://github.com/user-attachments/assets/40e08dce-7aa5-4b93-9d57-3e44c0d77a46)

- The field id is the primary key of the table.

### Order
![order](https://github.com/user-attachments/assets/fa89f491-0802-40cf-9408-64515bf32fb7)

- The field id is the primary key of the table.
- The field userId is the foreign key linking the Order table with the User table.

### Product_order
![product_order](https://github.com/user-attachments/assets/0b3d869e-2d43-42f4-8e43-0cca220808aa)

- The field id is the primary key of the table.
- The fields orderId and productId are foreign keys that link the Order table with the Product table.
- This table is necessary because the relationship between Order and Product is 1:n (one order is related to many products), so an intermediary table is needed to relate a product to an order.
- In some literature, this is called OrderRow or order line.
- To display the content of an order, we must search in this table for the products with the corresponding orderId.

## Creation of the basic HTML/PHP structure of the store
The navigation structure is as follows:
* Home (Landing page)
* Products
    - Product page
* Categories
    - Category page
* Login
    - My profile (private area)
    - My orders (private area)
    - Administration (private area)
* Register
* Cart
* Checkout

## General information
I have implemented (in a very simple way) the Model-View-Controller (MVC) architecture pattern.


By separating the application into layers, it allows abstraction between each layer so that it only handles what it needs to do (for example, avoiding having views or files containing HTML perform database queries, iterate loops to obtain values, etc.) to apply the 


Single Responsibility Principle.
It’s worth mentioning that I am using plain PHP without any framework or library managing routing, etc.
I only used Bootstrap as a CSS library to simplify the front-end and avoid writing excessive CSS since it includes many pre-made styles that are easy to use.


We have a folder called Model that contains the model classes (product, category, user...) which hold the business logic and handle database access by offering methods to retrieve and store data, returning these to the controller.


On the other hand, we have the folder View, which contains the views or templates. We’ll have static methods in them that will be called and can receive parameters necessary for rendering the view. For example, to display the cart item table, we’ll call a method cartTable(products, total) that will return the HTML containing the lines for each product with its details (image, name, quantity, etc.). This way, we abstract the views from logic; they will simply handle displaying the HTML.


Lastly, we have the Controller folder which will contain the controllers that will be called depending on the requested URL. If we call /products, the ProductsController will be called. The controller contains the necessary functions to call the model and request data, which is then passed to the view.


Now, let’s look at how the calls are handled. We have an index.php that will manage which controller to call. It’s important to note that for this to work, I am redirecting from the .htaccess file to this index.php.

The .htaccess file contains the following code, which will redirect requests to index.php, sending the last part of the URL as a GET parameter:

```
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?controller=$1 [L,QSA]
```

If we request /products, it will redirect to index.php?controller=products, and in index.php, we handle the logic to call the appropriate controller. Without this redirection, we would get a 404 “not found” response from the server since there is no such route as /products or /categories.


Finally, to avoid repeating the same code on each page, I have extracted the header and footer into two separate files: header.php and footer.php, which are included using the include() function at the start and end of each page.


In the top navigation menu, we first have the store logo, which links to the homepage (Home), followed by Products, and finally Categories, which is a dropdown. On the right, we have the search bar, the “My Account” dropdown (if the user is logged in), and the link to the cart.

![search](https://github.com/user-attachments/assets/a280754b-cc9d-4c35-b688-9367bcad93ea)

## Home
This is the homepage of the online store. The root route or “/” calls the HomeController, which is responsible for displaying the home.template.php template. It shows a carousel of products and below it, featured products.

![home](https://github.com/user-attachments/assets/46705d0a-c868-4328-ab39-c4017022d90b)

## Products
This page is accessible from the top navigation menu and displays products dynamically. Although all products are currently shown, in a real page, we would limit the query or use pagination. The ProductsController calls the model to get the collection of products as an array of Product objects, which is then iterated, and each product is passed to the view to render the HTML of the products. A grid of products is displayed with product information (image, name, price), and we can click on any product to access its details page. We can also add products to the cart, showing a message on the screen saying “Product added.”

![products](https://github.com/user-attachments/assets/5242427d-a9e3-4176-b817-64f101a66dac)

## Product detail
When you click on a product, it takes you to the details page. This is done dynamically by passing the product ID as a URL parameter. PHP retrieves this parameter, and the model performs an SQL query that returns the product details, which are passed back to the controller as a Product object and then to the view to render the HTML for the product details. We display the image, name, price, description, and a button to add the product to the cart. After adding to the cart, we show a message.

It’s important to note that the action of adding to the cart, both on the product detail page and the product gallery view, is done via AJAX. Previously, this would be done by submitting a form to a script that processes the POST request, causing an annoying page reload. Now, it’s done through AJAX for a more user-friendly experience. I use jQuery to send the AJAX call, passing only the product ID. More details on this process will be explained in the Cart section.

![product-detail](https://github.com/user-attachments/assets/be4671a1-6409-45c0-b23b-21ac59129dfe)

## Categories
This page is accessible from the top navigation menu and displays categories dynamically. All categories are shown, but if there were many, we would limit the query or implement pagination in a real page. The CategoriesController calls the model to get the collection of categories as an array of Category objects, which is iterated and passed to the view to render the HTML of the categories. A list of categories is displayed with category information (image, name, description), and we can click on any category to access the details page.

![categories](https://github.com/user-attachments/assets/94c306f9-bda2-411c-8ec9-b095885e4719)

## Products by category
Clicking on a category (or selecting it from the top navigation menu dropdown) takes you to the details of that category. This is done dynamically by passing the category ID as a URL parameter. PHP retrieves this parameter, and the model performs an SQL query (this time including the WHERE clause with the category ID) that returns the category data, which is then passed to the controller as a Category object, and then to the view to render the HTML for the category details.

Next, the model also retrieves the products in that category from the database, using the relationship in the Product table, which links to the cat foreign key, and returns the collection of products as an array of Product objects. This array is iterated, and the products are passed to the view by the controller for rendering.

![products-category](https://github.com/user-attachments/assets/47bc2a4d-038e-4b41-82ca-cf951620bb91)

## Login
The login page displays a form asking for the username and password. The LoginController handles checking the credentials entered in the form and calls the LoginModel to check the database for matching credentials. If they are correct, it returns to the controller to create the session, which I handle with PHP sessions ($_SESSION).

When a user logs in, I create a session variable username like this: $_SESSION["username"], so this session can be accessed at any time. To access private pages (My Profile, My Orders, and Admin), I need to check if the session exists. I do this using a global function that returns a boolean value. For this, I have a class called GlobalFunctions that contains static methods, which can be used from anywhere in the application without instantiating the GlobalFunctions class. The method is as follows:
```
public static function isLogged() { 	 
return (isset($_SESSION['username']));
}
```
To use it, I simply call it at the start of private pages like this, redirecting to the login page if the session doesn’t exist:
```
if(!GlobalFunctions::isLogged()) {
    header('Location: /login');
}
```
There’s also a method to check the user’s role. This method is used, for example, in the Admin page to check if the role is greater than 1 (1 is the default value for any registered customer).

![login](https://github.com/user-attachments/assets/7801be92-5352-4fc7-b3c7-4695e97e56a4)

## User profile
This private page loads the ProfileController. It first checks if there’s a user session and redirects to the login page if not. The view for modifying personal data is shown, where the user can change their email and password. The username cannot be modified as it is used for the session. When the form is submitted, the controller processes the POST request and calls the ProfileModel, a class that extends UserModel (using inheritance to access properties and methods of UserModel). The ProfileModel has methods to show the pre-filled data when entering the form, as well as the updateData() method that performs the UPDATE query in the database.

![data-modify](https://github.com/user-attachments/assets/f607b980-2d85-488f-a165-6361f6a678c9)

## User orders
This private page is loaded by the OrdersController. It first checks if we have an active user session; if not, it redirects us to the Login page.
The controller will then call the view that displays the user’s orders table. To do this, it will call the ProfileModel, which is a class that extends from the UserModel (thus using inheritance and accessing the properties and methods of the UserModel).
The ProfileModel contains the necessary methods to display the order data for a user. To achieve this, we need to pull data from several tables using a JOIN, as the Order table does not contain order data itself; this data is found in the "intermediate" table Product_Order, where we have the userId key to establish the relationship. Remember, this is a many-to-many relationship. Additionally, we must perform another JOIN with the Products table because the Product_Order table does not list each individual product, but rather only the product ID (which would break the relational model). Therefore, we need to fetch the details from the Product table.
```
SELECT * FROM `Order`
JOIN Product_Order ON Order.id = Product_Order.orderId
JOIN Product ON Product_Order.productId = Product.id
WHERE userId = ????
```
The controller then contains logic to iterate through the collection and create a new array formatted to the user's preferences, to be passed to the view, removing duplicates that arise from performing multiple JOINs between tables. This way, I create an array of orders, where each order contains the ID, the date, and an array of Product objects with the order's content.

![orders](https://github.com/user-attachments/assets/abfd883b-89a2-4e69-8e02-6e20ad7ab387)

## Sign up
On the registration page, we have the registration form, which comes from the view (called by the User Controller). It allows us to generate a random password (I do this with JavaScript, and I also change the input type to "text" so the password is visible). When the form is submitted (when we perform a "form submit"), the POST request is handled by the controller, where the fields are validated. If they are not empty, the passwords match, etc., it will call the UserModel to insert the data into the database.
In the model, before inserting, a SELECT query is performed to check if the same username already exists in the database, to prevent inserting a duplicate username. If it doesn't exist, it is inserted, and a success message is displayed.

![signup](https://github.com/user-attachments/assets/af26648e-fa70-4738-b9ff-083a12309c56)


## Cart management
The cart page is controlled by the CartController, which will call the view to display a table with the lines of the cart’s contents, showing the product image, name, price, and the number of units we have in the cart.

![cart-number](https://github.com/user-attachments/assets/94599b9c-8b14-4895-a792-a5f83ef11462)

The cart is accessible from any point in the online store by clicking on the cart icon located on the top-right navigation bar. When there are items in the cart, a small number is displayed showing the number of items in it.

Conceptually, the cart is managed with a session variable.

When we add an item to the cart, we first check if the session variable ```$_SESSION[“cart”]``` already exists.

If it doesn't, we create it by adding a PHP array where the key is the product ID and the value is the number of items of that type, which is 1.

For example, if we want to add an item with product ID 5, we would add an array like this to the session variable:
```
$_SESSION["cart"] = [5 => 1]
```
If we later want to add a product that already exists in the cart, such as the product with ID = 3, we will see that it's already there. Instead of adding it with array_push() as we did before, we will increment the value of that ID. This way, we keep track of the quantity of that particular product.
```
$_SESSION["cart"] = [
  5 => 1,
  3 => 1
];
```
If we later add the same product again (ID = 3), we will increment its quantity in the session array instead of adding it as a new entry:
```
$_SESSION["cart"] = [
  5 => 1,
  3 => 2
];
```

![cart](https://github.com/user-attachments/assets/038b4bae-66f9-4104-9f88-727a87ec214c)

## Checkout process management
The purchase process works as follows. First, products must be chosen, either from the products page or from a category page, by clicking the “Add to Cart” button for each product.

Once we have products in the cart, we can click the cart icon in the top navigation bar. The cart page will be displayed, and from here, we can check that the products added are the ones we want. If not, we can remove them.

If everything is correct, we click the "Pay" button, and we will be taken to the Checkout page.

The Checkout page loads the CheckoutController, which calls the CheckoutTemplate view, passing the Products array retrieved from the CartModel (the model that contains the logic for fetching the products from the database based on the session variable). The view then renders the Checkout form.

Now, we can have three scenarios:
- The option to make a purchase without creating an account (anonymously). In this case, the buyer's details are collected and saved in the order. This will be the only information available about the buyer, meaning it won’t be associated with a user in the User table.
- The option to create an account by checking the "Create Account" box. If we check this box, a password field will appear, and a new account will be created, associating the order with the user.
- The last option is when a session is already active. If a user is logged in, the order will be associated with that user.

In any of the three use cases, the shipping information will be stored in the Orders table, as well as the products in the Product_Order table.

![checkout](https://github.com/user-attachments/assets/da4820bd-dadf-4b37-803d-d5941072e7d6)

## Administration Panel Creation for Order Consultation
The Admin page shows all orders from all users.

![admin](https://github.com/user-attachments/assets/24f4b0b5-67f2-472e-a5ff-43b696ccbffa)

Its functionality is similar to the user’s order panel, except now it shows orders from all users. In the AdminModel, I no longer include the clause “WHERE userId=…” in the query because I want to fetch all orders.

Another difference is that I now check if the user has the admin role. Role management is as follows: In the User table, there is a "role" field, which by default is 1 (the customer role). Of course, there's the exceptional case of the admin user who manually has role 2.

When a user logs in, the Login controller checks the role, and if it is greater than 1, it creates a session variable like this: ```$_SESSION[‘admin’]```.

There will be an isAdmin() method that can be called on pages that require higher privileges, like this:
```
public static function isAdmin() { 	 
    return (isset($_SESSION[‘admin’]));
}
```
This page is accessible from the top user menu for logged-in users. A user with admin privileges will see an option called "Administration."

![admin-menu](https://github.com/user-attachments/assets/66f123e6-67bc-444f-ad48-ccbf179765c0)

## Appendix
### Project Setup
#### DB
The database used by the project is called "uoc" and is in the database export file.
The connection configuration file is located at /config/db.class.php.
It’s set up to work with the following connection parameters:

* Database User: mike
* Server: 'localhost'
* Password: mike%
* Database Name: uoc

#### Login
* Client Login:
    * User: mgoyeneche@uoc.edu
    * Password: asdf


* Admin User Login:
    * User: admin@uoc.edu
    * Password: admin

#### Extra Functionality
* Product Search:
  Located at the top of the navigation bar, it works as follows: When you type, products that match the name will appear. For example, if you type the letter "c," several products containing the "c" in their name will appear.
In reality, these containers (divs) are already there but hidden. When typing, a key press event is triggered (with each key press), and I check if any of the products (by looping through all of them) contain the typed string—meaning if the typed substring is found in the name of any product. Of course, the product list is dynamically loaded.

![search](https://github.com/user-attachments/assets/a280754b-cc9d-4c35-b688-9367bcad93ea)

* Category List:
Displayed in the top navigation menu and footer, loaded dynamically.

* My Account Section:
Where a logged-in user can check and modify their data.

* My Orders Section:
Where a logged-in user can check their past orders.

* Administration Section:
Where a logged-in user with the "admin" role can see a list of store orders.

* Remove Products from the Cart.

* Count Identical Products in the Cart.
