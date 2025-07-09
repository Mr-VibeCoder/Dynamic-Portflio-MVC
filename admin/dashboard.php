<?php
session_start();
include '../includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// ADD project
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
    $badge = $_POST['badge'];

    $stmt = $conn->prepare("INSERT INTO projects (title, description, link, icon, badge) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $link, $icon, $badge);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit();
}

// DELETE project
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM projects WHERE id=$id");
    header("Location: dashboard.php");
    exit();
}

// UPDATE project
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $icon = $_POST['icon'];
    $badge = $_POST['badge'];

    $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, link=?, icon=?, badge=? WHERE id=?");
    $stmt->bind_param("sssssi", $title, $description, $link, $icon, $badge, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Mr Vibe Coder</title>
    <link rel="icon" href="https://img.icons8.com/ios-filled/50/ffffff/administrator-male.png" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="bg-gray-950 text-white p-8">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-400"><i class="fas fa-cogs mr-2"></i>Dashboard</h1>
            <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white font-semibold">Logout</a>
        </div>

        <!-- Add Project -->
        <div class="bg-gray-900 p-6 rounded-xl mb-8">
            <h2 class="text-xl font-semibold mb-4">Add New Project</h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" autocomplete="off" name="title" placeholder="Title" required class="px-4 py-2 rounded bg-gray-800">
                <input type="text" autocomplete="off" name="icon" placeholder="Font Awesome Icon (e.g., fa-code)" required class="px-4 py-2 rounded bg-gray-800">
                <input type="text" autocomplete="off" name="badge" placeholder="Badge (e.g., Bolt.new)" class="px-4 py-2 rounded bg-gray-800">
                <input type="url" autocomplete="off" name="link" placeholder="Project Link (optional)" class="px-4 py-2 rounded bg-gray-800">
                <textarea name="description" placeholder="Project Description" required class="px-4 py-2 rounded bg-gray-800 md:col-span-2"></textarea>
                <button type="submit" name="add" class="bg-purple-500 hover:bg-purple-600 px-6 py-2 rounded font-semibold md:col-span-2">Add Project</button>
            </form>
        </div>
        <!-- Project List with Modal -->
        <div class="bg-gray-900 p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-semibold mb-6 text-purple-300"><i class="fas fa-list-ul mr-2"></i>All Projects</h2>

            <?php
            $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            while ($row = $result->fetch_assoc()):
                $modalId = "modal_" . $row['id'];
            ?>
                <!-- Project Title Button -->
                <button onclick="document.getElementById('<?= $modalId ?>').classList.remove('hidden')"
                    class="flex items-center justify-between w-full text-left text-lg font-medium text-white hover:text-purple-400 mb-2 p-3 rounded-lg bg-gray-800 hover:bg-gray-700 transition">
                    <div><i class="fas fa-folder-open mr-2 text-purple-400"></i><?= htmlspecialchars($row['title']) ?></div>
                    <i class="fas fa-pen text-gray-400 text-sm"></i>
                </button>

                <!-- Modal -->
                <div id="<?= $modalId ?>" class="fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center hidden">
                    <div class="bg-gray-900 p-6 rounded-xl w-full max-w-xl relative shadow-2xl border border-purple-600">
                        <!-- Close Button -->
                        <button onclick="document.getElementById('<?= $modalId ?>').classList.add('hidden')"
                            class="absolute top-2 right-3 text-gray-300 text-2xl hover:text-red-400 transition">
                            <i class="fas fa-times"></i>
                        </button>

                        <!-- Modal Form -->
                        <h3 class="text-xl font-semibold mb-4 text-purple-300 flex items-center">
                            <i class="fas fa-pencil-alt mr-2 text-purple-400"></i>Edit Project
                        </h3>

                        <form method="POST" class="grid gap-4 mt-2">
                            <input type="hidden" autocomplete="off" name="id" value="<?= $row['id'] ?>">

                            <div class="flex items-center">
                                <i class="fas fa-heading mr-3 text-purple-400"></i>
                                <input type="text" autocomplete="off" name="title" value="<?= htmlspecialchars($row['title']) ?>" required class="p-3 bg-gray-800 rounded w-full" placeholder="Project Title">
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-icons mr-3 text-purple-400"></i>
                                <input type="text" autocomplete="off" name="icon" value="<?= htmlspecialchars($row['icon']) ?>" required class="p-3 bg-gray-800 rounded w-full" placeholder="Font Awesome Icon (fa-...)">
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-tag mr-3 text-purple-400"></i>
                                <input type="text" autocomplete="off" name="badge" value="<?= htmlspecialchars($row['badge']) ?>" class="p-3 bg-gray-800 rounded w-full" placeholder="Badge">
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-link mr-3 text-purple-400"></i>
                                <input type="url" autocomplete="off" name="link" value="<?= htmlspecialchars($row['link']) ?>" class="p-3 bg-gray-800 rounded w-full" placeholder="Project URL">
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-align-left mr-3 text-purple-400 mt-3"></i>
                                <textarea name="description" class="p-3 bg-gray-800 rounded w-full" placeholder="Description" required><?= htmlspecialchars($row['description']) ?></textarea>
                            </div>

                            <div class="flex gap-3 mt-4">
                                <button type="submit" name="update" class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-black font-bold px-4 py-2 rounded w-full transition">
                                    <i class="fas fa-save"></i> Update
                                </button>
                                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this project?')"
                                    class="flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded w-full transition">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>

            <?php if ($result->num_rows === 0): ?>
                <p class="text-gray-400 text-center">No projects found.</p>
            <?php endif; ?>
        </div>


</body>

</html>