function genshou(e,cart_id,hiki){
    if(e.target.parentNode.querySelector('.cartkosuu').innerHTML > 1){
        e.target.disabled = true;
        document.querySelector('.totalprice').innerHTML = document.querySelector('.totalprice').innerHTML - e.target.parentNode.parentNode.parentNode.querySelector('.unit_pricevalue').value * e.target.parentNode.parentNode.parentNode.querySelector('.quantityvalue').value;
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
            // やりたい処理
            e.target.parentNode.querySelector('.cartkosuu').innerHTML = res;
            e.target.parentNode.parentNode.parentNode.querySelector('.quantityvalue').value = res;
            document.querySelector('.totalprice').innerHTML = Number(document.querySelector('.totalprice').innerHTML) + e.target.parentNode.parentNode.parentNode.querySelector('.unit_pricevalue').value * res;
            if(Number(document.querySelector('.totalprice').innerHTML) >= 10000){
                document.querySelector('.muryou').querySelector('.uline').innerHTML = '無料配送まで：到達しました';
            }else{
                document.querySelector('.muryou').querySelector('.uline').innerHTML = '無料配送まで：￥' + (10000 - document.querySelector('.totalprice').innerHTML).toLocaleString();;
            }
            document.querySelector('.kakutokupoint').querySelector('.uline').innerHTML = '獲得ポイント：￥' + (document.querySelector('.totalprice').innerHTML * 0.02).toLocaleString();
            e.target.disabled = false;
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
    }
}

function zouka(e,cart_id,tasi){
    e.target.disabled = true;
    document.querySelector('.totalprice').innerHTML = document.querySelector('.totalprice').innerHTML - e.target.parentNode.parentNode.parentNode.querySelector('.unit_pricevalue').value * e.target.parentNode.parentNode.parentNode.querySelector('.quantityvalue').value;
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
        // やりたい処理
        e.target.parentNode.querySelector('.cartkosuu').innerHTML = res;
        e.target.parentNode.parentNode.parentNode.querySelector('.quantityvalue').value = res;
        document.querySelector('.totalprice').innerHTML = Number(document.querySelector('.totalprice').innerHTML) + e.target.parentNode.parentNode.parentNode.querySelector('.unit_pricevalue').value * res;
        if(Number(document.querySelector('.totalprice').innerHTML) >= 10000){
            document.querySelector('.muryou').querySelector('.uline').innerHTML = '無料配送まで：到達しました';
        }else{
            document.querySelector('.muryou').querySelector('.uline').innerHTML = '無料配送まで：￥' + (10000 - document.querySelector('.totalprice').innerHTML).toLocaleString();
        }
        document.querySelector('.kakutokupoint').querySelector('.uline').innerHTML = '獲得ポイント：￥' + (document.querySelector('.totalprice').innerHTML * 0.02).toLocaleString();
        e.target.disabled = false;
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}