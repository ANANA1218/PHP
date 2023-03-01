create database videogames;

create table videogames.game
(
    id tinyint PRIMARY KEY auto_increment,
    title varchar
(255) not null, 
    description text, 
    release_date date not null, 
    poster varchar
(255), 
    price decimal
(5,2)
);

insert into videogames.game
    (title, description, release_date, poster, price)
values
    ("Mario Bros.", "Mario Bros. is a 1983 arcade game developed and published for arcades by Nintendo. It was designed by Shigeru Miyamoto and Gunpei Yokoi, Nintendo's chief engineer. Italian twin brother plumbers Mario and Luigi exterminate creatures emerging from the sewers by knocking them upside-down and kicking them away.", '1983-05-01', "https://fs-prod-cdn.nintendo-europe.com/media/images/10_share_images/games_15/virtual_console_nintendo_3ds_7/SI_3DSVC_SuperMarioBros.jpg", 30.50),
    ("Snake", "Snake is a sub-genre of action video games where the player maneuvers the end of a growing line, often themed as a snake. The player must keep the snake from colliding with both other obstacles and itself, which gets harder as the snake lengthens", '2015-05-30', "https://www.google.com/url?sa=i&url=https%3A%2F%2Fopengameart.org%2Fcontent%2Fsnake-game-assets&psig=AOvVaw1-vGRD0hBBCbXT4uJytr6H&ust=1677762165471000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCLj9nKLluv0CFQAAAAAdAAAAABAH", 20.00),
    ("A Plague Tale", "A Plague Tale: Innocence is an action-adventure stealth game developed by Asobo Studio and published by Focus Home Interactive. It was released for Windows, PlayStation 4 and Xbox One in May 2019. The game was made available on the cloud-based service Amazon Luna in November 2020.
", '2019-08-5', "https://upload.wikimedia.org/wikipedia/en/1/1d/A_Plague_Tale_cover_art.jpg", 39.99),
    ("Metro Exodus", "Metro Exodus is a first-person shooter video game developed by 4A Games and published by Deep Silver. It is the third installment in the Metro video game trilogy based on Dmitry Glukhovsky's novels, following the events of Metro 2033 and Metro: Last Light.", '2019-04-09', "https://d25-a.sdn.cz/d_25/c_img_H_CV/jEPBjuO.jpeg", 30.99);