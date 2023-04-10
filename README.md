1. clone project
2. Install dependencies using `composer install`
3. create a db named `fruit`
4. run `php yii migrate` command to create database tables
5. On root of the project run `php yii fruits/fetch` command in terminal to fetch and save fruits from API
    5-a. If mailer isn't enabled/setup on your system comment `$this->sendEmail();` following line in `commands/FruitsController.php` file
6. use admin/admin or demo/demo to login as a user on project 
