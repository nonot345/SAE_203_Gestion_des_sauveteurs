# SAE 2.3 - Gestion des sauveteurs SSF

---

## 1. Installation

1. Copier le dossier dans le répertoire web
2. Modifier `config/config.php` avec les identifiants de votre base MariaDB/MySQL

---

**Modifications ALTER par rapport au schéma initial :**
- `Utilisateur` : ajout de `nom`, `prenom`, `nomdep`, `num_tel`
- `Mission` : ajout de `Lieu`

---

## 2. Rôles

| Rôle | Permissions | Redirection après connexion |
|---|---|---|
| **lecture** | Planning uniquement | `planning` |
| **gestionnaire** | Planning + Missions + Ajout sauveteur | `operations` |
| **administration** | Tout + Gestion des comptes | `modif_utilisateurs_form` |

---

## 3. Comptes de test

| Login | Mot de passe | Rôle |
|---|---|---|
| `vverdon` | `gtrnet` | administration |
| `admin` | `admin` | administration |
| `gestionnaire` | `gestionnaire` | gestionnaire |
| `lecture` | `lecture` | lecture |

---

## 4. Sécurité

- **PDO** avec requêtes préparées et paramètres nommés (`:login`, `:date`)
- **password_hash()** (bcrypt) pour le stockage des mots de passe
- **password_verify()** pour la vérification à la connexion
- **session_regenerate_id(true)** après authentification
- **Regex** de validation des routes : `preg_match('#^[a-zA-Z0-9 _]*$#')`
- **htmlentities()** sur toutes les sorties utilisateur (protection XSS)

---

## 5. Planning — Fonctionnement

- 48 créneaux de 30 minutes (00:00 à 23:30)
- 1 ligne par sauveteur
- Test de chevauchement créneau/mission avec `DateTime`
- 7 couleurs correspondant aux 7 statuts SSF
- Opacité réduite (0.4) + lettre "P" pour les missions en préparation
- Durée indéterminée : date de fin = `2099-12-31`
