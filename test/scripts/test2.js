new Vue({
  el: '#app',
  data: {
    components: [],
    selectedComponent: null,
    draggedComponent: null,
    offsetX: 0,
    offsetY: 0,
    sidebarOpen: false, // サイドバーの開閉状態を管理
    sidebarOpen2: false, // サイドバーの開閉状態を管理
    sidebarOpen3: false, // サイドバーの開閉状態を管理
    sidebarOpen4: false, // サイドバーの開閉状態を管理
    sidebarOpen5: false, // サイドバーの開閉状態を管理
    // テキストエリアの内容を管理
    // inputContent: ''
    activeTab: 'html'  // 初期タブをHTMLに設定
  },
  methods: {
    // ドラッグ開始時にコンポーネントのタイプを保持
    startDrag(type, event, def) {
      this.draggedComponent = { type, x: 0, y: 0, width: 150, placeholder: def, text: def };
    },
    // ドラッグ開始
    dragStart(index, event) {
      this.selectedComponent = index;  // 選択されたコンポーネントのインデックスを追跡
      const component = this.components[index];
      this.offsetX = event.clientX - component.x;
      this.offsetY = event.clientY - component.y;
    },
    // ドロップ後にcomponentsを並び替える
    sortComponentsByPosition() {
      this.components.sort((a, b) => {
        // x座標に基づいて昇順で並べ替える
        // return a.x - b.x;

        // y座標に基づいて昇順で並べ替える
        return a.y - b.y;
      });
    },
    // ドラッグ終了時の位置更新
    dragEnd(event) {
      // const x = event.clientX - this.offsetX;
      // const y = event.clientY - this.offsetY;

      // if (this.selectedComponent !== null) {
      //   this.$set(this.components, this.selectedComponent, {
      //     ...this.components[this.selectedComponent],
      //     x: x,
      //     y: y
      //   });
      // }
      if (this.movingComponent !== null) {
        const dropzoneRect = this.$refs.dropzone.getBoundingClientRect();
        let x = event.clientX - this.offsetX;
        let y = event.clientY - this.offsetY;

        // ドロップゾーン内に座標を制限
        if (x < 0) x = 0;
        if (y < 0) y = 0;
        if (x > dropzoneRect.width - 100) x = dropzoneRect.width - 100;
        if (y > dropzoneRect.height - 30) y = dropzoneRect.height - 30;

        // 選択されたコンポーネントの位置を更新
        this.$set(this.components, this.selectedComponent, {
          ...this.components[this.selectedComponent],
          x: x,
          y: y
        });
      }
      this.selectedComponent = null; // ドラッグが終わったら選択を解除
      this.sortComponentsByPosition();
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
      // 新しいコンポーネントが追加された後に並べ替え
      this.sortComponentsByPosition();
    },
    // コンポーネントを選択
    selectComponent(index) {this.selectedComponent = index;},
    toggleSidebar() {this.sidebarOpen = !this.sidebarOpen;},
    toggleSidebar2() {this.sidebarOpen2 = !this.sidebarOpen2;},
    toggleSidebar3() {this.sidebarOpen3 = !this.sidebarOpen3;},
    toggleSidebar4() {this.sidebarOpen4 = !this.sidebarOpen4;},
    toggleSidebar5() {this.sidebarOpen5 = !this.sidebarOpen5;}
  },
  computed: {
    generatedCode() {
      // return this.droppedComponents.map(comp => {
      //   if (comp.type === 'button') {
      //     return '<button>ボタン</button>';
      //   } else if (comp.type === 'input') {
      //     return '<input type="text" />';
      //   }
      // }).join('\n');
      return this.components.map(comp => {
        if (comp.type === 'button') {
          return '<button>'+comp.text+'</button>';
        } else if (comp.type === 'text') {
          return '<h3>'+comp.text+'</h3>';
        } else if(comp.type === 'textbox'){
          return '<input type="text" />';
        }
      }).join('\n');
    }
  },
  mounted() {
    // ドラッグ中の動きを追跡するためにwindowにmousemoveとmouseupイベントを登録
    window.addEventListener('mousemove', this.dragMove);
    window.addEventListener('mouseup', this.dragEnd);
  }
});
// console.log(this.data);