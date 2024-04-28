CREATE OR REPLACE VIEW allFavorite AS
SELECT favorite.*,items.* , ROUND(items.items_price - (items.items_price*items.items_discount/100), 2) AS total_price ,users.users_id FROM favorite
JOIN items ON favorite.favorite_itemsId = items.items_id
JOIN users ON favorite.favorite_usersId = users.users_id;


CREATE OR REPLACE VIEW cartProducts AS
SELECT ROUND(SUM(items.items_price - (items.items_price*items.items_discount/100)), 2) AS total_price , COUNT(items.items_price) as Itemscount, cart.*,items.*
FROM items JOIN cart
ON items.items_id = cart.cart_itemsId JOIN users
ON users.users_id = cart_usersId
GROUP BY items.items_price ,cart.cart_usersId , cart.cart_itemsId ;


CREATE OR REPLACE VIEW favoriteSearch AS
SELECT DISTINCT itemview.* FROM itemview JOIN favorite
ON itemview.items_id = favorite.favorite_itemsId;