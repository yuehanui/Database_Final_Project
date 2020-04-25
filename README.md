# Database Final Project
##Part I

### Apr 8
- VEHICLE 和 DRIVER 改成 many-to-many
- DRIVER 的 LISCENSE 格式改成 VARCHAR，因为驾照号码可以含有字母
- DRIVER 的 PK 改成新添加的 DRIVER_ID
- VEHICLE 的 VIN 格式改成 VARCHAR，因为VIN含有字母
- VEHICLE 的 PK 改成新添加的 VEHICLE_ID
- HOME 的 SWIM_POOL 改成 非必须
- 添加各种ID的最小值限制
- HOME 的 SWIM_POOL, SEC_SYS,BASEMENT 的格式从 BINARY 改成 NUMERIC



## Part II

#### file directory
private

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
    - staff-dashboard.php (空着)
    `support file for public/dashboard.php`
    - customer.dashboard.php  (空着)
    `support file for public/dashboard.php`
    
public 

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
   
   
