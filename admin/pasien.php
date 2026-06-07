SELECT
users.nama,
users.email,
pasien.no_telp

FROM pasien

JOIN users
ON pasien.user_id=users.id