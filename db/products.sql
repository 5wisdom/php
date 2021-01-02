create table products(
    num int not null auto_increment,
    id char(20) not null,
    name char(20) not null,
    title char(50) not null,
    content char(200) not null,
    price int not null,
    fav int not null,
    hit int not null,
    resist_day char(20) not null,
    file_name char(50),
    file_type char(50),
    file_copied char(50),
    primary key(num)

)charset=utf8;