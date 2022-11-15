document.querySelector('.zouka').addEventListener('click', function() {
    let data = document.querySelector('.text').innerHTML;
    fetch('CartUpdate.php', {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then((response) => {
        if(!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }   
        return response.json()
    })
    .then(res => {
        console.log(res); // やりたい処理
        document.querySelector('.text').innerHTML += ' ' + res;
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
    console.log(JSON.stringify(data));
})