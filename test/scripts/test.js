new Vue({
    el: '#app',
    data() {
      return {
        items: [
          { name: "アイテム 1" },
          { name: "アイテム 2" },
          { name: "アイテム 3" }
        ],
        draggedItem: null,
      };
    },
    methods: {
      dragStart(item) {
        this.draggedItem = item;
      },
      drop() {
        alert(`${this.draggedItem.name} がドロップされました`);
        this.draggedItem = null;
      }
    }
  });