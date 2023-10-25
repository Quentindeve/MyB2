#set document(title: "Compte-rendu Site Vitrine B2", author: "DUTILLEUL Quentin")
#set heading(numbering: "I", bookmarked: true)
#set text(font: "Liberation Sans")

#show heading: set text(fill: red, weight: "bold", style: "oblique")

= Tâche à réaliser

Le projet est un site vitrine pour une boutique de jeux-vidéos. Ce site est composé de :

- Une page d’accueil *index.php* présentant les principaux aspects de l’entreprise, ses produits phare, sa localisation.

- Un page listant tous les produits *products.php* affichant la liste des produits. Il est possible de les trier par prix, ainsi que de les filtrer par titre, prix, description et catégorie.

- Une page montrant le détail du produit *product_page.php* montrant les détails du produit choisi, et permettant de rentrer une note de celui-ci.

- Une page de statistiques *statistics.php* affichant avec des graphiques différentes données sur les produits proposés en boutique.

- Une page permettant d’ajouter un produit *add_product.php*, de le supprimer *delete_product.php* ou de le modifier *edit_product.php*.

= Screenshots

#figure(
  image("images/index.png", width: 80%),
  caption: [
    Page index.php.
  ],
)

#figure(
  image("images/products.png", width: 80%),
  caption: [
    Page products.php.
  ],
)


#figure(
  image("images/product_page.png", width: 80%),
  caption: [
    Page product_page.php.
  ],
)

#figure(
  image("images/stats.png", width: 80%),
  caption: [
    Page statistics.php.
  ],
)

#figure(
  image("images/add_product.png", width: 80%),
  caption: [
    Page add_product.php.
  ],
)

#figure(
  image("images/delete_product.png", width: 80%),
  caption: [
    Page delete_product.php.
  ],
)

#figure(
  image("images/edit_product.png", width: 80%),
  caption: [
    Page edit_product.php.
  ],
)