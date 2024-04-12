CREATE OR REPLACE VIEW allFavorite AS
SELECT favorite.* from favorite JOIN users
ON favorite.favorite_usersId = users.users_id JOIN items
ON favorite.favorite_itemsId = items.items_id;