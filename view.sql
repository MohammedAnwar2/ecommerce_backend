CREATE OR REPLACE VIEW allFavorite AS
SELECT favorite.*,items.* , ROUND(items.items_price - (items.items_price*items.items_discount/100), 2) AS total_price ,users.users_id FROM favorite
JOIN items ON favorite.favorite_itemsId = items.items_id
JOIN users ON favorite.favorite_usersId = users.users_id;


CREATE OR REPLACE VIEW cartProducts AS
SELECT ROUND(SUM(items.items_price - (items.items_price*items.items_discount/100)), 2) AS total_price , COUNT(items.items_price) as Itemscount, cart.*,items.*
FROM items JOIN cart
ON items.items_id = cart.cart_itemsId JOIN users
ON users.users_id = cart_usersId
WHERE cart_orders = 0
GROUP BY items.items_price ,cart.cart_usersId , cart.cart_orders ;
-- CREATE OR REPLACE VIEW cartProducts AS
-- SELECT ROUND(SUM(items.items_price - (items.items_price*items.items_discount/100)), 2) AS total_price , COUNT(items.items_price) as Itemscount, cart.*,items.*
-- FROM items JOIN cart
-- ON items.items_id = cart.cart_itemsId JOIN users
-- ON users.users_id = cart_usersId
-- WHERE cart_orders = 0
-- GROUP BY items.items_price ,cart.cart_usersId , cart.cart_itemsId ;


CREATE OR REPLACE VIEW favoriteSearch AS
SELECT DISTINCT itemview.* FROM itemview JOIN favorite
ON itemview.items_id = favorite.favorite_itemsId;


--* we using LEFT JOIN to get everything , the address is there or not , we will get everything
--! this qury to get the address
CREATE OR REPLACE VIEW ordersview AS
SELECT orders.* , address.*
FROM orders 
LEFT JOIN address 
ON orders.orders_addressId = address.address_id



CREATE OR REPLACE VIEW orderdetailsview AS
SELECT ROUND(SUM(items.items_price - (items.items_price*items.items_discount/100)), 2) AS total_price , COUNT(items.items_price) as Itemscount, cart.*,items.* ,ordersview.*
FROM orders, items 
JOIN cart ON items.items_id = cart.cart_itemsId 
JOIN ordersview ON ordersview.orders_id = cart.cart_orders 
JOIN users ON users.users_id = cart_usersId
WHERE cart_orders != 0 AND orders.orders_id = cart.cart_orders
GROUP BY items.items_price ,cart.cart_usersId , cart.cart_orders ;