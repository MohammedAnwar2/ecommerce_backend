CREATE OR REPLACE VIEW allFavorite AS
SELECT favorite.*,items.*,users.users_id FROM favorite
JOIN items ON favorite.favorite_itemsId = items.items_id
JOIN users ON favorite.favorite_usersId = users.users_id;