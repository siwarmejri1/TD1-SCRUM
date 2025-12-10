<?php
// Vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer et sécuriser les données
    $name = htmlspecialchars($_POST['name']);
    $arrival = htmlspecialchars($_POST['arrival']);
    $departure = htmlspecialchars($_POST['departure']);
    $adults = htmlspecialchars($_POST['adults']);
    $children = htmlspecialchars($_POST['children']);

    // Connexion à la base de données
    $host = "localhost";
    $dbname = "hotelDB";
    $username = "root";  // ton user MySQL
    $password = "";      // ton mot de passe MySQL

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer et exécuter la requête
        $stmt = $conn->prepare("INSERT INTO reservations (name, arrival, departure, adults, children) 
                                VALUES (:name, :arrival, :departure, :adults, :children)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':arrival', $arrival);
        $stmt->bindParam(':departure', $departure);
        $stmt->bindParam(':adults', $adults);
        $stmt->bindParam(':children', $children);

        $stmt->execute();

       // Message de succès
        echo "success|Merci $name, votre réservation a été enregistrée !";

    } catch(PDOException $e) {
        // Message d'erreur
        echo "error|Erreur : " . $e->getMessage();
    }
}
?>
