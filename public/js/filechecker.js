const sizeLimit = 1024 * 50;　// 制限サイズ1024 *1024 *1
const fileInput = document.getElementById('file'); // input要素
// changeイベントで呼び出す関数
const handleFileSelect = () => {
  const files = fileInput.files;
  for (let i = 0; i < files.length; i++) {
    if (files[i].size > sizeLimit) {
      // ファイルサイズが制限以上
      alert('ファイルサイズは50KB以下にしてください'); // エラーメッセージを表示
      fileInput.value = ''; // inputの中身をリセット
      return; // この時点で処理を終了する
    }
  }
}
fileInput.addEventListener('change', handleFileSelect, false);
