## TwistCafe Test Application

This is a repository for homework from TwistCafe. The application consists of small Invoice bundle that can be used to create, read and update invoices. The application is built using Symfony 7.2 and PHP 8.3.

### Installation

1. Clone the repository
2. Run `docker-compose --env-file ./docker/.env up -d` to start the application
3. Attach to the PHP container using `docker exec -it twistcafe_php bash`
4. Run `cd /app` to get to root of application
5. Run `chmod +x init-app.sh`
6. Run `./init-app.sh` to install dependencies and run migrations automatically

### Usage
The application runs on `localhost:8080`. You can access the application by visiting http://localhost:8080 in your browser.
By default the Dashboard module is visible. 

The invoice module is available on http://localhost:8080/invoice. You can create, read and update invoices from this module.
The customer details submodule is available on http://localhost:8080/customer-details. You can create, read and update customer details from this module.