create table buyer(
    num int not null auto_increment,
    id char(20) not null,
    name char(20) not null,
    buy_code int not null,
    buy_num int not null,
    buy_day char(20) not null,
    primary key(num)
)charset=utf8;