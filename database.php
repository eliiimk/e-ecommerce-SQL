<?php

// Détails de la base de données
$host = '127.0.0.1';
$dbname = 'ecommerce';
$user = 'root';
$port = 3308;
$password = '';

try {
    // Créer une connexion PDO
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Message de connexion réussie
    echo "Connexion réussie à la base de données.\n";

    // Insertion dans la table product
    $sql = "INSERT INTO product(nom, prix) VALUES (:nom, :prix)";
    $stmt = $pdo->prepare($sql);

    $products = [
        ['nom' => 'Airpods', 'prix' => 200],
        ['nom' => 'AirTag', 'prix' => 45],
    ];

    foreach ($products as $product) {
        $stmt->execute($product);
        echo "Produit ajouté : {$product['nom']} - {$product['prix']}€\n";
    }

    // Insertion dans la table user
    $sql = "INSERT INTO user(username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);

    $userData = [
        'username' => 'eliiimk',
        'email' => 'elimoktar@ynov.com',
        'password' => password_hash("Em2910", PASSWORD_DEFAULT),
    ];
    $stmt->execute($userData);

    echo "Utilisateur ajouté : {$userData['username']} - {$userData['email']}\n";

    // Insertion dans la table command
    $sql = "INSERT INTO command (statut, date, id_user) VALUES (:statut, current_timestamp(), :id_user)";
    $stmt = $pdo->prepare($sql);

    $commandData = [
        'statut' => 'en cours',
        'id_user' => 1,
    ];
    $stmt->execute($commandData);

    echo "Commande ajoutée : Statut - {$commandData['statut']}, Utilisateur ID - {$commandData['id_user']}\n";

    // Insertion dans la table cart
    $sql = "INSERT INTO cart (product_id, list_id, id_user) VALUES (:product_id, :list_id, :id_user)";
    $stmt = $pdo->prepare($sql);

    $cartData = [
        'product_id' => 1,
        'list_id' => 1,
        'id_user' => 1,
    ];
    $stmt->execute($cartData);

    echo "Panier ajouté : Produit ID - {$cartData['product_id']}, Liste ID - {$cartData['list_id']}, Utilisateur ID - {$cartData['id_user']}\n";

    // Insertion dans la table adress
    $sql = "INSERT INTO adress (rue, ville, code_postale, id_user) VALUES (:rue, :ville, :code_postale, :id_user)";
    $stmt = $pdo->prepare($sql);

    $addressData = [
        'rue' => 'Avenue Marceau',
        'ville' => 'Trappes',
        'code_postale' => '78190',
        'id_user' => 1,
    ];
    $stmt->execute($addressData);

    echo "Adresse ajoutée : {$addressData['rue']}, {$addressData['ville']} - {$addressData['code_postale']}, Utilisateur ID - {$addressData['id_user']}\n";

    // Insertion dans la table invoice
    $sql = "INSERT INTO invoice (command_id, montant) VALUES (:command_id, :montant)";
    $stmt = $pdo->prepare($sql);

    $invoiceData = [
        'command_id' => 1,
        'montant' => 245.00,
    ];
    $stmt->execute($invoiceData);

    echo "Facture ajoutée : Commande ID - {$invoiceData['command_id']}, Montant - {$invoiceData['montant']}€\n";

    // Insertion dans la table list
    $sql = "INSERT INTO list (product_id, quantite, cart_id) VALUES (:product_id, :quantite, :cart_id)";
    $stmt = $pdo->prepare($sql);

    $listData = [
        'product_id' => 1,
        'quantite' => 1,
        'cart_id' => 1,
    ];
    $stmt->execute($listData);

    echo "Liste ajoutée : Produit ID - {$listData['product_id']}, Quantité - {$listData['quantite']}, Panier ID - {$listData['cart_id']}\n";
    
    $sql = "INSERT INTO payment (methode, command_id) VALUES (:methode, :command_id)";
    $stmt = $pdo->prepare($sql);

    $methode = 'Apple Pay';
    $command_id = 1;

    $stmt->bindParam(':methode', $methode);
    $stmt->bindParam(':command_id', $command_id);

    $stmt->execute();

    echo "Paiement ajouté : Méthode - $methode, Commande ID - $command_id\n";
    
    $sql = "INSERT INTO rate (product_id, note, commentaire, id_user) 
            VALUES (:product_id, :note, :commentaire, :id_user)";
    $stmt = $pdo->prepare($sql);

    $product_id = 2;
    $note = 9;
    $commentaire = 'Confort et son. Nouvelle évolution.';
    $id_user = 1;

    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':note', $note);
    $stmt->bindParam(':commentaire', $commentaire);
    $stmt->bindParam(':id_user', $id_user);

    $stmt->execute();

    echo "Évaluation ajoutée : Produit ID - $product_id, Note - $note, Commentaire - \"$commentaire\", Utilisateur ID - $id_user\n";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage() . "\n";
}
