
# Project Author : Johnny Wang & Shangxi Sun

# https://github.com/yuehanui/Insurance-Company-RDBMS
## Part I

### Apr 8
- VEHICLE 和 DRIVER 改成 many-to-many
- DRIVER 的 LISCENSE 格式改成 VARCHAR，因为驾照号码可以含有字母
- DRIVER 的 PK 改成新添加的 DRIVER_ID
- VEHICLE 的 VIN 格式改成 VARCHAR，因为VIN含有字母
- VEHICLE 的 PK 改成新添加的 VEHICLE_ID
- HOME 的 SWIM_POOL 改成 非必须
- 添加各种ID的最小值限制
- HOME 的 SWIM_POOL, SEC_SYS,BASEMENT 的格式从 BINARY 改成 NUMERIC

### Relational Model

<img src="/Users/Yuehan/Desktop/GIT/insurance_company_business_managment_company/PART II/relation_model.png" alt="relation_model" style="zoom: 33%;" />

## Part II


####Apr 26
完成客户的个人信息显示和保险计划显示

### file directory
####private

- initialize.php
- function.php
- shared
    - header.php    `contains the common header for all pages`
    - footer.php
    ` contains the common footer for all pages`
    - nav_guest.php        
    `the navigation bar for guest`
    - nav_user.php
    `the navigation bar for logged in user`
    - staff-dashboard.php 
    `support file for public/dashboard.php`
    - customer.dashboard.php
    `support file for public/dashboard.php`
    

####public 

- index.php 
- dashboard.php
	`page for staff to select and manimulate data,for customer to view his/her own data`                   
- customerlogin.php      
  `login page for client account`	
- customer-loging-in.php 
`check credential for client account`
- stafflogin.php   
  `login page for staff account`
- staff-loging-in.php
`check credential for staff account`
- register.php.   
`register page for client`
- create-account.php
`process user input and create account for registers`
- logout.php.   
`log user out by unset cookies`
- Subscription.  
`show customer's insurance plans`
  
 
  
### Summary of development environments:
HTML, CSS, JavaScript, Bootstrap, PHP, MySQL, Apache server, Oracle Data Modeler, Online RDBMS converter, Sublime Text
Summary of features:
-  Customer register
-  Customer and staff login
-  Duplicate login
-  Purchase insurance
-  Browse
- Customer account deletion
- Insurance record deletion
- Hashed password with salt
- Against SQL injection
- Against Cross-site scripting attack – sanitize output ---- htmlspecialchars
- Keep state for a user session ----- cookies and sessions
### Summary of learning outcome:
#### We will...
- utilize the techniques about database structure learnt from class.
- use different kinds of development environments such like PHP and MySQL
#### efficiently.
- demonstrate the ability to resolve same kind of problems that occur in the field.
- be able to cooperate and share ideas with other group members.
  
