<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Usuari - Restaurant</title>
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
        <h1 class="text-center mb-4">Chat de <?php echo $_SESSION['logged_user']['username'] ?> - Restaurant</h1>
        <div id="chatContainer">
            <?php
            $currentUser = $_SESSION['logged_user']['username'] ?? null;
            $currentUserMessages = $params['messages'][$currentUser] ?? [];

            foreach ($currentUserMessages as $message) {
                if (is_array($message) && isset($message['content'], $message['type'])) {
                    $messageClass = ($message['type'] === 'admin') ? 'admin-message' : 'client-message';
                    $messageSender = ($message['type'] === 'admin') ? ' (Restaurant)' : ' (' . $_SESSION['logged_user']['username'] . ')';
                    $avatarSrc = ($message['type'] === 'admin') ? '../../../Public/Assets/images/profile_images/restaurant.jpg' : '../../../Public/Assets/images/profile_images/' . $_SESSION['logged_user']['username'] . '.jpg';
            ?>
                    <div class="message <?php echo $messageClass; ?>">
                        <img src="<?php echo $avatarSrc; ?>" alt="Perfil de <?php echo $_SESSION['logged_user']['username']; ?>" class="user-avatar">
                        <div>
                            <?php echo htmlspecialchars($message['content']) . $messageSender; ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <form action="/user/sendMessage" method="post">
            <div class="form-group">
                <input type="text" name="message" class="form-control" placeholder="Escriu el teu missatge...">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>