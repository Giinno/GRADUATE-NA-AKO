<?php
// Path to the statistics.php file
$file_path = 'statistics.php';

// Function to read the content of the file
function readContent($file_path) {
    if (file_exists($file_path)) {
        return json_decode(file_get_contents($file_path), true);
    } else {
        return [];
    }
}

// Function to write the content to the file
function writeContent($file_path, $content) {
    file_put_contents($file_path, json_encode($content, JSON_PRETTY_PRINT));
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $players = readContent($file_path);
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $new_player = [
                    'id' => uniqid(),
                    'name' => $_POST['name'],
                    'team' => $_POST['team'],
                    'position' => $_POST['position'],
                    'stats' => $_POST['stats']
                ];
                $players[] = $new_player;
                break;

            case 'update':
                foreach ($players as &$player) {
                    if ($player['id'] == $_POST['id']) {
                        $player['name'] = $_POST['name'];
                        $player['team'] = $_POST['team'];
                        $player['position'] = $_POST['position'];
                        $player['stats'] = $_POST['stats'];
                        break;
                    }
                }
                break;

            case 'delete':
                $players = array_filter($players, function($player) {
                    return $player['id'] != $_POST['id'];
                });
                break;
        }
        writeContent($file_path, $players);
    }
    header('Location: cms.php');
    exit;
}

$players = readContent($file_path);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Content Management System</title>
    <style>
        textarea {
            width: 100%;
            height: 100px;
        }
        input, button {
            display: block;
            margin: 5px 0;
        }
        .player {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Player Management System</h1>

    <h2>Add Player</h2>
    <form method="post">
        <input type="hidden" name="action" value="create">
        <label>Name: <input type="text" name="name" required></label>
        <label>Team: <input type="text" name="team" required></label>
        <label>Position: <input type="text" name="position" required></label>
        <label>Stats: <textarea name="stats" required></textarea></label>
        <button type="submit">Add Player</button>
    </form>

    <h2>Players List</h2>
    <?php foreach ($players as $player): ?>
        <div class="player">
            <form method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($player['id']); ?>">
                <label>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($player['name']); ?>" required></label>
                <label>Team: <input type="text" name="team" value="<?php echo htmlspecialchars($player['team']); ?>" required></label>
                <label>Position: <input type="text" name="position" value="<?php echo htmlspecialchars($player['position']); ?>" required></label>
                <label>Stats: <textarea name="stats" required><?php echo htmlspecialchars($player['stats']); ?></textarea></label>
                <button type="submit" name="action" value="update">Update Player</button>
                <button type="submit" name="action" value="delete">Delete Player</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
