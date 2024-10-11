
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<link href="../css/project-kanri.css" rel="stylesheet">
    <title>プロジェクト管理</title>
</head>
<body>

<div id="app">
  <!-- ヘッダー -->
  <header>
    <h1>プロジェクト管理</h1>
    <button @click="createNewProject">+ 新規プロジェクト作成</button>
  </header>

  <!-- 検索フィルター -->
  <div>
    <input v-model="searchQuery" placeholder="プロジェクト名で検索" />
  </div>

  <!-- プロジェクト一覧 -->
  <div v-if="filteredProjects.length > 0">
    <div v-for="(project, index) in filteredProjects" :key="project.id" class="project-card">
      <h3>{{ project.name }}</h3>
      <p>作成日: {{ project.created }}</p>
      <p>更新日: {{ project.updated }}</p>
      <button @click="openProject(index)">開く</button>
      <button @click="exportProject(index)">エクスポート</button>
      <button @click="deleteProject(index)">削除</button>
    </div>
  </div>
  <div v-else>
    <p>プロジェクトがありません。</p>
  </div>
</div>
<script src="../script/project-kanri.js"></script>
</body>
</html>