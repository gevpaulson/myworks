SELECT name, COUNT(phone) as phone_count
FROM users
         LEFT JOIN phone_numbers pn on users.id = pn.user_id
WHERE TIMESTAMPDIFF(YEAR, FROM_UNIXTIME(birth_date), CURRENT_TIMESTAMP) < 22
  AND TIMESTAMPDIFF(YEAR, FROM_UNIXTIME(birth_date), CURRENT_TIMESTAMP) > 18
  AND gender = 1
GROUP BY name;