// function allowDrop(ev) {
//     ev.preventDefault();  // ドロップを許可
// }

// function drag(ev) {
//     // ドラッグする要素のIDを設定
//     const targetId = ev.target.id;  // ドラッグ対象のIDを取得
//     console.log("ドラッグ中の要素ID:", targetId);  // デバッグ用
//     ev.dataTransfer.setData("text/plain", targetId);
// }

// function drop(ev) {
//     ev.preventDefault();  // デフォルトの動作を防ぐ
//     const data = ev.dataTransfer.getData("text/plain");  // データを取得
//     const draggedElement = document.getElementById(data);

//     if (ev.target.id === "dropArea1") {
//         // ドロップエリアに新しい要素を追加する場合
//         if (data === "drag1") {
//             const wrapperDiv = createWrapper("input");
//             ev.target.appendChild(wrapperDiv);
//         } else if (data === "drag2") {
//             const wrapperDiv = createWrapper("button");
//             ev.target.appendChild(wrapperDiv);
//         }
//     } else if (ev.target.classList.contains("div")) {
//         // 既存の要素の上にドロップした場合、入れ替え
//         ev.target.parentNode.insertBefore(draggedElement, ev.target.nextSibling);
//     }
// }
// function drop2(ev) {
//     ev.preventDefault();  // デフォルトの動作を防ぐ
//     const data = ev.dataTransfer.getData("text/plain");  // データを取得
//     const draggedElement = document.getElementById(data);

//     if (ev.target.id === "dropArea1") {
//         // ドロップエリアに新しい要素を追加する場合
//         if (data === "drag1") {
//             const wrapperDiv = createWrapper("input");
//             ev.target.appendChild(wrapperDiv);
//         } else if (data === "drag2") {
//             const wrapperDiv = createWrapper("button");
//             ev.target.appendChild(wrapperDiv);
//         }
//     } else if (ev.target.classList.contains("div")) {
//         // 既存の要素の上にドロップした場合、入れ替え
//         ev.target.parentNode.insertBefore(draggedElement, ev.target.nextSibling);
//     }
// }

// function createWrapper(type) {
//     const wrapperDiv = document.createElement("div");
//     wrapperDiv.className = "div";
//     wrapperDiv.draggable = "true";
//     wrapperDiv.ondragstart = drag2;

//     if (type === "input") {
//         wrapperDiv.id = "drag1";
//         const input = document.createElement("input");
//         input.type = "text";
//         wrapperDiv.appendChild(input);
//     } else if (type === "button") {
//         wrapperDiv.id = "drag2";
//         const button = document.createElement("button");
//         button.textContent = "新しいボタン";
//         button.style.color = "red";  // ボタンの色を赤に設定
//         wrapperDiv.appendChild(button);
//     }
//     return wrapperDiv;
// }

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