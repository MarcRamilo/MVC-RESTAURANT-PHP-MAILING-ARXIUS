<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Administrador - Restaurant amb usuari <?php echo $params["username"] ?></title>
    <style>
        #chatContainer {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            height: 300px;
            overflow-y: scroll;

        }

        .message {
            margin-bottom: 10px;
        }

        .admin-message {

            background-color: #f0f0f0;
            color: #333;
            padding: 5px;
            border-radius: 5px;
        }

        .client-message {
            background-color: #d3ffd3;
            color: #006600;
            padding: 5px;
            border-radius: 5px;
        }
        .user-avatar {
            width: 30px; 
            height: 30px; 
            border-radius: 50%;
            margin-right: 10px; 
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Chat Administrador - Restaurant amb usuari <?php echo $params["username"] ?></h1>
        <div id="chatContainer">
            <?php
            $currentUserMessages = $params['messages'][$_SESSION['username_chat']] ?? [];

            foreach ($currentUserMessages as $message) {
                if (is_array($message) && isset($message['content'], $message['type'])) {
                    $messageClass = ($message['type'] === 'admin') ? 'admin-message' : 'client-message';
                    $messageSender = ($message['type'] === 'admin') ? ' (Restaurant)' : ' (' . $_SESSION['username_chat'] . ')';
                    // Definir la ruta de la imagen del remitente
                    $avatarSrc = ($message['type'] === 'admin') ? '../../../Public/Assets/images/profile_images/restaurant.jpg' : '../../../Public/Assets/images/profile_images/' . $_SESSION['username_chat'] . '.jpg';
            ?>
                    <div class="message <?php echo $messageClass; ?>">
                        <!-- Mostrar la imagen del remitente del mensaje -->
                        <img src="<?php echo $avatarSrc; ?>" alt="Avatar de <?php echo $_SESSION['username_chat']; ?>" class="user-avatar">
                        <div>
                            <?php echo htmlspecialchars($message['content']) . $messageSender; ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <form action="/user/sendMessageAdmin" method="post">
            <div class="form-group">
                <input type="text" name="message" class="form-control" placeholder="Escriu el teu missatge...">
                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($params['username']); ?>">

            </div>
            <input type="hidden" name="id_user" value="<?php echo $id_user['id_user']; ?>">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>