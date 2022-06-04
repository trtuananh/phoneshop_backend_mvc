drop schema if exists phoneshop;
create schema phoneshop;
use phoneshop;
create table users (
	id			int		primary key		auto_increment,
    email 		varchar(30),
    password 	varchar(100),
    username 	varchar(20),
    first_name	varchar(30),
    last_name	varchar(30),
    contact_number	varchar(30),
    address		text,
    district	text,
    city		text,
    role		boolean,
    profile_img	varchar(200)
);

create table products (
	id 					int 	primary key		auto_increment,
    product_name		text,
    price 				bigint,
    image				varchar(200),
    type				varchar(100),
    brand				varchar(100),
    hf_1				text,
    hf_2				text,
    hf_3				text,
    hf_4				text,
    star_review			float,
    description			text,
    screen_size			int,
    screen_tech			varchar(100),
    screen_phan_giai	varchar(100),
    screen_lam_tuoi		varchar(100),
    backcam_thong_so	varchar(100),
    backcam_quay		varchar(100),
    backcam_feature		varchar(100),
    frontcam_thong_so	varchar(100),
    frontcam_video		varchar(100),
    CPU_chipset			varchar(100),
    CPU_thong_so		varchar(100),
    CPU_GPU				varchar(100),
    RAM_dung_luong		int,
    RAM_bo_nho_trong	int,
    pin_dung_luong		int,
    pin_sac				varchar(100),
    pin_cong_sac		varchar(100),
    communicate_sim		varchar(100),
    communicate_OS		varchar(100),
    communicate_NFC		varchar(100),
    communicate_mang	varchar(100),
    communicate_wifi	varchar(100),
    communicate_bluetooth	varchar(100),
    communicate_GPS		varchar(100),
    design_size			varchar(100),
    design_weight		varchar(100),
    design_chatluong	varchar(100),
    design_khung_vien	varchar(100),
    time_create         datetime,
    time_modified		datetime
);

create table orders (
	id			int		primary key		auto_increment,
    user_id		int,
    time		timestamp 	default current_timestamp on update current_timestamp
);

create table orders_product (
	order_id	int,
    product_id	int,
    quantity	int,
    foreign key (order_id) references orders (id) on update cascade on delete cascade
);


create table posts (
	id			int		primary key		auto_increment,
    time		timestamp 	default current_timestamp on update current_timestamp,
    user_id		int,
    version     varchar(30),
    blocks      JSON
);

create table reviews (
	id			int		primary key		auto_increment,
    product_id	int,
    user_id		int,
    star_rating	float,
    content		text,
    time        timestamp   default current_timestamp on update current_timestamp
);

