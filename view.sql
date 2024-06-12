CREATE OR REPLACE VIEW itemview AS
SELECT items.* , categories.* ,ROUND((items_price - (items_price*items_discount/100)),2)AS itemspricediscount
FROM items JOIN categories 
ON items_cat = categories.categories_id



CREATE OR REPLACE VIEW allFavorite AS
SELECT favorite.*,items.* , ROUND(items.items_price - (items.items_price*items.items_discount/100), 2) AS total_price ,users.users_id FROM favorite
JOIN items ON favorite.favorite_itemsId = items.items_id
JOIN users ON favorite.favorite_usersId = users.users_id;

-- CREATE OR REPLACE VIEW allFavorite AS
-- SELECT favorite.*,items.* , ROUND(items.items_price - (items.items_price*items.items_discount/100), 2) AS total_price ,users.users_id FROM favorite
-- JOIN items ON favorite.favorite_itemsId = items.items_id
-- JOIN users ON favorite.favorite_usersId = users.users_id;


CREATE OR REPLACE VIEW cartProducts AS
SELECT ROUND(SUM(items.items_price - (items.items_price*items.items_discount/100)), 2) AS total_price , COUNT(items.items_price) as Itemscount, cart.*,items.*
FROM items 
JOIN cart ON items.items_id = cart.cart_itemsId 
JOIN users ON users.users_id = cart_usersId
WHERE cart_orders = 0
GROUP BY items.items_price ,cart.cart_usersId ;
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
--* get data for archive and pending
--! this qury to get the address
CREATE OR REPLACE VIEW ordersview AS
SELECT orders.*, orderAddress.*
FROM orders 
LEFT JOIN orderAddress 
ON orders.orders_id = orderAddress.orderAddress_orderId
ORDER BY orders.orders_id ASC;
-- CREATE OR REPLACE VIEW ordersview AS
-- SELECT orders.* , orderAddress.*
-- FROM orders 
-- LEFT JOIN orderAddress 
-- ON orders.orders_addressId = orderAddress.orderAddress_addressId
------------------------
-- CREATE OR REPLACE VIEW ordersview AS
-- SELECT orders.* , address.*
-- FROM orders 
-- LEFT JOIN address 
-- ON orders.orders_addressId = address.address_id



--* get data for details
CREATE OR REPLACE VIEW orderdetailsview AS
SELECT ROUND(SUM(items.items_price - (items.items_price*items.items_discount/100)), 2) AS total_price , COUNT(items.items_price) as Itemscount, cart.*,items.* 
FROM orders, items 
JOIN cart ON items.items_id = cart.cart_itemsId 
JOIN users ON users.users_id = cart_usersId
WHERE cart_orders != 0 AND orders.orders_id = cart.cart_orders
GROUP BY items.items_price ,cart.cart_usersId , cart.cart_orders ;

--* top selling
--! if you want to rename the coulmn and this coulmn with Group by ,  
--! you should make another group by for only naming this cloulmn
CREATE OR REPLACE VIEW itemstopselling AS 
SELECT COUNT(cart_itemsId) as top_selling, cart.* ,items.*, ROUND((items_price - (items_price*items_discount/100)),2)AS itemspricediscount
FROM cart JOIN items ON cart_itemsId = items.items_id
WHERE cart_orders != 0 
GROUP BY cart_itemsId 
ORDER BY top_selling ASC;