document.querySelector('.plus-btn').addEventListener('click', function() {
    const data = {
        kosuu: document.querySelector('.cartkosuu').innerHTML,
        cart_id: document.querySelector('.cart_id').innerHTML,
        check: document.querySelector('.tasi').innerHTML
    }
    fetch('php/CartUpdate.php', {
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
        document.querySelector('.cartkosuu').innerHTML = res;
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
    console.log(JSON.stringify(data));
})

document.querySelector('.minus-btn').addEventListener('click', function() {
    if(document.querySelector('.cartkosuu').innerHTML > 1){
        const data = {
            kosuu: document.querySelector('.cartkosuu').innerHTML,
            cart_id: document.querySelector('.cart_id').innerHTML,
            check: document.querySelector('.hiki').innerHTML
        }
        fetch('php/CartUpdate.php', {
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
            document.querySelector('.cartkosuu').innerHTML = res;
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
        console.log(JSON.stringify(data));
    }
})