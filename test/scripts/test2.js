new Vue({
    el: '#app',
    data: {
      components: [],
      selectedComponent: null,
      draggedComponent: null,
      offsetX: 0,
      offsetY: 0,
      sidebarOpen: false, // サイドバーの開閉状態を管理
      sidebarOpen2: false // サイドバーの開閉状態を管理
    },
    methods: {
      // ドラッグ開始時にコンポーネントのタイプを保持
      startDrag(type, event, def) {
        this.draggedComponent = { type, x: 0, y: 0, width: 150, placeholder: def, text: def };
      },
      // ドラッグ開始
      dragStart(index, event) {
        const component = this.components[index];
        this.offsetX = event.clientX - component.x;
        this.offsetY = event.clientY - component.y;
      },
      // ドラッグ終了時の位置更新
      dragEnd(event) {
        const x = event.clientX - this.offsetX;
        const y = event.clientY - this.offsetY;
        if (this.selectedComponent !== null) {
          this.$set(this.components, this.selectedComponent, {
            ...this.components[this.selectedComponent],
            x: x,
            y: y
          });
        }
      },
      // ドロップ処理
      dropComponent(event) {
        const x = event.clientX - this.offsetX;
        const y = event.clientY - this.offsetY;
        if (this.draggedComponent) {
          this.draggedComponent.x = x;
          this.draggedComponent.y = y;
          this.components.push({ ...this.draggedComponent });
          this.draggedComponent = null;
        }
      },
      // コンポーネントを選択
      selectComponent(index) {
        this.selectedComponent = index;
      },
      toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen; // フラグを切り替える
      },
      toggleSidebar2() {
        this.sidebarOpen2 = !this.sidebarOpen2; // フラグを切り替える
      }
    }
  });