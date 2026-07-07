# Exemple pour la classe 1

## Base MySQL oneblog

### Table user

| Champ | Type | Null | Clé | Défaut | Commentaire |
|---|---|---|---|---|---|
| id | smallint UNSIGNED | NON | PK, AUTO_INCREMENT | | ID unique unsigned auto increment not null |
| login | varchar(30) | NON | UNIQUE | | login unique mais case sensitive ( ADMIN != Admin ) not null |
| realname | varchar(100) | OUI | | NULL | NULL : non obligatoire |
| pwd | varchar(255) | NON | | | Mot de passe hash (empreinte), avec 255 max, case sensitive, actuellement 60 not null |
| email | varchar(120) | NON | | | email utilisateur not null |
| actif | tinyint UNSIGNED | OUI | | 2 | 0 => actif / 1 => banni / 2 => non activé / 3 => RGPD avec articles anonymes / 4 => RGPD avec articles cachés |
| uniqid | varchar(80) | OUI | | NULL | |

### Table article

| Champ | Type | Null | Clé | Défaut | Commentaire |
|---|---|---|---|---|---|
| id | int UNSIGNED | NON | PK, AUTO_INCREMENT | | |
| title | varchar(90) | NON | | | |
| content | text | NON | | | |
| datetime | datetime | OUI | | CURRENT_TIMESTAMP | ou now(), temps actuel si non renseigné |
| actif | tinyint | OUI | | 0 | 0 => non visible / 1 => visible / 2 => article caché |
| user_id | smallint UNSIGNED | NON | FK -> user.id | | clef étrangère qui fait le lien avec la table user |

### Table category

| Champ | Type | Null | Clé | Défaut | Commentaire |
|---|---|---|---|---|---|
| id | smallint UNSIGNED | NON | PK, AUTO_INCREMENT | | |
| title | varchar(60) | NON | | | |
| description | varchar(300) | OUI | | NULL | |

### Table category_has_article

Table de liaison many-to-many entre `category` et `article`.

| Champ | Type | Null | Clé | Défaut | Commentaire |
|---|---|---|---|---|---|
| category_id | smallint UNSIGNED | NON | PK, FK -> category.id | | ON DELETE CASCADE, ON UPDATE CASCADE |
| article_id | int UNSIGNED | NON | PK, FK -> article.id | | ON DELETE CASCADE, ON UPDATE CASCADE |

### Relations entre les tables

- `article.user_id` -> `user.id` (un user peut avoir plusieurs articles)
- `category_has_article.article_id` -> `article.id`
- `category_has_article.category_id` -> `category.id`
- `article` <-> `category` : relation many-to-many via `category_has_article`

## Utilisateurs de test

### Admin
- login : `Admin`
- nom : `Pitz Michaël`
- mot de passe : `admin321`

- login : `ThePiet`
- nom : `Sandron Pierre`
- mot de passe : `admin567`



