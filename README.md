# Database Final Project

## Apr 8
- VEHICLE 和 DRIVER 改成 many-to-many
- DRIVER 的 LISCENSE 格式改成 VARCHAR，因为驾照号码可以含有字母
- DRIVER 的 PK 改成新添加的 DRIVER_ID
- VEHICLE 的 VIN 格式改成 VARCHAR，因为VIN含有字母
- VEHICLE 的 PK 改成新添加的 VEHICLE_ID
- HOME 的 SWIM_POOL 改成 非必须
- 添加各种ID的最小值限制
- HOME 的 SWIM_POOL, SEC_SYS,BASEMENT 的格式从 BINARY 改成 NUMERIC
