new Vue({
    el: "#app",
    data: {
      projects: [], // プロジェクト一覧
      searchQuery: "", // 検索クエリ
    },
    mounted() {
      // ローカルストレージからプロジェクトデータを取得
      const savedProjects = localStorage.getItem("projects");
      if (savedProjects) {
        this.projects = JSON.parse(savedProjects);
      }
    },
    computed: {
      // 検索クエリに基づいてフィルターされたプロジェクト
      filteredProjects() {
        return this.projects.filter(project =>
          project.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      }
    },
    methods: {
      // 新しいプロジェクトを作成
      createNewProject() {
        const newProject = {
          id: Date.now(),
          name: `新規プロジェクト ${this.projects.length + 1}`,
          created: new Date().toLocaleDateString(),
          updated: new Date().toLocaleDateString(),
        };
        this.projects.push(newProject);
        this.saveProjects();
      },
      // プロジェクトを開く（ダミー機能、詳細画面に遷移可能）
      openProject(index) {
        alert(`プロジェクト「${this.projects[index].name}」を開く`);
      },
      // プロジェクトをエクスポート（JSON形式でダウンロード）
      exportProject(index) {
        const project = this.projects[index];
        const projectData = JSON.stringify(project, null, 2);
        const blob = new Blob([projectData], { type: "application/json" });
        const url = URL.createObjectURL(blob);
  
        const a = document.createElement("a");
        a.href = url;
        a.download = `${project.name}.json`;
        a.click();
        URL.revokeObjectURL(url);
      },
      // プロジェクトを削除
      deleteProject(index) {
        if (confirm(`プロジェクト「${this.projects[index].name}」を削除してもよろしいですか？`)) {
          this.projects.splice(index, 1);
          this.saveProjects();
        }
      },
      // ローカルストレージにプロジェクトを保存
      saveProjects() {
        localStorage.setItem("projects", JSON.stringify(this.projects));
      }
    }
  });
  