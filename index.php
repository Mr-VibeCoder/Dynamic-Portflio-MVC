<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vibe Coder - My Creations Vault</title>
  <meta name="description" content="Portfolio of Vibe Coder - Transforming Ideas into Reality Using AI" />
  <link rel="icon" href="https://img.icons8.com/ios-filled/50/ffffff/user.png" type="image/png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
  <style>
    :root {
      --bg-main: #0f0f0f;
      --card-bg: #1a1a1a;
      --accent: #a855f7;
      --text: #e5e7eb;
    }

    body.theme-default {
      --bg-main: #0f0f0f;
      --card-bg: #1a1a1a;
      --accent: #a855f7;
      --text: #e5e7eb;
    }

    body.theme-cyberpunk {
      --bg-main: #050505;
      --card-bg: #0d0d0d;
      --accent: #00f0ff;
      --text: #e0f7ff;
    }

    body.theme-minimal {
      --bg-main: #111111;
      --card-bg: #1c1c1c;
      --accent: #cccccc;
      --text: #eeeeee;
    }

    body.theme-neon {
      --bg-main: #000000;
      --card-bg: #121212;
      --accent: #336699;
      --text: #d4ffd4;
    }

    body {
      background: url('https://www.transparenttextures.com/patterns/dark-mosaic.png'), var(--bg-main);
      color: var(--text);
    }

    .card {
      background-color: var(--card-bg);
      border: 1px solid #333;
    }

    .btn {
      background-color: var(--accent);
      color: #000;
    }

    .btn:hover {
      filter: brightness(1.1);
    }

    .accent-text {
      color: var(--accent);
    }

    .badge {
      background-color: var(--accent);
      color: #000;
    }
  </style>
</head>

<body class="font-sans transition-all duration-300">

<!-- Theme Toggle -->
<div class="fixed top-4 right-4 z-50 flex items-center gap-2 bg-white px-3 py-2 rounded-full shadow-md">
  <button id="themeToggle" class="text-xl text-black" title="Select Theme"><i class="fa-solid fa-palette"></i></button>
  <div id="themeMenu" class="flex items-center gap-2 hidden">
    <div onclick="applyTheme('default')" class="w-5 h-5 rounded-full cursor-pointer" style="background-color: #a855f7;" title="Purple"></div>
    <div onclick="applyTheme('cyberpunk')" class="w-5 h-5 rounded-full cursor-pointer" style="background-color: #00f0ff;" title="Cyber"></div>
    <div onclick="applyTheme('minimal')" class="w-5 h-5 rounded-full cursor-pointer" style="background-color: #cccccc;" title="Minimal"></div>
    <div onclick="applyTheme('neon')" class="w-5 h-5 rounded-full cursor-pointer" style="background-color: #336699;" title="Neon"></div>
  </div>
</div>

<!-- Hero Section -->
<section class="min-h-screen flex flex-col justify-center items-center text-center px-6 relative">
  <div class="w-full max-w-4xl animate-fade-in z-10">
    <div class="w-24 h-24 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg" style="background: var(--accent);">
      <i class="fas fa-user text-black text-3xl"></i>
    </div>
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-wide accent-text">Vibe Coder</h1>
    <p class="text-xl md:text-2xl text-gray-400 mb-8">Transforming Ideas into Reality Using AI</p>
  </div>
  <a href="#projects" class="absolute bottom-10 animate-bounce z-10">
    <i class="fas fa-chevron-down text-xl accent-text"></i>
  </a>
</section>

<!-- Projects Section -->
<section id="projects" class="py-20 px-6 max-w-7xl mx-auto">
  <h2 class="text-4xl font-bold mb-16 text-center accent-text">My Creations Vault</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

    <?php
    $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
    while ($row = $result->fetch_assoc()):
    ?>
    <div class="card rounded-2xl p-6 shadow-md hover:shadow-xl transition hover:scale-105 duration-300">
      <div class="flex items-center mb-4">
        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: var(--accent);">
          <i class="fas <?= htmlspecialchars($row['icon']) ?> text-black"></i>
        </div>
        <h3 class="text-xl font-semibold"><?= htmlspecialchars($row['title']) ?></h3>
      </div>
      <span class="text-sm badge rounded-full px-3 py-1 mb-4 inline-block"><?= htmlspecialchars($row['badge']) ?></span>
      <p class="text-gray-400 mb-6"><?= htmlspecialchars($row['description']) ?></p>
      <?php if (!empty($row['link'])): ?>
        <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="block w-full py-2 text-center rounded-xl btn font-semibold transition">View Project</a>
      <?php endif; ?>
    </div>
    <?php endwhile; ?>

  </div>
</section>

<!-- Contact -->
<section class="py-20 px-6 text-center border-t border-gray-800">
  <h2 class="text-3xl font-bold mb-6 accent-text">Get in Touch</h2>
  <div class="flex justify-center space-x-6 text-3xl">
    <a href="mailto:vibecoder83@gmail.com" target="_blank" class="text-gray-400 hover:text-white transition">
      <i class="fas fa-envelope"></i>
    </a>
    <a href="https://github.com/Mr-VibeCoder/" target="_blank" class="text-gray-400 hover:text-white transition">
      <i class="fab fa-github"></i>
    </a>
  </div>
</section>

<!-- Footer -->
<footer class="text-center py-6 border-t border-gray-800 text-gray-500 text-sm">
  &copy; <?= date('Y') ?> All rights reserved by 
  <a href="http://bhojanapudevaraj.free.nf" target="_blank" class="accent-text font-semibold">Mr.VibeCoder</a> | 
  <a href="admin/login.php" class="text-gray-400 font-bold hover:text-purple-600">Admin</a>
</footer>

<!-- Theme Script -->
<script>
  const applyTheme = (theme) => {
    document.body.classList.remove('theme-default', 'theme-cyberpunk', 'theme-minimal', 'theme-neon');
    document.body.classList.add(`theme-${theme}`);
    document.getElementById('themeMenu').classList.add('hidden');
  };
  applyTheme('default');
  document.getElementById('themeToggle').addEventListener('click', () => {
    document.getElementById('themeMenu').classList.toggle('hidden');
  });
  document.addEventListener('click', (e) => {
    const btn = document.getElementById('themeToggle');
    const menu = document.getElementById('themeMenu');
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.add('hidden');
    }
  });
</script>

<!-- GSAP Animation -->
<script>
  gsap.from(".animate-fade-in", {
    opacity: 0,
    y: 50,
    duration: 1,
    ease: "power3.out"
  });
</script>

</body>
</html>
