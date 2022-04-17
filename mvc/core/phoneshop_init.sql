drop schema if exists phoneshop;
create schema phoneshop;
use phoneshop;
create table users (
	id			int		primary key		auto_increment,
    email 		varchar(30),
    password 	varchar(15),
    username 	varchar(20),
    first_name	varchar(30),
    last_name	varchar(30),
    contact_number	int,
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
    screen_size			varchar(100),
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
    RAM_dung_luong		varchar(100),
    RAM_bo_nho_trong	varchar(100),
    pin_dung_luong		varchar(100),
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
    design_khung_vien	varchar(100)
);

create table orders (
	id			int		primary key		auto_increment,
    user_id		int,
    time		datetime 	default current_timestamp,
    foreign key (user_id) references users (id) on update cascade on delete cascade
);

create table orders_product (
	order_id	int,
    product_id	int,
    quantity	int,
    foreign key (order_id) references orders (id) on update cascade on delete cascade,
    foreign key (product_id) references products (id) on update cascade on delete cascade
);


create table posts (
	id			int		primary key		auto_increment,
    time		datetime 	default current_timestamp,
    user_id		int,
    header		text,
    img			varchar(200),
    foreign key (user_id) references users (id) on update cascade on delete cascade
);

create table reviews (
	id			int		primary key		auto_increment,
    product_id	int,
    user_id		int,
    star_rating	float,
    data		text,
    foreign key (user_id) references users (id) on update cascade on delete cascade,
    foreign key (product_id) references products (id) on update cascade on delete cascade
);

