function genshou(e,cart_id,hiki){
    if(e.target.parentNode.querySelector('.cartkosuu').innerHTML > 1){
        const data = {
            kosuu: e.target.parentNode.querySelector('.cartkosuu').innerHTML,
            cart_id: cart_id,
            check: hiki
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
            e.target.parentNode.querySelector('.cartkosuu').innerHTML = res;
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
        console.log(JSON.stringify(data));
    }
}

function zouka(e,cart_id,tasi){
    const data = {
        kosuu: e.target.parentNode.querySelector('.cartkosuu').innerHTML,
        cart_id: cart_id,
        check: tasi
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
        e.target.parentNode.querySelector('.cartkosuu').innerHTML = res;
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
    console.log(JSON.stringify(data));
}