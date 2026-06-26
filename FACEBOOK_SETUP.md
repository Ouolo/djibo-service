# Configuration Facebook pour la publication automatique de produits

Pour activer la publication de produits sur Facebook, vous devez configurer les variables d'environnement suivantes dans votre fichier `.env` :

## Variables à ajouter au fichier .env

```
FACEBOOK_APP_ID=votre_app_id
FACEBOOK_APP_SECRET=votre_app_secret
FACEBOOK_PAGE_ID=votre_page_id
FACEBOOK_PAGE_ACCESS_TOKEN=votre_token_dacces
```

## Comment obtenir ces credentials

### 1. Facebook App ID et App Secret
- Accédez à [Facebook Developers](https://developers.facebook.com/)
- Créez une nouvelle application (ou utilisez une existante)
- Allez dans Settings > Basic
- Copiez l'**App ID** et l'**App Secret**

### 2. Facebook Page ID
- Allez sur votre page Facebook
- Cliquez sur "À propos" ou allez dans les paramètres
- Trouvez votre **Page ID** ou utilisez l'URL de votre page

### 3. Facebook Page Access Token
- Allez dans [Graph API Explorer](https://developers.facebook.com/tools/explorer)
- Sélectionnez votre app dans le sélecteur en haut à gauche
- Sélectionnez votre page Facebook
- Générez un **User Token** (avec les permissions `pages_manage_posts`)
- Ensuite, générez un **Page Token** qui n'expire pas

## Permissions requises

Assurez-vous que votre token a les permissions suivantes :
- `pages_manage_posts` - Pour publier des posts
- `pages_read_engagement` - Pour lire les engagements

## Comment utiliser

1. Configurez les variables d'environnement dans `.env`
2. Allez dans l'admin → Produits
3. Chaque produit aura un bouton "Publier sur Facebook" bleu
4. Cliquez sur le bouton pour publier le produit sur votre page Facebook
5. Le statut passera à "Publié" une fois publié avec succès

## Résolution des problèmes

- **Erreur: Token d'accès Facebook non configuré** → Vérifiez que toutes les variables sont configurées dans `.env`
- **Erreur Facebook SDK** → Vérifiez que vos credentials sont corrects
- **Erreur de permission** → Assurez-vous que votre token a les bonnes permissions
- **Les logs** → Consultez `storage/logs/laravel.log` pour plus de détails
