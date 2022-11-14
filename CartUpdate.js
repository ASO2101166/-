aaaaaaa.addEventListener('click', function() {
    let data = document.querySelector('zouka').innerHTML;
    fetch('./CartUpdate/php', {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => response.json()) // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
    .then(res => {
        console.log(res); // やりたい処理
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
})